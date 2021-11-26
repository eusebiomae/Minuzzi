<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class UserProfileModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'user_profile';

	public $fillable = [
		'desc',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function user() {
		return $this->belongsTo('App\Model\api\UserModel');
	}
}
