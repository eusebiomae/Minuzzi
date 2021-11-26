<?php

namespace App\Model\api\Prospection;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Traits\Updater;

use Illuminate\Support\Facades\DB;

class RegistryModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'registry';

	public $fillable = [
		'leads_id',
		'course_id',
		'class_id',
		'city_id',
		'consultant',
		'start_payment_date',
		'form_payment',
		'total_value',
		'discount',
		'total_payble',
		'number_installments',
		'installments_sd',
		'installments_cd',
		'expiry_payment_day',
		'responsible_payment',
		'type_person',
		'social_name',
		'cnpj',
		'insc_est',
		'responsible_name',
		'responsible_cpf',
		'responsible_rg',
		'responsible_address',
		'responsible_number',
		'responsible_complement',
		'responsible_district',
		'responsible_city',
		'responsible_state',
		'responsible_zip_code',
		'responsible_phone',
		'responsible_cel_phone',
		'responsible_email',
		'responsible_contact_name',
		'responsible_contact_phone',
		'responsible_contact_cel_phone',
		'responsible_contact_email',
		'responsible_observation',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function leads() {
		return $this->belongsTo('App\Model\api\Prospection\LeadsModel');
	}

	public function course() {
		return $this->belongsTo('App\Model\api\Prospection\CourseModel');
	}

	public function class() {
		return $this->belongsTo('App\Model\api\Prospection\ClassModel');
	}

	public function city() {
		return $this->belongsTo('App\Model\api\Configuration\CityModel');
	}

	public function user() {
		return $this->belongsTo('App\Model\api\UserModel');
	}

	// retorna data na tela
	public function getStartPaymentDateAttribute($value) {
		return Carbon::parse($value)->format('d/m/Y');
	}

	//insert data
	public function setStartPaymentDateAttribute($value) {
		$this->attributes['start_payment_date'] = formatDateEng($value);
	}

}
