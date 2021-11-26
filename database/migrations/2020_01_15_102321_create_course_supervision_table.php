<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseSupervisionTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('course_supervision')) {
			Schema::create('course_supervision', function(Blueprint $table) {
				$table->increments('id');
				$table->date('date')->nullable();
				$table->integer('team_id')->unsigned();
				$table->double('value_1', 11, 2)->default(0)->nullable();
				$table->double('value_2', 11, 2)->default(0)->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('team_id')
					->references('id')
					->on('team');
			});
		}
	}
}
