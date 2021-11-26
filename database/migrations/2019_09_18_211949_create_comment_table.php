<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('comment')) {
			Schema::create('comment', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('user_id')->unsigned()->nullable();
				$table->integer('blog_id')->unsigned();
				$table->string('name', 255);
				$table->string('email', 255);
				$table->text('comments');
				$table->integer('approved')->nullable();
				$table->integer('approved_by')->unsigned()->nullable();
				$table->dateTime('approved_at')->nullable();
				$table->integer('answer_from')->unsigned()->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('blog_id')
					->references('id')
					->on('blog');

				$table->foreign('user_id')
					->references('id')
					->on('user');

				$table->foreign('approved_by')
					->references('id')
					->on('user');

				$table->foreign('answer_from')
					->references('id')
					->on('comment');
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
		Schema::dropIfExists('comment');
	}
}
