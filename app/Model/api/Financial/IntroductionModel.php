<?php

namespace App\Model\api\Financial;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class IntroductionModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'introduction';

	public $fillable = [
		'title',
		'description',
		'form_payment_id',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	function formPayment() {
		return $this->belongsTo('\App\Model\api\FormPaymentModel');
	}

}
