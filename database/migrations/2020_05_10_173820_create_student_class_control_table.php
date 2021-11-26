<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentClassControlTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('student_class_control')) {
			Schema::create('student_class_control', function(Blueprint $table) {
				$table->increments('id');

				$table->integer('order_id')->unsigned()->nullable();
				$table->integer('student_id')->unsigned()->nullable();
				$table->integer('course_id')->unsigned()->nullable();
				$table->integer('class_id')->unsigned()->nullable();
				$table->integer('classes_id')->unsigned()->nullable();
				$table->integer('content_course_id')->unsigned()->nullable();
				$table->date('start_date')->nullable();
				$table->date('end_date')->nullable();
				$table->string('status', 1)->nullable();
				$table->string('presence', 1)->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('order_id')->references('id')->on('order');
				$table->foreign('student_id')->references('id')->on('student');
				$table->foreign('course_id')->references('id')->on('course');
				$table->foreign('class_id')->references('id')->on('class');
				$table->foreign('classes_id')->references('id')->on('classes');
				$table->foreign('content_course_id')->references('id')->on('content_course');
			});
		}
	}

	public function down() {
		Schema::dropIfExists('student_class_control');
	}
}
