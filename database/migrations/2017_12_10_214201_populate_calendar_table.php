<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateCalendarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('calendar')->insert(array('description_pt'=>'Feriados', 'description_en'=>'Holidays', 'description_es'=>'Feriado', 'calendar_privacy_id'=>'1', 'color'=>'#f56d6d', 'annual_repeat'=>'1'));
        DB::table('calendar')->insert(array('description_pt'=>'Pedagógico', 'description_en'=>'Pedagogical', 'description_es'=>'Pedagógico', 'calendar_privacy_id'=>'1', 'color'=>'#f56d6d', 'annual_repeat'=>'1'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
