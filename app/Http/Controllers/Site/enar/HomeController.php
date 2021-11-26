<?php

namespace App\Http\Controllers\site\enar;
use App\Model\api\SlideModel;

use App\Http\Controllers\Controller;
use App\Model\api\ContentPageModel;
use App\Model\api\TestemonialModel;
use App\Model\api\Prospection\VideoModel;
use App\Model\api\FileSiteModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{

	public function index(Request $request)
	{
		$flgPage = $request->get('flgPage');

		$carousel = SlideModel::whereHas('contentPage', function ($query) use ($flgPage) {
			$query->where('flg_page', $flgPage);
		})->get();

		$pageComponents = ContentPageModel::getByComponent($flgPage);

		$testimonial = TestemonialModel::limit(5)->orderBy('id','desc')->get();

		$video = VideoModel::limit(4)->where('type', 'S')->orderBy('id')->get();

		$material = FileSiteModel::where('type_file_id', '2')->orderBy('id')->first();

		return view('site/pages/default')
		->with('carousel', $carousel)
		->with('pageComponents', $pageComponents)
		->with('testimonial', $testimonial)
		->with('video', $video)
		->with('material', $material);
	}
}
