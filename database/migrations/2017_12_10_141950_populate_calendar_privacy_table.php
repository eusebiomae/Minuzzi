<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateCalendarPrivacyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('weekday')->delete();

        DB::table('calendar_privacy')->insert(array('description_pt'=>'Público', 'description_en'=>'Public', 'description_es'=>'Público', 'suffix'=>'PU'));
        DB::table('calendar_privacy')->insert(array('description_pt'=>'Privado', 'description_en'=>'Private', 'description_es'=>'Privado', 'suffix'=>'PR'));
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
