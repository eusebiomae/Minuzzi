<?php
namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class ThesesMonographModel extends Model {
	use SoftDeletes;
	use Updater;

	protected $table = 'theses_monograph';

	public $fillable = [
		'course_category_id',
		'author',
		'title',
		'description',
		'file',
		'year',
		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = [ 'deleted_at' ];
}
