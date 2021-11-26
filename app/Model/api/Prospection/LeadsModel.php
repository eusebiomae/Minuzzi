<?php

namespace App\Model\api\Prospection;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Traits\Updater;

class LeadsModel extends Model
{
	use Updater;
	use SoftDeletes;

	protected $table = 'leads';

	public $fillable = [
		'flg_type',
		'student_name',
		'student_last_name',
		'badge_name',
		'birth_date',
		'gender',
		'cpf',
		'rg',
		'dispatcher_organ',
		'address',
		'number',
		'complement',
		'reference',
		'district',
		'city',
		'state',
		'zip_code',
		'phone',
		'cel_phone',
		'other_contact',
		'email',
		'company_name',
		'office',
		'department',
		'commercial_phone',
		'branch_line',
		'fax',
		'commercial_email',
		'observation',
		'img',
		'is_formed_in_psychology',
		'level_of_interest',
		'whatsapp',
		'course_id',
		'course_category_id',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	public $levelOfInterest = [
		'1' => 'Inicio imédiato',
		'2' => 'Inicio futuro',
		'3' => 'Não sei responder',
	];

	protected $appends = ['full_name'];

	public function course()
	{
		return $this->belongsTo('App\Model\api\Prospection\CourseModel');
	}

	public function courseCategory()
	{
		return $this->belongsTo('App\Model\api\Prospection\CourseCategoryModel');
	}

	public function getFullNameAttribute()
	{
		return $this->attributes['student_name'] . ' ' . $this->attributes['student_last_name'];
	}

	protected $dates = ['deleted_at'];

	// retorna data na tela
	public function getBirthDateAttribute($value)
	{
		return empty($value) ? '' : Carbon::parse($value)->format('d/m/Y');
	}

	public function getIsFormedInPsychologyAttribute($value)
	{
		return $value ? 'Sim' : 'Não';
	}

	public function getLevelOfInterestAttribute($value)
	{
		return isset($value) ? $this->levelOfInterest[$value] : null;
	}

	//insert data
	public function setBirthDateAttribute($value)
	{
		$this->attributes['birth_date'] = formatDateEng($value);
	}

	public function leadsVisit() {
		return $this->hasMany('App\Model\api\Prospection\LeadsVisitModel', 'leads_id');
	}

	public function leadsPhoneCall() {
		return $this->hasMany('App\Model\api\Prospection\LeadsPhoneCallModel', 'leads_id');
	}

	public function seller() {
		return $this->belongsToMany('App\Model\api\UserModel', 'responsible_seller', 'leads_id', 'user_id');
	}
}
