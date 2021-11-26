<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Traits\Updater;

class CourseSupervisionModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'course_supervision';

	public $fillable = [
		'date',
		'team_id',
		'value_1',
		'value_2',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function setDateAttribute($value) {
		$this->attributes['date'] = formatDateEng($value);
	}

	protected function setValue1Attribute($val) {
		$this->attributes['value_1'] = toNumberFormat($val);
	}

	protected function setValue2Attribute($val) {
		$this->attributes['value_2'] = toNumberFormat($val);
	}

	protected function getValue1Attribute($val) {
		return formatNumber($val);
	}

	protected function getValue2Attribute($val) {
		return formatNumber($val);
	}

	public function getDateAttribute($value) {
		return empty($value) ? '' : Carbon::parse($value)->format('d/m/Y');
	}

	function course() {
		return $this->belongsToMany('App\Model\api\Prospection\CourseModel', 'course_supervision_courses', 'course_supervision_id', 'course_id');
	}

	function courseSupervisionCourses() {
		return $this->hasMany('App\Model\api\CourseSupervisionCoursesModel', 'course_supervision_id', 'id');
	}

	function teacher() {
		return $this->belongsTo('App\Model\api\TeamModel', 'team_id', 'id');
	}

	public static function getCoursesTitle(&$data) {
		$courses = [];

		foreach ($data->course as $item) {
			$courses[] = $item->title_pt;
		}

		return implode(' | ', $courses);
	}
}
