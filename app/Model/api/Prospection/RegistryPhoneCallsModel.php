<?php

namespace App\Model\api\Prospection;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class RegistryPhoneCallsModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'registry_phone_calls';

	public $fillable = [
		'registry_id',
		'contact_name',
		'phone_contact',
		'subject',
		'registry_status_id',
		'observation',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function registry() {
		return $this->belongsTo('App\Model\api\RegistreModel');
	}

	public function registryStatus() {
		return $this->belongsTo('App\Model\api\RegistryStatusModel');
  	}

}
