<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class ConstructionModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'construction';

	public $fillable = [
		'name_pt',
		'name_en',
		'name_es',
		'description_pt',
		'description_en',
		'description_es',
		'image',
		'label_image_pt',
		'label_image_en',
		'label_image_es',
		'school_information_id',
		'construction_category_id',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
}
