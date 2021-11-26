<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class OrderAdditionalModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'order_additional';

	public $fillable = [
		'order_id',
		'course_additional_id',
		'additional_id',
		'course_id',
		'form_payment_id',
		'parcel',
		'value',
		'full_value',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

}
