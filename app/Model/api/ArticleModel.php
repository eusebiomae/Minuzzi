<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Traits\Updater;
use Carbon\Carbon;

class ArticleModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'blog';

	public $fillable = [
		'image',
		'label_image_pt',
		'label_image_en',
		'label_image_es',
		'title_pt',
		'title_en',
		'title_es',
		'subtitle_pt',
		'subtitle_en',
		'subtitle_es',
		'text_pt',
		'text_en',
		'text_es',
		// 'date_post',
		'author_post',
		'user_cad_id',
		'blog_category_id',
		'count_likes',
		'count_comments',
		'count_likes',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function category()
	{
		return $this->belongsTo('\App\Model\api\Configuration\ArticleCategoryModel', 'article_category_id');
	}

	public function author()
	{
		return $this->belongsTo('\App\Model\api\UserModel', 'author_post');
	}

	public function blogsTags()
	{
		return $this->hasMany('\App\Model\api\Configuration\BlogsTagsModel', 'blog_id');
	}

	public function getCreatedAtAttribute($value)
	{
		return empty($value) ? '' : Carbon::parse($value)->format('d/m/Y');
	}

	static public function getRecentPosts($count)
	{
		return ArticleModel::select('id', 'image', 'title_pt AS title', 'subtitle_pt AS subtitle', 'created_at')
			->orderBy('created_at', 'desc')
			->take($count)
			->get();
	}

	static public function getPopularTags() {
		return DB::select("SELECT DISTINCT blog_tag.id
				, blog_tag.description
			FROM blog_tag
				INNER JOIN blogs_tags ON blogs_tags.deleted_at IS NULL AND blogs_tags.blog_tag_id = blog_tag.id
				INNER JOIN blog ON blog.deleted_at IS NULL AND blog.id = blogs_tags.blog_id
			WHERE blog_tag.deleted_at IS NULL
			ORDER BY blog.count_views DESC
			LIMIT 6");
	}
}
