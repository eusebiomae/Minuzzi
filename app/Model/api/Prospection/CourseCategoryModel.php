<?php

namespace App\Model\api\Prospection;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;
use Illuminate\Support\Facades\Storage;

class CourseCategoryModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'course_category';

	public $fillable = [
		'description_pt',
		'description_en',
		'description_es',
		'course_category_type_id',
		'image',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function getImageAttribute($value) {
		return empty($value) ? null : Storage::url("course_category/{$value}");
	}

	function courseCategoryType() {
		return $this->belongsTo('\App\Model\api\Prospection\CourseCategoryTypeModel');
	}

	function course() {
		return $this->hasMany('\App\Model\api\Prospection\CourseModel', 'course_category_id', 'id');
	}
}
