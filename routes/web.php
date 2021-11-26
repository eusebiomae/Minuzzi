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

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::get('/', 'Site\minuzzi\HomeController@index')->name('home')->middleware(['injectFlgPage:home']);

Route::get('about_us', 'Site\minuzzi\aboutController@index')->name('about_us')->middleware(['injectFlgPage:about_us']);

Route::get('about_us_details', 'Site\minuzzi\aboutController@index')->name('about_us_details')->middleware(['injectFlgPage:about_us_details']);

Route::get('budget', 'Site\minuzzi\BudgetController@index')->name('budget')->middleware(['injectFlgPage:budget']);

Route::get('budget/{id}', 'Site\minuzzi\BudgetController@index')->name('budget')->middleware(['injectFlgPage:budget']);

Route::get('blog', 'Site\minuzzi\BlogController@index')->name('blog')->middleware(['injectFlgPage:blog']);

Route::get('blog_details/{id}', 'Site\minuzzi\BlogController@getPost')->middleware(['injectFlgPage:blog_details']);

Route::get('product_details/{id}', 'Site\minuzzi\ProductController@getPost')->middleware(['injectFlgPage:product_details']);

Route::get('products', 'Site\minuzzi\ProductController@index')->name('products')->middleware(['injectFlgPage:products']);


Route::get('contact', 'Site\minuzzi\ContactController@index')->name('contact')->middleware(['injectFlgPage:contact']);

Route::post('contact', 'Site\minuzzi\ContactController@store');

Route::get('search', 'Site\minuzzi\SearchController@search')->middleware(['injectFlgPage:search']);

Route::get('faq', 'Site\minuzzi\FaqController@index')->middleware(['injectFlgPage:faq']);

Route::get('support', 'Site\minuzzi\SupportController@index')->middleware(['injectFlgPage:support']);

Route::get('manual', 'Site\minuzzi\ManualController@index')->middleware(['injectFlgPage:manual']);

Route::get('term', 'Site\minuzzi\TermController@index')->name('term')->middleware(['injectFlgPage:term']);

Route::get('privacy', 'Site\minuzzi\PrivacyController@index')->name('privacy')->middleware(['injectFlgPage:privacy']);

Route::get('certified', 'Site\minuzzi\PrivacyController@certified')->name('certified')->middleware(['injectFlgPage:certified']);

Route::get('register', 'Site\minuzzi\RegisterController@index')->name('register')->middleware(['injectFlgPage:register']);

Route::post('register', 'Site\minuzzi\RegisterController@store');

Route::get('lang/{lang}', 'Site\minuzzi\LanguageController@switchLang')->name('lang.switch');

Route::get('/bilingualism', 'Site\minuzzi\\BilingualismController@index');

// Route::get('/test', function () {
// 	App::setLocale('');

// });


