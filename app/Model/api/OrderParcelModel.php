<?php

namespace App\Model\api;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderParcelModel extends Model {
	use SoftDeletes;

  protected $table = 'order_parcel';

	public $fillable = [
    'order_id',
		'form_payment_id',
    'bank_id',
    'code',
    'due_date',
    'payday',
    'value',
    'n',
		'value_paid',
    'asaas_code',
    'asaas_json',
    'created_by',
    'updated_by',
    'deleted_by',
  ];

  protected $dates = [ 'deleted_at' ];

  protected $appends = [ 'status', 'statusLabel' ];

  public function setDueDateAttribute($value) {
		$this->attributes['due_date'] = formatDateEng($value);
	}

	public function setPaydayAttribute($value) {
		$this->attributes['payday'] = formatDateEng($value);
  }

  public function setBankIdAttribute($val) {
		$this->attributes['bank_id'] = empty($val) ? null : $val;
	}

	public function setValuePaidAttribute($val) {
		$this->attributes['value_paid'] = empty($val) ? null : toNumberFormat($val);
	}

  protected function getDueDateAttribute($value) {
		return empty($value) ? '' : Carbon::parse($value)->format('d/m/Y');
  }

  protected function getPaydayAttribute($value) {
		return empty($value) ? '' : Carbon::parse($value)->format('d/m/Y');
	}

  protected function getAsaasJsonAttribute($value) {
    try {
      return json_decode($value);
    } catch (\Throwable $th) {
      return null;
    }
  }

  protected function getStatusLabelAttribute() {
    if (empty($this->attributes['deleted_at'])) {

      if (empty($this->attributes['payday'])) {
        $dueDate = strtotime("+5 day", strtotime($this->attributes['due_date']));
        if (strtotime(date('Y-m-d', strtotime('now'))) > $dueDate) {
          return '<i class="fa fa-circle text-danger" title="Atrasado"></i>';
        } else {
          if (strtotime(date('Y-m-01', $dueDate)) > strtotime(date('Y-m-01', strtotime('now')))) {

            return '<i class="fa fa-circle text-success" title="Aberto"></i>';
          } else {

            return '<i class="fa fa-circle text-warning" title="Pendente"></i>';
          }
        }
      } else {

        return '<i class="fa fa-circle text-green" title="Pago"></i>';
      }
    } else {

      $this->attributes['status'] = 'Cancelado';
      return '<i class="fa fa-circle text-muted" title="Cancelado"></i>';
    }
  }

  function getStatusAttribute() {
    if (empty($this->attributes['deleted_at'])) {
      if (empty($this->attributes['payday'])) {
        $dueDate = strtotime("+5 day", strtotime($this->attributes['due_date']));
        if (strtotime(date('Y-m-d', strtotime('now'))) > $dueDate) {
          return 'At';
        } else {
          if (strtotime(date('Y-m-01', $dueDate)) > strtotime(date('Y-m-01', strtotime('now')))) {
            return 'Ab';
          } else {
            return 'Pd';
          }
        }
      } else {
        return 'Pg';
      }
    } else {
      return 'Ca';
    }
  }

  public function formPayment() {
		return $this->belongsTo('App\Model\api\FormPaymentModel');
	}
}
