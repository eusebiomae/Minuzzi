<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseDefaultValueTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('course_default_value')) {
			Schema::create('course_default_value', function(Blueprint $table) {
				$table->increments('id');
				$table->integer('course_id')->unsigned();
				$table->integer('class_id')->unsigned();
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
			});
		}
	}
}
