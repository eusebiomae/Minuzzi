<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;
use Illuminate\Support\Facades\Storage;

class SlideModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'slide';

	public $fillable = [
		'pretitle_pt',
		'pretitle_en',
		'pretitle_es',
		'title_pt',
		'title_en',
		'title_es',
		'subtitle_pt',
		'subtitle_en',
		'subtitle_es',
		'flg_type',
		'image',
		'status',
		'label_link',
		'link',
		'content_page_id',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
	// protected $appends = ['labelFlgType'];

	public function getImageAttribute($val) {
		return empty($val) ? null : Storage::url("slides/{$val}");
	}

	// public function getLabelFlgTypeAttribute($val) {
	// 	return ($this->attributes['flg_type'] == 0) ? 'Banner' : 'Carrosel';
	// }

	public function contentPage() {
		return $this->belongsTo('\App\Model\api\ContentPageModel');
	}
}
