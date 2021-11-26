<?php

namespace App\Http\Controllers\site\enar;

use App\Http\Controllers\Controller;
use App\Model\api\ContentPageModel;
use App\Model\api\EventModel;
use App\Model\api\SlideModel;
use Illuminate\Http\Request;

class CalendarController extends Controller
{

	public function index(Request $request)
	{
		$flgPage = $request->get('flgPage');

		$pageComponents = ContentPageModel::getByComponent($flgPage);

		$banner = SlideModel::whereHas('contentPage', function ($query) use ($flgPage) {
			$query->where('flg_page', $flgPage);
		})->get();

		$eventModel = EventModel::select(['event_datetime as start', 'title_pt as title'])->get();

		return view('site/pages/default')
		->with('pageComponents', $pageComponents)
		->with('calendar', $eventModel)
		->with('banner', $banner);
	}
}
