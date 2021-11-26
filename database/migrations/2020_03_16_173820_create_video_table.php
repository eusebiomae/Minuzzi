<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('video')) {
			Schema::create('video', function(Blueprint $table) {
				$table->increments('id');

				$table->string('title', 128)->nullable();
				$table->text('description', 255)->nullable();
				$table->string('link', 255)->nullable();
				$table->string('image', 255)->nullable();
				$table->string('type', 1)->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

			});
		}
	}

	public function down()
	{
		Schema::dropIfExists('video');
	}
}
