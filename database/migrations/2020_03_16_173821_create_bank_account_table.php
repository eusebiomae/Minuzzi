<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAccountTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('bank_account')) {
			Schema::create('bank_account', function(Blueprint $table) {
				$table->increments('id');

				$table->string('name', 128)->nullable();
				$table->string('cpf', 11)->nullable();
				$table->integer('bank_id')->unsigned()->nullable();
				$table->integer('bank_account_type_id')->unsigned()->nullable();
				$table->integer('form_payment_id')->unsigned()->nullable();
				$table->string('agency', 128)->nullable();
				$table->string('account', 128)->nullable();
				$table->string('description', 128)->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('bank_id')
					->references('id')
					->on('bank');

				$table->foreign('bank_account_type_id')
					->references('id')
					->on('bank_account_type');

				$table->foreign('form_payment_id')
				->references('id')
				->on('form_payment');

			});
		}
	}

	public function down()
	{
		Schema::dropIfExists('bank_account');
	}
}
