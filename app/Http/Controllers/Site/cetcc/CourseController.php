<?php

namespace App\Http\Controllers\site\cetcc;

use Illuminate\Http\Request;
use App\Model\api\Prospection\CourseCategoryModel;
use App\Model\api\Prospection\CourseCategoryTypeModel;
use App\Model\api\Prospection\CourseModel;
use App\Model\api\Prospection\CourseSubcategoryModel;
use App\Model\api\SchoolInformationModel;
use App\Model\api\SlideModel;

class CourseController extends _Controller
{

	public function default(Request $request)
	{
		$flgPage = $request->get('flgPage');
		$flgCourse = $request->get('flgCourse');
		// $typeCourse = $request->get('typeCourse');

		return view('site/cetcc/pages/courses')
			->with('params', $request->all())
			->with('flgPage', $flgPage)
			->with('banner', SlideModel::whereHas('contentPage', function($query) use ($flgPage) {
				$query->where('flg_page', $flgPage);
			})->first())
			->with('courseCategoryTypes', CourseCategoryTypeModel::all())
			->with('courseCategories', CourseCategoryModel::all())
			->with('courseSubcategories', CourseSubcategoryModel::all())
			->with('courses', CourseModel::with(['courseCategory', 'courseCategoryType', 'courseSubcategory'])->whereNull('inactive')->get())
			->with('flgCourseCategoryType', $flgCourse)
			->with('footerLinks', $this->generateFooterLinks());
	}

	public function courseDetails(Request $request, $id) {
		$flgPage = $request->get('flgPage');

		$course = CourseModel::with([
			'place',
			'teacher',
			'class' => function ($query) {
				$query
				->where('show_site', '1')
				->with([
					'classTeacher.team.graduation',
					'classTeacher.team.function',
					'classTeacher.team.office',
					'courseModule' => function($query) {
						$query->with([ 'contentCourse' ])
						->orderBy('start_date')
						->orderBy('sequence');
					},
					'city',
				]);
			},
			'bonusCourse' => function($query) {
				$query->orderBy('title_pt');
			},
			'courseFormPayment' => function($query) {
				$query
				->with([
					'formPayment',
				])
				->orderBy('value', 'desc');
			},
			'courseModule' => function($query) {
				$query->with([ 'contentCourse' ])
				->orderBy('start_date')
				->orderBy('sequence');

			},
		])->find($id);

		foreach ($course->courseFormPayment as $courseFormPayment) {
			if (!empty($courseFormPayment->flg_main)) {
				$course->courseFormPaymentMain = $courseFormPayment;
				break;
			}
		}

		$mapDataTableValues = [
			'header' => [],
			'data' => [],
		];

		foreach ($course->courseFormPayment as $courseFormPayment) {
			$mapDataTableValues['header'][$courseFormPayment->form_payment_id] = [
				'label' => $courseFormPayment->formPayment->description,
				'column' => $courseFormPayment->form_payment_id,
			];

			$mapDataTableValues['data'][$courseFormPayment->desc][$courseFormPayment->form_payment_id][] = $courseFormPayment->toArray();
		}

		$cities = [];
		$course['doesRegistre'] = false;

		foreach ($course->class as $class) {
			if ($class->city_id) {
				$cities[$class->city_id] = $class->city;
			}

			if (!$course['doesRegistre'] && $class->does_registre == '1') {
				$course['doesRegistre'] = true;
			}
		}

		$course['cities'] = $cities;
		// return $course;

		return view('site/cetcc/pages/course_details')
		->with('flgPage', $flgPage)
		->with('mapDataTableValues', $mapDataTableValues)
		->with('course', $course)
		->with('banner', SlideModel::whereHas('contentPage', function($query) use ($flgPage) {
			$query->where('flg_page', $flgPage);
		})->first())
		->with('footerLinks', $this->generateFooterLinks());
	}
}
