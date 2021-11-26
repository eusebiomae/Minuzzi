<?php

namespace App\Http\Controllers\Admin;

use App\Model\api\OrderModel;
use App\Model\api\StudentClassControlModel;
use App\Utils\StudentClassControlUtils;
use Illuminate\Http\Request;

class ClassReleaseController extends \App\Http\Controllers\Controller {
	public function list() {
		return view('admin.pages.classRelease.list');
	}

	public function getList(Request $request) {
		if ($request->get('class')) {
			$class = $request->get('class');

			return OrderModel::with([
				'student',
				'class',
			])->where('class_id', $class)->get();
		}

		return [];
	}

	public function form(Request $request, $id) {
		$order = OrderModel::with([
			'student',
			'course.courseCategoryType',
			'course.courseCategory',
			'course.courseSubcategory',
			'class.classes' => function($query) {
				$query
				->orderBy('start_date')
				->orderBy('sequence')
				->orderBy('id')->get();

				$query->with([ 'contentCourse' ]);
			},
		])->find($id)->toArray();

		$order['studentClassControl'] = [];

		foreach ($order['class']['classes'] as $classes) {
			$studentClassControl = StudentClassControlModel::where('order_id', $order['id'])->where('classes_id', $classes['id'])->with([ 'contentCourse', 'classes' ])->first();
			if ($studentClassControl) {
				$order['studentClassControl'][] = $studentClassControl;
			} else {
				$order['studentClassControl'][] = [
					'start_date' => null,
					'end_date' => null,
					'status' => null,
					'presence' => null,
					'classes_id' => $classes['id'],
					'content_course' => $classes['content_course'],
				];
			}
		}

		return view('admin.pages.classRelease.form')->with('payload', [
			'order' => $order,
		]);
	}

	public function save(Request $request) {
		if ($request->get('id')) {
			$order = OrderModel::find($request->get('id'));

			if ($order->register_date != $request->get('register_date') || $order->repetition != $request->get('repetition') || $order->permanence != $request->get('permanence') || $order->permanence_all != $request->get('permanence_all')) {
				$order->fill($request->all())->save();
				(new StudentClassControlUtils)->generateByOrder($order->id);
			} else {
				StudentClassControlModel::where('order_id', $request->get('id'))->update([
					'status' => null,
					'presence' => null,
				]);

				if ($request->get('studentClassControl')) {
					foreach ($request->get('studentClassControl') as $classesId => $item) {
						StudentClassControlModel::where('order_id', $request->get('id'))->where('classes_id', $classesId)->update([
							'status' => isset($item['status']) ? $item['status'] : null,
							'presence' => isset($item['presence']) ? $item['presence'] : null,
						]);
					}
				}
			}
		}

		return redirect()->back();
	}

}
