<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class PopulatePeriodicityTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		DB::table('periodicity')->insert([ 'title' => 'Diária' ]);
		DB::table('periodicity')->insert([ 'title' => 'Semanal' ]);
		DB::table('periodicity')->insert([ 'title' => 'Quinzenal' ]); // ou Bimensal
		DB::table('periodicity')->insert([ 'title' => 'Mensal' ]);
		DB::table('periodicity')->insert([ 'title' => 'Bimestral' ]);
		DB::table('periodicity')->insert([ 'title' => 'Trimestral' ]);
		DB::table('periodicity')->insert([ 'title' => 'Quadrimestral' ]);
		DB::table('periodicity')->insert([ 'title' => 'Semestral' ]);
		DB::table('periodicity')->insert([ 'title' => 'Anual' ]);
		DB::table('periodicity')->insert([ 'title' => 'Bienal' ]);
		DB::table('periodicity')->insert([ 'title' => 'Trienal' ]);
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
