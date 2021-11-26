<?php

namespace App\Utils;

use App\Model\api\CourseAdditionalModel;
use App\Model\api\CourseDiscountModel;
use App\Model\api\CourseFormPaymentModel;
use App\Model\api\CourseSupervisionModel;
use App\Model\api\ErrorAsaasModel;
use App\Model\api\FormPaymentModel;
use App\Model\api\OrderAdditionalModel;
use App\Model\api\OrderModel;
use App\Model\api\OrderParcelModel;
use App\Model\api\Prospection\CourseModel;
use App\Model\api\SchoolInformationModel;
use App\Model\api\StudentModel;

class ConfirmPaymentUtils {
	private $company = null;
	private $course = null;
	private $asaasType = null;

	public function __construct($opt) {
		$schoolInformationModel = SchoolInformationModel::query();

		if (isset($opt->courseId) && $opt->courseId) {
			$this->course = CourseModel::with('courseSubcategory')->find($opt->courseId);

			$flgSubcategory = $this->course->courseSubcategory->flg;

			if (in_array($flgSubcategory, ['for', 'esp'])) {
				$schoolInformationModel->where('id', 1);
				$this->asaasType = 'subscriptions';
			} else {
				$schoolInformationModel->where('id', 2);
				$this->asaasType = 'payments';
			}
		} else {
			$schoolInformationModel->where('id', 2);
			$this->asaasType = 'payments';
		}

		$this->company = $schoolInformationModel->first();

		if (!$this->company) {
			$this->company = SchoolInformationModel::first();
		}
	}

	public function getCode() {
		return base_convert(time() . mt_rand(0, 0xffff), 10, 36);
	}

	public function makeStudentOrder($payload, $studentId) {
		$this->getAsaasCustomerCode($studentId, $payload);

		$payload['flg_free'] = false;

		// Se houver uma Negociação especial, não aplica nenhum outro calculo de valores
		if (isset($payload['specialNegotiation'])) {
			$this->setBySpecialNegotiation($payload);
		} else {
			if (isset($payload['supervision_id']) && !empty($payload['supervision_id'])) {
				$this->setBySupervisionFormPayment($payload);
			} else
			if (isset($payload['course_form_payment_id']) && !empty($payload['course_form_payment_id'])) {
				$this->setByCourseFormPayment($payload);
			}

			if (isset($payload['additional'])) {
				$this->setByAdditionalsFormPayment($payload);
			}

			if (isset($payload['course_discount_id'])) {
				$this->setCourseDiscount($payload);
			}
		}

		if (empty($payload['expiration_day'])) {
			$payload['expiration_day'] = date('d');
		}

		$expirationDateTime = strtotime(date("Y-m-{$payload['expiration_day']}"));

		if ($expirationDateTime < strtotime('now')) {
			$payload['due_date'] = date('Y-m-d', strtotime('+1 month', $expirationDateTime));
		} else {
			$payload['due_date'] = date('Y-m-d', $expirationDateTime);
		}

		if ($payload['value'] == 0) {
			$payload['flg_free'] = true;
		}

		if ($payload['flg_free']) {
			$payload['status'] = 'AP';
		}

		// return $payload;

		if (isset($payload['orderId']) && !empty($payload['orderId'])) {
			$order = OrderModel::find($payload['orderId']);

			OrderParcelModel::where('order_id', $payload['orderId'])->delete();
			if (is_null($order)) {
				$order = new OrderModel;
			}
		} else {
			$order = new OrderModel;
		}

		if (!isset($order->id)) {
			$payload['code'] = $this->getCode();
		}

		$order->fill($payload)->save();

		OrderAdditionalModel::where('order_id', $order->id)->delete();

		if (isset($payload['additionals'])) {
			foreach ($payload['additionals'] as $additional) {
				(new OrderAdditionalModel)->fill([
					'order_id' => $order->id,
					'course_additional_id' => $additional->id,
					'additional_id' => $additional->additional_id,
					'course_id' => $additional->course_id,
					'form_payment_id' => $additional->form_payment_id,
					'parcel' => $additional->parcel,
					'value' => $additional->value,
					'full_value' => $additional->full_value,
				])->save();
			}
		}

		if ($payload['flg_free']) {
			$payments = $this->makeOrderParcel($order);
		} else
		if (in_array($order->form_payment, [ 'card', 'bankSlip' ])) {
			$payments = $this->paymentAsaas($order);
		} else
		if (in_array($order->form_payment, [ 'postdatedChecks' ])) {
			$payments = $this->paymentChecks($order);
		} else {
			$payments = $this->makeOrderParcel($order);
		}

		if ($order->status == 'AP') {
			(new StudentClassControlUtils)->generateByOrder($order->id);
		}

		return [
		 'order' => $order,
		 'payments' => $payments,
		];
	}

	public function getAsaasCustomerCode($studentId, &$payload) {
		$student = StudentModel::find($studentId);

		$payload['student_id'] = $student->id;

		if (empty($payload['email'])) {
			$payload['email'] = $student->email;
		}

		if (empty($payload['cpf'])) {
			$payload['cpf'] = $student->cpf;
		}

		// $asaasCustomerCode = $student->asaas_code;
		$asaasCustomerCode = $this->getClientAsaas($student);

		if (!$asaasCustomerCode) {

			if (!$asaasCustomerCode) {
				$asaasCustomerCode = $this->asaasCustomers($student);
			}

			if (isset($asaasCustomerCode->errors)) {
				throw new \Exception(json_encode([
					'showError' => $asaasCustomerCode,
				]));
			}

		}

		if ($asaasCustomerCode != $student->asaas_code) {
			StudentModel::where('id', $studentId)->update([ 'asaas_code' => $asaasCustomerCode ]);
		}

		$payload['asaas_customers_code'] = $asaasCustomerCode;

		return $payload;
	}

	public function setBySpecialNegotiation(&$payload) {
		$formPayment = FormPaymentModel::find($payload['formPayment']);

		$payload['form_payment_id'] = $formPayment->id;
		$payload['form_payment'] = $formPayment->flg_type;
		$payload['number_parcel'] = $payload['specialNegotiation']['parcel'];
		$payload['value'] = toNumberFormat($payload['specialNegotiation']['value']);
		$payload['full_value'] = $payload['value'] * $payload['number_parcel'];

		return $payload;
	}

	public function setByCourseFormPayment(&$payload) {
		$courseFormPayment = CourseFormPaymentModel::with('formPayment')->find($payload['course_form_payment_id']);

		$payload['number_parcel'] = $courseFormPayment->parcel;
		$payload['value'] = $courseFormPayment->getOriginal('value');
		$payload['full_value'] = $courseFormPayment->getOriginal('full_value');
		$payload['course_form_payment_id'] = $courseFormPayment->id;
		$payload['form_payment_id'] = $courseFormPayment->formPayment->id;
		$payload['form_payment'] = $courseFormPayment->formPayment->flg_type;
		$payload['flg_free'] = $courseFormPayment->formPayment->flg_free;

		return $payload;
	}

	public function setBySupervisionFormPayment(&$payload) {
		$formPayment = FormPaymentModel::where('flg_type', 'card')->first();
		$supervision = CourseSupervisionModel::find($payload['supervision_id']);

		$payload['number_parcel'] = 1;
		$payload['value'] = $supervision->getOriginal('value_' . $payload['supervisionType']);
		$payload['full_value'] = $payload['value'];
		$payload['form_payment_id'] = $formPayment->id;
		$payload['form_payment'] = $formPayment->flg_type;
		// $payload['flg_free'] = $formPayment->flg_free;

		return $payload;
	}

	public function setByAdditionalsFormPayment(&$payload) {
		$additionals = CourseAdditionalModel::query();

		if (isset($payload['courseFormPaymentParcel'])) {
			$additionals->where('parcel', $payload['courseFormPaymentParcel']);
		}

		$additionals->where('course_id', $payload['course_id'])
		->where('form_payment_id', $payload['formPayment'])
		->whereIn('additional_id', $payload['additional']);

		$payload['additionals'] = $additionals->get();

		if (!isset($payload['form_payment_id'])) {
			$formPayment = FormPaymentModel::find($payload['formPayment']);
			$payload['form_payment_id'] = $formPayment->id;
			$payload['form_payment'] = $formPayment->flg_type;
			$payload['full_value'] = 0;
			$payload['value'] = 0;
			$payload['number_parcel'] = 0;
		}

		for ($i = 0, $ii = count($payload['additionals']); $i < $ii; $i++) {
			$additional = $payload['additionals'][$i];

			if ($payload['number_parcel'] < $additional->parcel) {
				$payload['number_parcel'] = $additional->parcel;
			}

			$payload['full_value'] += floatval($additional->full_value);
		}

		$payload['value'] = $payload['full_value'] / $payload['number_parcel'];

		return $payload;
	}

	public function setCourseDiscount(&$payload) {
		$courseDiscount = CourseDiscountModel::with([ 'discount' ])->find($payload['course_discount_id']);

		$percentage = 0;
		$value = 0;

		if (!empty($courseDiscount->discount->percentage) && $courseDiscount->discount->percentage != 0) {
			$percentage = $courseDiscount->discount->percentage;
		} else
		if (!empty($courseDiscount->discount->value) && $courseDiscount->discount->value != 0) {
			$value = $courseDiscount->discount->value;

			$percentage = floor($value * 100 / $payload['full_value']);
		}

		$value = round($percentage / 100 * $payload['full_value'], 2);

		$payload['discount_percentage'] = $percentage;
		$payload['discount_value'] = $value;

		$payload['value'] = $payload['value'] - round($percentage / 100 * $payload['value'], 2);

		if ($payload['value'] < 0) {
			$payload['value'] = 0;
		}

		$payload['full_value'] = $payload['value'] * $payload['number_parcel'];

		return $payload;
	}

	public function paymentAsaas(&$order) {
		$status = $order->status == 'AP' ? 'AP' : 'PE';
		$formPayment = $order->form_payment;
		$dueDate = $order->due_date;

		$asaasData = [
			'payload' => [
				'customer' => $order->asaas_customers_code,
				'description' => "Compra feita em {$this->company->name}",
				'externalReference' => $order->code,
			],
		];

		if ($this->asaasType == 'subscriptions' && $formPayment == 'card') {
			$asaasData['path'] = 'subscriptions';
			$asaasData['payload']['nextDueDate'] = $dueDate;
			$asaasData['payload']['cycle'] = 'MONTHLY';
			$asaasData['payload']['maxPayments'] = $order->number_parcel;
		} else {
			$asaasData['path'] = 'payments';
			$asaasData['payload']['dueDate'] = $dueDate;
		}

		if ($formPayment == 'bankSlip') {
			$asaasData['payload']['billingType'] = 'BOLETO';
		} else
		if ($formPayment == 'card') {
			$asaasData['payload']['billingType'] = 'CREDIT_CARD';

			$expiryMonthYear = explode('/', $order->shelf_life);

			$asaasData['payload']['creditCard'] = [
				'holderName' => $order->cardholder,
				'number' => $order->number_card,
				'expiryMonth' => $expiryMonthYear[0],
				'expiryYear' => '20' . $expiryMonthYear[1],
				'ccv' => $order->security_code,
			];

			$asaasData['payload']['creditCardHolderInfo'] = [
				'name' => $order->cardholder,
				'email' => $order->email,
				'cpfCnpj' => $order->cpf,
				'postalCode' => $order->zip_code,
				'addressNumber' => $order->address_number,
				'phone' => $order->phone,
			];
		}

		$asaasData['payload']['value'] = $order->value;
		$asaasData['payload']['installmentValue'] = $order->value;
		$asaasData['payload']['installmentCount'] = $order->number_parcel;

		// if (!empty($order->discount_percentage)) {
		// 	$asaasData['payload']['discount'] = [
		// 		'type' => 'PERCENTAGE',
		// 		'value' => $order->discount_percentage,
		// 	];
		// }

		$asaas = $this->asaas($asaasData);

		ErrorAsaasModel::where('order_id', $order->id)->forceDelete();

		if (isset($asaas->errors)) {
			(new ErrorAsaasModel())->fill([
				'order_id' => $order->id,
				'json' => json_encode($asaas),
			])->save();

			$asaas->asaasData = $asaasData;

			throw new \Exception(json_encode([
				'showError' => $asaas,
			]));
		}

		if (isset($asaas->id)) {
			if ($formPayment == 'card') {
				$status = 'AP';
			}

			$order->fill([
				'status' => $status,
				'asaas_payments_code' => $asaas->id,
				'asaas_json' => json_encode($asaas),
			])->save();

			$this->orderParcelByAsaas($order, $asaas);
		}

		return $asaas;
	}

	public function orderParcelByAsaas($order, $asaas) {
		$orderParcels = [];

		if (isset($asaas->installment)) {
			$asaas = $this->asaas([
				'path' => "payments?installment={$asaas->installment}&limit=100",
			]);

			$installments = $asaas->data;

			$n = 1;
			for ($i = count($installments) - 1; $i > -1; $i--) {
				$orderParcel = [
					'n' => $n++,
					'code' => $this->getCode(),
					'order_id' => $order->id,
					'due_date' => $installments[$i]->dueDate,
					'value' => $installments[$i]->value,
					'asaas_code' => $installments[$i]->id,
					'asaas_json' => json_encode($installments[$i]),
					'form_payment_id' => $order->form_payment_id,
					'bank_id' => $order->bank_id,
				];

				$orderParcels[$i] = new OrderParcelModel;
				$orderParcels[$i]->fill($orderParcel)->save();
			}
		} else {
			$orderParcels = $this->makeOrderParcel($order);
		}

		return $orderParcels;
	}

	public function makeOrderParcel($order) {
		$dueDate = $order->due_date;
		$numberParcel = $order->number_parcel + 1;
		$orderParcels = [];

		for ($i = 1; $i < $numberParcel; $i++) {
			$orderParcel = [
				'n' => $i,
				'code' => $this->getCode(),
				'order_id' => $order->id,
				'due_date' => $dueDate,
				'form_payment_id' => $order->form_payment_id,
				'bank_id' => $order->bank_id,
				'value' => $order->value,
			];

			$dueDate = date("Y-m-{$order->expiration_day}", strtotime('+1 month', strtotime($dueDate)));

			$orderParcels[$i] = new OrderParcelModel;
			$orderParcels[$i]->fill($orderParcel)->save();
		}

		return $orderParcels;
	}

	public function getClientAsaas($student) {
		$clientAsaas = $this->asaas([
			'path' => 'customers?cpfCnpj=' . $student->cpf,
		]);

		if ($clientAsaas->totalCount == 0) {
			return null;
		}

		return $clientAsaas->data[0]->id;
	}

	public function asaasCustomers(&$data) {
		$asaas = $this->asaas([
			'path' => 'customers',
			'payload' => [
				'name' => $data->name,
				'email' => $data->email,
				'phone' => $data->phone,
				'mobilePhone' => $data->cell_phone,
				'cpfCnpj' => $data->cpf,
			],
		]);

		if (!isset($asaas->errors)) {
			return $asaas->id;
		}

		return $asaas;
	}

	public function paymentChecks(&$order) {
		$dueDate = $order->due_date;

		$asaasData = [
			'path' => 'payments',
			'payload' => [
				'customer' => $order->asaas_customers_code,
				'description' => "Compra feita em {$this->company->name}",
				'externalReference' => $order->code,
			],
		];

		$asaasData['payload']['dueDate'] = $dueDate;
		$asaasData['payload']['billingType'] = 'BOLETO';
		$asaasData['payload']['value'] = $order->value;

		$asaas = $this->asaas($asaasData);

		ErrorAsaasModel::where('order_id', $order->id)->forceDelete();

		if (isset($asaas->errors)) {
			(new ErrorAsaasModel())->fill([
				'order_id' => $order->id,
				'json' => json_encode($asaas),
			])->save();

			$asaas->asaasData = $asaasData;

			throw new \Exception(json_encode($asaas));
		}

		if (isset($asaas->id)) {
			$order->fill([
				'status' => 'PE',
				'asaas_payments_code' => $asaas->id,
				'asaas_json' => json_encode($asaas),
			])->save();
		}

		$this->makeOrderParcel($order);

		return $asaas;
	}

	private function asaas($options) {
		$curl = curl_init();

		$opt = [
			'CURLOPT_CUSTOMREQUEST' => 'GET',
			'CURLOPT_POSTFIELDS' => '',
		];

		if (isset($options['payload'])) {
			$opt['CURLOPT_CUSTOMREQUEST'] = 'POST';
			$opt['CURLOPT_POSTFIELDS'] = json_encode($options['payload']);
		}

		$optArray = [
			CURLOPT_URL => $this->company->asaas_url . $options['path'],
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => $opt['CURLOPT_CUSTOMREQUEST'],
			CURLOPT_POSTFIELDS => $opt['CURLOPT_POSTFIELDS'],
			CURLOPT_HTTPHEADER => [
				'Accept: */*',
				'Content-Type: application/json',
				'Accept-Encoding: gzip, deflate',
				'Cache-Control: no-cache',
				'Connection: keep-alive',
				'access_token: ' . $this->company->asaas_token,
				'cache-control: no-cache'
			],
		];

		curl_setopt_array($curl, $optArray);

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);

		if ($err) {
			die($err);
		}

		return json_decode($response);
	}

	/*
	static public function importCETCC() {
		$importData = DB::select('select * from import_data where imported is null');

		foreach ($importData as &$data) {
			$payload = json_decode($data->payload);

			if (isset($payload->student->cpf)) {
				$student = $payload->student;

				$cpf = preg_replace('/\D/', '', $student->cpf);
				$studentModel = StudentModel::where('cpf', $cpf)->first();

				if ($studentModel) {
					DB::update("UPDATE import_data SET imported = ? WHERE id = ?", [0, $data->id]);
					continue;
				}

				$studentModel = new StudentModel;
				$studentModel->fill([
					'name' => $student->nome,
					'cpf' => $student->cpf,
					'email' => $student->email,
					'password' => \Illuminate\Support\Facades\Hash::make($cpf),
					'phone' => $student->telefone,
					'cell_phone' => $student->celular,
					'zip_code' => $student->cep,
					'address' => $student->endereco,
					'city' => $student->cidade,
					'formation' => $student->formacao,
					'tcc_experience' => $student->experiencia,
					'more_information' => isset($student->mais_informacao) ? $student->mais_informacao : $student->mais_informacoes,
					'imported' => $data->id,
				])->save();

				DB::update("UPDATE import_data SET imported = ? WHERE id = ?", [$studentModel->id, $data->id]);
			} else {
				DB::update("UPDATE import_data SET imported = ? WHERE id = ?", [0, $data->id]);
			}
		}

		return count($importData);
	}
	*/
}
