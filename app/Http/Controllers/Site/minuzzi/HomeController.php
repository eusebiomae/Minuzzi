<?php

namespace App\Http\Controllers\site\minuzzi;

use App\Http\Controllers\Controller;
use App\Model\api\BlogModel;
use App\Model\api\CarouselModel;
use App\Model\api\ContentPageModel;
use App\Model\api\FeatureModel;
use App\Model\api\GaleryModel;
use App\Model\api\Prospection\CourseModel;
use App\Model\api\SlideModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $flgPage = $request->get('flgPage');

        $pageComponents = ContentPageModel::getByComponent($flgPage);

        $banners = SlideModel::where('content_page_id', 1)->get();

        $product = CourseModel::where('course_category_id')->get();

        // $products = CourseModel::where('course_category_type_id', 1)->get();
        $editions = CourseModel::where('course_category_id', 1)->orderBy('created_at', 'asc')->limit(3)->get();

        $events = BlogModel::where(	'blog_category_id', 1)->orderBy('created_at', 'desc')->limit(3)->get();

        // return $pageComponents;

        return view('site/pages/default')
        ->with('flgPage', $flgPage)
        ->with('banners', $banners)
        ->with('product', $product)
        ->with('editions', $editions)
        ->with('events', $events)
        ->with('pageComponents', $pageComponents);
    }

    public function languageDemo(){
        return view('languageDemo');
    }
}
