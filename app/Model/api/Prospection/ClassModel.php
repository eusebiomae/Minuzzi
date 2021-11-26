<?php

namespace App\Model\api\Prospection;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Traits\Updater;

class ClassModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'class';

	public $fillable = [
		'name',
		'course_id',
		'place_id',
		'city_id',
		'contract_id',
		'periodicity_id',
		'link',
		'start_date',
		'end_date',
		'days_week',
		'start_hours',
		'end_hours',
		'status',
		'show_site',
		'does_registre',

		'permanence',
		'repetition',
		'permanence_all',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function course() {
		return $this->belongsTo('App\Model\api\Prospection\CourseModel');
	}

	public function city() {
		return $this->belongsTo('App\Model\api\Configuration\CityModel');
	}

	public function formPayment() {
		return $this->belongsToMany('App\Model\api\FormPaymentModel', 'course_form_payment', 'class_id', 'form_payment_id');
	}

	public function courseFormPayment() {
		return $this->hasMany('App\Model\api\CourseFormPaymentModel', 'class_id', 'id');
	}

	public function teacher() {
		return $this->belongsToMany('App\Model\api\TeamModel', 'class_teacher', 'class_id', 'team_id');
	}

	// public function contentCourse() {
	// 	return $this->belongsToMany('App\Model\api\Prospection\ContentCourseModel', 'class_content_course', 'class_id', 'content_course_id');
	// }

	public function courseModule() {
		return $this->hasMany('App\Model\api\CourseModuleModel', 'class_id', 'id');
	}

	public function classes() {
		return $this->hasMany('App\Model\api\ClassesModel', 'class_id', 'id');
	}

	public function classTeacher() {
		return $this->hasMany('App\Model\api\ClassTeacherModel', 'class_id', 'id');
	}
	public function courseDefaultValue() {
		return $this->hasMany('App\Model\api\CourseDefaultValueModel', 'class_id', 'id');
	}

	public function getStartDateAttribute($value) {
		return Carbon::parse($value)->format('d/m/Y');
	}

	public function setStartDateAttribute($value) {
		$this->attributes['start_date'] = formatDateEng($value);
	}

	public function getEndDateAttribute($value) {
		return Carbon::parse($value)->format('d/m/Y');
	}

	public function setEndDateAttribute($value) {
		$this->attributes['end_date'] = formatDateEng($value);
	}

}
