<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class ClassesVideoLessonModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'classes_video_lesson';

	public $fillable = [
		'classes_id',
		'video_lesson_id',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
}
