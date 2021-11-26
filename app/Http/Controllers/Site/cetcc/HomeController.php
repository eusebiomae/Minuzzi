<?php

namespace App\Http\Controllers\site\cetcc;

use Illuminate\Http\Request;
use App\Model\api\SchoolInformationModel;
use App\Model\api\SlideModel;
use App\Model\api\FeatureModel;
use App\Model\api\Prospection\CourseCategoryTypeModel;
use App\Model\api\Prospection\CourseModel;
use App\Model\api\BlogModel;
use App\Model\api\ContentPageModel;
use App\Model\api\TestemonialModel;
use App\Model\api\ContentSectionModel;
use App\Model\api\ContentModel;
use App\Model\api\Prospection\CourseCategoryModel;

class HomeController extends _Controller
{

	public function index(Request $request)
	{
		$flgPage = $request->get('flgPage');

		$carrossel = SlideModel::whereHas('contentPage', function ($query) use ($flgPage) {
			$query->where('flg_page', $flgPage);
		})->get();

		$features = FeatureModel::whereHas('contentPage', function ($query) use ($flgPage) {
			$query->where('flg_page', $flgPage);
		})->get();

		$categoriesCourseType = CourseCategoryTypeModel::select('id', 'title', 'description', 'image', 'flg')->get();

		$courseCategories = CourseCategoryModel::query()->whereHas('course.courseCategoryType', function($query) {
			$query->where('flg', 'presential');
		})->orderBy('description_pt')->get();

		$courses = CourseModel::where('show_home', '1')->with('courseCategory')->get();

		 $blogPosts = BlogModel::whereHas('category', function($query) {
			$query->where('flg_type', 'blog');
		})->with([
			'category' => function($query) {
				$query->select('id', 'description_pt');
			},
			'author' => function ($query) {
				$query->select('id', 'name');
			},
		])->orderBy('created_at', 'desc')->limit(4)->get();

		$testemonial = TestemonialModel::get();

		$contentsSection_1 = ContentSectionModel::whereHas('contentPage', function ($query) use ($flgPage) {
			$query->where('flg_page', $flgPage);
		})->where('flg', '1')->with('content')->first();

		$contentsSection_2 = ContentSectionModel::whereHas('contentPage', function ($query) use ($flgPage) {
			$query->where('flg_page', $flgPage);
		})->where('flg', '2')->with('content')->first();

		$contentsSection_3 = ContentSectionModel::whereHas('contentPage', function ($query) use ($flgPage) {
			$query->where('flg_page', $flgPage);
		})->where('flg', '3')->with('content')->first();

		return view('site/cetcc/pages/home')
			->with('flgPage', $flgPage)
			->with('pageComponents', ContentPageModel::getByComponent($flgPage))
			->with('features', $features)
			->with('categoriesCourseType', $categoriesCourseType)
			->with('carrossel', $carrossel)
			->with('courses', $courses)
			->with('blogPosts', $blogPosts)
			->with('testemonial', $testemonial)
			->with('contentsSection', [
				'1' => $contentsSection_1,
				'2' => $contentsSection_2,
				'3' => $contentsSection_3,
			])
			->with('courseCategories', $courseCategories)
			// ->with('content', $content)
			->with('footerLinks', $this->generateFooterLinks());
	}
}
