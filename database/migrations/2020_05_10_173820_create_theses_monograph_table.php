<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThesesMonographTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('theses_monograph')) {
			Schema::create('theses_monograph', function(Blueprint $table) {
				$table->increments('id');

				// $table->integer('user_id')->unsigned()->nullable();
				$table->integer('course_category_id')->unsigned()->nullable();

				$table->string('author', 400)->nullable();
				$table->string('title', 400)->nullable();
				$table->text('description')->nullable();
				$table->string('file', 255)->nullable();
				$table->year('year')->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				// $table->foreign('user_id')->references('id')->on('user');
				$table->foreign('course_category_id')->references('id')->on('course_category');
			});
		}
	}

	public function down()
	{
		Schema::dropIfExists('theses_monograph');
	}
}
