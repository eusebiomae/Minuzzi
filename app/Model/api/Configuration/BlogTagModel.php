<?php

namespace App\Model\api\Configuration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class BlogTagModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'blog_tag';

	public $fillable = [
		'description',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
}
