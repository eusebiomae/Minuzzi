<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParametersAppTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('parameters_app')) {
			Schema::create('parameters_app', function (Blueprint $table) {
				$table->increments('id');

				$table->integer('user_id')->unsigned()->nullable();
				$table->text('payload');

				$table->timestamps();
				$table->softDeletes();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();

				$table->foreign('user_id')
					->references('id')
					->on('user');
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
		Schema::dropIfExists('parameters_app');
	}
}
