<?php

namespace App\Http\Controllers\site\enar;

use App\Http\Controllers\Controller;
use App\Model\api\ContentPageModel;
use App\Model\api\FAQModel;
use App\Model\api\SlideModel;
use Illuminate\Http\Request;

class FaqController extends Controller
{

	public function index(Request $request)
	{

		$flgPage = $request->get('flgPage');

		$pageComponents = ContentPageModel::getByComponent($flgPage);
		$faq = FAQModel::orderBy('id','desc')->get();

		$banner = SlideModel::whereHas('contentPage', function ($query) use ($flgPage) {
			$query->where('flg_page', $flgPage);
		})->get();
		return view('site/pages/default')
		->with('pageComponents', $pageComponents)
		->with('banner', $banner)
		->with('faq', $faq);
	}
}
