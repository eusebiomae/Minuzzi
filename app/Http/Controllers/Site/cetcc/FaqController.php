<?php

namespace App\Http\Controllers\site\cetcc;

use Illuminate\Http\Request;
use App\Model\api\FAQModel;
use App\Model\api\SchoolInformationModel;
use App\Model\api\SlideModel;

class FaqController extends _Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$flgPage = $request->get('flgPage');

		return view('site/cetcc/pages/faq')
			->with('flgPage', $flgPage)
			->with('banner', SlideModel::whereHas('contentPage', function ($query) use ($flgPage) {
				$query->where('flg_page', $flgPage);
			})->first())
			->with('contentPage', FAQModel::all())
			->with('footerLinks', $this->generateFooterLinks());
	}
}
