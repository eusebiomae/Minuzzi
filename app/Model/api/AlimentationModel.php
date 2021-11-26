<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class AlimentationModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'alimentation';

	public $fillable = [
		'description_pt',
		'description_en',
		'description_es',
		'text_pt',
		'text_en',
		'text_es',
		'alimentation_type_id',
		'alimentation_category_id',
		'weekday_id',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function weekday() {
		return $this->belongsTo('App\Model\api\Configuration\WeekdayModel');
	}

	public function alimentationType() {
		return $this->belongsTo('App\Model\api\Configuration\AlimentationTypeModel');
	}

	public function alimentationCategory() {
		return $this->belongsTo('App\Model\api\Configuration\AlimentationCategoryModel');
	}
}
