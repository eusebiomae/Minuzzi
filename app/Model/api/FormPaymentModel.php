<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class FormPaymentModel extends Model
{
	use SoftDeletes;
	use Updater;

	protected $table = 'form_payment';

	public $fillable = [
		'description',
		'flg_type',
		'flg_web',
		'flg_free',
		'clause4_1b',
		'clause4_2_1',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
	protected $appends = [ 'labelFlgWeb' ];

	public function introduction() {
		return $this->hasMany('\App\Model\api\Financial\IntroductionModel', 'form_payment_id');
	}

	public function bankAccount() {
		return $this->hasMany('\App\Model\api\Financial\BankAccountModel', 'form_payment_id');
	}

	protected function getLabelFlgWebAttribute() {
		return $this->attributes['flg_web'] == 1  ? 'Sim' : 'Não';
	}

}
