<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class PhotoGaleryModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'photo_galery';

	public $fillable = [
		'title_pt',
		'title_en',
		'title_es',
		'file',
		'galery_id',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function getFileAttribute() {
		return "/storage/galery/{$this->attributes['galery_id']}/{$this->attributes['file']}";
	}

}
