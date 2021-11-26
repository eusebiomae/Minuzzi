<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class BudgetModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'budget';

	public $fillable = [
		'name',
		'company',
		'email',
		'phone',
		'quantity',
		'product_type',
		'phases',
		'input_voltage',
		'output_voltage',
		'power',
		'protection',
		'subject',
		'message',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	// function formPayment() {
	// 	return $this->belongsTo('\App\Model\api\FormPaymentModel');
	// }

}
