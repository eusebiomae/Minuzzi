<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		if (!Schema::hasTable('budget')) {
			Schema::create('budget', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name', 450)->nullable();
				$table->string('company', 450)->nullable();
				$table->string('email', 450)->nullable();
				$table->string('phone', 450)->nullable();
				$table->string('quantity', 450)->nullable();
				$table->string('product_type', 450)->nullable();
				$table->string('phases', 450)->nullable();
				$table->string('input_voltage', 450)->nullable();
				$table->string('output_voltage', 450)->nullable();
				$table->string('power', 450)->nullable();
				$table->string('protection', 450)->nullable();
				$table->string('subject', 450)->nullable();
				$table->string('message', 450)->nullable();
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
		Schema::dropIfExists('blog');
	}
}
