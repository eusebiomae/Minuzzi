<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('discount')) {
			Schema::create('discount', function(Blueprint $table) {
				$table->increments('id');

				$table->string('title', 255)->nullable();
				$table->double('value', 11, 2)->nullable();
				$table->double('percentage', 11, 2)->nullable();
				$table->date('shelf_life')->nullable();
				$table->integer('qtd')->nullable();
				$table->string('code', 32)->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();

				$table->timestamps();
				$table->softDeletes();
			});
		}
	}

	public function down() {
		Schema::dropIfExists('discount');
	}
}
