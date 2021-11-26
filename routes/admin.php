<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
// Login
Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
// Password reset routes
Route::post('password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('password/reset', 'Auth\AdminResetPasswordController@reset');
Route::get('password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

Route::group([ 'middleware' => [ 'auth:admin' ] ], function() {

	/*
	Route::get('allClass/{studentId}', function($studentId) {
		$classModel = \App\Model\api\Prospection\ClassModel::get();
		$studentClassControlUtils = new \App\Utils\StudentClassControlUtils;
		$orderIds = [];

		foreach ($classModel as $class) {
			$order = new \App\Model\api\OrderModel;

			$order->fill([
				'student_id' => $studentId,
				'course_id' => $class->course_id,
				'class_id' => $class->id,
				'number_parcel' => 1,
				'value' => 0,
				'status' => 'AP',
				'imported' => '2',
			])->save();

			$studentClassControlUtils->generateByOrder($order->id);

			$orderIds[] = $order->id;
		}

		return $orderIds;
	});
	*/


	Route::get('/', 'Admin\HomeController@index')->name('admin.dashboard');

	// Gestão Clientes
	Route::group([ 'prefix' => 'dashboardProspection' ], function () {
		$ctrll = 'Admin\DashboardProspectionController@';
		$name = 'admin.dashboardProspection';

		Route::get('', "{$ctrll}dashboard")->name($name);
		Route::get('last30DaysPCX', "{$ctrll}last30DaysPCX")->name($name);
	});

	// Gerenciamento e Configuração de Equipe
	// Otimizado por Joel Zanata - Normalização do Código
	// 24/08/2020
	Route::group([ 'prefix' => 'team' ], function () {
		$ctrll = 'Admin\TeamController@';
		$name = 'admin.team';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});


	// Gerenciamento e Configuração Paginas do site
	// Otimizado por Joel Zanata - Normalização do Código
	// 24/08/2020
	Route::group([ 'prefix' => 'contentpage' ], function () {
		$ctrll = 'Admin\ContentPageController@';
		$name = 'admin.configuration_page.contentpage';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'contentsection' ], function () {
		$ctrll = 'Admin\ContentSectionController@';
		$name = 'admin.configuration_page.contentsection';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'content' ], function () {
		$ctrll = 'Admin\ContentController@';
		$name = 'admin.configuration_page.content';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'slide' ], function () {
		$ctrll = 'Admin\SlideController@';
		$name = 'admin.configuration_page.slide';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'feature' ], function () {
		$ctrll = 'Admin\FeatureController@';
		$name = 'admin.configuration_page.feature';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'galery' ], function () {
		$ctrll = 'Admin\GaleryController@';
		$name = 'admin.configuration_page.galery';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'link_footer' ], function () {
		$ctrll = 'Admin\LinkFooterController@';
		$name = 'admin.configuration_page.link_footer';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'phrase' ], function () {
		$ctrll = 'Admin\PhraseController@';
		$name = 'admin.configuration_page.phrase';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);

	});

	Route::group([ 'prefix' => 'video' ], function () {
		$ctrll = 'Admin\VideoController@';
		$name = 'admin.configuration_page.video';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});









	Route::group(['prefix' => 'prospection'], function () {

		$pcxRoute = function($type) {
			return function () use ($type) {
				$ctrll = 'Admin\Prospection\Leads\LeadsController@';
				$name = 'admin.prospection.'.$type;
				Route::get('', "{$ctrll}list")->name($name);
				Route::get('/insert', "{$ctrll}insert")->name($name);
				Route::get('/update/{id}', "{$ctrll}update")->name($name);
				Route::get('/delete/{id}', "{$ctrll}delete")->name($name);
				Route::get('/enable/{id}', "{$ctrll}enable")->name($name);
				Route::post('/save', "{$ctrll}save")->name($name);

				Route::post('/phone_contact', "{$ctrll}phoneContactSave")->name($name);
				Route::get('/phone_contact/delete/{id}', "{$ctrll}phoneContactDelete")->name($name);
				Route::get('/phone_contact/enable/{id}', "{$ctrll}phoneContactEnable")->name($name);

				Route::get('/json', "{$ctrll}getJson")->name($name);
				Route::get('/dataTables', "{$ctrll}getDataTables")->name($name);
				Route::post('/import', "{$ctrll}import")->name($name);
				Route::post('/exists_email', "{$ctrll}existsEmail")->name($name);
			};
		};

		Route::group([
			'prefix' => 'prospect',
			'middleware' => ['injectTypeLeads:P']
		], $pcxRoute('prospect'));

		Route::group([
			'prefix' => 'client',
			'middleware' => ['injectTypeLeads:C']
		], $pcxRoute('client'));

		Route::group([
			'prefix' => 'former_client',
			'middleware' => ['injectTypeLeads:X']
		], $pcxRoute('former_client'));

		Route::group([ 'prefix' => 'guestbook' ], function () {
			$ctrll = 'Admin\Prospection\GuestBook\GuestBookController@';
			$name = 'admin.prospection.guestbook';

			Route::get('', "{$ctrll}list")->name($name);
			Route::get('update', "{$ctrll}form")->name($name);
			Route::get('/', "{$ctrll}list")->name($name);
			Route::get('/insert/{idLead?}/{idLeadsVisit?}', "{$ctrll}insert")->name($name);
			Route::get('/update/{id}', "{$ctrll}update")->name($name);
			Route::get('/delete/{id}', "{$ctrll}delete")->name($name);
			Route::get('/enable/{id}', "{$ctrll}enable")->name($name);
			Route::post('/save', "{$ctrll}save")->name($name);
			Route::post('/phone_contact', "{$ctrll}savePhoneContact")->name($name);
			Route::post('/pos_visit', "{$ctrll}savePosVisit")->name($name);
			Route::post('/lead', "{$ctrll}saveLead")->name($name);
			Route::post('/schedule', "{$ctrll}saveLeadsVisit")->name($name);
			Route::get('getHTMLquestionPCX/{flgType}', "{$ctrll}getHTMLquestionPCX")->name($name);
		});

		Route::group([ 'prefix' => 'visitSchedule' ], function () {
			$ctrll = 'Admin\Prospection\VisitSchedule\VisitScheduleController@';
			$name = 'admin.prospection.visitSchedule';

			Route::get('/', "{$ctrll}list")->name($name);
			Route::post('/schedule', "{$ctrll}scheduleSave")->name($name);
		});

		//NÃO SEI ONDE ESTÁ SENDO USADO
		// Route::get('dashboard-modelo', 'Admin\Prospection\DashboardController@dashboardModelo');
		// Route::get('/matriculationList', 'Admin\Prospection\MatriculationListController@list');
		// Route::get('/waitingList', 'Admin\Prospection\WaitingListController@list');

	});

	Route::group([ 'prefix' => 'routine_management' ], function () {
		Route::group([ 'prefix' => 'productivity' ], function () {
			$ctrll = 'Admin\ProductivityController@';
			$name = 'admin.routine_management.productivity';

			Route::get('', "{$ctrll}list")->name($name);
			Route::get('insert', "{$ctrll}insert")->name($name);
			Route::get('update/{id}', "{$ctrll}update")->name($name);
			Route::get('delete/{id}', "{$ctrll}delete")->name($name);
			Route::get('enable/{id}', "{$ctrll}enable")->name($name);
			Route::post('save', "{$ctrll}save")->name($name);
		});

		Route::group([ 'prefix' => 'goal_pcx' ], function () {
			$ctrll = 'Admin\RoutineManagement\GoalPCXController@';
			$name = 'admin.routine_management.goal_pcx';

			Route::get('', "{$ctrll}list")->name($name);
			Route::get('insert', "{$ctrll}insert")->name($name);
			Route::get('update/{id}', "{$ctrll}update")->name($name);
			Route::get('delete/{id}', "{$ctrll}delete")->name($name);
			Route::get('enable/{id}', "{$ctrll}enable")->name($name);
			Route::post('save', "{$ctrll}save")->name($name);

			Route::group([ 'prefix' => 'full' ], function () {
				$ctrll = 'Admin\RoutineManagement\GoalPCXFullController@';
				$name = 'admin.routine_management.goal_pcx.full';

				Route::get('insert', "{$ctrll}insert")->name($name);
				Route::get('update/{id}', "{$ctrll}update")->name($name);
				Route::get('delete/{id}', "{$ctrll}delete")->name($name);
				Route::get('enable/{id}', "{$ctrll}enable")->name($name);
				Route::post('save', "{$ctrll}save")->name($name);
				Route::get('remove/{type}/{id}', "{$ctrll}removePCXA")->name($name);
				Route::post('phone-contact', "{$ctrll}phoneContactSave")->name($name);
			});
		});

		Route::group([ 'prefix' => 'activities' ], function () {
			$ctrll = 'Admin\RoutineManagement\ActivitiesGoalPCXController@';
			$name = 'admin.routine_management.activities';

			Route::get('', "{$ctrll}list")->name($name);
			Route::get('insert', "{$ctrll}insert")->name($name);
			Route::get('update/{id}', "{$ctrll}update")->name($name);
			Route::get('delete/{id}', "{$ctrll}delete")->name($name);
			Route::get('enable/{id}', "{$ctrll}enable")->name($name);
			Route::post('save', "{$ctrll}save")->name($name);
			Route::get('/json', "{$ctrll}getJson")->name($name);
		});

		Route::group([ 'prefix' => 'dashboard' ], function () {
			$ctrll = 'Admin\RoutineManagement\DashboardController@';
			$name = 'admin.routine_management.dashboard';

			Route::get('', "{$ctrll}dashboard")->name($name);
		});

		Route::group([ 'prefix' => 'report_goal_pcx' ], function () {
			$ctrll = 'Admin\RoutineManagement\ReportGoalPCXController@';
			$name = 'admin.routine_management.report_goal_pcx';

			Route::get('', "{$ctrll}report")->name($name);
			Route::post('data', "{$ctrll}getData")->name($name);
			Route::post('report', "{$ctrll}getReport")->name($name);
		});
	});

	Route::group([ 'prefix' => 'course_category_type' ], function () {
		$ctrll = 'Admin\CourseCategoryTypeController@';
		$name = 'admin.course_management.course_category_type';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'course_category' ], function () {
		$ctrll = 'Admin\CourseCategoryController@';
		$name = 'admin.course_management.course_category';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'course_subcategory' ], function () {
		$ctrll = 'Admin\CourseSubcategoryController@';
		$name = 'admin.course_management.course_subcategory';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'course' ], function () {
		$ctrll = 'Admin\CourseController@';
		$name = 'admin.course_management.course';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'class' ], function () {
		$ctrll = 'Admin\ClassController@';
		$name = 'admin.course_management.class';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'content_course' ], function () {
		$ctrll = 'Admin\ContentCourseController@';
		$name = 'admin.course_management.content_course';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'bonus_course' ], function () {
		$ctrll = 'Admin\BonusCourseController@';
		$name = 'admin.course_management.bonus_course';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'file' ], function () {
		$ctrll = 'Admin\FileController@';
		$name = 'admin.course_management.file';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
		// Route::get('download/{nameFile}', "{$ctrll}download")->name($name);
		// Route::get('download', "{$ctrll}list")->name($name.'download');
	});

	Route::group([ 'prefix' => 'file_site' ], function () {
		$ctrll = 'Admin\FileSiteController@';
		$name = 'admin.configuration_page.file_site';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
		// Route::get('download/{nameFfleSite}', "{$ctrll}download")->name($name);
		// Route::get('download', "{$ctrll}list")->name($name.'download');
	});

	Route::group([ 'prefix' => 'contact' ], function () {
		$ctrll = 'Admin\ContactController@';
		$name = 'admin.site.contact';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
	});

	//dom massas
	Route::group([ 'prefix' => 'reseller' ], function () {
		$ctrll = 'Admin\ResellerController@';
		$name = 'admin.site.reseller';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
	});

	Route::group([ 'prefix' => 'carousel' ], function () {
		$ctrll = 'Admin\CarouselController@';
		$name = 'admin.site.carousel';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	// Módulo Gestão Aluno
	Route::group([
		'prefix' => 'student'
	], function () {
		$ctrll = 'Admin\StudentController@';
		$name = 'admin.student_management.student';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('supervision', "{$ctrll}listSupervision")->name('admin.student_management.student.supervision');
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
		Route::get('orderParcel', "{$ctrll}orderParcel")->name($name);
		Route::post('transactionGenerated', "{$ctrll}transactionGenerated")->name($name);
		Route::get('generateContract/{id}', "{$ctrll}generateContract")->name($name);
		Route::get('viewContract/{id}', "{$ctrll}viewContract")->name($name);
		Route::post('generateTransaction', "{$ctrll}generateTransaction")->name($name);
	});

	Route::group([
		'prefix' => 'rank'
	], function () {
		$ctrll = 'Admin\RankController@';
		$name = 'admin.rank';

		Route::get('all', "{$ctrll}all")->name($name.'.all');
	});

	Route::group([ 'prefix' => 'registration' ], function () {
		$ctrll = 'Admin\RegistrationController@';
		$name = 'admin.student_management.registration';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});
	Route::group([ 'prefix' => 'registry' ], function () {
		$ctrll = 'Admin\RegistryController@';
		$name = 'admin.student_management.registry';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);

		Route::post('/payment_history', "{$ctrll}savePaymentHistory")->name($name);
		Route::get('/payment_history_dlt/{id}', "{$ctrll}deletePaymentHistory")->name($name);
		Route::post('/phone_contact', "{$ctrll}savePhoneContact")->name($name);

	});


	Route::group(['prefix' => 'prospection'], function () {
		// Módulo cursos




		Route::group([ 'prefix' => 'class_list' ], function () {
			$ctrll = 'Admin\Prospection\ClassGroup\ClassListController@';
			$name = 'admin.student_management.class_list';

			Route::get('', "{$ctrll}list")->name($name);
			Route::get('insert', "{$ctrll}insert")->name($name);
			Route::get('update/{id}', "{$ctrll}update")->name($name);
			Route::get('delete/{id}', "{$ctrll}delete")->name($name);
			Route::get('enable/{id}', "{$ctrll}enable")->name($name);
			Route::post('save', "{$ctrll}save")->name($name);
		});

		// Route::get('/file/download/{nameFile}', 'Admin\Prospection\File\FileDownloadController@download')->middleware('auth:admin');
		// Route::get('/file_download', 'Admin\Prospection\File\FileDownloadController@list')->middleware('auth:admin');
	});

	// Módulo cursos
	Route::group([ 'prefix' => 'course_supervision' ], function () {
		$ctrll = 'Admin\CourseSupervisionController@';
		$name = 'admin.course_management.course_supervision';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'place' ], function () {
		$ctrll = 'Admin\PlaceController@';
		$name = 'admin.course_management.place';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	// Módulo Gestão Aluno
	Route::group([ 'prefix' => 'make_student_registration' ], function () {
		$ctrll = 'Admin\MakeStudentRegistrationController@';
		$name = 'admin.student_management.make_student_registration';

		Route::get('', "{$ctrll}index")->name($name);
		Route::post('', "{$ctrll}save")->name($name);
		Route::post('get_order', "{$ctrll}getOrder")->name($name);
	});

	Route::group([ 'prefix' => 'class_student_registration' ], function () {
		$ctrll = 'Admin\MakeStudentRegistrationController@';
		$name = 'admin.student_management.class_student_registration';

		Route::get('', "{$ctrll}index")->name($name);
		Route::post('', "{$ctrll}save")->name($name);
		Route::post('get_order', "{$ctrll}getOrder")->name($name);
	});

	Route::group([ 'prefix' => 'class_release', ], function () {
		$ctrll = 'Admin\ClassReleaseController@';
		$name = 'admin.student_management.class_release';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('update/{id}', "{$ctrll}form")->name($name);
		Route::post('getList', "{$ctrll}getList")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	// Módulo Gestão Financeira
	Route::group([ 'prefix' => 'introduction' ], function () {
		$ctrll = 'Admin\IntroductionController@';
		$name = 'admin.introduction';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'bank_account' ], function () {
		$ctrll = 'Admin\Financial\BankAccountController@';
		$name = 'admin.finance_management.bank_account';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'contract' ], function () {
		$ctrll = 'Admin\Financial\ContractController@';
		$name = 'admin.finance_management.contract';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'form_payment' ], function () {
		$ctrll = 'Admin\FormPaymentController@';
		$name = 'admin.finance_management.form_payment';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'type_payment' ], function () {
		$ctrll = 'Admin\TypePaymentController@';
		$name = 'admin.finance_management.type_payment';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	// Informação Empresa
	Route::group([ 'prefix' => 'schoolinformation' ], function () {
		$ctrll = 'Admin\SchoolInformationController@';
		$name = 'admin.schoolinformation';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	// Informação Usuário
	Route::group([ 'prefix' => 'user' ], function () {
		$ctrll = 'Admin\UserController@';
		$name = 'admin.user';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
		Route::get('email', "{$ctrll}email")->name($name);
	});

	// Informação Blog
	Route::group([ 'prefix' => 'blog' ], function () {
		$ctrll = 'Admin\BlogController@';
		$name = 'admin.blog.post';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
		Route::get('/removeTags/{id}', "{$ctrll}removeTags")->name($name);
	});

	Route::group([ 'prefix' => 'question' ], function () {
		$ctrll = 'Admin\QuestionController@';
		$name = 'admin.question';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
		Route::get('alternative/remove/{id}', "{$ctrll}alternativeRemove")->name($name);

	});

	Route::group([ 'prefix' => 'avaliation' ], function () {
		$ctrll = 'Admin\AvaliationController@';
		$name = 'admin.avaliation';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
		Route::get('alternative/remove/{id}', "{$ctrll}alternativeRemove")->name($name);

	});

	Route::group([ 'prefix' => 'type_file' ], function () {
		$ctrll = 'Admin\TypeFileController@';
		$name = 'admin.configuration_page.type_file';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	// // Informação Blog
	Route::group([ 'prefix' => 'blog' ], function () {

		Route::group([ 'prefix' => 'category' ], function () {
			$ctrll = 'Admin\BlogCategoryController@';
			$name = 'admin.blog.category';

			Route::get('', "{$ctrll}list")->name($name);
			Route::get('insert', "{$ctrll}insert")->name($name);
			Route::get('update/{id}', "{$ctrll}update")->name($name);
			Route::get('delete/{id}', "{$ctrll}delete")->name($name);
			Route::get('enable/{id}', "{$ctrll}enable")->name($name);
			Route::post('save', "{$ctrll}save")->name($name);
		});

		Route::group([ 'prefix' => 'tags' ], function () {
			$ctrll = 'Admin\BlogTagsController@';
			$name = 'admin.blogTags';

			Route::get('', "{$ctrll}list")->name($name);
			Route::get('insert', "{$ctrll}insert")->name($name);
			Route::get('update/{id}', "{$ctrll}update")->name($name);
			Route::get('delete/{id}', "{$ctrll}delete")->name($name);
			Route::get('enable/{id}', "{$ctrll}enable")->name($name);
			Route::post('save', "{$ctrll}save")->name($name);
			Route::get('json', "{$ctrll}json")->name($name);
		});

	});

	Route::group([ 'prefix' => 'city' ], function () {
		$ctrll = 'Admin\CityController@';
		$name = 'admin.city';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group(['prefix' => 'configuration'], function () {

		Route::group([ 'prefix' => 'bank' ], function () {
			$ctrll = 'Admin\Configuration\BankController@';
			$name = 'admin.configuration.bank';

			Route::get('', "{$ctrll}list")->name($name);
			Route::get('insert', "{$ctrll}insert")->name($name);
			Route::get('update/{id}', "{$ctrll}update")->name($name);
			Route::get('delete/{id}', "{$ctrll}delete")->name($name);
			Route::get('enable/{id}', "{$ctrll}enable")->name($name);
			Route::post('save', "{$ctrll}save")->name($name);

		});



		//NÃO USADOS NO PROJETO CETCC
		Route::group([ 'prefix' => 'englishlevel' ], function () {
			$ctrll = 'Admin\Configuration\EnglishLevelController@';
			$name = 'admin.englishlevel';

			Route::get('', "{$ctrll}list")->name($name);
			Route::get('insert', "{$ctrll}insert")->name($name);
			Route::get('update/{id}', "{$ctrll}update")->name($name);
			Route::get('delete/{id}', "{$ctrll}delete")->name($name);
			Route::get('enable/{id}', "{$ctrll}enable")->name($name);
			Route::post('save', "{$ctrll}save")->name($name);
		});

		Route::group([ 'prefix' => 'constructioncategory' ], function () {
			$ctrll = 'Admin\Configuration\ConstructionCategoryController@';
			$name = 'admin.constructioncategory';

			Route::get('', "{$ctrll}list")->name($name);
			Route::get('insert', "{$ctrll}insert")->name($name);
			Route::get('update/{id}', "{$ctrll}update")->name($name);
			Route::get('delete/{id}', "{$ctrll}delete")->name($name);
			Route::get('enable/{id}', "{$ctrll}enable")->name($name);
			Route::post('save', "{$ctrll}save")->name($name);
		});

		Route::group([ 'prefix' => 'alimentationtype' ], function () {
			$ctrll = 'Admin\Configuration\AlimentationTypeController@';
			$name = 'admin.alimentationtype';

			Route::get('', "{$ctrll}list")->name($name);
			Route::get('insert', "{$ctrll}insert")->name($name);
			Route::get('update/{id}', "{$ctrll}update")->name($name);
			Route::get('delete/{id}', "{$ctrll}delete")->name($name);
			Route::get('enable/{id}', "{$ctrll}enable")->name($name);
			Route::post('save', "{$ctrll}save")->name($name);
		});

		Route::group([ 'prefix' => 'alimentationcategory' ], function () {
			$ctrll = 'Admin\Configuration\AlimentationCategoryController@';
			$name = 'admin.alimentationcategory';

			Route::get('', "{$ctrll}list")->name($name);
			Route::get('insert', "{$ctrll}insert")->name($name);
			Route::get('update/{id}', "{$ctrll}update")->name($name);
			Route::get('delete/{id}', "{$ctrll}delete")->name($name);
			Route::get('enable/{id}', "{$ctrll}enable")->name($name);
			Route::post('save', "{$ctrll}save")->name($name);
		});

	});

	Route::group([ 'prefix' => 'newsletter' ], function () {
		$ctrll = 'Admin\NewsletterController@';
		$name = 'admin.newsletter';

		Route::get('', "{$ctrll}list")->name($name);
	});





	Route::group([ 'prefix' => 'patient' ], function () {
		$ctrll = 'Admin\Clinic\PatientController@';
		$name = 'admin.clinic.patient';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'psychologist' ], function () {
		$ctrll = 'Admin\Clinic\PsychologistController@';
		$name = 'admin.clinic.psychologist';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'testemonial' ], function () {
		$ctrll = 'Admin\TestemonialController@';
		$name = 'admin.testemonial';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'event' ], function () {
		$ctrll = 'Admin\EventController@';
		$name = 'admin.event';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'faq' ], function () {
		$ctrll = 'Admin\FaqController@';
		$name = 'admin.faq';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'office' ], function () {
		$ctrll = 'Admin\OfficeController@';
		$name = 'admin.office';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'graduation' ], function () {
		$ctrll = 'Admin\GraduationController@';
		$name = 'admin.graduation';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'function' ], function () {
		$ctrll = 'Admin\FunctionController@';
		$name = 'admin.function';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'work' ], function () {
		$ctrll = 'Admin\WorkController@';
		$name = 'admin.work';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::get('view/{id}', "{$ctrll}view")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'additional' ], function () {
		$ctrll = 'Admin\AdditionalController@';
		$name = 'admin.additional';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'discount' ], function () {
		$ctrll = 'Admin\DiscountController@';
		$name = 'admin.discount';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	//NÃO USADOS NO PROJETO CETCC
	Route::group([ 'prefix' => 'construction' ], function () {
		$ctrll = 'Admin\ConstructionController@';
		$name = 'admin.construction';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});

	Route::group([ 'prefix' => 'alimentation' ], function () {
		$ctrll = 'Admin\AlimentationController@';
		$name = 'admin.alimentation';

		Route::get('', "{$ctrll}list")->name($name);
		Route::get('insert', "{$ctrll}insert")->name($name);
		Route::get('update/{id}', "{$ctrll}update")->name($name);
		Route::get('delete/{id}', "{$ctrll}delete")->name($name);
		Route::get('enable/{id}', "{$ctrll}enable")->name($name);
		Route::post('save', "{$ctrll}save")->name($name);
	});
});

