<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderParcelTable extends Migration
{
	public function up() {
		if (!Schema::hasTable('order_parcel')) {
			Schema::create('order_parcel', function(Blueprint $table) {
				$table->increments('id');

				$table->integer('order_id')->unsigned()->nullable();
				$table->integer('form_payment_id')->unsigned()->nullable();
				$table->integer('bank_id')->unsigned()->nullable();

				$table->integer('n')->nullable();
				$table->string('code', 16)->nullable();
				$table->date('due_date')->nullable();
				$table->timestamp('payday')->nullable();

				$table->double('value', 11, 2)->default(0)->nullable();
				$table->double('value_paid', 11, 2)->default(0)->nullable();

				$table->string('asaas_code', 32)->nullable();
				$table->mediumText('asaas_json')->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->foreign('order_id')
					->references('id')
					->on('order');

				$table->foreign('form_payment_id')
					->references('id')
					->on('form_payment');

				$table->foreign('bank_id')
					->references('id')
					->on('bank');
			});
		}
	}

	public function down() {
		Schema::dropIfExists('order_parcel');
	}
}
