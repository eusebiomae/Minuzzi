<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhraseTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('phrase')) {
			Schema::create('phrase', function(Blueprint $table) {
				$table->increments('id');

				$table->string('name', 128)->nullable();
				$table->string('image', 450)->nullable();
				$table->string('phrase', 255)->nullable();


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
		Schema::dropIfExists('phrase');
	}
}
