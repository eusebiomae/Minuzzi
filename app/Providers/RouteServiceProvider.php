<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
	/**
	* This namespace is applied to your controller routes.
	*
	* In addition, it is set as the URL generator's root namespace.
	*
	* @var string
	*/
	protected $namespace = 'App\Http\Controllers';

	/**
	* Define your route model bindings, pattern filters, etc.
	*
	* @return void
	*/
	public function boot()
	{
		//

		parent::boot();
	}

	/**
	* Define the routes for the application.
	*
	* @return void
	*/
	public function map()
	{
		$this->mapApiRoutes();
		$this->mapWebRoutes();
		$this->mapAdminRoutes();
		$this->mapStudentArea();
	}

	/**
	* Define the "web" routes for the application.
	*
	* These routes all receive session state, CSRF protection, etc.
	*
	* @return void
	*/
	protected function mapWebRoutes()
	{
		Route::group([
			'middleware' => 'web',
			'namespace' => $this->namespace,
		], function ($router) {
			require base_path('routes/web.php');
		});
	}

	/**
	* Define the "api" routes for the application.
	*
	* These routes are typically stateless.
	*
	* @return void
	*/
	protected function mapApiRoutes()
	{
		Route::group([
			// 'middleware' => 'api',
			'namespace' => $this->namespace,
			'prefix' => 'api',
		], function ($router) {
			require base_path('routes/api.php');
		});
	}

	protected function mapAdminRoutes() {
		Route::group([
			'middleware' => ['web', 'guest:admin'],
			'namespace' => $this->namespace,
			'prefix' => 'admin',
		], function () {
			require base_path('routes/admin.php');
		});
	}

	protected function mapStudentArea() {
		Route::group([
			'middleware' => 'web',
			'namespace' => 'App\Http\Controllers\StudentArea',
			'prefix' => 'student_area',
		], function () {
			require base_path('routes/student_area.php');
		});
	}
}
