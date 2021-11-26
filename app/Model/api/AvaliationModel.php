<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;
use Carbon\Carbon;

class AvaliationModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'avaliation';

	public $fillable = [
		'title',
		'category_id',
		'date',
		'start_time',
		'duration',
		'time_limit',
		'description',
		'slide_id',
		// 'avaliation_question',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function setDateAttribute($val) {
		$this->attributes['date'] = formatDateEng($val);
	}
	public function getDateAttribute($val) {
		return empty($val) ? '' : Carbon::parse($val)->format('d/m/Y');
	}
	public function category() {
		return $this->belongsTo('App\Model\api\Prospection\CourseCategoryModel');
	}
}
