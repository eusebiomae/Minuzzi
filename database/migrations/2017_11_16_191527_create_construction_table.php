<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstructionTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		if (!Schema::hasTable('construction')) {
			Schema::create('construction', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name_pt', 400)->nullable();
				$table->string('name_en', 400)->nullable();
				$table->string('name_es', 400)->nullable();
				$table->mediumText('description_pt')->nullable();
				$table->mediumText('description_en')->nullable();
				$table->mediumText('description_es')->nullable();
				$table->string('capacity', 3)->nullable();
				$table->string('image', 450)->nullable();
				$table->string('label_image_pt', 1000)->nullable();
				$table->string('label_image_en', 1000)->nullable();
				$table->string('label_image_es', 1000)->nullable();
				$table->integer('school_information_id')->unsigned()->nullable();
				$table->integer('construction_category_id')->unsigned()->nullable();
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();
				$table->foreign('school_information_id')
				->references('id')
				->on('school_information');
				$table->foreign('construction_category_id')
				->references('id')
				->on('construction_category');
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
		Schema::dropIfExists('construction');
	}
}
