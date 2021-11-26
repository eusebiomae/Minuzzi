<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseFormPaymentTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		if (!Schema::hasTable('course_form_payment')) {
			Schema::create('course_form_payment', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('class_id')->unsigned()->nullable();
				$table->integer('course_id')->unsigned()->nullable();
				$table->integer('form_payment_id')->unsigned()->nullable();
				$table->integer('parcel')->nullable();
				$table->double('value', 11, 2)->nullable();
				$table->double('full_value', 11, 2)->nullable();
				$table->string('flg_main', 3)->nullable();
				$table->string('description', 255)->nullable();
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('class_id')
				->references('id')
				->on('class');

				$table->foreign('course_id')
				->references('id')
				->on('course');
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
		Schema::dropIfExists('course_form_payment');
	}
}
