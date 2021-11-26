<?php

namespace App\Model\api\Configuration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Traits\Updater;

class BlogCategoryModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'blog_category';

	public $fillable = [
		'description_pt',
		'description_en',
		'description_es',
		'flg_type',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	protected $appends = ['label_flg_type'];

	public function correspondingCourseCategory() {
		return $this->hasMany('App\Model\api\CorrespondingCourseCategoryModel', 'blog_category_id');
	}

	public function courseCategory() {
		return $this->belongsToMany('App\Model\api\Prospection\CourseCategoryModel', 'corresponding_course_category', 'blog_category_id', 'course_category_id');
	}

	public function getLabelFlgTypeAttribute() {
		if (!isset($this->attributes['flg_type'])) {
			return null;
		}

		return BlogCategoryModel::labelFlgType($this->attributes['flg_type']);
	}

	static function labelFlgType($flg) {
		$labelFlg = null;

		switch ($flg) {
			case 'blog':
				$labelFlg = 'Blog';
				break;
			case 'article':
				$labelFlg = 'Artigo';
				break;
		}

		return $labelFlg;
	}

	static public function getCategoryCountBlog($opts)
	{
		$where = ['deleted_at IS NULL'];

		if (isset($opts)) {
			if (isset($opts['flgType'])) {
				$where[] = "flg_type = '{$opts['flgType']}'";
			}
		}

		$where = implode(' AND ', $where);
		return DB::select("SELECT
				blog_category.id,
				blog_category.description_pt AS `description`,
				(
					SELECT COUNT(1)
					FROM blog
					WHERE deleted_at IS NULL AND blog_category_id = blog_category.id
				) AS count_blogs
			FROM blog_category
			WHERE {$where}
			ORDER BY blog_category.description_pt");
	}
}
