<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		if (!Schema::hasTable('user')) {
			Schema::create('user', function (Blueprint $table) {
				$table->increments('id');
				$table->string('image', 450)->nullable();
				$table->string('name');
				$table->string('user_name')->unique();
				$table->string('email')->unique();
				$table->string('password');
				$table->string('author', 1);
				$table->string('consultant', 1);
				$table->string('admin', 1);
				$table->integer('user_type_id')->unsigned()->nullable();
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->rememberToken();
				$table->timestamps();
        $table->softDeletes();

				$table->foreign('user_type_id')
				->references('id')
				->on('user_type');
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
		Schema::drop('users');
	}
}
