<?php

namespace App\Http\Controllers\Admin;

use App\Model\api\FormPaymentModel;
use App\Model\api\OrderModel;
use App\Model\api\Prospection\CourseModel;
use App\Model\api\StudentModel;
use Illuminate\Http\Request;

class MakeStudentRegistrationController extends \App\Http\Controllers\Controller {

	public function index(Request $request) {
		$payload = new \StdClass;

		$payload->student = StudentModel::orderBy('name')->get();

		$payload->course = CourseModel::with([
			'courseCategory',
			'courseCategoryType',
			'courseSubcategory',
			'class' => function($query) {
				// $query->where('does_registre', '1');
			},
		])->orderBy('title_pt')->get();

		$payload->formPayment = FormPaymentModel::orderBy('description')->get();

		return view('admin.studentRegistration.make')->with('payload', $payload);
	}

	public function getOrder(Request $request) {
		$orderModel = OrderModel::whereNotNull('course_id')
		->with([
			'course.courseCategoryType',
			'course.courseCategory',
			'course.courseSubcategory',
			'class',
		]);

		if ($request->get('studentId')) {
			$orderModel->where('student_id', $request->get('studentId'));
		} else {
			return [];
		}

		return $orderModel->get();
	}

	public function save(Request $request) {
		$input = $request->all();

		if (isset($input['value'])) {
			$input['value'] = toNumberFormat($input['value']);
			$input['full_value'] = toNumberFormat($input['full_value']);
		}

		(new OrderModel)->fill([
			'student_id' => $request->get('student'),
			'course_id' => $request->get('course'),
			'class_id' => $request->get('class'),
			'form_payment_id' => $request->get('formPayment'),
			'number_parcel' => $request->get('parcel'),
			'value' => $request->get('full_value'),
			'status' => isset($input['confirms_registration']) ? $input['confirms_registration'] : 'PE',
			'imported' => '1',
		])->save();

		return redirect()->back();
	}
}
