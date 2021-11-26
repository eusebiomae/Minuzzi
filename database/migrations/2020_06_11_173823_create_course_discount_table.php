<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseDiscountTable extends Migration {
	public function up() {
		if (!Schema::hasTable('course_discount')) {
			Schema::create('course_discount', function(Blueprint $table) {
				$table->increments('id');

				$table->integer('course_id')->unsigned()->nullable();
				$table->integer('discount_id')->unsigned()->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();

				$table->timestamps();
				$table->softDeletes();

				$table->foreign('course_id')->references('id')->on('course');
				$table->foreign('discount_id')->references('id')->on('discount');
			});
		}
	}

	public function down() {
		Schema::dropIfExists('course_discount');
	}
}
