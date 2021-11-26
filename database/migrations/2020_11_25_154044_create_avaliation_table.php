<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateAvaliationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('avaliation')) {
					Schema::create('avaliation', function (Blueprint $table) {
						$table->increments('id');
						$table->string('title', 255)->nullable();
						$table->time('duration')->nullable();

						$table->integer('category_id')->unsigned()->nullable();
						$table->integer('slide_id')->unsigned()->nullable();
						$table->date('date')->nullable();
						$table->time('start_time')->nullable();
						$table->time('time_limit')->nullable();
						$table->text('description')->nullable();
						$table->string('form_payment', 45)->nullable();
						$table->timestamps();
						$table->softDeletes();

						$table->integer('created_by')->nullable();
						$table->integer('updated_by')->nullable();
						$table->integer('deleted_by')->nullable();

						$table->foreign('slide_id')
							->references('id')
							->on('slide');

						$table->foreign('category_id')
							->references('id')
							->on('course_category');

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
        Schema::dropIfExists('avaliation');
    }
}
