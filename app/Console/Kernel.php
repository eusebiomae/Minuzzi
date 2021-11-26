<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {
	/**
	* The Artisan commands provided by your application.
	*
	* @var array
	*/
	protected $commands = [
		//
	];

	/**
	* Define the application's command schedule.
	*
	* @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	* @return void
	*/
	protected function schedule(Schedule $schedule) {
		// $schedule->command('inspire')->hourly();

		$schedule->call(function () { \App\Console\Jobs\CronBlogScheduling::run(); })->daily();
		$schedule->call(function () { \App\Console\Jobs\CronAsaasPayments::run(); })->hourly();
		$schedule->call(function () { \App\Utils\StudentClassControlUtils::cronValidDate(); })->cron('1 0 * * *');
	}

	/**
	* Register the Closure based commands for the application.
	*
	* @return void
	*/
	protected function commands() {
		require base_path('routes/console.php');
	}
}

// * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
