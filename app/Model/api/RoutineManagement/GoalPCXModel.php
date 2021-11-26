<?php

namespace App\Model\api\RoutineManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Traits\Updater;

class GoalPCXModel extends Model
{
	use Updater;
	use SoftDeletes;

	protected $table = 'goal_pcx';

	public $fillable = [
		'flg_type',
		'user_id',
		'date',
		'goal',
		'finished',
		'goal_planned',
		'goal_executed',
		'p_planned',
		'p_executed',
		'c_planned',
		'c_executed',
		'x_planned',
		'x_executed',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	public function setDateAttribute($value)
	{
		$this->attributes['date'] = formatDateEng($value);
	}

	public function getDateAttribute($value)
	{
		return Carbon::parse($value)->format('d/m/Y');
	}

	public function getGoalPlannedAttribute($value)
	{
		return str_replace('.', ',', $value);
	}

	public function getGoalExecutedAttribute($value)
	{
		return str_replace('.', ',', $value);
	}

	public function user() {
		return $this->belongsTo('\App\Model\api\UserModel');
	}
}
