<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAccountTypeTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('bank_account_type')) {
			Schema::create('bank_account_type', function(Blueprint $table) {
				$table->increments('id');

				$table->string('name', 128)->nullable();

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
		Schema::dropIfExists('bank_account_type');
	}
}
