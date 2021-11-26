<?php

namespace App\Http\Controllers\site\cetcc;

use Illuminate\Http\Request;
use App\Model\api\SchoolInformationModel;
use App\Model\api\SatisfactionSurveyModel;
use App\Model\api\TestemonialModel;
use App\Model\api\ContentPageModel;

class SatisfactionSurveyController extends _Controller
{

	public function index(Request $request)
	{
		return view('site/cetcc/pages/satisfactionSurvey')
		->with('flgPage', $request->get('flgPage'))
		->with('footerLinks', $this->generateFooterLinks());
	}

	public function save(Request $request) {
		$input = $request->all();

		if (isset($input['what_do_you_consider_positive_in_our_institution'])) {
			$input['what_do_you_consider_positive_in_our_institution'] = implode(', ', $input['what_do_you_consider_positive_in_our_institution']);
		}

		(new SatisfactionSurveyModel)->fill($input)->save();

		$fileName = '';

		if (!empty($request->file('fileImage'))) {
			$fileName = formatNameFile($request->file('fileImage')->getClientOriginalName());

			$request->file('fileImage')->move('storage/testemonial', $fileName);
		}

		if (!empty($input['text_pt'])) {
			$page = ContentPageModel::where('flg_page', 'home')->first();

			(new TestemonialModel)->fill([
				'name' => $input['name'],
				'image' => $fileName,
				'text_pt' => isset($input['text_pt']) ? $input['text_pt'] : '',
				'office' => isset($input['office']) ? $input['office'] : '',
				'abstract_pt' => isset($input['abstract_pt']) ? $input['abstract_pt'] : '',
				'content_page_id' => $page->id,
			])->save();
		}

		return redirect('/blog');
	}
}
