<?php

namespace App\Model\api;

use App\Traits\Updater;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentClassControlModel extends Model {
	use SoftDeletes, Updater;

	protected $table = 'student_class_control';

	public $fillable = [
		'order_id',
		'student_id',
		'course_id',
		'class_id',
		'classes_id',
		'content_course_id',
		'start_date',
		'end_date',
		'status',
		'presence',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function getStartDateAttribute($val) {
		return empty($val) ? null : Carbon::parse($val)->format('d/m/Y');
	}

	public function setStartDateAttribute($val) {
		$this->attributes['start_date'] = formatDateEng($val);
	}

	public function getEndDateAttribute($val) {
		return empty($val) ? null : Carbon::parse($val)->format('d/m/Y');
	}

	public function setEndDateAttribute($val) {
		$this->attributes['end_date'] = formatDateEng($val);
	}

	public function order() {
		return $this->belongsTo('\App\Model\api\OrderModel');
	}

	public function student() {
		return $this->belongsTo('\App\Model\api\StudentModel');
	}

	public function course() {
		return $this->belongsTo('\App\Model\api\Prospection\CourseModel');
	}

	public function class() {
		return $this->belongsTo('\App\Model\api\Prospection\ClassModel');
	}

	public function classes() {
		return $this->belongsTo('\App\Model\api\ClassesModel');
	}

	public function contentCourse() {
		return $this->belongsTo('\App\Model\api\Prospection\ContentCourseModel');
	}
}
