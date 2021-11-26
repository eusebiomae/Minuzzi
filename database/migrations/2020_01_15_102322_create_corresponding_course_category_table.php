<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorrespondingCourseCategoryTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('corresponding_course_category')) {
			Schema::create('corresponding_course_category', function(Blueprint $table) {
				$table->increments('id');
				$table->integer('course_category_id')->unsigned();
				$table->integer('blog_category_id')->unsigned();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('course_category_id')
					->references('id')
					->on('course_category');

				$table->foreign('blog_category_id')
					->references('id')
					->on('blog_category');
			});
		}
	}
}
