<?php

namespace App\Model\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Updater;

class ContractModel extends Model {
  use SoftDeletes;
  use Updater;

  protected $table = 'contract';

  public $fillable = [
		'title',
		'content',
		'status',

		'created_by',
		'updated_by',
		'deleted_by',
	];

	protected $dates = ['deleted_at'];

	protected $appends = [ 'statusData' ];

	public function getStatusDataAttribute() {
		if (isset($this->attributes['status'])) {
			foreach (ContractModel::getStatusList() as $status) {
				if ($this->attributes['status'] == $status['flg']) {
					return (object) $status;
				}
			}
		}

		return null;
	}

	public static function getStatusList() {
		return [
			[
				'flg' => 'draft',
				'label' => 'Rascunho',
				'ico' => 'fa fa-file-text fa-2x',
				'color' => '#428fd0',
			],
			[
				'flg' => 'current',
				'label' => 'Vigente',
				'ico' => 'fa fa-check-circle fa-2x',
				'color' => '#40aa58',
			],
			[
				'flg' => 'inactive',
				'label' => 'Inativo',
				'ico' => 'fa fa-times-circle fa-2x',
				'color' => 'red',
			],
		];
	}
}
