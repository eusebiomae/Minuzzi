<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;
use Carbon\Carbon;

class ProductivityModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'productivity';

	public $fillable = [
		'user_id',
		'title',
		'date',
		'weekday',
		'grade',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	public $appends = ['weekdayLabel'];

	protected $dates = ['deleted_at'];

	function user() {
		return $this->belongsTo('App\Model\api\userModel');
	}

	function productivityContent() {
		return $this->hasMany('App\Model\api\ProductivityContentModel', 'productivity_id', 'id');
	}

	function getDateAttribute($value) {
		return empty($value) ? '' : Carbon::parse($value)->format('d/m/Y');
	}

	function getWeekdayLabelAttribute() {
		return getWeekday($this->attributes['weekday']);
	}
}
