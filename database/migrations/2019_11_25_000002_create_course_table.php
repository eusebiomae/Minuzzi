<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		if (!Schema::hasTable('course')) {
			Schema::create('course', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('course_category_id')->unsigned()->nullable();
				$table->integer('course_subcategory_id')->unsigned()->nullable();
				$table->integer('course_category_type_id')->unsigned()->nullable();
				$table->integer('place_id')->unsigned()->nullable();
				$table->integer('team_id')->unsigned()->nullable();
				$table->string('name_pt', 450)->nullable();
				$table->string('name_en', 450)->nullable();
				$table->string('name_es', 450)->nullable();
				$table->string('img', 450)->nullable();
				$table->string('title_pt', 450)->nullable();
				$table->string('title_en', 450)->nullable();
				$table->string('title_es', 450)->nullable();
				$table->string('subtitle_pt', 450)->nullable();
				$table->string('subtitle_en', 450)->nullable();
				$table->string('subtitle_es', 450)->nullable();
				$table->double('value', 11, 2)->nullable();
				$table->double('full_value', 11, 2)->nullable();
				$table->text('description_pt')->nullable();
				$table->text('description_en')->nullable();
				$table->text('description_es')->nullable();
				$table->string('hours_load', 8)->nullable();
				$table->double('min_percentage_workload', 11, 2)->default(0)->nullable();
				$table->date('start_date')->nullable();
				$table->date('end_date')->nullable();
				$table->string('video_link', 512)->nullable();
				$table->string('certified', 50)->nullable();
				$table->string('show_home', 1)->nullable();
				$table->string('duration', 64)->nullable();
				$table->integer('number_modules')->nullable();
				$table->integer('service_hours')->nullable();
				$table->integer('hours_monitored_supervision')->nullable();
				$table->string('inactive', 1)->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('course_category_id')
				->references('id')
				->on('course_category');

				$table->foreign('course_subcategory_id')
				->references('id')
				->on('course_subcategory');

				$table->foreign('course_category_type_id')
				->references('id')
				->on('course_category_type');
			});
		}
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
	{
		Schema::dropIfExists('course');
	}
}
