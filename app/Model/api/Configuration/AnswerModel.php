<?php

namespace App\Model\api\Configuration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class AnswerModel extends Model {
	// use SoftDeletes;
	use Updater;

	protected $table = 'answer';

	public $fillable = [
		'question_id',
		'leads_phone_call_id',
		'guest_book_id',
		'answer',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function question()
	{
		return $this->belongsTo('App\Model\api\Configuration\QuestionModel');
	}

}
