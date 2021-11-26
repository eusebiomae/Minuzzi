<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormPaymentTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		if (!Schema::hasTable('form_payment')) {
			Schema::create('form_payment', function (Blueprint $table) {
				$table->increments('id');
				$table->string('description', 512)->nullable();
				$table->string('flg_type', 16)->nullable();
				$table->string('flg_web', 1)->nullable();
				$table->string('flg_free', 1)->nullable();
				$table->text('clause4_1b')->nullable();
				$table->text('clause4_2_1')->nullable();
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
		Schema::dropIfExists('form_payment');
	}
}
