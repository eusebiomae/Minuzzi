<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoGaleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('photo_galery')) {
			Schema::create('photo_galery', function (Blueprint $table) {
                $table->increments('id');
				$table->integer('galery_id')->unsigned();
				$table->string('title_pt', 450)->nullable();
				$table->string('title_en', 450)->nullable();
                $table->string('title_es', 450)->nullable();
                $table->string('file', 450)->nullable();
                $table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
                $table->softDeletes();
                
                $table->foreign('galery_id')
				->references('id')
				->on('galery');
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
        Schema::dropIfExists('photo_galery');
    }
}
