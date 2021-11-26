<?php

namespace App\Model\api\Configuration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class BankModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'bank';

	public $fillable = [
		'name',
		'code',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

}
