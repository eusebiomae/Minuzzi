<?php

namespace App\Model\api\Configuration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class PhraseModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'phrase';

	public $fillable = [
		'name',
		'image',
		'phrase',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function getImageAttribute($value) {
		return empty($value) ? null : \Illuminate\Support\Facades\Storage::url("phrase/{$value}");
	}

}
