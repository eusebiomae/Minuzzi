<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class MetaTagModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'meta_tag';

	public $fillable = [
		'content_page_id',
		'name',
		'content',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
}
