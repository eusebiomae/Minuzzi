<?php

namespace App\Http\Controllers\StudentArea;

use Illuminate\Http\Request;
use App\Model\api\CourseFormPaymentModel;
use App\Model\api\CourseSupervisionModel;
use App\Model\api\FormPaymentModel;
use App\Model\api\OrderModel;
use App\Model\api\StudentModel;
use App\Utils\ConfirmPaymentUtils;

class ConfirmPaymentController extends _Controller {

	public function confirmPayment(Request $request) {
		$studentId = \Illuminate\Support\Facades\Auth::guard('studentArea')->user()->id;
		$payload = $request->all();

		$student = StudentModel::find($studentId);

		$asaasCustomersCode = $student->asaas_code;

		if (!$asaasCustomersCode) {
			$asaasCustomersCode = $this->getClientAsaas($student);

			if (!$asaasCustomersCode) {
				$asaasCustomersCode = $this->asaasCustomers($student);
			}

			if (isset($asaasCustomersCode->errors)) {
				return json_encode($asaasCustomersCode);
			}

			StudentModel::where('id', $studentId)->update([ 'asaas_code' => $asaasCustomersCode ]);
		}

		$payload['student_id'] = $studentId;
		$payload['asaas_customers_code'] = $asaasCustomersCode;

		$isFree = false;
		if (isset($payload['supervision_id'])) {
			$formPayment = FormPaymentModel::where('flg_type', 'card')->first();
			$supervision = CourseSupervisionModel::find($payload['supervision_id']);

			$payload['value'] = $supervision->getOriginal('value_' . $payload['supervisionType']);
			$payload['number_parcel'] = 1;
			$payload['form_payment_id'] = $formPayment->id;
			$payload['form_payment'] = $formPayment->flg_type;
		} else {
			$courseFormPayment = CourseFormPaymentModel::with('formPayment')->find($payload['course_form_payment_id']);

			$payload['value'] = $courseFormPayment->getOriginal('full_value');
			$payload['number_parcel'] = $courseFormPayment->parcel;
			$payload['form_payment_id'] = $courseFormPayment->formPayment->id;
			$payload['form_payment'] = $courseFormPayment->formPayment->flg_type;
			$isFree = $courseFormPayment->formPayment->flg_free;
		}

		if (empty($payload['email'])) {
			$payload['email'] = $student->email;
		}

		if (empty($payload['cpf'])) {
			$payload['cpf'] = $student->cpf;
		}

		if ($isFree) {
			$payload['status'] = 'AP';
		}

		$payload['code'] = base_convert(time() . mt_rand(0, 0xfff), 10, 36);

		$order = (new OrderModel)->fill($payload);

		$order->save();

		$payments = null;
		if (in_array($order->form_payment, [ 'card', 'bankSlip' ]) && !$isFree) {
			$payments = (new ConfirmPaymentUtils)->paymentAsaas([
				'order' => $order,
			]);
		} else {
			$payments = (new ConfirmPaymentUtils)->orderParcel($order->id);
		}

		return json_encode([
			'order' => $order,
			'payments' => $payments,
		]);
	}

	/** PRIVATE METHODS */

	private function getClientAsaas($student) {
		$clientAsaas = asaas([
			'path' => 'customers?cpfCnpj=' . $student->cpf,
		]);

		if ($clientAsaas->totalCount == 0) {
			return null;
		}

		return $clientAsaas->data[0]->id;
	}

	private function asaasCustomers(&$data) {
		$asaas = asaas([
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

}
