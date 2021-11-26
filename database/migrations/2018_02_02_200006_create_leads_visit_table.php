<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsVisitTable extends Migration {
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		if (!Schema::hasTable('leads_visit')) {
			Schema::connection('mysql')->create('leads_visit', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('leads_id')->unsigned()->nullable();
				$table->integer('city_id')->unsigned()->nullable();
				$table->integer('course_id')->unsigned()->nullable();
				$table->integer('consultant')->unsigned()->nullable();
				$table->date('visit_date')->nullable();
				$table->string('visit_time', 10)->nullable();
				$table->string('subject', 200)->nullable();
				$table->text('observation')->nullable();
				$table->string('location_description', 450)->nullable();
				$table->string('address', 450)->nullable();
				$table->integer('number')->nullable();
				$table->string('complement', 100)->nullable();
				$table->string('district', 45)->nullable();
				$table->string('city', 45)->nullable();
				$table->string('state', 3)->nullable();
				$table->string('zip_code', 10)->nullable();
				$table->string('reference', 450)->nullable();
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('leads_id')
				->references('id')
				->on('leads');

				$table->foreign('city_id')
				->references('id')
				->on('city');

				$table->foreign('course_id')
				->references('id')
				->on('course');

				$table->foreign('consultant')
				->references('id')
				->on('user');

			});
		}
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::connection('mysql')->drop('leads_visit');
	}
}
