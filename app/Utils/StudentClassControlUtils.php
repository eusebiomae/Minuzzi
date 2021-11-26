<?php
namespace App\Utils;

use App\Model\api\ClassesModel;
use App\Model\api\OrderModel;
use App\Model\api\Prospection\ClassModel;
use App\Model\api\StudentClassControlModel;

class StudentClassControlUtils {

	public function generateByOrder($idOrder) {
		$order = OrderModel::with([
			'course.courseCategoryType',
			'class.classes' => function($query) {
				$query->orderBy('start_date')->orderBy('sequence')->orderBy('id')->get();
			},
		])->find($idOrder);

		if ($order->status != 'AP' || !$order->course) {
			return $order->id;
		}

		if (!$order->register_date) {
			$order->register_date = date('Y-m-d');
		}

		if (is_null($order->repetition)) {
			$order->repetition = empty($order->class->repetition) ? 7 : $order->class->repetition;
		}

		if (is_null($order->permanence)) {
			$order->permanence = empty($order->class->permanence) ? 60 : $order->class->permanence;
		}

		if (is_null($order->permanence_all)) {
			$order->permanence_all = $order->class->permanence_all;
		}

		$order->save();

		if ($order->course->courseCategoryType->flg == 'ead') {
			return $this->fnPopulateEad($order);
		} else {
			return $this->fnPopulatePresential($order);
		}
	}

	private function fnPopulateEad($order) {
		$repetition = $order->repetition;
		$permanence = $order->permanence;
		$permanenceAll = $order->permanence_all;
		$startDate = $order->getRawOriginal('register_date');
		$endDate = empty($permanenceAll) ? null : date('Y-m-d', strtotime("+{$permanence} day", strtotime($startDate)));
		$nowDateTime = strtotime('now');

		foreach ($order->class->classes as $classes) {
			$studentClassControl = StudentClassControlModel::where('order_id', $order->id)->where('classes_id', $classes->id)->first();
			if ($classes->orientative == 'yes') {
				$fillData = [
					'start_date' => null,
					'end_date' => null,
					'status' => '1',
				];
			} else {
				$startDateTime = strtotime($startDate);
				$endDateTime = empty($permanenceAll) ? strtotime("+{$permanence} day", $startDateTime) : strtotime($endDate);

				$status = '1';
				// if ($studentClassControl) {
				// 	$status = $studentClassControl->status;
				// }

				$fillData = [
					'start_date' => $startDate,
					'end_date' => date('Y-m-d', $endDateTime),
					'status' => $status == '1' ? '1' : (($nowDateTime >= $startDateTime && $nowDateTime <= $endDateTime) ? '1' : null),
				];

				$startDate = ( date('Y-m-d', strtotime("+{$repetition} day", $startDateTime)) );
			}

			if ($studentClassControl) {
				$studentClassControl->fill(array_merge($fillData, [
					'course_id' => $classes->course_id,
					'class_id' => $classes->class_id,
					'content_course_id' => $classes->content_course_id,
				]))->save();
			} else {
				(new StudentClassControlModel)->fill(array_merge($fillData, [
					'order_id' => $order->id,
					'student_id' => $order->student_id,
					'classes_id' => $classes->id,
					'course_id' => $classes->course_id,
					'class_id' => $classes->class_id,
					'content_course_id' => $classes->content_course_id,
				]))->save();
			}
		}

		return $order;
	}

	private function fnPopulatePresential($order) {
		$endDate = $order->class->getRawOriginal('end_date');
		$nowDateTime = strtotime('now');
		$endDateTimeClass = strtotime("+60 day", strtotime($endDate));

		foreach ($order->class->classes as $classes) {
			$studentClassControl = StudentClassControlModel::where('order_id', $order->id)->where('classes_id', $classes->id)->first();

			if ($classes->orientative == 'yes') {
				$fillData = [
					'start_date' => null,
					'end_date' => null,
					'status' => '1',
				];
			} else {
				$startDate = $classes->getRawOriginal('start_date');

				if (empty($startDate)) {
					$startDate = date('Y-m-d');
				}

				$startDateTime = strtotime("-7 day", strtotime($startDate));

				// if ($classes->end_date) {
				// 	$endDateTime = strtotime("+60 day", strtotime($classes->getRawOriginal('end_date')));
				// } else {
					$endDateTime = $endDateTimeClass;
				// }

				$status = '1';
				// if ($studentClassControl) {
				// 	$status = $studentClassControl->status;
				// }

				$fillData = [
					'start_date' => date('Y-m-d', $startDateTime),
					'end_date' => date('Y-m-d', $endDateTime),
					'status' => $status == '1' ? '1' : (($nowDateTime >= $startDateTime && $nowDateTime <= $endDateTime) ? '1' : null),
				];
			}

			if ($studentClassControl) {
				$studentClassControl->fill(array_merge($fillData, [
					'course_id' => $classes->course_id,
					'class_id' => $classes->class_id,
					'content_course_id' => $classes->content_course_id,
				]))->save();
			} else {
				(new StudentClassControlModel)->fill(array_merge($fillData, [
					'order_id' => $order->id,
					'student_id' => $order->student_id,
					'classes_id' => $classes->id,
					'course_id' => $classes->course_id,
					'class_id' => $classes->class_id,
					'content_course_id' => $classes->content_course_id,
				]))->save();
			}
		}

		return $order;
	}

	public function generateByClass($idClass) {
		$classModel = ClassModel::find($idClass);

		if ($classModel) {
			$classesModel = ClassesModel::where('class_id', $idClass)->get();

			foreach ($classesModel as $classes) {
				StudentClassControlModel::where('classes_id', $classes->id)->update([
					'content_course_id' => $classes->content_course_id,
				]);
			}

			$orderModel = OrderModel::with([
				'course.courseCategoryType',
				'class.classes' => function($query) {
					$query->orderBy('start_date')->orderBy('sequence')->orderBy('id')->get();
				},
			])->where('class_id', $idClass)->get();

			foreach ($orderModel as $order) {
				$order->fill([
					'permanence' => $classModel->permanence,
					'repetition' => $classModel->repetition,
					'permanence_all' => $classModel->permanence_all,
				])->save();

				if ($order->course->courseCategoryType->flg == 'ead') {
					$this->fnPopulateEad($order);
				} else {
					$this->fnPopulatePresential($order);
				}
			}

			return $orderModel;
		}

		return null;
	}

	static public function cronValidDate() {
		$studentClassControl = StudentClassControlModel::whereNull('status')->whereNotNull('start_date')->get();
		$nowDateTime = strtotime('now');

		foreach ($studentClassControl as $item) {
			$startDateTime = strtotime($item->getRawOriginal('start_date'));
			$endDateTime = strtotime($item->getRawOriginal('end_date'));

			// $status = ($nowDateTime >= $startDateTime && $nowDateTime <= $endDateTime) ? '1' : null;
			$status = 1;

			if ($status) {
				$item->fill([
					'status' => $status,
				])->save();
			}
		}

		return 'cronValidDate:OK';
	}
}
