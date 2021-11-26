<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;
use Illuminate\Support\Facades\Storage;

class CarouselModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'carousel';

	public $fillable = [
		'id',
		'flg_page',
		'content_page_id',
		'title',
		'description',
		'image_main',
		'image_additional_1',
		'image_additional_2',
		'image_additional_3',
		'image_additional_4',
		'image_additional_5',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
	// protected $appends = ['labelFlgType'];

	public function getImageAttribute($val) {
		return empty($val) ? null : Storage::url("carousel/{$val}");
	}

	// public function getLabelFlgTypeAttribute($val) {
	// 	return ($this->attributes['flg_type'] == 0) ? 'Banner' : 'Carrosel';
	// }

	public function contentPage() {
		return $this->belongsTo('\App\Model\api\ContentPageModel');
	}
}
