<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('leads')) {
			Schema::connection('mysql')->create('leads', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('course_id')->unsigned()->nullable();
				$table->integer('course_category_id')->unsigned()->nullable();
				$table->date('birth_date')->nullable();
				$table->integer('is_formed_in_psychology')->nullable();
				$table->integer('level_of_interest')->nullable();
				$table->integer('number')->nullable();
				$table->string('address', 450)->nullable();
				$table->string('badge_name', 200)->nullable();
				$table->string('branch_line', 9)->nullable();
				$table->string('cel_phone', 15)->nullable();
				$table->string('city', 45)->nullable();
				$table->string('commercial_email', 450)->nullable();
				$table->string('commercial_phone', 45)->nullable();
				$table->string('company_name', 200)->nullable();
				$table->string('complement', 100)->nullable();
				$table->string('cpf', 45)->nullable();
				$table->string('department', 45)->nullable();
				$table->string('dispatcher_organ', 8)->nullable();
				$table->string('district', 45)->nullable();
				$table->string('email', 450)->nullable();
				$table->string('fax', 45)->nullable();
				$table->string('flg_type', 1)->default('P');
				$table->string('gender', 1)->nullable();
				$table->string('img', 450)->nullable();
				$table->string('office', 45)->nullable();
				$table->string('other_contact', 15)->nullable();
				$table->string('phone', 15)->nullable();
				$table->string('reference', 100)->nullable();
				$table->string('rg', 45)->nullable();
				$table->string('state', 3)->nullable();
				$table->string('student_last_name', 200)->nullable();
				$table->string('student_name', 200)->nullable();
				$table->string('whatsapp', 15)->nullable();
				$table->string('zip_code', 10)->nullable();
				$table->text('observation')->nullable();
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('course_id')
					->references('id')
					->on('course');

				$table->foreign('course_category_id')
					->references('id')
					->on('course_category');
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
		Schema::connection('mysql')->drop('leads');
	}
}
