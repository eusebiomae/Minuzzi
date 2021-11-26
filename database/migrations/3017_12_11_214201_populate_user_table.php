<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PopulateUserTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up(){
		DB::table('user')->insert(array('name'=>'Administrador', 'user_name'=>'admin', 'email'=>'joel.zanata@gigapixel.com.br', 'password'=> Hash::make('admin'), 'user_type_id'=>'1'));
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
