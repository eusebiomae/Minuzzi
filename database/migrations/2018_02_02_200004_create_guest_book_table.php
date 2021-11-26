<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestBookTable extends Migration {
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		if (!Schema::hasTable('guest_book')) {
			Schema::connection('mysql')->create('guest_book', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('leads_id')->unsigned()->nullable();
				$table->integer('leads_visit_id')->unsigned()->nullable();
				$table->integer('guest_book_id')->unsigned()->nullable();
				$table->string('question1', 200)->nullable();
				$table->string('question2', 200)->nullable();
				$table->string('question3', 200)->nullable();
				$table->string('question4', 200)->nullable();
				$table->string('question5', 200)->nullable();
				$table->string('question6', 200)->nullable();
				$table->string('question7', 200)->nullable();
				$table->string('question8', 200)->nullable();
				$table->string('question9', 200)->nullable();
				$table->string('question10', 200)->nullable();
				$table->string('alternative1', 1)->nullable();
				$table->string('alternative2', 1)->nullable();
				$table->string('alternative3', 1)->nullable();
				$table->string('alternative4', 1)->nullable();
				$table->string('alternative5', 1)->nullable();
				$table->text('observation')->nullable();
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('leads_id')
					->references('id')
					->on('leads');

				$table->foreign('leads_visit_id')
					->references('id')
					->on('leads_visit');

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
	public function down() {
		Schema::connection('mysql')->drop('guest_book');
	}
}
