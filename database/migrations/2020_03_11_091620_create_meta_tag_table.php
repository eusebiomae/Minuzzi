<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaTagTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('meta_tag')) {
			Schema::create('meta_tag', function(Blueprint $table) {
				$table->increments('id');

				$table->integer('content_page_id')->unsigned();
				$table->string('name', 128)->nullable();
				$table->string('content', 1024)->nullable();

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

	public function down()
	{
		Schema::dropIfExists('meta_tag');
	}
}
