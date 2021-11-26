<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		if (!Schema::hasTable('team')) {
			Schema::create('team', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name', 400);
				$table->mediumText('description_pt')->nullable();
				$table->mediumText('description_en')->nullable();
				$table->mediumText('description_es')->nullable();
				$table->string('image', 450)->nullable();
				$table->string('label_image_pt', 1000)->nullable();
				$table->string('label_image_en', 1000)->nullable();
				$table->string('label_image_es', 1000)->nullable();
				$table->string('crp', 16)->nullable();
				$table->integer('school_information_id')->unsigned()->nullable();
				$table->integer('graduation_id')->unsigned()->nullable();
				$table->integer('function_id')->unsigned()->nullable();
				$table->integer('office_id')->unsigned()->nullable();
				$table->integer('english_level_id')->unsigned()->nullable();
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();
				$table->foreign('school_information_id')
				->references('id')
				->on('school_information');
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
		Schema::dropIfExists('team');
	}
}
