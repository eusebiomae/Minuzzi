<?php

namespace App\Model\api\Prospection;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class CourseCategoryTypeModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'course_category_type';

	public $fillable = [
		'title',
		'description',
		'image',
		'flg',
		'type',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	function courseCategory() {
		return $this->hasMany('\App\Model\api\Prospection\CourseCategoryModel', 'course_category_type_id', 'id');
	}

	function course() {
		return $this->hasMany('\App\Model\api\Prospection\CourseModel', 'course_category_type_id', 'id');
	}

	static public function getCourses($type)
	{
		return CourseCategoryTypeModel::where('type', $type)
		->select('id', 'title', 'description', 'image', 'flg', 'type')
		->with([
			'course' => function($query) {
				$query->select('id', 'name_pt', 'title_pt', 'subtitle_pt', 'description_pt', 'img', 'course_category_id', 'course_category_type_id');
			},
			'course.courseCategory' => function($query) {
				$query->select('id', 'description_pt');
			},
			'course.courseSubcategory' => function($query) {
				$query->select('id', 'description_pt');
			},
		])
		->get();
	}

	public function getImageAttribute($value) {
		return empty($value) ? null : \Illuminate\Support\Facades\Storage::url("courseCategoryType/{$value}");
	}
}
