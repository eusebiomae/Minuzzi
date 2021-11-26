<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('contract')) {
			Schema::create('contract', function(Blueprint $table) {
				$table->increments('id');

				$table->integer('order_id')->unsigned()->nullable();
				$table->string('title', 255)->nullable();
				$table->string('status', 16)->nullable();
				$table->longText('content')->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();
			});
		}
	}

	public function down() {
		Schema::dropIfExists('contract');
	}
}
