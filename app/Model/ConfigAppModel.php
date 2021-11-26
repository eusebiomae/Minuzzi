<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class ConfigAppModel extends Model
{
	use SoftDeletes;
	use Updater;

	protected $table = 'config_app';

	public $fillable = [
		'table',
		'user_id',
		'show_form_fields',
		'show_list_fields',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	public function getShowListFields($table, $idUser = null)
	{
		$arr = $this
			->whereNotNull('show_list_fields')
			->where('table', $table)
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
			$conf = json_decode($arr[$i]->show_list_fields);

			$config = array_merge($config, (array) $conf);
		}

		return $config;
	}

	public function getShowFormFields($table, $idUser, $fields)
	{
		$arr = $this
			->whereNotNull('show_form_fields')
			->where(function ($query) use ($idUser) {
				$query
					->where('user_id', '=', $idUser)
					->orWhereNull('user_id');
			})
			->orderBy('user_id', 'asc')
			->get();

		$length = count($arr);
		$config = [];

		for ($i = 0, $ii = count($fields); $i < $ii; $i++) {
			$config[$fields[$i]] = 1;
		}

		for ($i = 0; $i < $length; $i++) {
			$conf = json_decode($arr[$i]->show_form_fields);

			$config = array_merge($config, (array) $conf);
		}

		return $length ? (object) $config : null;
	}
}
