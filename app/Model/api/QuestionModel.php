<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class QuestionModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'question';

	public $fillable = [
		'title',
		'description',
		'category_id',
		'flg_type',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
	protected $appends = [ 'type' ];

	public function alternative()
	{
		return $this->hasMany('App\Model\api\Configuration\AlternativeModel', 'question_id', 'id');
	}
	public function category() {
		return $this->belongsTo('App\Model\api\Prospection\CourseCategoryModel');
	}
	public function getTypeAttribute(){
		return QuestionModel::getType($this->attributes['flg_type']);
	}
	static public function getType($flg_type){
		switch ($flg_type) {
			case '1':
				return 'Textual';
				break;
			case '2':
				return 'Multipla Escolha (Apenas uma ops.)';
				break;
			case '3':
				return 'Multipla Escolha (Várias ops.)';
				break;
			case '4':
				return 'Dicotómica (Sim/Não)';
				break;
		}
	}
}
