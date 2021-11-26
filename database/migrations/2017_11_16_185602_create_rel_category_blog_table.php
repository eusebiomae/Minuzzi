<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelCategoryBlogTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		if (!Schema::hasTable('rel_category_blog')) {
			Schema::create('rel_category_blog', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('blog_category_id')->unsigned()->nullable();
				$table->integer('blog_id')->unsigned()->nullable();
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();
				$table->foreign('blog_category_id')
				->references('id')
				->on('blog_category');
				$table->foreign('blog_id')
				->references('id')
				->on('blog');
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
		Schema::dropIfExists('rel_category_blog');
	}
}
