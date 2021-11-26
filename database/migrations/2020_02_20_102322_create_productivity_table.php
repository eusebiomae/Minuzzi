<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductivityTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('productivity')) {
			Schema::create('productivity', function(Blueprint $table) {
				$table->increments('id');

				$table->integer('user_id')->unsigned();
				$table->string('title', 512)->nullable();
				$table->date('date')->nullable();
				$table->string('weekday', 3)->nullable();
				$table->integer('grade')->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('user_id')
					->references('id')
					->on('user');
			});
		}
	}

	public function down()
	{
		Schema::dropIfExists('productivity');
	}
}
