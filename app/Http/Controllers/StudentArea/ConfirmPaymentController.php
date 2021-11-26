<?php

namespace App\Http\Controllers\StudentArea;

use App\Model\api\CourseDiscountModel;
use Illuminate\Http\Request;
use App\Utils\ConfirmPaymentUtils;
use stdClass;

class ConfirmPaymentController extends _Controller {

	public function confirmPayment(Request $request) {
		$payload = $request->all();

		if (isset($payload['student_id'])) {
			$studentId = $payload['student_id'];
		} else {
			$studentId = \Illuminate\Support\Facades\Auth::guard('studentArea')->user()->id;
		}

		$opts = new stdClass;

		if (isset($payload['course_id'])) {
			$opts->course_id = $payload['course_id'];
		}

		$confirmPaymentUtils = new ConfirmPaymentUtils($opts);

		try {
			return json_encode($confirmPaymentUtils->makeStudentOrder($payload, $studentId));
		} catch (\Throwable $th) {
			return $th->getMessage();
		}

		// $payments = null;
		// if (in_array($order->form_payment, [ 'card', 'bankSlip' ]) && !$isFree) {
		// 	$payments = $confirmPaymentUtils->paymentAsaas([
		// 		'order' => $order,
		// 	]);
		// } else {
		// 	$payments = $confirmPaymentUtils->orderParcel($order);
		// }

		// return json_encode([
		// 	'order' => $order,
		// 	'payments' => $payments,
		// ]);
	}

	public function applyDiscount(Request $request) {
		$input = $request->all();

		if (!empty($input['code']) && !empty($input['courseId'])) {
			return CourseDiscountModel::query()
			->select([
				'course_discount.id as course_discount_id',
				'discount.id',
				'discount.code',
				'discount.percentage',
				'discount.value',
			])
			->join('discount', 'discount.id', 'course_discount.discount_id')
			->where('course_discount.course_id', $input['courseId'])
			->where('discount.code', $input['code'])
			->first();
		}

		return null;
	}
}
