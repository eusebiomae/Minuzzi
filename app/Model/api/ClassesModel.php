<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;
use Carbon\Carbon;

class ClassesModel extends Model {
	use SoftDeletes, Updater;

	protected $table = 'classes';

	public $fillable = [
		'sequence',
		'start_date',
		'end_date',
		'course_id',
		'class_id',
		'team_id',
		'content_course_id',
		'type',
		'number_of_classes',
		'view_presencial',
		'link_live',
		'orientative',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	protected $appends = [ 'typeLabel' ];

	public function getTypeLabelAttribute() {
		if (isset($this->attributes['type'])) {
			switch ($this->attributes['type']) {
				case 'presential': return 'Presencial';
				case 'online': return 'Online';
			}
		}
	}

	public function getStartDateAttribute($value) {
		return empty($value) ? null : Carbon::parse($value)->format('d/m/Y');
	}

	public function setStartDateAttribute($value) {
		$this->attributes['start_date'] = formatDateEng($value);
	}

	public function getEndDateAttribute($value) {
		return empty($value) ? null : Carbon::parse($value)->format('d/m/Y');
	}

	public function setEndDateAttribute($value) {
		$this->attributes['end_date'] = formatDateEng($value);
	}

	public function team() {
		return $this->belongsTo('\App\Model\api\TeamModel');
	}

	public function class() {
		return $this->belongsTo('\App\Model\api\Prospection\ClassModel');
	}

	public function contentCourse() {
		return $this->belongsTo('\App\Model\api\Prospection\ContentCourseModel');
	}

	public function videoLesson() {
		return $this->belongsToMany('App\Model\api\Prospection\VideoModel', 'classes_video_lesson', 'classes_id', 'video_lesson_id');
	}

	public function fileContentCourse() {
		return $this->hasMany('App\Model\api\FileContentCourseModel', 'content_course_id', 'content_course_id');
	}

	public function studentClassControl() {
		return $this->belongsTo('App\Model\api\StudentClassControlModel', 'id', 'classes_id');
	}
}
