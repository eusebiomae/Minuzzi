<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class PageFileModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'page_file';

	public $fillable = [
		'content_page_id',
		'file_site_id',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

}
