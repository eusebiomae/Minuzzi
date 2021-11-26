<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class PatientModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'patient';

	public $fillable = [
		'name',
		'phone',
		'whatsapp',
		'email',
		'recommendation',
		'initial_complaint',
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
