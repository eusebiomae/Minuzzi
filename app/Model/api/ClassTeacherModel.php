<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class ClassTeacherModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'class_teacher';

	public $fillable = [
		'class_id',
		'team_id',
		'description',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function class() {
		return $this->belongsTo('App\Model\api\Prospection\ClassModel');
	}

	public function team() {
		return $this->belongsTo('App\Model\api\TeamModel');
	}
}
