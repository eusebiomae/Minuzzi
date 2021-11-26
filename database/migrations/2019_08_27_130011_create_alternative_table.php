<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlternativeTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		if (!Schema::hasTable('alternative')) {
			Schema::create('alternative', function (Blueprint $table) {
				$table->increments('id');
				$table->string('flg_type', 3);
				$table->integer('order')->nullable();
				$table->string('title', 255);
				$table->text('description')->nullable();
				$table->integer('question_id')->unsigned();
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->softDeletes();
				$table->timestamps();

				$table->foreign('question_id')
				->references('id')
				->on('question');
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
		Schema::dropIfExists('alternative');
	}
}
