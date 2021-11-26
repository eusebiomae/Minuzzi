<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

use Illuminate\Support\Facades\DB;

class ResponsibleSellerModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'responsible_seller';

	public $fillable = [
		'user_id',
		'leads_id',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

}
