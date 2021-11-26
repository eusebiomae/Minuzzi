<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateMonthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('month')->insert(array('description_pt'=>'Janeiro', 'description_en'=>'January', 'description_es'=>'Enero', 'abbreviation_pt'=>'JAN', 'abbreviation_en'=>'JAN', 'abbreviation_es'=>'ENE', 'suffix'=>'JR'));
        DB::table('month')->insert(array('description_pt'=>'Fevereiro', 'description_en'=>'February', 'description_es'=>'Febrero', 'abbreviation_pt'=>'FEV', 'abbreviation_en'=>'FEB', 'abbreviation_es'=>'FEB', 'suffix'=>'FB'));
        DB::table('month')->insert(array('description_pt'=>'Março' , 'description_en'=>'March', 'description_es'=>'Marzo', 'abbreviation_pt'=>'MAR', 'abbreviation_en'=>'MAR', 'abbreviation_es'=>'MAR', 'suffix'=>'MR'));                       
        DB::table('month')->insert(array('description_pt'=>'Abril', 'description_en'=>'April' , 'description_es'=>'Abril', 'abbreviation_pt'=>'ABR', 'abbreviation_en'=>'APR', 'abbreviation_es'=>'ABR', 'suffix'=>'AB'));                       
        DB::table('month')->insert(array('description_pt'=>'Maio', 'description_en'=>'May', 'description_es'=>'Mayo', 'abbreviation_pt'=>'MAI', 'abbreviation_en'=>'MAY', 'abbreviation_es'=>'MAY', 'suffix'=>'MI'));
        DB::table('month')->insert(array('description_pt'=>'Junho', 'description_en'=>'June', 'description_es'=>'Junio', 'abbreviation_pt'=>'JUN', 'abbreviation_en'=>'JUN', 'abbreviation_es'=>'JUN', 'suffix'=>'JN'));
        DB::table('month')->insert(array('description_pt'=>'Julho', 'description_en'=>'July', 'description_es'=>'Julio', 'abbreviation_pt'=>'JUL', 'abbreviation_en'=>'JUL', 'abbreviation_es'=>'JUL', 'suffix'=>'JL'));           
        DB::table('month')->insert(array('description_pt'=>'Agosto', 'description_en'=>'August', 'description_es'=>'Agosto', 'abbreviation_pt'=>'AGO', 'abbreviation_en'=>'AUG', 'abbreviation_es'=>'AGO', 'suffix'=>'AG'));
        DB::table('month')->insert(array('description_pt'=>'Setembro', 'description_en'=>'September', 'description_es'=>'Septiembre', 'abbreviation_pt'=>'SET', 'abbreviation_en'=>'SEP', 'abbreviation_es'=>'SEP', 'suffix'=>'ST'));
        DB::table('month')->insert(array('description_pt'=>'Outubro', 'description_en'=>'October', 'description_es'=>'Octubre', 'abbreviation_pt'=>'OUT', 'abbreviation_en'=>'OCT', 'abbreviation_es'=>'OCT', 'suffix'=>'OT'));                     
        DB::table('month')->insert(array('description_pt'=>'Novembro', 'description_en'=>'November', 'description_es'=>'Noviembre', 'abbreviation_pt'=>'NOV', 'abbreviation_en'=>'NOV', 'abbreviation_es'=>'NOV', 'suffix'=>'NV'));                          
        DB::table('month')->insert(array('description_pt'=>'Dezembro', 'description_en'=>'December', 'description_es'=>'Diciembre', 'abbreviation_pt'=>'DEZ', 'abbreviation_en'=>'DEC', 'abbreviation_es'=>'DIC', 'suffix'=>'DZ'));
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('month')->delete();
    }
}
