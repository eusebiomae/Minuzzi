<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\Model\api\OrderModel;
use App\Model\api\StudentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', 'site\enar\HomeController@index')->name('home')->middleware(['injectFlgPage:home']);
Route::get('/calendar', 'site\enar\CalendarController@index')->name('calendar')->middleware(['injectFlgPage:calendar']);
Route::get('/faq', 'site\enar\FaqController@index')->name('faq')->middleware(['injectFlgPage:faq']);
Route::get('/contact', 'site\enar\ContactController@index')->name('contact')->middleware(['injectFlgPage:contact']);
Route::post('/contact/save', 'site\enar\ContactController@save')->name('contact')->middleware(['injectFlgPage:contact']);
Route::get('/avaliation', 'site\enar\AvaliationController@index')->name('avaliation')->middleware(['injectFlgPage:avaliation']);
Route::get('/register', 'site\enar\RegisterController@index')->name('register')->middleware(['injectFlgPage:register']);
Route::get('/institution', 'site\enar\InstitutionController@index')->name('institution')->middleware(['injectFlgPage:institution']);
Route::get('/about', 'site\enar\AboutController@index')->name('about')->middleware(['injectFlgPage:about']);
Route::get('/cronAsaasPayments', function() { return \App\Console\Jobs\CronAsaasPayments::run(); });

/*
Route::post('/contact/save', 'site\cetcc\ContactController@save')->middleware(['injectFlgPage:contact']);
Route::get('/about', 'site\cetcc\AboutController@index')->middleware(['injectFlgPage:about']);
Route::get('/supervision', 'site\cetcc\SupervisionController@index')->middleware(['injectFlgPage:supervision']);
Route::get('/teacher', 'site\cetcc\TeacherController@index')->middleware(['injectFlgPage:teacher']);
Route::get('/teacher/{id}', 'site\cetcc\TeacherController@teacher')->middleware(['injectFlgPage:teachers_details']);
Route::get('/team/{id}', 'site\cetcc\TeacherController@teacher')->middleware(['injectFlgPage:team_details']);
Route::get('/photos', 'site\cetcc\PhotosController@index')->middleware(['injectFlgPage:photos']);
Route::get('/photos/{id}', 'site\cetcc\PhotosController@index')->middleware(['injectFlgPage:photos']);
Route::get('/add_psychologist', 'site\cetcc\PsychologistController@add')->middleware(['injectFlgPage:add_psychologist']);
Route::post('/add_psychologist/save', 'site\cetcc\PsychologistController@save');
Route::get('/add_patient', 'site\cetcc\PatientController@add')->middleware(['injectFlgPage:add_patient']);
Route::post('/add_patient/save', 'site\cetcc\PatientController@save')->middleware(['injectFlgPage:add_patient']);
Route::get('/doc', 'site\cetcc\DocController@index')->middleware(['injectFlgPage:doc']);
Route::get('/recommendation', 'site\cetcc\RecommendationController@index')->middleware(['injectFlgPage:recommendation']);
// Route::get('/faq', 'site\cetcc\FaqController@index')->middleware(['injectFlgPage:faq']);
Route::get('/shopping_journey', 'site\cetcc\ShoppingJourneController@index')->middleware(['injectFlgPage:shopping_journey']);

Route::get('/blog', 'site\cetcc\BlogController@index')->middleware(['injectFlgPage:blog']);
Route::get('/article', 'site\cetcc\BlogController@index')->middleware(['injectFlgPage:article']);

Route::get('/blog/{id}/{title?}', 'site\cetcc\BlogController@getPost')->middleware(['injectFlgPage:blog']);
Route::get('/article/{id}/{title?}', 'site\cetcc\BlogController@getPost')->middleware(['injectFlgPage:article']);

Route::get('/blog/liked/{id}/{isLiked}', 'site\cetcc\BlogController@liked')->middleware(['injectFlgPage:blog']);
Route::post('/comment', 'site\cetcc\CommentController@post')->middleware(['injectFlgPage:comment']);
Route::get('/comment/blog/{blogId}', 'site\cetcc\CommentController@getByBlog')->middleware(['injectFlgPage:comment']);
Route::get('/search', 'site\cetcc\SearchController@search')->middleware(['injectFlgPage:search']);

Route::get('/satisfaction_survey', 'site\cetcc\SatisfactionSurveyController@index');
Route::post('/satisfaction_survey', 'site\cetcc\SatisfactionSurveyController@save');

Route::get('/link', function() {
	return file_get_contents(base_path() . '/public/maundy/index.html');
});

Route::get('course', 'site\cetcc\CourseController@default')->middleware(['injectFlgPage:course']);

Route::get('course/{id}', 'site\cetcc\CourseController@courseDetails')->middleware(['injectFlgPage:course_details']);

Route::get('resetPassword/{code}', function(Request $request, $code) {
	preg_match('/^(\w+)\-.+/', $code, $match);

	switch ($match[1]) {
		case 'studentArea':
			return view('student_area.login.login')->with('resetPasswordCode', $code);
		break;
	}

	return [$code, $request->all()];
});

Route::get('emailConfirmation/{code}', function(Request $request, $code) {
	preg_match('/^(\w+)\-.+/', $code, $match);

	switch ($match[1]) {
		case 'studentArea':
			$student = \App\Model\api\StudentModel::where('email_confirmation_code', $code)->first();
			if ($student) {
				$student->fill(['email_confirmation_code' => null])->save();
			}
		break;
	}

	return redirect('student_area/login');
});

Route::post('newsletter', function(Request $request) {
	(new App\Model\api\NewsletterModel)->fill($request->all())->save();

	return redirect()->back()->withInput([
		'feedbackMessages' => [
			[
				'type' => 'success',
				'title' => 'Newsletters',
				'body' => 'Você se cadastrou com sucessom! Aguarde novidades!',
			]
		]
	]);
});

Route::group([
	'prefix' => 'bill',
	'middleware' => [],
], function () {
	$ctrll = '@';

	Route::get('{table}/{id}', '\App\Http\Controllers\StudentArea\BillController@index')->where('table', 'order|orderParcel');
});

$mapCourseParam = [
	'ead' => [
		'flgPage' =>'ead',
		'flgCourse' =>'ead',
		'typeCourse' =>'course',
	],
	'presential' => [
		'flgPage' =>'presential',
		'flgCourse' =>'presential',
		'typeCourse' =>'course',
	],
	'semipresential' => [
		'flgPage' =>'semipresential',
		'flgCourse' =>'semipresential',
		'typeCourse' =>'course',
	],
	'lecture' => [
		'flgPage' =>'lecture',
		'flgCourse' =>'lecture',
		'typeCourse' =>'lecture',
	],
	'workshops' => [
		'flgPage' =>'workshops',
		'flgCourse' =>'workshop',
		'typeCourse' =>'workshop',
	],
];

Route::get('/{url}/{idCategory?}', function(Request $request, $url, $idCategory = null) use ($mapCourseParam) {
	foreach ($mapCourseParam[$url] as $key => $value) {
		$request[$key] = $value;
	}

	if (isset($idCategory)) {
		$request['idCategory'] = $idCategory;
	}

	return (new App\Http\Controllers\site\cetcc\CourseController)->default($request);
})->where('url', implode('|', array_keys($mapCourseParam)));

Route::get('ays', function() {
	$orders = OrderModel::where('status', 'AP')->get();
	// $orders = OrderModel::where('id', 1246)->get();

	$studentClassControl = [];
	$studentClassControlUtils = new \App\Utils\StudentClassControlUtils;
	for ($i = count($orders) - 1; $i > -1; $i--) {
		$studentClassControl[] = $studentClassControlUtils->generateByOrder($orders[$i]->id);
	}

	return count($studentClassControl);
	// return \App\Utils\ConfirmPaymentUtils::importCETCC();
	// return \Illuminate\Support\Facades\Mail::to('jonathaskranmer.s@gmail.com')->send(new App\Mail\EmailModel());

	// $student = StudentModel::find(34);

	// \Illuminate\Support\Facades\Mail::to($student->email)->send(new \App\Mail\EmailConfirmationMail($student));
});
*/
