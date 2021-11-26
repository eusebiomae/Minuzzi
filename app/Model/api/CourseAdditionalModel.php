<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class CourseAdditionalModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'course_additional';

	public $fillable = [
		'course_id',
		'additional_id',
		'form_payment_id',
		'parcel',
		'value',
		'full_value',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	protected function setValueAttribute($val) {
		$this->attributes['value'] = toNumberFormat($val);
	}

	protected function setFullValueAttribute($val) {
		$this->attributes['full_value'] = toNumberFormat($val);
	}

	protected function getValueAttribute($val) {
		return number_format($val, 2, '.', '');
	}

	protected function getFullValueAttribute($val) {
		return number_format($val, 2, '.', '');
	}
}
