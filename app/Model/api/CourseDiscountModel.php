<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class CourseDiscountModel extends Model {
	use SoftDeletes, Updater;

	protected $table = 'course_discount';

	public $fillable = [
		'course_id',
		'discount_id',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function discount() {
		return $this->belongsTo('App\Model\api\DiscountModel');
	}
}
