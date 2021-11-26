<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('class_status')) {
			Schema::create('class_status', function (Blueprint $table) {
				$table->increments('id');
				$table->string('description_pt', 45)->nullable();
				$table->string('description_en', 45)->nullable();
				$table->string('description_es', 45)->nullable();
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
        Schema::dropIfExists('class_status');
    }
}
