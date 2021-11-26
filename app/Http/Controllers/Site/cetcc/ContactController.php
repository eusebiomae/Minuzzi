<?php

namespace App\Http\Controllers\site\cetcc;

use Illuminate\Http\Request;
use App\Model\api\SchoolInformationModel;
use App\Model\api\SlideModel;
use App\Model\api\FeatureModel;
use App\Model\api\ContentModel;
use Illuminate\Support\Facades\App;

class ContactController extends _Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$flgPage = $request->get('flgPage');

		$content = ContentModel::whereHas('contentPage', function ($query) use ($flgPage) {
			$query->where('flg_page', $flgPage);
		})->get();

		// $features = FeatureModel::whereHas('contentPage', function($query) use ($flgPage) {
		// 	$query->where('flg_page', $flgPage);
		// })->get();

		$schoolInformation = schoolInformation();

		$features = [
			(object) [
				'icon' => 'pe-7s-phone',
				'title' => 'Telefone',
				'description' => $schoolInformation->phone1,
			],
			(object) [
				'icon' => 'pe-7s-mail',
				'title' => 'E-mail',
				'description' => $schoolInformation->email1,
			],
			(object) [
				'icon' => 'pe-7s-map',
				'title' => 'Endereço',
				'description' => $schoolInformation->fullAddress,
			],
		];

		return view('site/cetcc/pages/contact')
			->with('flgPage', $flgPage)
			->with('schoolInformation', $schoolInformation)
			->with('features', $features)
			->with('banner', SlideModel::whereHas('contentPage', function($query) use ($flgPage) {
				$query->where('flg_page', $flgPage);
			})->first())
			->with('content', $content)
			->with('footerLinks', $this->generateFooterLinks());
	}

	public function save(Request $request) {
		// \Illuminate\Support\Facades\Mail::to('aysiondenosfero@gmail.com', 'Contato CETCC')->send(new \App\Mail\ContactMail($request->all()));

		return redirect()->back()->withInput(['savedSuccessfully' => true]);
	}
}
