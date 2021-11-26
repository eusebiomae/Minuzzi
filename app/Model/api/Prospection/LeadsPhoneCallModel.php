<?php

namespace App\Model\api\Prospection;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;
use App\Model\api\Configuration\QuestionModel;

class LeadsPhoneCallModel extends Model
{
	use SoftDeletes;
	use Updater;

	protected $table = 'leads_phone_call';

	public $fillable = [
		'leads_id',
		'contact_name',
		'phone_contact',
		'subject',
		'leads_status_id',
		'observation',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function leads()
	{
		return $this->belongsTo('App\Model\api\LeadsModel');
	}

	public function leadsStatus()
	{
		return $this->belongsTo('App\Model\api\LeadsStatusModel');
	}

	public function setPhoneContactAttribute($value)
	{
		$this->attributes['phone_contact'] = preg_replace('/\D/', '', $value);
	}

	public function getQuestions()
	{
		return QuestionModel::where('flg_source', 'leads_phone_call')->with('alternative')->get();
	}

	public function answers()
	{
		return $this->hasMany('App\Model\api\Configuration\AnswerModel', 'leads_phone_call_id', 'id');
	}
}
