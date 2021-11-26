<?php

namespace App\Model\api\Configuration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class BlogsTagsModel extends Model {
	// use SoftDeletes;
	use Updater;

	protected $table = 'blogs_tags';

	public $fillable = [
		'blog_id',
		'blog_tag_id',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function tags()
	{
		return $this->belongsTo('\App\Model\api\Configuration\BlogTagModel', 'blog_tag_id', 'id');
	}
}
