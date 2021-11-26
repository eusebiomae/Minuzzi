<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('faq')) {
			Schema::create('faq', function(Blueprint $table) {
				$table->increments('id');

				$table->string('question', 1024)->nullable();
				$table->text('answer')->nullable();

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
		Schema::dropIfExists('faq');
	}
}
