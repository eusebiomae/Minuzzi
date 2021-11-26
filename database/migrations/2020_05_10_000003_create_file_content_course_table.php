<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileContentCourseTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('file_content_course')) {
			Schema::create('file_content_course', function(Blueprint $table) {
				$table->increments('id');

				$table->integer('file_id')->unsigned()->nullable();
				$table->integer('content_course_id')->unsigned()->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('file_id')
					->references('id')
					->on('files');

				$table->foreign('content_course_id')
					->references('id')
					->on('content_course');
			});
		}
	}

	public function down()
	{
		Schema::dropIfExists('file_content_course');
	}
}
