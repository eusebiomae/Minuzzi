<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePsychologistTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		if (!Schema::hasTable('psychologist')) {
			Schema::create('psychologist', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name', 255)->nullable();
				$table->string('phone', 16)->nullable();
				$table->string('whatsapp', 16)->nullable();
				$table->string('email', 255)->nullable();
				$table->text('specialties')->nullable();
				$table->string('crp', 32)->nullable();
				$table->string('address', 255)->nullable();
				$table->string('number', 32)->nullable();
				$table->string('neighborhood', 128)->nullable();
				$table->string('city', 128)->nullable();
				$table->string('met', 255)->nullable();
				$table->string('zip_code', 10)->nullable();
				$table->integer('state_id')->unsigned()->nullable();
				$table->string('complement', 255)->nullable();
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
		Schema::dropIfExists('psychologist');
	}
}
