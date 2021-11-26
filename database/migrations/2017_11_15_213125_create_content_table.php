<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		if (!Schema::hasTable('content')) {
			Schema::create('content', function (Blueprint $table) {

				$table->increments('id');
				$table->string('title_pt', 400)->nullable();
				$table->string('title_en', 400)->nullable();
				$table->string('title_es', 400)->nullable();
				$table->string('subtitle_pt', 400)->nullable();
				$table->string('subtitle_en', 400)->nullable();
				$table->string('subtitle_es', 400)->nullable();
				$table->mediumText('text_pt')->nullable();
				$table->mediumText('text_en')->nullable();
				$table->mediumText('text_es')->nullable();
				$table->string('image', 450)->nullable();
				$table->string('image_bg', 450)->nullable();
				$table->string('label_image_pt', 4000)->nullable();
				$table->string('label_image_en', 4000)->nullable();
				$table->string('label_image_es', 4000)->nullable();
				$table->string('icon', 450)->nullable();
				$table->string('link_label', 96)->nullable();
				$table->string('link', 450)->nullable();
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
		Schema::dropIfExists('contents');
		Schema::dropIfExists('content');
	}
}
