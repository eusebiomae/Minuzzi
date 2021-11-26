<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		if (!Schema::hasTable('patient')) {
			Schema::create('patient', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name', 255)->nullable();
				$table->string('phone', 16)->nullable();
				$table->string('whatsapp', 16)->nullable();
				$table->string('email', 255)->nullable();
				$table->string('recommendation', 255)->nullable();
				$table->text('initial_complaint')->nullable();
				$table->string('address', 255)->nullable();
				$table->string('number', 32)->nullable();
				$table->string('neighborhood', 128)->nullable();
				$table->string('city', 128)->nullable();
				$table->integer('state_id')->unsigned()->nullable();
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('state_id')
				->references('id')
				->on('state');
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
		Schema::dropIfExists('patient');
	}
}
