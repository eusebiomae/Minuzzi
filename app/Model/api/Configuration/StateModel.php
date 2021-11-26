<?php

namespace App\Model\api\Configuration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class StateModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'state';

	public $fillable = [
		'description',
		'abbreviation',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
}
