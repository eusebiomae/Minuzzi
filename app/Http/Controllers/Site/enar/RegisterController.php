<?php

namespace App\Http\Controllers\site\enar;

use App\Http\Controllers\Controller;
use App\Model\api\ContentPageModel;
use App\Model\api\SlideModel;
use Illuminate\Http\Request;
use App\Model\api\Configuration\StateModel;
use App\Model\api\CourseSupervisionModel;
use App\Model\api\Prospection\CourseCategoryModel;
use App\Model\api\Prospection\CourseCategoryTypeModel;
use App\Model\api\Prospection\CourseModel;
use App\Model\api\Prospection\CourseSubcategoryModel;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{


	public function index(Request $request)
	{
		$flgPage = $request->get('flgPage');

		$payload = (object) [
			'student' => Auth::guard('studentArea')->user(),
			'states' => StateModel::orderBy('abbreviation')->get(),
			'categoryType' => CourseCategoryTypeModel::orderBy('title')->get(),
			'category' => CourseCategoryModel::orderBy('description_pt')->get(),
			'subCategory' => CourseSubcategoryModel::orderBy('description_pt')->get(),
			'courses' => CourseModel::with([
				'class' => function($query) {
					$query->where('does_registre', '1');
				},
				'courseFormPayment' => function($query) {
					$query->with([
						'formPayment.introduction',
						'formPayment.bankAccount.bank',
					]);
					$query->orderBy('value', 'desc');
				},
			])->get(),
		];

		// if ($request->has('supervision')) {
		// 	$payload->supervision = CourseSupervisionModel::with([ 'course', 'teacher' ])
		// 	->whereRaw('date >= CURRENT_DATE()')
		// 	->orderBy('date')
		// 	->get();
		// } else {
		// 	$payload->categoryType = CourseCategoryTypeModel::orderBy('title')->get();
		// 	$payload->category = CourseCategoryModel::orderBy('description_pt')->get();
		// 	$payload->subCategory = CourseSubcategoryModel::orderBy('description_pt')->get();
		// 	$payload->courses = CourseModel::with([
		// 		'courseCategory',
		// 		'courseCategoryType',
		// 		'courseSubcategory',
		// 		'class' => function($query) {
		// 			$query->where('does_registre', '1');
		// 		},
		// 		'courseFormPayment' => function($query) {
		// 			$query->with([
		// 				'formPayment.introduction',
		// 				'formPayment.bankAccount.bank',
		// 			]);

		// 			$query->orderBy('value', 'desc');
		// 		},
		// 		'courseAdditional' => function($query) {
		// 			$query->select([ 'course_additional.*', 'additional.title' ]);
		// 			$query->with([ 'formPayment' ]);
		// 			$query->join('additional', 'additional.id', '=', 'course_additional.additional_id');
		// 			$query->orderBy('additional.title', 'asc');
		// 		},
		// 		'courseDiscount.discount',
		// 	])->orderBy('title_pt')->get();
		// }

		$pageComponents = ContentPageModel::getByComponent($flgPage);

		$banner = SlideModel::whereHas('contentPage', function ($query) use ($flgPage) {
			$query->where('flg_page', $flgPage);
		})->get();

		return view('site/pages/default')
			->with('payload', $payload)
			->with('pageComponents', $pageComponents)
			->with('banner', $banner);
	}
}
