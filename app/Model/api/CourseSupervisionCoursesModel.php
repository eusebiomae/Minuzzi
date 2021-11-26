<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class CourseSupervisionCoursesModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'course_supervision_courses';

	public $fillable = [
		'course_supervision_id',
		'course_id',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
}
