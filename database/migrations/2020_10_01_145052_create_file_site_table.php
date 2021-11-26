<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileSiteTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		if (!Schema::hasTable('file_site')) {
			Schema::create('file_site', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('type_file_id')->unsigned()->nullable();

				$table->string('name', 450)->nullable();
				$table->string('title', 450)->nullable();
				$table->string('subtitle', 450)->nullable();
				$table->text('description')->nullable();
				$table->string('extension', 450)->nullable();
				$table->string('link', 450)->nullable();
				$table->string('img', 450)->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('type_file_id')
				->references('id')
				->on('type_file');

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
		Schema::dropIfExists('file_site');
	}
}
