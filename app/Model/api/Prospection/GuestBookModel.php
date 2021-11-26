<?php

namespace App\Model\api\Prospection;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Traits\Updater;

class GuestBookModel extends Model
{
	use SoftDeletes;
	use Updater;

	protected $table = 'guest_book';

	public $fillable = [

		'leads_id',
		'leads_visit_id',
		'guest_book_id',
		'question1',
		'question2',
		'question3',
		'question4',
		'question5',
		'question6',
		'question7',
		'question8',
		'question9',
		'question10',
		'alternative1',
		'alternative2',
		'alternative3',
		'alternative4',
		'alternative5',
		'observation',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function leads()
	{
		return $this->belongsTo('App\Model\api\Prospection\LeadsModel');
	}

	public function leadsVisit()
	{
		return $this->belongsTo('App\Model\api\Prospection\LeadsVisitModel');
	}

	public function guestBook()
	{
		return $this->belongsTo('App\Model\api\Prospection\GuestBookModel', 'id', 'guest_book_id');
	}

	public function answers()
	{
		return $this->hasMany('App\Model\api\Configuration\AnswerModel', 'guest_book_id', 'id');
	}
}
