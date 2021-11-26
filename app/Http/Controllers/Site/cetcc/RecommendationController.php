<?php

namespace App\Http\Controllers\site\cetcc;

use Illuminate\Http\Request;
use App\Model\api\ContentPageModel;
use App\Model\api\Configuration\StateModel;
use App\Model\api\SchoolInformationModel;
use App\Model\api\SlideModel;


class RecommendationController extends _Controller
{

	private function getListSelectBox()
	{
		$list = [];

		$list['state'] = StateModel::all();

		return $list;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$flgPage = $request->get('flgPage');
		$listSelectBox = $this->getListSelectBox();

		$slides = SlideModel::whereHas('contentPage', function($query) use ($flgPage) {
			$query->where('flg_page', $flgPage);
		})->get();

		// return $slides;
		return view('site/cetcc/pages/default')
		->with('listSelectBox', $listSelectBox)
		->with('flgPage', $flgPage)
		->with('pageComponents', ContentPageModel::getByComponent($flgPage))
		->with('banner', SlideModel::whereHas('contentPage', function($query) use ($flgPage) {
			$query->where('flg_page', $flgPage);
		})->first())
		->with('footerLinks', $this->generateFooterLinks());
	}
}
