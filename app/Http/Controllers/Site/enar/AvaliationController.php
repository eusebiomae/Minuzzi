<?php

namespace App\Http\Controllers\site\enar;

use App\Http\Controllers\Controller;
use App\Model\api\ContentPageModel;
use App\Model\api\FileSiteModel;
use App\Model\api\SlideModel;
use Illuminate\Http\Request;

class AvaliationController extends Controller
{

	public function index(Request $request)
	{

		$flgPage = $request->get('flgPage');

		$pageComponents = ContentPageModel::getByComponent($flgPage);
		$material = FileSiteModel::with([ 'typeFile'])->where('type_file_id', '2')->orderBy('id')->first();
		$avaliations = FileSiteModel::with([ 'typeFile'])->where('type_file_id', '1')->orderBy('id')->get();
		$feedback = FileSiteModel::with([ 'typeFile'])->where('type_file_id', '3')->orderBy('id')->get();
		$handout = FileSiteModel::with([ 'typeFile'])->where('type_file_id', '4')->orderBy('id')->get();


		$banner = SlideModel::whereHas('contentPage', function ($query) use ($flgPage) {
			$query->where('flg_page', $flgPage);
		})->get();

		return view('site/pages/default')
		->with('pageComponents', $pageComponents)
		->with('banner', $banner)
		->with('material', $material)
		->with('avaliations', $avaliations)
		->with('handout', $handout)
		->with('feedback', $feedback);
	}
}
