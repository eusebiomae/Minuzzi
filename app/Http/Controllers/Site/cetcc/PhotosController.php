<?php

namespace App\Http\Controllers\site\cetcc;

use Illuminate\Http\Request;
use App\Model\api\ContentPageModel;
use App\Model\api\SchoolInformationModel;
use App\Model\api\SlideModel;

class PhotosController extends _Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$flgPage = $request->get('flgPage');

		// return ContentPageModel::getByComponent($flgPage);
		return view('site/cetcc/pages/default')
			->with('flgPage', $flgPage)
			->with('photoGalery', isset($request->id) ? \App\Model\api\GaleryModel::with('photoGalery')->find($request->id) : false)
			->with('banner', SlideModel::whereHas('contentPage', function($query) use ($flgPage) {
				$query->where('flg_page', $flgPage);
			})->first())
			->with('pageComponents', ContentPageModel::getByComponent($flgPage))
			->with('footerLinks', $this->generateFooterLinks());
	}
}
