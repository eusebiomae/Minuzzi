<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\Updater;
use Carbon\Carbon;

class StudentModel extends Authenticatable {
	use SoftDeletes;
	use Updater;

	protected $guard = 'studentArea';

	protected $table = 'student';

	public $fillable = [
		'asaas_code',
		'name',
		'cpf',
		'email',
		'password',
		'phone',
		'cell_phone',
		'birth_date',
		'zip_code',
		'address',
		'city',
		'state_id',
		'formation',
		'modality',
		'tcc_experience',
		'rg',
		'gender',
		'neighborhood',
		'n',
		'complement',
		'more_information',
		'image',
		'remember_token',
		'reset_password_code',
		'email_confirmation_code',
		'mother',
		'father',
		'kids',
		'imported',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	protected $appends = [ 'phones' ];

	protected $hidden = [
		'password', 'remember_token',
	];

	public function getPhonesAttribute() {
		$phones = [];

		if (!empty($this->attributes['phone'])) {
			$phones[] = formatValue($this->attributes['phone'], 'phone');
		}
		if (!empty($this->attributes['cell_phone'])) {
			$phones[] = formatValue($this->attributes['cell_phone'], 'phone');
		}

		return implode(' | ', $phones);
	}

	public function setCpfAttribute($value) {
		$this->attributes['cpf'] = preg_replace('/\D/', '', $value);
	}

	public function setPhoneAttribute($value) {
		$this->attributes['phone'] = preg_replace('/\D/', '', $value);
	}

	public function setCellPhoneAttribute($value) {
		$this->attributes['cell_phone'] = preg_replace('/\D/', '', $value);
	}

	public function setRgAttribute($value) {
		$this->attributes['rg'] = preg_replace('/\W/', '', $value);
	}

	public function setZipCodeAttribute($value) {
		$this->attributes['zip_code'] = preg_replace('/\D/', '', $value);
	}

	public function setBirthDateAttribute($value)
	{
		$this->attributes['birth_date'] = formatDateEng($value);
	}

	public function getBirthDateAttribute($value) {
		return empty($value) ? '' : Carbon::parse($value)->format('d/m/Y');
	}

	public function getImageAttribute($value) {
		return empty($value) ? '' : \Illuminate\Support\Facades\Storage::url("student/{$value}");
	}

	public function state() {
		return $this->belongsTo('\App\Model\api\Configuration\StateModel');
	}

	public function order() {
		return $this->belongsTo('\App\Model\api\OrderModel', 'id', 'student_id');
	}
}
