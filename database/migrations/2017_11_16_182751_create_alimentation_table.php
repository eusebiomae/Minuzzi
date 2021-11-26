<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlimentationTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		if (!Schema::hasTable('alimentation')) {
			Schema::create('alimentation', function (Blueprint $table) {
				$table->increments('id');
				$table->string('description_pt', 4000)->nullable();
				$table->string('description_en', 4000)->nullable();
				$table->string('description_es', 4000)->nullable();
				$table->mediumText('text_pt')->nullable();
				$table->mediumText('text_en')->nullable();
				$table->mediumText('text_es')->nullable();
				$table->integer('alimentation_type_id')->unsigned();
				$table->integer('alimentation_category_id')->unsigned();
				$table->integer('weekday_id')->unsigned();
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();
				$table->foreign('alimentation_type_id')
				->references('id')
				->on('alimentation_type');
				$table->foreign('alimentation_category_id')
				->references('id')
				->on('alimentation_category');
				$table->foreign('weekday_id')
				->references('id')
				->on('weekday');
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
		Schema::dropIfExists('alimentation');
	}
}
