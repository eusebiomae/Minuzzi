<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use App\Traits\Updater;

use Illuminate\Support\Facades\DB;

class GaleryModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'galery';

	public $fillable = [
		'pretitle_pt',
		'subtitle_pt',
		'link',
		'link_label',
		'title_pt',
		'title_en',
		'title_es',
		'description_pt',
		'description_en',
		'description_es',
		'type',
		'image',
		'content_page_id',
		'content_section_id',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function getImageAttribute($val) {
		return empty($val) ? null : Storage::url("galery/{$this->attributes['id']}/{$val}");
	}

	public function photoGalery() {
		return $this->hasMany('App\Model\api\PhotoGaleryModel', 'galery_id', 'id');
	}

	public function contentPage() {
		return $this->belongsTo('App\Model\api\ContentPageModel');
	}

	public function contentSection() {
		return $this->belongsTo('App\Model\api\ContentSectionModel');
	}

}
