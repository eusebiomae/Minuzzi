<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestBookPhoneCallsTable extends Migration {
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::connection('mysql')->create('guest_book_phone_calls', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('guest_book_id')->unsigned()->nullable();
			$table->string('contact_name', 200)->nullable();
			$table->string('phone_contact', 45)->nullable();
			$table->string('subject', 200)->nullable();
			$table->integer('guest_book_status_id')->unsigned()->nullable();
			$table->text('observation')->nullable();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('guest_book_id')
			->references('id')
			->on('guest_book');

			$table->foreign('guest_book_status_id')
			->references('id')
			->on('guest_book_status');
		});
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::connection('mysql')->drop('guest_book_phone_calls');
	}
}
