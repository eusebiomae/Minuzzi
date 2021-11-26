<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('state')->delete();

        DB::table('state')->insert(array('description'=>'Acre', 'abbreviation'=>'AC'));
        DB::table('state')->insert(array('description'=>'Alagoas', 'abbreviation'=>'AL'));
        DB::table('state')->insert(array('description'=>'Amapá', 'abbreviation'=>'AP'));
        DB::table('state')->insert(array('description'=>'Amazonas', 'abbreviation'=>'AM'));
        DB::table('state')->insert(array('description'=>'Bahia', 'abbreviation'=>'BA'));
        DB::table('state')->insert(array('description'=>'Ceará', 'abbreviation'=>'CE'));
        DB::table('state')->insert(array('description'=>'Distrito Federal', 'abbreviation'=>'DF'));
        DB::table('state')->insert(array('description'=>'Espírito Santo', 'abbreviation'=>'ES'));
        DB::table('state')->insert(array('description'=>'Goiás', 'abbreviation'=>'GO'));
        DB::table('state')->insert(array('description'=>'Maranhão', 'abbreviation'=>'MA'));
        DB::table('state')->insert(array('description'=>'Mato Grosso', 'abbreviation'=>'MT'));
        DB::table('state')->insert(array('description'=>'Mato Grosso do Sul', 'abbreviation'=>'MS'));
        DB::table('state')->insert(array('description'=>'Minas Gerais', 'abbreviation'=>'MG'));
        DB::table('state')->insert(array('description'=>'Pará', 'abbreviation'=>'PA'));
        DB::table('state')->insert(array('description'=>'Paraíba', 'abbreviation'=>'PB'));
        DB::table('state')->insert(array('description'=>'Paraná', 'abbreviation'=>'PR'));
        DB::table('state')->insert(array('description'=>'Pernambuco', 'abbreviation'=>'PE'));
        DB::table('state')->insert(array('description'=>'Piauí', 'abbreviation'=>'PI'));
        DB::table('state')->insert(array('description'=>'Rio de Janeiro', 'abbreviation'=>'RJ'));
        DB::table('state')->insert(array('description'=>'Rio Grande do Norte', 'abbreviation'=>'RN'));
        DB::table('state')->insert(array('description'=>'Rio Grande do Sul', 'abbreviation'=>'RS'));
        DB::table('state')->insert(array('description'=>'Rôndonia', 'abbreviation'=>'RO'));
        DB::table('state')->insert(array('description'=>'Roraima', 'abbreviation'=>'RR'));
        DB::table('state')->insert(array('description'=>'Santa Catarina', 'abbreviation'=>'SC'));
        DB::table('state')->insert(array('description'=>'São Paulo', 'abbreviation'=>'SP'));
        DB::table('state')->insert(array('description'=>'Sergipe', 'abbreviation'=>'SE'));
        DB::table('state')->insert(array('description'=>'Tocantins', 'abbreviation'=>'TO'));
        
        

       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('state')->delete();
    }
}
