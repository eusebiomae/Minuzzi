<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class PageModuleModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'page_module';

	public $fillable = [
		'page_module_id',
		'name_key',
		'icon',
		'desc',
		'sequence',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function pageModule() {
		return $this->belongsTo('App\Model\api\PageModuleModel', 'page_module_id');
	}
}
