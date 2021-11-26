<?php

namespace App\Http\Controllers\Admin;

use App\Model\api\FormPaymentModel;
use App\Model\api\OrderModel;
use App\Model\api\Prospection\CourseModel;
use App\Model\api\StudentModel;
use Illuminate\Http\Request;

class ClassStudentRegistrationController extends \App\Http\Controllers\Controller {

	public function index(Request $request) {
		$payload = new \StdClass;

		// $payload->student = StudentModel::orderBy('name')->get();

		$payload->course = CourseModel::with([
			'courseCategory',
			'courseCategoryType',
			'courseSubcategory',
			'class' => function($query) {
				// $query->where('does_registre', '1');
			},
		])->orderBy('title_pt')->get();

		// $payload->formPayment = FormPaymentModel::orderBy('description')->get();

		return view('admin.studentRegistration.class')->with('payload', $payload);
	}

	public function getOrder(Request $request) {
		$orderModel = OrderModel::whereNotNull('course_id')
		->with([
			'student'
			// 'course.courseCategoryType',
			// 'course.courseCategory',
			// 'course.courseSubcategory',
			// 'class',
		]);

		if ($request->get('classId')) {
			$orderModel->where('class_id', $request->get('classId'));
		} else {
			return [];
		}

		return $orderModel->get();
	}

	public function save(Request $request) {
		$input = $request->all();

		$input['value'] = toNumberFormat($input['value']);
		$input['full_value'] = toNumberFormat($input['full_value']);

		(new OrderModel)->fill([
			'student_id' => $input['student'],
			'course_id' => $input['course'],
			'class_id' => $input['class'],
			'form_payment_id' => $input['formPayment'],
			'number_parcel' => $input['parcel'],
			'value' => $input['full_value'],
			'status' => isset($input['confirms_registration']) ? $input['confirms_registration'] : 'PE',
			'imported' => '1',
		])->save();

		return redirect()->back();
	}
}
