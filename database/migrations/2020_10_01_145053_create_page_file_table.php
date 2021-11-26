<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageFileTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		if (!Schema::hasTable('page_file')) {
			Schema::create('page_file', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('content_page_id')->unsigned()->nullable();
				$table->integer('file_site_id')->unsigned()->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('content_page_id')
				->references('id')
				->on('content_page');

				$table->foreign('file_site_id')
				->references('id')
				->on('file_site');

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
		Schema::dropIfExists('page_file');
	}
}
