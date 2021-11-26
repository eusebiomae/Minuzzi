<?php

namespace App\Model\api\Configuration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class RelCategoryBlogModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'rel_category_blog';

	public $fillable = [
		'blog_category_id',
		'blog_id',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
}
