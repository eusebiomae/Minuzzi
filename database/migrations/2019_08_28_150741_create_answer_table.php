<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('answer')) {
			Schema::create('answer', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('question_id')->unsigned();
				$table->integer('leads_phone_call_id')->unsigned()->nullable();
				$table->integer('guest_book_id')->unsigned()->nullable();
				$table->text('answer');
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->softDeletes();
				$table->timestamps();

				$table->foreign('question_id')
				->references('id')
				->on('question');

				$table->foreign('leads_phone_call_id')
				->references('id')
				->on('leads_phone_call');

				$table->foreign('guest_book_id')
				->references('id')
				->on('guest_book');
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
		Schema::dropIfExists('answer');
	}
}
