<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarouselTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carousel', function (Blueprint $table) {
            $table->increments('id');
			$table->string('flg_page', 32)->nullable();
			$table->string('title', 255);
			$table->string('description', 255)->nullable();
			$table->string('image_main', 255)->nullable();
			$table->string('image_additional_1', 255)->nullable();
			$table->string('image_additional_2', 255)->nullable();
			$table->string('image_additional_3', 255)->nullable();
			$table->string('image_additional_4', 255)->nullable();
			$table->string('image_additional_5', 255)->nullable();
            $table->integer('content_page_id')->unsigned();

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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carousel');
    }
}
