<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

use Illuminate\Support\Facades\DB;

class ContentSectionModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'content_section';

	public $fillable = [
		'component',
		'component_order',
		'content_page_id',
		'description_pt',
		'description_en',
		'description_es',
		'subtitle_pt',
		'subtitle_en',
		'subtitle_es',
		'flg',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	function contentPage() {
		return $this->belongsTo('\App\Model\api\ContentPageModel');
	}

	function content() {
		return $this->hasMany('\App\Model\api\ContentModel', 'content_section_id', 'id');
	}

	function galery() {
		return $this->hasMany('\App\Model\api\GaleryModel', 'content_section_id', 'id');
	}

}
