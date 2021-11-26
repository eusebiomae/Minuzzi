<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTagsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blogs_tags', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('blog_id')->unsigned();
			$table->integer('blog_tag_id')->unsigned();

			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('blog_id')
				->references('id')
				->on('blog');

			$table->foreign('blog_tag_id')
				->references('id')
				->on('blog_tag');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('blogs_tags');
	}
}
