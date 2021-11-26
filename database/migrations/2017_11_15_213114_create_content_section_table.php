<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentSectionTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::dropIfExists('content_section');

		if (!Schema::hasTable('content_section')) {
			Schema::create('content_section', function (Blueprint $table) {
				$table->increments('id');
				$table->string('description_pt', 450)->nullable();
				$table->string('description_en', 450)->nullable();
				$table->string('description_es', 450)->nullable();
				$table->string('subtitle_pt', 450)->nullable();
				$table->string('subtitle_en', 450)->nullable();
				$table->string('subtitle_es', 450)->nullable();
				$table->string('component', 96)->nullable();
				$table->string('flg', 8)->nullable();
				$table->integer('component_order')->nullable();
				$table->integer('content_page_id')->unsigned();
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
		Schema::dropIfExists('content_section');
	}
}
