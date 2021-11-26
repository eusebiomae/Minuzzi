<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterQuestionTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('question', function (Blueprint $table) {
			$table->integer('category_id')->unsigned()->nullable();
			$table->foreign('category_id')
				->references('id')
				->on('course_category');

			// $table->dropColumn(['flg_pcx', 'flg_source', 'order']);
	});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('question', function (Blueprint $table) {
			// $table->integer('order')->nullable();
			// $table->string('flg_pcx', 1);
			// $table->string('flg_source', 50);

			$table->dropForeign(['category_id']);
			$table->dropColumn('category_id');
	});
	}
}
