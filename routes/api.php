<?php

use App\Model\api\Prospection\LeadsModel;
use App\Model\api\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('user', function (Request $request) {
	return $request->user();
})->middleware('auth:api');

Route::get('', function () {
	return response()->json(['message' => 'Jobs API', 'status' => 'Connected']);;
});

Route::resource('contentsection', 'api\Configuration\ContentSectionController');

Route::get('contentsection/contentpage/{id}', 'api\Configuration\ContentSectionController@getByContentPage');

Route::resource('contentpage', 'api\Configuration\ContentPageController');
// Route::resource('page', 'api\PageController');
Route::resource('content', 'api\ContentController');

Route::post('save', function(\Illuminate\Http\Request $request) {
	return (new App\Http\Controllers\api\ApiSaveController)->{$request->header('method')}($request);
});

Route::get('splitLeads', function() {
	$sellers = UserModel::where('consultant', 'S')->get();
	$sellersCount = count($sellers);

	$leads = LeadsModel::with('leadsPhoneCall')->whereDoesntHave('leadsPhoneCall')->get();

	foreach ($leads as $lead) {
		$lead->seller()->sync([ $sellers[rand(0, $sellersCount - 1)]->id ]);
	}

	return count($leads);
});

