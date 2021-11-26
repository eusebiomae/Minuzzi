<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestemonialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        if (!Schema::hasTable('testemonial')) {
			Schema::create('testemonial', function (Blueprint $table) {
				$table->increments('id');
                $table->string('name', 100)->nullable();
                $table->string('office', 45)->nullable();
                $table->mediumText('text_pt')->nullable();
                $table->mediumText('text_en')->nullable();
                $table->mediumText('text_es')->nullable();
                $table->string('abstract_pt', 400)->nullable();
                $table->string('abstract_en', 400)->nullable();
                $table->string('abstract_es', 400)->nullable();;
                $table->string('image', 400)->nullable();
                $table->string('status', 1)->nullable();
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
        Schema::dropIfExists('testemonial');
    }
}
