<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('manual')) {
			Schema::create('manual', function (Blueprint $table) {
				$table->increments('id');
                $table->string('title_pt', 400)->nullable();
                $table->string('title_en', 400)->nullable();
                $table->string('title_es', 400)->nullable();
                $table->string('subtitle_pt', 400)->nullable();
                $table->string('subtitle_en', 400)->nullable();
                $table->string('subtitle_es', 400)->nullable();
                $table->mediumText('description_pt')->nullable();
                $table->mediumText('description_en')->nullable();
                $table->mediumText('description_es')->nullable();
                $table->string('image', 400)->nullable();
                $table->integer('content_page_id')->unsigned();

                $table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();

                $table->timestamps();
                $table->softDeletes();
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
        Schema::dropIfExists('manual');
    }
}
