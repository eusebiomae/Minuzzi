<?php

namespace App\Http\Controllers\StudentArea;

use App\Model\api\CourseFormPaymentModel;
use App\Model\api\OrderModel;
use App\Model\api\OrderParcelModel;
use App\Model\api\SchoolInformationModel;
use App\Model\api\StudentModel;
use Illuminate\Http\Request;

class BillController extends _Controller {
	public function index(Request $request, $table, $id) {
		// $orderModel = OrderModel::with([
		// 	'student' => function($query) {
		// 		$query->with([
		// 			'state',
		// 		]);
		// 	},
		// 	'courseFormPayment' => function($query) {
		// 		$query->with([
		// 			'formPayment',
		// 			'course' => function($query) {
		// 				$query->with([
		// 					'courseCategory',
		// 					'courseCategoryType',
		// 					'courseSubcategory',
		// 				]);
		// 			},
		// 		]);
		// 	}
		// ])->find($request->id);

		$payload = new \stdClass;

		switch ($table) {
			case 'order':
				$order = $payload->order = OrderModel::with([
					'formPayment',
				])->find($id);
			break;
			case 'orderParcel':
				$payload->order = OrderParcelModel::with([
					'formPayment',
				])->find($id);
				$order = OrderModel::find($payload->order->order_id);
			break;
		}

		$payload->company = schoolInformation();
		$payload->student = StudentModel::with([ 'state' ])->find($order->student_id);
		$payload->courseFormPayment = CourseFormPaymentModel::with([
			'course.courseCategory',
			'course.courseCategoryType',
			'course.courseSubcategory',
		])->find($order->course_form_payment_id);

		return view('student_area/order/bill')->with('payload', $payload);
	}
}
