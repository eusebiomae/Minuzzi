<?php

namespace App\Http\Controllers\site\cetcc;

use Illuminate\Http\Request;
use App\Model\api\SchoolInformationModel;
use App\Model\api\SlideModel;

class EventController extends _Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$flgPage = $request->get('flgPage');

		$slides = SlideModel::whereHas('contentPage', function ($query) use ($flgPage) {
			$query->where('flg_page', $flgPage);
		})->get();

		return view('site/cetcc/pages/event')
			->with('flgPage', $flgPage)
			->with('carrossel', $slides)
			->with('footerLinks', $this->generateFooterLinks());
	}
}
