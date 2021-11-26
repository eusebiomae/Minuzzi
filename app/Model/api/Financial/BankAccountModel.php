<?php

namespace App\Model\api\Financial;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class BankAccountModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'bank_account';

	public $fillable = [
		'bank_id',
		'form_payment_id',
		'bank_account_type_id',
		'description',
		'name',
		'cpf',
		'agency',
		'account',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function bank() {
		return $this->belongsTo('\App\Model\api\Configuration\BankModel');
	}

	public function bankAccountType() {
		return $this->belongsTo('\App\Model\api\Financial\BankAccountTypeModel');
	}

	public function formPayment() {
		return $this->belongsTo('\App\Model\api\FormPaymentModel');
	}
}
