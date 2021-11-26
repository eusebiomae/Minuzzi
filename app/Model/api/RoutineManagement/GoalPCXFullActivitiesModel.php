<?php

namespace App\Model\api\RoutineManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Traits\Updater;

class GoalPCXFullActivitiesModel extends Model
{
	use Updater;
	use SoftDeletes;

	protected $table = 'goal_pcx_full_activities';

	public $fillable = [
		'goal_pcx_id',
		'activities_goal_pcx_id',
		'executed',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	public function getGoalPCXFull($goalPcxId)
	{
		return DB::select("SELECT
			gpfa.id,
			gpfa.activities_goal_pcx_id AS 'fk',
			gpfa.executed,
			agp.description
		FROM goal_pcx_full_activities gpfa
		INNER JOIN activities_goal_pcx agp ON agp.id = gpfa.activities_goal_pcx_id
		WHERE gpfa.deleted_at IS NULL AND gpfa.goal_pcx_id = {$goalPcxId}");
	}
}
