<?php

namespace App\Http\Controllers\Site\minuzzi;

use App\Http\Controllers\Controller;
use App\Model\api\ContentPageModel;
use App\Model\api\FeatureModel;
use App\Model\api\Prospection\CourseCategoryModel;
use App\Model\api\Prospection\CourseCategoryTypeModel;
use App\Model\api\Prospection\CourseModel;
use App\Model\api\Prospection\CourseSubcategoryModel;
use App\Model\api\SlideModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
	{
		$flgPage = $request->get('flgPage');
		$flgCourse = $request->get('flgCourse');
        // $typeCourse = $request->get('typeCourse');

        $pageComponents = ContentPageModel::getByComponent($flgPage);

        $banner = SlideModel::whereHas('contentPage', function ($query) use ($flgPage) {
            		$query->where('flg_page', $flgPage);
                })->get();

				$products = CourseModel::where('course_category_type_id', 1)
				->with([
					'courseCategory' => function($query){
						$query->select('id', 'description_pt');
					},
					'courseSubcategory' => function($query){
						$query->select('id', 'description_pt', 'flg');
					}
				])
				->get();

		// $courses = CourseModel::select('id', 'img', 'title_pt', 'subtitle_pt', 'course_category_id', 'course_subcategory_id', 'course_category_type_id')
		// ->with([
		// 	'courseCategory' => function($query){
		// 		$query->select('id', 'description_pt');
		// 	},
		// 	'courseCategoryType' => function($query){
		// 		$query->select('id', 'title', 'flg');
		// 	},
		// 	'courseSubcategory' => function($query){
		// 		$query->select('id', 'description_pt', 'flg');
		// 	}])
		// ->whereNull('inactive')->get();

		// return $products;

		return view('site/pages/default')
			->with('params', $request->all())
			->with('flgPage', $flgPage)
            ->with('pageComponents', $pageComponents)
			->with('banner', $banner)
			->with('products', $products)
			// ->with('courseCategoryTypes', CourseCategoryTypeModel::all())
			// ->with('courseCategories', CourseCategoryModel::all())
			// ->with('courseSubcategories', CourseSubcategoryModel::all())
			// ->with('courses', $courses)
			->with('flgCourseCategoryType', $flgCourse);
	}


    public function getPost(Request $request, $id) {

        $flgPage = $request->get('flgPage');

        $pageComponents = ContentPageModel::getByComponent($flgPage);

        $product = CourseModel::find($id);

        $editions = CourseModel::where('course_category_id', 1)->inRandomOrder('')->limit(3)->get();

        // return $blog;

        return view ('site/pages/blog_details')
        ->with('flgPage', $flgPage)
        ->with('pageComponents', $pageComponents)
        ->with('product', $product)
        ->with('editions', $editions);
    }
}
