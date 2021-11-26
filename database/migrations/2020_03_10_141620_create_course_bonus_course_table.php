<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseBonusCourseTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('course_bonus_course')) {
			Schema::create('course_bonus_course', function(Blueprint $table) {
				$table->increments('id');

				$table->integer('course_id')->unsigned();
				$table->integer('bonus_course_id')->unsigned();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('course_id')
					->references('id')
					->on('course');

				$table->foreign('bonus_course_id')
					->references('id')
					->on('bonus_course');
			});
		}
	}

	public function down()
	{
		Schema::dropIfExists('course_bonus_course');
	}
}
