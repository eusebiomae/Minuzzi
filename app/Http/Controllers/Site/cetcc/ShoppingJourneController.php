<?php

namespace App\Http\Controllers\site\cetcc;

use Illuminate\Http\Request;
use App\Model\api\SchoolInformationModel;
use App\Model\api\SlideModel;
use App\Model\api\ContentPageModel;
use App\Model\api\Configuration\StateModel;
use App\Model\api\CourseSupervisionModel;
use App\Model\api\FormPaymentModel;
use App\Model\api\Prospection\CourseModel;
use Illuminate\Support\Facades\Auth;

class ShoppingJourneController extends _Controller
{

	public function index(Request $request)
	{
		$flgPage = $request->get('flgPage');

		return view('site/cetcc/pages/default')
			->with('payload', (object) [
				'student' => Auth::guard('studentArea')->user(),
				'states' => StateModel::orderBy('abbreviation')->get(),
				'courses' => $request->has('supervision') ? null : CourseModel::with([
					'courseCategory',
					'courseCategoryType',
					'courseSubcategory',
					'class' => function($query) {
						$query->where('does_registre', '1');
					},
					'courseFormPayment.formPayment.introduction',
					'courseFormPayment.formPayment.bankAccount.bank',
					'courseFormPayment' => function($query) {
						$query->orderBy('value', 'desc');
					},
				])->get(),
				'supervision' => $request->has('supervision') ? CourseSupervisionModel::with([ 'course', 'teacher' ])
					->whereRaw('date >= CURRENT_DATE()')
					->orderBy('date')
					->get() : null,
			])
			->with('flgPage', $flgPage)
			->with('banner', SlideModel::whereHas('contentPage', function($query) use ($flgPage) {
				$query->where('flg_page', $flgPage);
			})->first())
			->with('pageComponents', ContentPageModel::getByComponent($flgPage))
			->with('footerLinks', $this->generateFooterLinks());
	}
}
