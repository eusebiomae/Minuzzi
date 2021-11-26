<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseCategoryTypeTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		if (!Schema::hasTable('course_category_type')) {
			Schema::create('course_category_type', function (Blueprint $table) {
				$table->increments('id');
				$table->string('title', 255);
				$table->string('description', 255)->nullable();
				$table->string('image', 512)->nullable();
				$table->string('flg', 96)->nullable();
				$table->string('type', 96)->nullable();

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
		Schema::dropIfExists('course_category_type');
	}
}
