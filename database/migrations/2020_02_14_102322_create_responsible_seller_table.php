<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsibleSellerTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('responsible_seller')) {
			Schema::create('responsible_seller', function(Blueprint $table) {
				$table->increments('id');
				$table->integer('user_id')->unsigned();
				$table->integer('leads_id')->unsigned();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('user_id')
					->references('id')
					->on('user');

				$table->foreign('leads_id')
					->references('id')
					->on('leads');
			});
		}
	}

	public function down()
	{
		Schema::dropIfExists('responsible_seller');
	}
}
