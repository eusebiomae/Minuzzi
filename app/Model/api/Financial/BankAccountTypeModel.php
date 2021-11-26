<?php

namespace App\Model\api\Financial;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class BankAccountTypeModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'bank_account_type';

	public $fillable = [
		'name',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
}
