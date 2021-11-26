<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	* Bootstrap any application services.
	*
	* @return void
	*/
	public function boot() {
		setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
		date_default_timezone_set('America/Sao_Paulo');
		\Carbon\Carbon::setlocale(LC_TIME, 'pt_BR');
	}

	/**
	* Register any application services.
	*
	* @return void
	*/
	public function register() {
		require_once __DIR__ . '/../Http/Helpers/Navigation.php';
		require_once __DIR__ . '/../Http/Helpers/Utils.php';
		require_once __DIR__ . '/../Http/Helpers/GigaGetData.php';
	}
}
