<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;
use Carbon\Carbon;

class CourseBonusCourseModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'course_bonus_course';

	public $fillable = [
		'course_id',
		'bonus_course_id',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
}
