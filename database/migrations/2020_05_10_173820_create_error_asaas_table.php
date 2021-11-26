<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErrorAsaasTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('error_asaas')) {
			Schema::create('error_asaas', function(Blueprint $table) {
				$table->increments('id');

				$table->integer('order_id')->unsigned()->nullable();
				$table->mediumText('json')->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('order_id')->references('id')->on('order');
			});
		}
	}

	public function down()
	{
		Schema::dropIfExists('error_asaas');
	}
}
