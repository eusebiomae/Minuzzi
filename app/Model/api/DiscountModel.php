<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;
use Carbon\Carbon;

class DiscountModel extends Model {
	use SoftDeletes, Updater;

	protected $table = 'discount';

	public $fillable = [
		'title',
		'value',
		'percentage',
		'shelf_life',
		'qtd',
		'code',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	protected function setValueAttribute($val) {
		$this->attributes['value'] = toNumberFormat($val);
	}

	protected function getValueAttribute($val) {
		return number_format($val, 2, '.', '');
	}

	protected function setPercentageAttribute($val) {
		$this->attributes['percentage'] = toNumberFormat($val);
	}

	protected function getPercentageAttribute($val) {
		return number_format($val, 2, '.', '');
	}

	protected function setShelfLifeAttribute($val) {
		$this->attributes['shelf_life'] = formatDateEng($val);
	}

	protected function getShelfLifeAttribute($val) {
		return empty($val) ? '' : Carbon::parse($val)->format('d/m/Y');
	}
}
