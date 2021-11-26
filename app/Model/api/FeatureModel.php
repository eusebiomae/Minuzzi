<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class FeatureModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'feature';

	public $fillable = [
		'content_page_id',
		'icon',
		'title',
		'description',
		'image',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function contentPage() {
		return $this->belongsTo('App\Model\api\ContentPageModel');
	}
}
