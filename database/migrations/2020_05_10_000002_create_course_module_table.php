<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseModuleTable extends Migration {
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		if (!Schema::hasTable('course_module')) {
			Schema::create('course_module', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('content_course_id')->unsigned()->nullable();
				$table->integer('course_id')->unsigned()->nullable();
				$table->integer('class_id')->unsigned()->nullable();
				$table->integer('sequence')->nullable();
				$table->date('start_date')->nullable();
				$table->string('type', 32)->nullable();
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('course_id')
				->references('id')
				->on('course');

				$table->foreign('class_id')
				->references('id')
				->on('class');

				$table->foreign('content_course_id')
				->references('id')
				->on('content_course');
			});
		}
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::dropIfExists('course_module');
	}
}
