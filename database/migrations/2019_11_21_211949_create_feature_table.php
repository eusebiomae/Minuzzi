<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeatureTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('feature')) {
			Schema::create('feature', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('content_page_id')->unsigned()->nullable();
				$table->string('icon', 64)->nullable();
				$table->string('title', 255);
				$table->string('description', 255)->nullable();
				$table->string('image', 512)->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('content_page_id')
					->references('id')
					->on('content_page');
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
		Schema::dropIfExists('feature');
	}
}
