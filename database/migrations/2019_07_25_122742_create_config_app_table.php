<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigAppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('config_app')) {
            Schema::create('config_app', function (Blueprint $table) {
                $table->increments('id');
                $table->string('table', 32);
                $table->integer('user_id')->unsigned()->nullable();
                $table->text('show_form_fields')->nullable();
                $table->text('show_list_fields')->nullable();

                $table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
                $table->integer('deleted_by')->nullable();

                $table->timestamps();
                $table->softDeletes();

                $table->foreign('user_id')
				->references('id')
				->on('user');
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
        Schema::dropIfExists('config_app');
    }
}
