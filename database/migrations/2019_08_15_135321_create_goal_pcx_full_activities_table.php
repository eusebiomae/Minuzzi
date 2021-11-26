<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoalPcxFullActivitiesTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		if (!Schema::hasTable('goal_pcx_full_activities')) {
			Schema::create('goal_pcx_full_activities', function (Blueprint $table) {
				$table->increments('id');

				$table->integer('goal_pcx_id')->unsigned();
				$table->integer('activities_goal_pcx_id')->unsigned();
				$table->integer('executed')->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();

				$table->softDeletes();
				$table->timestamps();

				$table->foreign('goal_pcx_id')
				->references('id')
				->on('goal_pcx');

				$table->foreign('activities_goal_pcx_id')
				->references('id')
				->on('activities_goal_pcx');
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
		Schema::dropIfExists('goal_pcx_full_activities');
	}
}
