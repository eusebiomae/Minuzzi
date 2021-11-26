<?php

namespace App\Model\api\Prospection;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class CourseSubcategoryModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'course_subcategory';

	public $fillable = [
		'description_pt',
		'description_en',
		'description_es',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	// function courseCategoryType() {
	// 	return $this->belongsTo('\App\Model\api\Prospection\CourseCategoryTypeModel');
	// }

	function course() {
		return $this->hasMany('\App\Model\api\Prospection\CourseModel', 'course_subcategory_id', 'id');
	}
}
