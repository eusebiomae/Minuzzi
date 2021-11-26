<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class CourseOtherInfModel extends Model
{
	use SoftDeletes;
	use Updater;

	protected $table = 'course_other_inf';

	public $fillable = [
		'course_id',
		'other_inf_type_id',
		'other_inf_id',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function otherInfType() {
		return $this->belongsTo('App\Model\api\OtherInfTypeModel');
	}

	public function otherInf() {
		return $this->belongsTo('App\Model\api\OtherInfModel');
	}

}
