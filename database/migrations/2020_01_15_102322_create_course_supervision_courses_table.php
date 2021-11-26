<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseSupervisionCoursesTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('course_supervision_courses')) {
			Schema::create('course_supervision_courses', function(Blueprint $table) {
				$table->increments('id');
				$table->integer('course_supervision_id')->unsigned();
				$table->integer('course_id')->unsigned();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('course_supervision_id')
					->references('id')
					->on('course_supervision');

				$table->foreign('course_id')
					->references('id')
					->on('course');
			});
		}
	}
}
