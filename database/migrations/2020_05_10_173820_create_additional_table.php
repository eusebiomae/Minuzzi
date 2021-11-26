<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionalTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('additional')) {
			Schema::create('additional', function(Blueprint $table) {
				$table->increments('id');

				$table->string('title', 255)->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();
			});
		}
	}

	public function down() {
		Schema::dropIfExists('additional');
	}
}
