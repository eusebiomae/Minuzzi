<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class LinkFooterModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'link_footer';

	public $fillable = [
		'label',
		'url',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
}
