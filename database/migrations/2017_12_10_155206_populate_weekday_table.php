<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateWeekdayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('weekday')->insert(array('description_pt'=>'Domingo', 'description_en'=>'Sunday', 'description_es'=>'Domingo', 'abbreviation_pt'=>'DOM', 'abbreviation_en'=>'SUN', 'abbreviation_es'=>'DOM', 'suffix'=>'SU'));
        DB::table('weekday')->insert(array('description_pt'=>'Segunda', 'description_en'=>'Monday', 'description_es'=>'Lunes', 'abbreviation_pt'=>'SEG', 'abbreviation_en'=>'MON', 'abbreviation_es'=>'LUN', 'suffix'=>'MO'));
        DB::table('weekday')->insert(array('description_pt'=>'Terça' , 'description_en'=>'Tuesday', 'description_es'=>'Martes', 'abbreviation_pt'=>'TER', 'abbreviation_en'=>'TUE', 'abbreviation_es'=>'MAR', 'suffix'=>'TU'));                       
        DB::table('weekday')->insert(array('description_pt'=>'Quarta', 'description_en'=>'Wednesday' , 'description_es'=>'Miércoles', 'abbreviation_pt'=>'QUA', 'abbreviation_en'=>'WED', 'abbreviation_es'=>'MIÉ', 'suffix'=>'WE'));                       
        DB::table('weekday')->insert(array('description_pt'=>'Quinta', 'description_en'=>'Thursday', 'description_es'=>'Jueves', 'abbreviation_pt'=>'QUI', 'abbreviation_en'=>'THU', 'abbreviation_es'=>'JUE', 'suffix'=>'TH'));
        DB::table('weekday')->insert(array('description_pt'=>'Sexta', 'description_en'=>'Friday', 'description_es'=>'Viernes', 'abbreviation_pt'=>'SEX', 'abbreviation_en'=>'FRI', 'abbreviation_es'=>'VIE', 'suffix'=>'FR'));
        DB::table('weekday')->insert(array('description_pt'=>'Sábado', 'description_en'=>'Saturday', 'description_es'=>'Sábado', 'abbreviation_pt'=>'SÁB', 'abbreviation_en'=>'SAT', 'abbreviation_es'=>'SÁB', 'suffix'=>'SA'));              
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('weekday')->delete();
    }
}
