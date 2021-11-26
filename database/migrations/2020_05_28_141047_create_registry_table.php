<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::hasTable('registry')) {
            Schema::connection('mysql')->create('registry', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('leads_id')->unsigned()->nullable();
                $table->integer('course_id')->unsigned()->nullable();
                $table->integer('class_id')->unsigned()->nullable();
                $table->integer('city_id')->unsigned()->nullable();
                $table->integer('consultant')->unsigned()->nullable();
                $table->date('start_payment_date')->nullable();
                $table->string('form_payment', 45)->nullable();
                $table->double('total_value', 8, 2)->nullable();
                $table->double('discount', 8, 2)->nullable();
                $table->double('total_payble', 8, 2)->nullable();
                $table->integer('number_installments')->nullable();
                $table->integer('installments_sd')->nullable();
                $table->integer('installments_cd')->nullable();
                $table->string('expiry_payment_day', 2)->nullable();
                $table->string('responsible_payment', 200)->nullable();
                $table->string('type_person', 1)->nullable();
                $table->string('social_name', 200)->nullable();
                $table->string('cnpj', 45)->nullable();
                $table->string('insc_est', 45)->nullable();
                $table->string('responsible_name', 200)->nullable();
                $table->string('responsible_cpf', 45)->nullable();
                $table->string('responsible_rg', 45)->nullable();
                $table->string('responsible_address', 450)->nullable();
                $table->integer('responsible_number')->nullable();
                $table->string('responsible_complement', 100)->nullable();
                $table->string('responsible_district', 45)->nullable();
                $table->string('responsible_city', 45)->nullable();
                $table->string('responsible_state', 3)->nullable();
                $table->string('responsible_zip_code', 10)->nullable();
                $table->string('responsible_phone', 15)->nullable();
                $table->string('responsible_cel_phone', 15)->nullable();
                $table->string('responsible_email', 450)->nullable();
                $table->string('responsible_contact_name', 200)->nullable();
                $table->string('responsible_contact_phone', 15)->nullable();
                $table->string('responsible_contact_cel_phone', 15)->nullable();
                $table->string('responsible_contact_email', 450)->nullable();
                $table->text('responsible_observation')->nullable();
                $table->integer('created_by')->nullable();
                $table->integer('updated_by')->nullable();
                $table->integer('deleted_by')->nullable();
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('leads_id')
                ->references('id')
                ->on('leads');

                $table->foreign('course_id')
                ->references('id')
                ->on('course');

                $table->foreign('class_id')
                ->references('id')
                ->on('class');

                $table->foreign('city_id')
                ->references('id')
                ->on('city');

                $table->foreign('consultant')
                ->references('id')
                ->on('user');


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
        //
    }
}
