<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class PeriodicityModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'periodicity';

	public $fillable = [
		'title',
	];

	protected $dates = ['deleted_at'];
}
