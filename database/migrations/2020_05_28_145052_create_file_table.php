<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		if (!Schema::hasTable('file')) {
			Schema::create('file', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('course_id')->unsigned()->nullable();

				$table->string('name', 450)->nullable();
				$table->string('title', 450)->nullable();
				$table->string('subtitle', 450)->nullable();
				$table->text('description')->nullable();
				$table->string('extension', 450)->nullable();
				$table->string('link', 450)->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

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
		Schema::dropIfExists('file');
	}
}
