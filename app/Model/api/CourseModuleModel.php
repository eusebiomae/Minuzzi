<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;
use Carbon\Carbon;

class CourseModuleModel extends Model {
	// use SoftDeletes;
	use Updater;

	protected $table = 'course_module';

	public $fillable = [
		'content_course_id',
		'course_id',
		'class_id',
		'sequence',
		'start_date',
		'type',
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

	// public function getEndDateAttribute($value) {
	// 	return empty($value) ? null : Carbon::parse($value)->format('d/m/Y');
	// }

	// public function setEndDateAttribute($value) {
	// 	$this->attributes['end_date'] = formatDateEng($value);
	// }

	public function class() {
		return $this->belongsTo('\App\Model\api\Prospection\ClassModel');
	}

	public function contentCourse() {
		return $this->belongsTo('\App\Model\api\Prospection\ContentCourseModel');
	}

	// public function videoLesson() {
	// 	return $this->belongsToMany('App\Model\api\Prospection\VideoModel', 'class_content_video_lesson', 'class_content_course_id', 'video_lesson_id');
	// }

	// public function fileContentCourse() {
	// 	return $this->hasMany('App\Model\api\FileContentCourseModel', 'content_course_id', 'content_course_id');
	// }
}
