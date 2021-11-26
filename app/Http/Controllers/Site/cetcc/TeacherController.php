<?php

namespace App\Http\Controllers\site\cetcc;

use Illuminate\Http\Request;
use App\Model\api\Prospection\CourseModel;
use App\Model\api\SchoolInformationModel;
use App\Model\api\SlideModel;
use App\Model\api\TeamModel;

class TeacherController extends _Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$flgPage = $request->get('flgPage');

		$teams = TeamModel::whereHas('office', function($query) {
			$query->where('flg', 'teacher');
		})->with([
			'graduation', 'function',
		])
		->orderBy('name')->get();

		return view('site/cetcc/pages/teacher')
			->with('flgPage', $flgPage)
			->with('banner', SlideModel::whereHas('contentPage', function ($query) use ($flgPage) {
				$query->where('flg_page', $flgPage);
			})->first())
			->with('teams', $teams)
			->with('footerLinks', $this->generateFooterLinks());
	}

	public function teacher(Request $request, $id) {
		$flgPage = $request->get('flgPage');

		$payload = TeamModel::with([
			'graduation',
			'function',
		])->find($id);

		$payload['course'] = CourseModel::whereHas('class.classTeacher', function($query) use ($id) {
			$query->where('team_id', $id);
		})->get();

		return view('site/cetcc/pages/teachers_details')
			->with('payload', $payload)
			->with('flgPage', $flgPage)
			->with('banner', SlideModel::whereHas('contentPage', function ($query) use ($flgPage) {
				$query->where('flg_page', $flgPage);
			})->first())
			->with('footerLinks', $this->generateFooterLinks());
	}
}
