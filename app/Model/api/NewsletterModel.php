<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class NewsletterModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'newsletter';

	public $fillable = [
		'name',
		'email',

		'created_by',
		'updated_by',
		'deleted_by',
	];
}
