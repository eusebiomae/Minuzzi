<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('class')) {
			Schema::create('class', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('course_id')->unsigned()->nullable();
				$table->integer('place_id')->unsigned()->nullable();
				$table->integer('city_id')->unsigned()->nullable();
				$table->integer('contract_id')->unsigned()->nullable();
				$table->integer('periodicity_id')->unsigned()->nullable();
				$table->string('name', 200)->nullable();
				$table->string('days_week', 200)->nullable();
				$table->string('start_hours', 5)->nullable();
				$table->string('end_hours', 5)->nullable();
				$table->string('desc', 255)->nullable();
				$table->string('link', 255)->nullable();
				$table->date('start_date')->nullable();
				$table->date('end_date')->nullable();
				$table->string('status', 2)->nullable();
				$table->string('show_site', 1)->nullable();
				$table->string('does_registre', 1)->nullable();

				$table->integer('repetition')->nullable();
				$table->integer('permanence')->nullable();
				$table->string('permanence_all', 1)->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('course_id')
					->references('id')
					->on('course');

				$table->foreign('city_id')
					->references('id')
					->on('city');

				$table->foreign('place_id')
					->references('id')
					->on('place');

				$table->foreign('contract_id')
					->references('id')
					->on('contract');

					$table->foreign('periodicity_id')
					->references('id')
					->on('periodicity');
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
		Schema::dropIfExists('class');
	}
}
