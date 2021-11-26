<?php

namespace App\Model\api\Prospection;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Traits\Updater;

class ContentCourseModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'content_course';

	public $fillable = [
		'course_category_id',
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
		'start_date',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function getStartDateAttribute($value) {
		return Carbon::parse($value)->format('d/m/Y');
	}

	public function setStartDateAttribute($value) {
		$this->attributes['start_date'] = formatDateEng($value);
	}

	public function getImgAttribute($value)
	{
		return empty($value) ? '' : "/storage/contentCourse/{$value}";
	}

	public function courseCategory() {
		return $this->belongsTo('App\Model\api\Prospection\CourseCategoryModel');
	}

}
