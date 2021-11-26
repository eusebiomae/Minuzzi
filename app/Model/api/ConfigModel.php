<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class ConfigModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'config';

	public $fillable = [
		'average',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

}
