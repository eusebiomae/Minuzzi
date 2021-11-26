<?php

namespace App\Model\api\Configuration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

use Illuminate\Support\Facades\DB;

class CityModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'city';


	public $fillable = [
		'name',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

}
