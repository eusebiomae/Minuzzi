<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppConfTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('app_conf')) {
			Schema::create('app_conf', function(Blueprint $table) {
				$table->increments('id');

				$table->date('cron_asaas_payments')->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();
			});

			\Illuminate\Support\Facades\DB::table('app_conf')->insert([
				'cron_asaas_payments' => \Carbon\Carbon::now(),
			]);
		}
	}

	public function down() {
		Schema::dropIfExists('app_conf');
	}
}
