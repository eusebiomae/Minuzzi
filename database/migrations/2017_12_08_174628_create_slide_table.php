<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlideTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('slide')) {
			Schema::create('slide', function (Blueprint $table) {
				$table->increments('id');
				$table->string('pretitle_pt', 400)->nullable();
				$table->string('pretitle_en', 400)->nullable();
				$table->string('pretitle_es', 400)->nullable();
				$table->string('title_pt', 400)->nullable();
				$table->string('title_en', 400)->nullable();
				$table->string('title_es', 400)->nullable();
				$table->string('subtitle_pt', 400)->nullable();
				$table->string('subtitle_en', 400)->nullable();
				$table->string('subtitle_es', 400)->nullable();
                $table->string('image', 400)->nullable();
				// $table->string('flg_type', 1)->nullable();
                $table->string('status', 1)->nullable();
                $table->string('label_link', 255)->nullable();
                $table->string('link', 255)->nullable();
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slide');
    }
}
