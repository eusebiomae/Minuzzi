<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaceTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		if (!Schema::hasTable('place')) {
			Schema::create('place', function (Blueprint $table) {
				$table->increments('id');
				$table->string('description', 512)->nullable();
				$table->string('company_information', 512)->nullable();
				$table->string('responsible', 512)->nullable();
				$table->string('phone', 45)->nullable();
				$table->string('cell_phone', 45)->nullable();
				$table->string('phone_resp', 45)->nullable();
				$table->string('email', 128)->nullable();
				$table->string('cep', 15)->nullable();
				$table->string('city', 45)->nullable();
				$table->string('neighborhood', 45)->nullable();
				$table->string('complement', 512)->nullable();
				$table->string('number', 9)->nullable();
				$table->string('address', 512)->nullable();
				$table->integer('uf')->nullable();
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();
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
		Schema::dropIfExists('place');
	}
}
