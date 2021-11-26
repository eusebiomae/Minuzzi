<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		if (!Schema::hasTable('question')) {
			Schema::create('question', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('order')->nullable();
				$table->string('flg_type', 3);
				$table->string('flg_pcx', 1);
				$table->string('title', 255);
				$table->string('flg_source', 50);
				$table->text('description')->nullable();
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->softDeletes();
				$table->timestamps();
			});
		}
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
	{
		Schema::dropIfExists('question');
	}
}
