<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class WorkWithUsModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'work_with_us';

	public $fillable = [
		'name',
		'last_name',
		'genre',
		'date_birth',
		'profession',
		'address',
		'number',
		'complement',
		'neighborhood',
		'city',
		'uf',
		'cep',
		'phone1',
		'phone2',
		'cell_phone1',
		'cell_phone2',
		'email1',
		'email2',
		'curriculum',
		'video',
		'text_pt',
		'text_en',
		'text_es',
		'graduation_id',
		'function_id',
		'office_id',
		'english_level_id',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
}
