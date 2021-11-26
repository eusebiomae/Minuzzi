<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentPageTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		if (!Schema::hasTable('content_page')) {
			Schema::create('content_page', function (Blueprint $table) {
				$table->increments('id');
				$table->string('description_pt', 45)->nullable();
				$table->string('description_en', 45)->nullable();
				$table->string('description_es', 45)->nullable();
				$table->string('url', 255)->nullable();
				$table->string('show', 1)->nullable();
				$table->string('target', 1)->nullable();
				$table->string('flg_page', 96)->nullable();
				$table->integer('content_page_id')->nullable()->unsigned();
				$table->integer('sequence')->nullable();
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();
				$table->foreign('content_page_id')
				->references('id')
				->on('content_page');
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
		Schema::dropIfExists('content_page');
	}
}
