<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class ContentModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'content';

	public $fillable = [
		'title_pt',
		'title_en',
		'title_es',
		'subtitle_pt',
		'subtitle_en',
		'subtitle_es',
		'text_pt',
		'text_en',
		'text_es',
		'image',
		'image_bg',
		'label_image_pt',
		'label_image_en',
		'label_image_es',
		'link_label',
		'link',
		'icon',
		'content_page_id',
		'content_section_id',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	protected $softDelete = true;

	public function getImageAttribute($value)
	{
		return empty($value) ? '' : "/storage/content/{$value}";
	}

	public function getImageBgAttribute($value)
	{
		return empty($value) ? '' : "/storage/content/{$value}";
	}

	public function contentPage() {
		return $this->belongsTo('App\Model\api\ContentPageModel');
	}

	public function contentSection() {
		return $this->belongsTo('App\Model\api\ContentSectionModel');
	}

}
