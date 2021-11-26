<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
Auth::routes();
Route::group([
	'prefix' => 'login',
], function() {
	$ctrll = 'LoginController@';

	Route::get('', "{$ctrll}index")->name('studentArea.login');
	Route::post('', "{$ctrll}login");
	Route::post('register', "{$ctrll}register");
	Route::get('logout', "{$ctrll}logout")->name('studentArea.logout');
	Route::post('resetSendEmail', "{$ctrll}resetSendEmail");
	Route::post('resetPassword', "{$ctrll}resetPassword");
});

Route::group([ 'prefix' => 'api' ], function() {
	Route::post('account_data', 'AccountDataController@saveData');
	Route::post('confirm_payment', 'ConfirmPaymentController@confirmPayment');
	Route::post('loginRegister', 'AccountDataController@loginRegister');
	Route::post('apply_discount', 'ConfirmPaymentController@applyDiscount');

});

Route::post('account_data/save', "AccountDataController@toSave");

Route::group([
	'middleware' => 'auth:studentArea',
], function() {
	Route::get('', 'HomeController@index')->name('studentArea.dashboard');

	Route::group([
		'prefix' => 'account_data',
		'middleware' => [],
	], function () {
		$ctrll = 'AccountDataController@';
		$name = 'admin.account_data';


		Route::get('', "{$ctrll}index")->name($name);
	});

	Route::group([
		'prefix' => 'order',
		'middleware' => [],
	], function () {
		$ctrll = 'OrderController@';

		Route::get('course', "{$ctrll}listCourse");
		Route::get('supervision', "{$ctrll}listSupervision");
		Route::get('{id}', "{$ctrll}details")->where('id', '[0-9]+');
	});

	Route::group([
		'prefix' => 'avaliation',
		'middleware' => [],
	], function () {
		$ctrll = 'AvaliationController@';

		Route::get('', "{$ctrll}avaliation");
		Route::get('save', "{$ctrll}save");
	});

	Route::group([
		'prefix' => 'rank'
	], function () {
		$ctrll = 'RankController@';
		$name = 'admin.rank';

		Route::get('all', "{$ctrll}all")->name($name.'.all');
	});

});
