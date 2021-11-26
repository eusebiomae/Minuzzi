<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('event')) {
			Schema::create('event', function (Blueprint $table) {
				$table->increments('id');
                $table->string('title_pt', 400)->nullable();
                $table->string('title_en', 400)->nullable();
                $table->string('title_es', 400)->nullable();
                $table->mediumText('description_pt')->nullable();
                $table->mediumText('description_en')->nullable();
                $table->mediumText('description_es')->nullable();
                $table->dateTime('event_datetime')->nullable();
                $table->string('localization', 100)->nullable();
                $table->integer('annual_repeat')->nullable();;
                $table->string('flg_special_date', 1)->nullable();
                $table->integer('class_status_id')->unsigned();
                $table->integer('status')->nullable();
                $table->integer('calendar_id')->unsigned();
                $table->integer('calendar_privacy_id')->unsigned();
                $table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('class_status_id')
				->references('id')
                ->on('class_status');

                $table->foreign('calendar_id')
				->references('id')
                ->on('calendar');

                $table->foreign('calendar_privacy_id')
				->references('id')
				->on('calendar_privacy');
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
        Schema::dropIfExists('event');
    }
}
