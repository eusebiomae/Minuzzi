<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class ProductivityContentModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'productivity_content';

	public $fillable = [
		'productivity_id',
		'type',
		'content',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];
}
