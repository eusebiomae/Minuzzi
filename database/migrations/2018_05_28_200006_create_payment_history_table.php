<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
	{
		if (!Schema::hasTable('payment_history')) {
			Schema::create('payment_history', function (Blueprint $table) {
                $table->increments('id');
			    $table->integer('registry_id')->unsigned()->nullable();                               
                $table->date('payment_date')->nullable();
                $table->double('value', 8, 2)->nullable();
				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
                $table->softDeletes();
                
                $table->foreign('registry_id')
                ->references('id')
                ->on('registry');
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
		Schema::dropIfExists('payment_history');
	}
}
