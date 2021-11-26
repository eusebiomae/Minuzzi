<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		if (!Schema::hasTable('contact')) {
			Schema::create('contact', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name', 255)->nullable();
				$table->string('last_name', 255)->nullable();
				$table->string('email', 255)->nullable();
				$table->string('phone', 45)->nullable();
				$table->string('subject', 255)->nullable();
				$table->text('description_pt')->nullable();


				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

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
		Schema::dropIfExists('page_file');
	}
}
