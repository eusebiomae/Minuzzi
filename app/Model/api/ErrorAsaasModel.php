<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ErrorAsaasModel extends Model {
	use SoftDeletes;

	protected $table = 'error_asaas';

	public $fillable = [
		'order_id',
		'json',
	];

	protected $dates = ['deleted_at'];

	protected function getJsonAttribute($val) {
		return empty($val) ? null : json_decode($val);
	}

	public function order() {
		return $this->belongsTo('App\Model\api\OrderModel', 'order_id');
	}

}
