<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class ContactModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'contact';

	public $fillable = [
		'name',
		'company'
		'invoice'
		'product'
		'site',
		'email',
		'phone',
		'description_pt',
		'subject',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
}
