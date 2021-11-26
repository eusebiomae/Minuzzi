<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderAdditionalTable extends Migration {
	public function up() {
		if (!Schema::hasTable('order_additional')) {
			Schema::create('order_additional', function(Blueprint $table) {
				$table->increments('id');

				$table->integer('order_id')->unsigned()->nullable();
				$table->integer('course_additional_id')->unsigned()->nullable();
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

				$table->foreign('course_additional_id')->references('id')->on('course_additional');
				$table->foreign('order_id')->references('id')->on('order');
				$table->foreign('additional_id')->references('id')->on('additional');
				$table->foreign('course_id')->references('id')->on('course');
				$table->foreign('form_payment_id')->references('id')->on('form_payment');
			});
		}
	}

	public function down() {
		Schema::dropIfExists('order_additional');
	}
}
