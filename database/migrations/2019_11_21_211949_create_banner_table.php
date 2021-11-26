<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('banner', function (Blueprint $table) {
			$table->increments('id');
			$table->string('flg_page', 32)->nullable();
			$table->string('title', 255);
			$table->string('subtitle', 255)->nullable();
			$table->string('link', 255)->nullable();
			$table->string('image', 255)->nullable();
			$table->string('slide', 1)->nullable();

			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('deleted_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('banner');
	}
}
