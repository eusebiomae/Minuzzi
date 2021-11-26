<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class PopulateUserTypeTable extends Migration {

	public function up() {
		DB::table('user_type')->insert([ 'id' => 1, 'description' => 'Administrador', 'permission' => '1' ]);
		DB::table('user_type')->insert([ 'id' => 2, 'description' => 'Consultor de vendas', 'permission' => '2' ]);
		DB::table('user_type')->insert([ 'id' => 3, 'description' => 'Autor do Blog', 'permission' => '3' ]);
	}
}
