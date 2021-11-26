<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkWithUsTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		if (!Schema::hasTable('work_with_us')) {
			Schema::create('work_with_us', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name', 1000)->nullable();
				$table->string('last_name', 1000)->nullable();
				$table->string('genre', 1)->nullable();
				$table->dateTime('date_birth')->nullable();
				$table->string('profession', 1000)->nullable();
				$table->string('address', 1000)->nullable();
				$table->string('number', 9)->nullable();
				$table->mediumText('complement')->nullable();
				$table->string('neighborhood', 45);
				$table->string('city', 45)->nullable();
				$table->string('uf', 45)->nullable();
				$table->string('cep', 15)->nullable();
				$table->string('phone1', 45)->nullable();
				$table->string('phone2', 45)->nullable();
				$table->string('cell_phone1', 45)->nullable();
				$table->string('cell_phone2', 45)->nullable();
				$table->string('email1', 450)->nullable();
				$table->string('email2', 450)->nullable();
				$table->mediumText('curriculum')->nullable();
				$table->string('video', 400)->nullable();
				$table->mediumText('text_pt')->nullable();
				$table->mediumText('text_en')->nullable();
				$table->mediumText('text_es')->nullable();
				$table->integer('graduation_id')->unsigned()->nullable();
				$table->integer('function_id')->unsigned()->nullable();
				$table->integer('office_id')->unsigned()->nullable();
				$table->integer('english_level_id')->unsigned()->nullable();
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();
				$table->foreign('graduation_id')
				->references('id')
				->on('graduation');
				$table->foreign('function_id')
				->references('id')
				->on('function');
				$table->foreign('office_id')
				->references('id')
				->on('office');
				$table->foreign('english_level_id')
				->references('id')
				->on('english_level');
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
		Schema::dropIfExists('work_with_us');
	}
}
