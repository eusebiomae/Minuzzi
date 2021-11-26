<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class CourseDefaultValueModel extends Model
{
	use SoftDeletes;
	use Updater;

	protected $table = 'course_default_value';

	public $fillable = [
		'course_id',
		'class_id',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function courseFormPayment() {
		return $this->hasMany('App\Model\api\CourseFormPaymentModel', 'class_id', 'class_id');
	}
}
