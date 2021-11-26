<?php

namespace App\Http\Controllers\StudentArea;

use App\Model\api\CourseSupervisionModel;
use App\Model\api\OrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends _Controller {

	public function index(Request $request) {
		$active = OrderModel::where('student_id', Auth::guard('studentArea')->user()->id)
		->whereNull('supervision_id')
		->orderByDesc('id')
		->with([
			'course',
			'class',
		]);

		$finished = clone $active;

		$active->whereIn('status', ['PE', 'AP', 'TR']);
		$finished->whereIn('status', ['CA', 'IN']);

		$supervision = OrderModel::where('student_id', Auth::guard('studentArea')->user()->id)
		->whereNull('course_id')
		->with([
			'supervision.teacher',
			'supervision.course',
		])->get();

		foreach ($supervision as $item) {
			$item->supervision->courses = CourseSupervisionModel::getCoursesTitle($item->supervision);
		}

		return view('student_area/home/index')->with('payload', [
			'active' => $active->get(),
			'finished' => $finished->get(),
			'supervision' => $supervision,
		]);
	}

}
