<?php

namespace App\Http\Controllers\Site\minuzzi;

use App\Http\Controllers\Controller;
use App\Model\api\ContentPageModel;
use App\Model\api\SlideModel;
use Illuminate\Http\Request;

class SupportController extends Controller
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

}
