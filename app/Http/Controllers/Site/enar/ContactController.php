<?php

namespace App\Http\Controllers\site\enar;

use App\Http\Controllers\Controller;
use App\Model\api\ContactModel;
use App\Model\api\ContentPageModel;
use App\Model\api\SlideModel;
use GigaGetData;
use Illuminate\Http\Request;

class ContactController extends Controller
{

	public function index(Request $request)
	{

		$flgPage = $request->get('flgPage');

		$pageComponents = ContentPageModel::getByComponent($flgPage);

		$banner = SlideModel::whereHas('contentPage', function ($query) use ($flgPage) {
			$query->where('flg_page', $flgPage);
		})->get();

		return view('site/pages/default')
		->with('pageComponents', $pageComponents)
		->with('banner', $banner);
	}

	public function save(Request $request) {
		$footer = GigaGetData::footer();
		\Illuminate\Support\Facades\Mail::to($footer['e-mail'], 'Contato Enar')->send(new \App\Mail\ContactMail($request->all()));
		$contact = new ContactModel();
		$contact->fill($request->all())->save();

		return redirect()->back()->withInput(['savedSuccessfully' => true]);
	}
}
