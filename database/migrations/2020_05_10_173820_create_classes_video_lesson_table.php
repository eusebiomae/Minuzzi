<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesVideoLessonTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('classes_video_lesson')) {
			Schema::create('classes_video_lesson', function(Blueprint $table) {
				$table->increments('id');

				$table->integer('classes_id')->unsigned()->nullable();
				$table->integer('video_lesson_id')->unsigned()->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('classes_id')
					->references('id')
					->on('classes');

				$table->foreign('video_lesson_id')
					->references('id')
					->on('video');
			});
		}
	}

	public function down()
	{
		Schema::dropIfExists('classes_video_lesson');
	}
}
