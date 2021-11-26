<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class AppConfModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'app_conf';

	public $fillable = [
		'cron_asaas_payments',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
}
