<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsPhoneCallsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('leads_phone_call')) {
			Schema::connection('mysql')->create('leads_phone_call', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('leads_id')->unsigned()->nullable();
				$table->string('contact_name', 200)->nullable();
				$table->string('phone_contact', 45)->nullable();
				$table->string('subject', 200)->nullable();
				$table->integer('leads_status_id')->unsigned()->nullable();
				$table->text('observation')->nullable();
				$table->string('question1', 200)->nullable();
				$table->string('question2', 200)->nullable();
				$table->string('question3', 200)->nullable();
				$table->string('question4', 200)->nullable();
				$table->string('question5', 200)->nullable();
				$table->string('question6', 200)->nullable();
				$table->string('question7', 200)->nullable();
				$table->string('question8', 200)->nullable();
				$table->string('question9', 200)->nullable();
				$table->string('question10', 200)->nullable();
				$table->string('alternative1', 1)->nullable();
				$table->string('alternative2', 1)->nullable();
				$table->string('alternative3', 1)->nullable();
				$table->string('alternative4', 1)->nullable();
				$table->string('alternative5', 1)->nullable();
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('leads_id')
					->references('id')
					->on('leads');

				$table->foreign('leads_status_id')
					->references('id')
					->on('leads_status');
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
		Schema::connection('mysql')->drop('leads_phone_call');
	}
}
