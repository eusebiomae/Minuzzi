<?php

namespace App\Model\api\RoutineManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

use App\Traits\Updater;

class GoalPCXFullPcxModel extends Model
{
	use Updater;
	use SoftDeletes;

	protected $table = 'goal_pcx_full_pcx';

	public $fillable = [
		'goal_pcx_id',
		'pcx_id',
		'executed',
		'created_by',
		'updated_by',
		'deleted_by',
	];


	public function getGoalPCXFull($goalPcxId)
	{
		return DB::select("SELECT
			gpfp.id,
			gpfp.pcx_id AS 'fk',
			gpfp.executed,
			leads.student_name AS full_name,
			IFNULL(leads.whatsapp, leads.phone) AS phone_contact,
			leads.flg_type
		FROM goal_pcx_full_pcx AS gpfp
		INNER JOIN leads ON leads.id = gpfp.pcx_id
		WHERE gpfp.deleted_at IS NULL AND gpfp.goal_pcx_id = {$goalPcxId}");
	}
}
