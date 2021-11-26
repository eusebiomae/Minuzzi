<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('student')) {
			Schema::create('student', function(Blueprint $table) {
				$table->increments('id');

				$table->string('asaas_code', 32)->nullable();
				$table->string('name', 128)->nullable();
				$table->string('mother', 128)->nullable();
				$table->string('father', 128)->nullable();
				$table->string('cpf', 14)->nullable();
				$table->string('rg', 12)->nullable();
				$table->string('email', 255)->nullable();
				$table->string('password', 255)->nullable();
				$table->date('birth_date')->nullable();
				$table->string('phone', 16)->nullable();
				$table->string('cell_phone', 16)->nullable();
				$table->string('gender', 16)->nullable();
				$table->string('zip_code', 10)->nullable();
				$table->string('address', 450)->nullable();
				$table->string('neighborhood', 450)->nullable();
				$table->string('complement', 450)->nullable();
				$table->string('n', 32)->nullable();
				$table->string('city', 45)->nullable();
				$table->integer('state_id')->unsigned()->nullable();
				$table->string('formation', 128)->nullable();
				$table->string('modality', 1)->nullable();
				$table->string('kids', 1)->nullable();
				$table->string('tcc_experience', 1)->nullable();
				$table->string('image', 255)->nullable();
				$table->string('remember_token', 255)->nullable();
				$table->string('reset_password_code', 255)->nullable();
				$table->string('email_confirmation_code', 128)->nullable();
				$table->text('more_information')->nullable();
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('state_id')
					->references('id')
					->on('state');
			});
		}
	}

	public function down()
	{
		Schema::dropIfExists('student');
	}
}
