<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntroductionTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('introduction')) {
			Schema::create('introduction', function(Blueprint $table) {
				$table->increments('id');

				$table->string('title', 128)->nullable();
				$table->string('description', 255)->nullable();
				$table->integer('form_payment_id')->unsigned()->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('form_payment_id')
				->references('id')
				->on('form_payment');

			});
		}
	}

	public function down()
	{
		Schema::dropIfExists('introduction');
	}
}
