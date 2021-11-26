<?php

namespace App\Http\Controllers\site\cetcc;

use Illuminate\Http\Request;
use App\Model\api\ContentPageModel;
use App\Model\api\SchoolInformationModel;
use App\Model\api\SlideModel;
use App\Model\api\CourseSupervisionModel;

class SupervisionController extends _Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		$flgPage = $request->get('flgPage');

		$banner = SlideModel::whereHas('contentPage', function ($query) use ($flgPage) {
			$query->where('flg_page', $flgPage);
		})->first();

		$contentPage = ContentPageModel::getByComponent($flgPage);

		foreach ($contentPage->contentSection as &$contentSection) {
			if ($contentSection->component == 'table_supervision') {

				$tableSupervision = [];
				$courseSupervision = CourseSupervisionModel::with([ 'course', 'teacher' ])
					->whereRaw('date >= CURRENT_DATE()')
					->orderBy('date')
					->get();

				foreach ($courseSupervision as &$courseSupervisionItem) {
					$courses = [];

					foreach ($courseSupervisionItem->course as $course) {
						$courses[] = $course->title_pt;
					}

					$courseSupervisionItem['courses'] = $courses;

					$tableSupervision[substr($courseSupervisionItem->date, 3)][] = $courseSupervisionItem;
				}

				$contentSection['content'] = $tableSupervision;

				// return ($contentSection['content']);
			}
		}

		return view('site/cetcc/pages/default')
			->with('flgPage', $flgPage)
			->with('banner', $banner)
			->with('pageComponents', $contentPage)
			->with('footerLinks', $this->generateFooterLinks());
	}
}
