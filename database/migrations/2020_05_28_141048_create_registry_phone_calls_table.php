<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistryPhoneCallsTable extends Migration {
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		if (!Schema::hasTable('registry_phone_calls')) {
			Schema::connection('mysql')->create('registry_phone_calls', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('registry_id')->unsigned()->nullable();
				$table->string('contact_name', 200)->nullable();
				$table->string('phone_contact', 45)->nullable();
				$table->string('subject', 200)->nullable();
				$table->integer('registry_status_id')->unsigned()->nullable();
				$table->text('observation')->nullable();
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('registry_id')
				->references('id')
				->on('registry');

				$table->foreign('registry_status_id')
				->references('id')
				->on('registry_status');
			});
		}
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::connection('mysql')->drop('registry_phone_calls');
	}
}
