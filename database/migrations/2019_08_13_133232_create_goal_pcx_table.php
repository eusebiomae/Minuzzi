<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoalPcxTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('goal_pcx')) {

			Schema::create('goal_pcx', function (Blueprint $table) {
				$table->increments('id');

				$table->string('flg_type', 1);
				$table->integer('user_id')->unsigned();
				$table->date('date');
				$table->string('goal', 256);
				$table->integer('finished')->nullable();
				$table->double('goal_planned', 11, 2)->nullable();
				$table->double('goal_executed', 11, 2)->nullable();
				$table->integer('p_planned')->nullable();
				$table->integer('p_executed')->nullable();
				$table->integer('c_planned')->nullable();
				$table->integer('c_executed')->nullable();
				$table->integer('x_planned')->nullable();
				$table->integer('x_executed')->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();

				$table->timestamps();
				$table->softDeletes();

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
		Schema::dropIfExists('goal_pcx');
	}
}
