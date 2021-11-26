<?php

namespace App\Model\api\Prospection;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

use Illuminate\Support\Facades\DB;

class BonusCourseModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'bonus_course';

	public $fillable = [
		'course_id',
		'img',
		'title_pt',
		'title_en',
		'title_es',
		'subtitle_pt',
		'subtitle_en',
		'subtitle_es',
		'description_pt',
		'description_en',
		'description_es',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function course() {
		return $this->belongsTo('App\Model\api\Prospection\CourseModel');
	}

	public function getImgAttribute($value) {
		return empty($value) ? null : \Illuminate\Support\Facades\Storage::url("bonus_course/{$value}");
	}

}
