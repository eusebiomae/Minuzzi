<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class ParametersAppModel extends Model
{
	use SoftDeletes;
	use Updater;

	protected $table = 'parameters_app';

	public $fillable = [
		'user_id',
		'payload',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	/**
	 * payload => {
	 * 	valueOfMeta: 0 (Qtd) | 1 (Currency)
	 * }
	 */

	public function get($idUser = null)
	{
		$arr = $this
			->where(function ($query) use ($idUser) {
				$query
					->where('user_id', '=', $idUser)
					->orWhereNull('user_id');
			})
			->orderBy('user_id', 'asc')
			->get();

		$length = count($arr);
		$config = [];

		for ($i = 0; $i < $length; $i++) {
			$conf = json_decode($arr[$i]->payload);

			$config = array_merge($config, (array) $conf);
		}

		return (object) $config;
	}
}
