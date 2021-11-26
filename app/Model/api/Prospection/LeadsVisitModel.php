<?php

namespace App\Model\api\Prospection;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Traits\Updater;

class LeadsVisitModel extends Model
{
	use SoftDeletes;
	use Updater;

	protected $table = 'leads_visit';

	public $fillable = [
		'leads_id',
		'city_id',
		'course_id',
		'consultant',
		'visit_date',
		'visit_time',
		'subject',
		'observation',
		'location_description',
		'address',
		'number',
		'complement',
		'district',
		'city',
		'state',
		'zip_code',
		'reference',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
	protected $appends = ['visit_datetime'];

	public function leads()
	{
		return $this->belongsTo('App\Model\api\Prospection\LeadsModel');
	}

	// public function city() {
	// 	return $this->belongsTo('App\Model\api\CityModel');
	// }

	public function course()
	{
		return $this->belongsTo('App\Model\api\Prospection\CourseModel');
	}

	public function consultant()
	{
		return $this->belongsTo('App\Model\api\UserModel', 'consultant', 'id');
	}

	public function getVisitDatetimeAttribute()
	{
		return Carbon::parse($this->attributes['visit_date'])->format('d/m/Y') . ' ' . $this->attributes['visit_time'];
	}

	public function setVisitDateAttribute($value)
	{
		$this->attributes['visit_date'] = formatDateEng($value);
	}

	public function getVisitTimeAttribute($value)
	{
		return Carbon::parse($value)->format('h:i:s');
	}

	public function setVisitTimeAttribute($value)
	{
		$this->attributes['visit_time'] = formatDateEng($value);
	}
}
