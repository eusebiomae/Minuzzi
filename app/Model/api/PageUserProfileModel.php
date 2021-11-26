<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class PageUserProfileModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'page_user_profile';

	public $fillable = [
		'page_module_id',
		'page_config_id',
		'user_profile_id',
		'user_id',

		'create',
		'read',
		'update',
		'delete',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	function pageConfig() {
		return $this->belongsTo('App\Model\api\PageConfigModel');
	}

	function pageModule() {
		return $this->belongsTo('App\Model\api\PageModuleModel');
	}

	function userProfile() {
		return $this->belongsTo('App\Model\api\UserProfileModel');
	}
}
