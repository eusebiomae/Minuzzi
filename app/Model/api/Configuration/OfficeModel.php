<?php

namespace App\Model\api\Configuration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class OfficeModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'office';

	public $fillable = [
		'description_pt',
		'description_en',
		'description_es',
		'flg',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
}
