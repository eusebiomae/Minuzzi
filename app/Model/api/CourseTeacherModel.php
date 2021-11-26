<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class CourseTeacherModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'course_teacher';

	public $fillable = [
		'course_id',
		'team_id',
		'description',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function course() {
		return $this->belongsTo('App\Model\api\Prospection\CourseModel');
	}

	public function team() {
		return $this->belongsTo('App\Model\api\TeamModel');
	}
}
