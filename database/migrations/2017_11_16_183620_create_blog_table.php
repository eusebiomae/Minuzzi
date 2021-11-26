<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		if (!Schema::hasTable('blog')) {
			Schema::create('blog', function (Blueprint $table) {
				$table->increments('id');
				$table->string('image', 450)->nullable();
				$table->string('label_image_pt', 4000)->nullable();
				$table->string('label_image_en', 4000)->nullable();
				$table->string('label_image_es', 4000)->nullable();
				$table->string('title_pt', 400)->nullable();
				$table->string('title_en', 400)->nullable();
				$table->string('title_es', 400)->nullable();
				$table->string('subtitle_pt', 400)->nullable();
				$table->string('subtitle_en', 400)->nullable();
				$table->string('subtitle_es', 400)->nullable();
				$table->longText('text_pt')->nullable();
				$table->longText('text_en')->nullable();
				$table->longText('text_es')->nullable();
				// $table->dateTime('date_post');
				$table->integer('blog_category_id')->unsigned();
				$table->integer('author_post')->unsigned()->nullable();
				$table->integer('user_cad_id')->unsigned()->nullable();
				$table->integer('count_likes')->default(0)->nullable();
				$table->integer('count_views')->default(0)->nullable();
				$table->integer('count_comments')->default(0)->nullable();
				$table->string('status', 3);
				$table->dateTime('scheduling_date');

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();
				$table->foreign('blog_category_id')
				->references('id')
				->on('blog_category');
				$table->foreign('author_post')
				->references('id')
				->on('user');
				$table->foreign('user_cad_id')
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
		Schema::dropIfExists('blog');
	}
}
