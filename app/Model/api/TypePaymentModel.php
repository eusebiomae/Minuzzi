<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class TypePaymentModel extends Model
{
	use SoftDeletes;
	use Updater;

	protected $table = 'type_payment';

	public $fillable = [
		'description',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	// public function introduction()
	// {
	// 	return $this->hasMany('\App\Model\api\Financial\IntroductionModel', 'form_payment_id');
	// }

	// public function bankAccount()
	// {
	// 	return $this->hasMany('\App\Model\api\Financial\BankAccountModel', 'form_payment_id');
	// }
}
