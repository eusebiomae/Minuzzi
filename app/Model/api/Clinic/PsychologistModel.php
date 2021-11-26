<?php

namespace App\Model\api\Clinic;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class PsychologistModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'psychologist';

	public $fillable = [
		'name',
		'phone',
		'whatsapp',
		'email',
		'specialties',
		'crp',
		'address',
		'number',
		'neighborhood',
		'city',
		'state_id',
		'complement',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

}
