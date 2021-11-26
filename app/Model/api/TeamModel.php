<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class TeamModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'team';

	public $fillable = [
		'name',
		'description_pt',
		'description_en',
		'description_es',
		'image',
		'label_image_pt',
		'label_image_en',
		'label_image_es',
		'school_information_id',
		'graduation_id',
		'function_id',
		'office_id',
		'english_level_id',
		'crp',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function getImageAttribute() {
		return "/storage/team/{$this->attributes['image']}";
	}

	public function graduation()
	{
		return $this->belongsTo('\App\Model\api\Configuration\GraduationModel');
	}

	public function function()
	{
		return $this->belongsTo('\App\Model\api\Configuration\FunctionModel');
	}

	public function office()
	{
		return $this->belongsTo('\App\Model\api\Configuration\OfficeModel');
	}

	public function classTeacher() {
		return $this->hasMany('\App\Model\api\ClassTeacherModel', 'team_id', 'id');
	}
}
