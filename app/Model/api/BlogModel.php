<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Traits\Updater;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class BlogModel extends Model {
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
		'author',
		'user_cad_id',
		'blog_category_id',
		'count_likes',
		'count_comments',
		'count_likes',
		'status',
		'scheduling_date',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function category() {
		return $this->belongsTo('\App\Model\api\Configuration\BlogCategoryModel', 'blog_category_id');
	}

	public function author() {
		return $this->belongsTo('\App\Model\api\UserModel', 'author_post');
	}

	public function blogTag() {
		return $this->belongsToMany('\App\Model\api\Configuration\BlogTagModel', 'blogs_tags', 'blog_id', 'blog_tag_id');
	}

	public function getCreatedAtAttribute($value) {
		return empty($value) ? '' : Carbon::parse($value)->format('d/m/Y');
	}

	public function getSchedulingDateAttribute($val) {
		return empty($val) ? '' : Carbon::parse($val)->format('d/m/Y');
	}

	public function setSchedulingDateAttribute($val) {
		$this->attributes['scheduling_date'] = formatDateEng($val);
	}

	public static function getStatusList() {
		return [
			[
				'flg' => 'AT',
				'label' => 'Ativo',
			],
			[
				'flg' => 'IN',
				'label' => 'Inativo',
			],
			[
				'flg' => 'AG',
				'label' => 'Agendado',
			],
		];
	}

	static public function getRecentPosts($opts)
	{
		return BlogModel::select('id', 'image', 'title_pt AS title', 'subtitle_pt AS subtitle', 'created_at')
			->whereHas('category', function($query) use ($opts) {
				$query->where('flg_type', $opts['flgType']);
			})
			->orderBy('created_at', 'desc')
			->take($opts['count'])
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

	public function getImageAttribute($value) {
		return empty($value) ? null : Storage::url("blog/{$value}");
	}
}
