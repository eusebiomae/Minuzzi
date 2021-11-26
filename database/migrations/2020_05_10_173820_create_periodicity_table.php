<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodicityTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('periodicity')) {
			Schema::create('periodicity', function(Blueprint $table) {
				$table->increments('id');

				$table->string('title', 400)->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();
			});
		}
	}

	public function down() {
		Schema::dropIfExists('periodicity');
	}
}
