<?php

namespace App\Http\Controllers\StudentArea;

use App\Model\api\CourseSupervisionModel;
use App\Model\api\OrderModel;
use App\Model\api\Prospection\ClassModel;
use App\Model\api\Prospection\FileModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends _Controller {

	public function listCourse(Request $request) {
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

		return view('student_area/order/list')
		->with('listView', 'student_area.components.list_course')
		->with('payload', [
			'active' => $active->get(),
			'finished' => $finished->get(),
		]);
	}

	public function listSupervision(Request $request) {
		$order = OrderModel::where('student_id', Auth::guard('studentArea')->user()->id)
		->whereNull('course_id')
		->with([
			'supervision.teacher',
			'supervision.course',
		])->get();

		foreach ($order as $item) {
			$item->supervision->courses = CourseSupervisionModel::getCoursesTitle($item->supervision);
		}

		return view('student_area/order/list')
		->with('listView', 'student_area.components.list_supervision')
		->with('payload', [
			'order' => $order,
		]);
	}

	public function details(Request $request) {
		$order = OrderModel::with([
			'formPayment',
			'supervision.teacher',
			'supervision.course',
			'course',
			'orderParcel' => function($query) {
				$query->withTrashed();
			},
		])->find($request->id);

		$files = [];

		if ($order->status == 'AP') {
			$order->class = ClassModel::with([
				'classes' => function($query) use ($order) {
					$query->with([
						'team',
						'contentCourse',
						'videoLesson',
						'fileContentCourse.file',
						'studentClassControl' => function($query) use ($order) {
							$query->where('order_id', $order->id);
						},
					])
					->orderBy('start_date')
					->orderBy('sequence')
					->orderBy('id');
				},
			])->find($order->class_id);

			// if ($order->class) {
			// 	$files = DB::select('SELECT f.*, concat(\'/storage/file/\', f.link) AS link
			// 		FROM file f
			// 			INNER JOIN file_content_course fcc ON fcc.file_id = f.id
			// 			INNER JOIN class_content_course ccc ON ccc.content_course_id = fcc.content_course_id
			// 		WHERE ccc.class_id = ?', [ $order->class->id ]);

			// 	foreach ($files as &$file) {
			// 		$file->icon = FileModel::getIcon($file->extension);
			// 	}
			// }
		}

		return view('student_area/order/' . ($order->supervision ? 'supervisionDetails' : 'courseDetails'))
			->with('order', $order)
			->with('files', $files);
	}
}
