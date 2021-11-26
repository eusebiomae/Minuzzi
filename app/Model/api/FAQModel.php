<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class FAQModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'faq';

	public $fillable = [
		'question',
		'answer',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
}
