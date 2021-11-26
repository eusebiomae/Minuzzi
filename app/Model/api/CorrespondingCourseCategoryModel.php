<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class CorrespondingCourseCategoryModel extends Model
{
	use SoftDeletes;
	use Updater;

	protected $table = 'corresponding_course_category';

	public $fillable = [
		'course_category_id',
		'blog_category_id',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function courseCategory() {
		return $this->hasMany('App\Model\api\Prospection\CourseCategoryModel', 'id', 'course_category_id');
	}
}
