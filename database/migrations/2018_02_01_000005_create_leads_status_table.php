<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsStatusTable extends Migration {
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		if (!Schema::hasTable('leads_status')) {
			Schema::connection('mysql')->create('leads_status', function (Blueprint $table) {
				$table->increments('id');
				$table->string('initials', 3)->nullable();
				$table->string('description_pt', 45)->nullable();
				$table->string('description_en', 45)->nullable();
				$table->string('description_es', 45)->nullable();
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();
			});
		}
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::connection('mysql')->drop('leads_status');
	}
}
