<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsletterTable extends Migration {
	public function up() {
		if (!Schema::hasTable('newsletter')) {
			Schema::create('newsletter', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name', 255)->nullable();
				$table->string('email', 255)->nullable();

				$table->integer('created_by')->nullable();
				$table->integer('updated_by')->nullable();
				$table->integer('deleted_by')->nullable();
				$table->timestamps();
				$table->softDeletes();
			});
		}
	}

	public function down() {
		Schema::dropIfExists('newsletter');
	}
}
