<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductivityContentTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('productivity_content')) {
			Schema::create('productivity_content', function(Blueprint $table) {
				$table->increments('id');

				$table->integer('productivity_id')->unsigned();
				$table->string('type', 3)->nullable();
				$table->text('content')->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('productivity_id')
					->references('id')
					->on('productivity');
			});
		}
	}

	public function down()
	{
		Schema::dropIfExists('productivity_content');
	}
}
