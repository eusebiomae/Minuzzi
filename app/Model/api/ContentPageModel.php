<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class ContentPageModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'content_page';

	public $fillable = [
		'flg_page',
		'description_pt',
		'description_en',
		'description_es',
		'content_page_id',
		'show',
		'target',
		'url',
		'sequence',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function content() {
		return $this->hasMany('App\Model\api\ContentModel', 'content_page_id', 'id');
	}

	public function metaTag() {
		return $this->hasMany('App\Model\api\MetaTagModel', 'content_page_id', 'id');
	}

	public function contentSection() {
		return $this->hasMany('App\Model\api\ContentSectionModel', 'content_page_id', 'id');
	}

	static public function getByComponent($flgPage) {
		return ContentPageModel::where('flg_page', $flgPage)
		->select('id', 'description_pt', 'flg_page')
		->with([
			'metaTag',
			'contentSection' => function($query) {
				$query->select('id', 'content_page_id', 'description_pt', 'subtitle_pt', 'component', 'component_order');
				$query->whereNotNull('component');
				$query->orderBy('component_order', 'asc');
				$query->with([
					'content' => function($query) {
						$query->select('id', 'content_section_id', 'title_pt', 'subtitle_pt', 'text_pt', 'title_en', 'subtitle_en', 'text_en', 'title_es', 'subtitle_es', 'text_es', 'image', 'link', 'image_bg', 'link_label', 'icon', 'created_at', 'created_by');
					},
					// 'galery' => function($query) {
					// 	$query->select('id', 'content_section_id', 'title_pt', 'description_pt', 'type', 'image');
						// $query->with(['photoGalery' => function($query) {
						// 	$query->select('title_pt', 'file', 'galery_id');
						// }]);
					// },
				]);
			},
		])
		->first();
	}

	function contentPage() {
		return $this->belongsTo('\App\Model\api\ContentPageModel');
	}
}
