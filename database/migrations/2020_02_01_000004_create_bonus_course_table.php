<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBonusCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('bonus_course')) {
			Schema::create('bonus_course', function (Blueprint $table) {
                $table->increments('id');
			    $table->integer('course_id')->unsigned()->nullable();                
                $table->string('img', 450)->nullable();
                $table->string('title_pt', 450)->nullable();
                $table->string('title_en', 450)->nullable();
                $table->string('title_es', 450)->nullable();
                $table->string('subtitle_pt', 450)->nullable();
                $table->string('subtitle_en', 450)->nullable();
                $table->string('subtitle_es', 450)->nullable();
                $table->text('description_pt')->nullable();
                $table->text('description_en')->nullable();
                $table->text('description_es')->nullable();
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
                $table->softDeletes();
                
                $table->foreign('course_id')
			    ->references('id')
                ->on('course');
            
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
		Schema::dropIfExists('bonus_course');
        
    }
}
