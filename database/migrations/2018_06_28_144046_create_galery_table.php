<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGaleryTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		if (!Schema::hasTable('galery')) {
			Schema::create('galery', function (Blueprint $table) {
				$table->increments('id');
				$table->string('pretitle_pt', 450)->nullable();
				$table->string('subtitle_pt', 450)->nullable();
				$table->string('link', 255)->nullable();
				$table->string('link_label', 32)->nullable();
				$table->string('title_pt', 450)->nullable();
				$table->string('title_en', 450)->nullable();
				$table->string('title_es', 450)->nullable();
				$table->text('description_pt')->nullable();
				$table->text('description_en')->nullable();
				$table->text('description_es')->nullable();
				$table->string('type', 45)->nullable();
				$table->string('image', 450)->nullable();
				$table->integer('content_page_id')->unsigned();
				$table->integer('content_section_id')->unsigned();
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('content_page_id')
				->references('id')
				->on('content_page');
				$table->foreign('content_section_id')
				->references('id')
				->on('content_section');
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
		Schema::dropIfExists('galery');
	}
}
