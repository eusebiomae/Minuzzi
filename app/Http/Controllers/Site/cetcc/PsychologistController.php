<?php

namespace App\Http\Controllers\site\cetcc;

use Illuminate\Http\Request;
use App\Model\api\ContentPageModel;
use App\Model\api\Configuration\StateModel;
use App\Model\api\PsychologistModel;
use App\Model\api\SchoolInformationModel;
use App\Model\api\SlideModel;

class PsychologistController extends _Controller
{
	private function getListSelectBox()
	{
		$list = [];

		$list['state'] = StateModel::all();

		return $list;
	}

	public function add(Request $request)
	{
		$flgPage = $request->get('flgPage');

		$listSelectBox = $this->getListSelectBox();

		return view('site/cetcc/pages/default')
			->with('listSelectBox', $listSelectBox)
			->with('flgPage', $flgPage)
			->with('banner', SlideModel::whereHas('contentPage', function($query) use ($flgPage) {
				$query->where('flg_page', $flgPage);
			})->first())
			->with('pageComponents', ContentPageModel::getByComponent($flgPage))
			->with('footerLinks', $this->generateFooterLinks());
	}

	public function save(Request $request)
	{
		$psychologist = new PsychologistModel;

		$request['specialties'] = implode(', ', $request['specialties']);

		$psychologist->fill($request->all())->save();

		return redirect()->back()->withInput(['savedSuccessfully' => 1]);
	}
}
