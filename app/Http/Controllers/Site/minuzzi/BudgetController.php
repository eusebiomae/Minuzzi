<?php

namespace App\Http\Controllers\Site\minuzzi;

use App\Http\Controllers\Controller;
use App\Model\api\ContentPageModel;
use App\Model\api\Prospection\CourseModel;
use App\Model\api\SlideModel;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $flgPage = $request->get('flgPage');

        $pageComponents = ContentPageModel::getByComponent($flgPage);


		// $banner = SlideModel::whereHas('contentPage', function ($query) use ($flgPage) {
		// 	$query->where('flg_page', $flgPage);
        // })->get();

        // return $pageComponents;
        return view('site/pages/default')
        ->with('flgPage', $flgPage)
        // ->with('banner', $banner)
        ->with('pageComponents', $pageComponents);
        // ->with('banner', $banner);
    }

    public function getPost(Request $request, $id) {

        $flgPage = $request->get('flgPage');

        $pageComponents = ContentPageModel::getByComponent($flgPage);

        $product = CourseModel::find($id);

        // return $blog;

        return view ('site/pages/blog_details')
        ->with('flgPage', $flgPage)
        ->with('pageComponents', $pageComponents)
        ->with('product', $product);
    }

}
