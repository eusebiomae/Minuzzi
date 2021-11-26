<?php

namespace App\Model\api\RoutineManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class ActivitiesGoalPCXModel extends Model
{
	use Updater;
	use SoftDeletes;

	protected $table = 'activities_goal_pcx';

	public $fillable = [
		'description',
		'created_by',
		'updated_by',
		'deleted_by',
	];

}
