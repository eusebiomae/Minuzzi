<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolInformationTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		if (!Schema::hasTable('school_information')) {
			Schema::create('school_information', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name', 400);
				$table->string('address', 400);
				$table->string('number', 9);
				$table->string('complement', 4000)->nullable();
				$table->string('neighborhood', 45);
				$table->string('city', 45);
				$table->integer('uf');
				$table->string('cep', 15);
				$table->string('phone1', 45);
				$table->string('phone2', 45)->nullable();
				$table->string('phone3', 45)->nullable();
				$table->string('cell_phone1', 45)->nullable();
				$table->string('cell_phone2', 45)->nullable();
				$table->string('cell_phone3', 45)->nullable();
				$table->string('email1', 450)->nullable();
				$table->string('email2', 450)->nullable();
				$table->string('email3', 450)->nullable();
				$table->string('image', 450)->nullable();
				$table->string('facebook', 255)->nullable();
				$table->string('twitter', 255)->nullable();
				$table->string('instagram', 255)->nullable();
				$table->string('pinterest', 255)->nullable();
				$table->string('linkedin', 255)->nullable();
				$table->string('youtube', 255)->nullable();
				$table->text('map_iframe')->nullable();
				$table->string('label_image_pt', 4000)->nullable();
				$table->string('label_image_en', 4000)->nullable();
				$table->string('label_image_es', 4000)->nullable();
				$table->string('multilanguage', 1)->nullable();
				$table->text('company_information')->nullable();
				$table->string('asaas_url', 255)->nullable();
				$table->string('asaas_token', 128)->nullable();
				$table->string('flg_main', 1)->nullable();
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
		Schema::dropIfExists('school_information');
	}
}
