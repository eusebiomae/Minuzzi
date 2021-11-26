<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class PageConfigModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'page_config';

	public $fillable = [
		'page_module_id',
		'name_key',
		'icon',
		'desc',
		'url',
		'sequence',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function fieldPageConfig() {
		return $this->hasMany('App\Model\api\FieldPageConfigModel', 'page_config_id')->orderBy('sequence');
	}
}
