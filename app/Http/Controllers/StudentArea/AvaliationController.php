<?php

namespace App\Http\Controllers\StudentArea;

use App\Model\api\CourseSupervisionModel;
use App\Model\api\OrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AvaliationController extends _Controller {

	public function avaliation(Request $request) {

		return view('student_area/avaliation/index');
	}
}
