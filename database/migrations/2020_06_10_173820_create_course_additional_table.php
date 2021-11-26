<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseAdditionalTable extends Migration {
	public function up() {
		if (!Schema::hasTable('course_additional')) {
			Schema::create('course_additional', function(Blueprint $table) {
				$table->increments('id');

				$table->integer('course_id')->unsigned()->nullable();
				$table->integer('additional_id')->unsigned()->nullable();
				$table->integer('form_payment_id')->unsigned()->nullable();

				$table->integer('parcel')->nullable();
				$table->double('value', 11, 2)->nullable();
				$table->double('full_value', 11, 2)->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('course_id')->references('id')->on('course');
				$table->foreign('additional_id')->references('id')->on('additional');
				$table->foreign('form_payment_id')->references('id')->on('form_payment');
			});
		}
	}

	public function down() {
		Schema::dropIfExists('course_additional');
	}
}
