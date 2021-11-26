<?php

namespace App\model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class PlaceModel extends Model
{
	use SoftDeletes;
	use Updater;

	protected $table = 'place';

	public $fillable = [
		'description',
		'address',
		'number',
		'complement',
		'neighborhood',
		'city',
		'uf',
		'cep',
		'phone',
		'cell_phone',
		'phone_resp',
		'email',
		'responsible',
		'company_information',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
}
