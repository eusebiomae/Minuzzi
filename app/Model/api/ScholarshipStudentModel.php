<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;
use GigaGetData;
use Illuminate\Support\Facades\Crypt;

class ScholarshipStudentModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'scholarship_student';

	public $fillable = [
		'student_id',
		'scholarship_id',
		'scholarship_student_status_id',
		'student_socioeconomic_id',
		'avaliation_id',
		'proficiency_note',
		'socio_economic_note',
		'to_approve',
		'ranking',

		'code',
		'status',
		'form_payment_id',
		'form_payment',
		'due_date',
		'number_parcel',
		'value',
		'full_value',
		'discount_value',
		'discount_percentage',
		'value_paid',
		'payment_date',
		'birth_date',
		'cardholder',
		'cpf',
		'number_card',
		'security_code',
		'shelf_life',
		'email',
		'phone',
		'zip_code',
		'address_number',
		'asaas_token',
		'asaas_payments_code',
		'asaas_customers_code',
		'asaas_json',
		'asaas_fine',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	protected $appends = [ 'paymentStatus' ];

	// Junções de Tabela

	public function scholarship() {
		return $this->belongsTo('\App\Model\api\ScholarshipModel');
	}

	public function scholarshipStudentStatus() {
		return $this->belongsTo('\App\Model\api\ScholarshipStudentStatusModel');
	}

	public function student() {
		return $this->belongsTo('\App\Model\api\StudentModel');
	}

	public function studentSocioeconomic() {
		return $this->belongsTo('\App\Model\api\StudentSocioeconomicModel');
	}

	public function setAsaasTokenAttribute($val) {
		$this->attributes['asaas_token'] = empty($val) ? null : Crypt::encrypt($val);
	}

	public function getAsaasTokenAttribute($val) {
		return empty($val) ? null : Crypt::decrypt($val);
	}

	public function getPaymentStatusAttribute() {
		return GigaGetData::STATUS_ASAAS[$this->attributes['status']] ?? 'Nenhuma forma de pagamento gerada';
	}
}
