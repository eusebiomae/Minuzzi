<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class SchoolInformationModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'school_information';

	public $fillable = [
		'name',
		'address',
		'number',
		'complement',
		'neighborhood',
		'city',
		'uf',
		'cep',
		'phone1',
		'phone2',
		'phone3',
		'cell_phone1',
		'cell_phone2',
		'cell_phone3',
		'email1',
		'email2',
		'email3',
		'image',
		'label_image_pt',
		'label_image_en',
		'label_image_es',
		'company_information',
		'facebook',
		'twitter',
		'instagram',
		'pinterest',
		'linkedin',
		'youtube',
		'map_iframe',
		'asaas_token',
		'asaas_url',
		'flg_main',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	protected $appends = [ 'fullAddress', 'email', 'phone', 'cellPhone', ];

	public function state() {
		return $this->belongsTo('App\Model\api\Configuration\StateModel', 'uf');
	}

	protected function getImageAttribute() {
		return "storage/scholinformation/{$this->attributes['image']}";
	}

	protected function getFullAddressAttribute() {
		return "{$this->attributes['address']} Nª: {$this->attributes['number']}, {$this->attributes['complement']} - {$this->attributes['neighborhood']}, {$this->attributes['city']} - {$this->state->abbreviation} CEP: {$this->attributes['cep']}";
	}

	protected function getEmailAttribute() {
		$email = [];

		if (!empty($this->attributes['email1'])) {
			$email[] = $this->attributes['email1'];
		}

		if (!empty($this->attributes['email2'])) {
			$email[] = $this->attributes['email2'];
		}

		if (!empty($this->attributes['email3'])) {
			$email[] = $this->attributes['email3'];
		}

		return implode(' | ', $email);
	}

	protected function getPhoneAttribute() {
		$phone = [];

		if (!empty($this->attributes['phone1'])) {
			$phone[] = $this->attributes['phone1'];
		}

		if (!empty($this->attributes['phone2'])) {
			$phone[] = $this->attributes['phone2'];
		}

		if (!empty($this->attributes['phone3'])) {
			$phone[] = $this->attributes['phone3'];
		}

		return implode(' | ', $phone);
	}

	protected function getCellPhoneAttribute() {
		$cellPhone = [];

		if (!empty($this->attributes['cell_phone1'])) {
			$cellPhone[] = $this->attributes['cell_phone1'];
		}

		if (!empty($this->attributes['cell_phone2'])) {
			$cellPhone[] = $this->attributes['cell_phone2'];
		}

		if (!empty($this->attributes['cell_phone3'])) {
			$cellPhone[] = $this->attributes['cell_phone3'];
		}

		return implode(' | ', $cellPhone);
	}

	protected function setFlgMainAttribute($val) {
		if (!empty($val)) {
			$schoolInformation = SchoolInformationModel::whereNotNull('flg_main');

			if (!empty($this->attributes['id'])) {
				$schoolInformation->where('id',	'!=' , $this->attributes['id']);
			}

			$schoolInformation->update([ 'flg_main' => null ]);
		}

		$this->attributes['flg_main'] = $val;
	}
}
