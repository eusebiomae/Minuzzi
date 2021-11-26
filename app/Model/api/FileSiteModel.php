<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class FileSiteModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'file_site';

	public $fillable = [
		'type_file_id',
		'name',
		'title',
		'subtitle',
		'description',
		'extension',
		'link',
		'img',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
	protected $appends = [ 'icon' ];


	public function typeFile() {
		return $this->belongsTo('App\Model\api\TypeFileModel', 'type_file_id');
	}

	public function contentPage() {
		return $this->belongsToMany('App\Model\api\ContentPageModel', 'page_file', 'file_site_id', 'content_page_id');
	}

	public function pageFile() {
		return $this->hasMany('App\Model\api\PageFileModel', 'file_site_id');
	}

	public function getLinkAttribute($value) {
		return empty($value) ? null : \Illuminate\Support\Facades\Storage::url("fileSite/doc/{$value}");
	}

	public function getImgAttribute($value) {
		return empty($value) ? null : \Illuminate\Support\Facades\Storage::url("fileSite/img/{$value}");
	}

	public function getIconAttribute() {
		return FileSiteModel::getIcon($this->attributes['extension']);
	}

	static public function getIcon($extension) {
		switch ($extension) {
			case 'jpg':
			case 'png':
			case 'git':
				return 'fa-file-image';
			case 'mp4':
				return 'fa-file-video';
			case 'mp3':
				return 'fa-file-audio';
			case 'pdf':
				return 'fa-file-pdf';
			case 'docx':
			case 'docm':
			case 'dotx':
			case 'dotm':
				return 'fa-file-word';
			case 'pptx':
			case 'ppt':
				return 'fa-file-powerpoint';
			case 'xls':
			case 'xlt':
				return 'fa-file-excel';
			case 'zip':
			case 'rar':
				return 'fa-file-archive';
			case 'txt':
				return 'fa-file-alt';
			default: return 'fa-file';
		}
	}
}
