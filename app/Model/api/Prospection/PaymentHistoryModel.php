<?php

namespace App\Model\api\Prospection;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Updater;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class PaymentHistoryModel extends Model {
	use Updater;

	protected $table = 'payment_history';

	public $fillable = [
		'registry_id',
		'payment_date',
		'value',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function getPaymentDateAttribute($value) {
		return Carbon::parse($value)->format('d/m/Y');
	}

	public function setPaymentDateAttribute($value) {
		$this->attributes['payment_date'] = formatDateEng($value);
	}

	public function setValueAttribute($value) {
		$this->attributes['value'] = toNumberFormat($value);
	}
}
