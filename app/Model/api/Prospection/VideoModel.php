<?php

namespace App\Model\api\Prospection;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;
use Illuminate\Support\Facades\Storage;

class VideoModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'video';

	public $fillable = [
		'title',
		'description',
		'link',
		'image',
		'type',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
	protected $appends = ['linkVimeo', 'show_site_label'];


	public function getLinkVimeoAttribute() {
		$val = $this->attributes['link'];
		// return empty($val) ? '' : "https://player.vimeo.com/video/{$val}";
		return empty($val) ? '' : "https://www.youtube.com/embed/{$val}";
	}
	public function getImageAttribute($val) {
		return empty($val) ? null : Storage::url("video/{$val}");
	}
	public function getShowSiteLabelAttribute() {
		if (isset($this->attributes['type'])) {
			return ($this->attributes['type'] == 'A') ? 'Aula' : 'Site';
		}
		// return !isset($this->attributes['type']) || is_null($this->attributes['type']) ? 'Inativo' : 'Ativo';
	}
}
