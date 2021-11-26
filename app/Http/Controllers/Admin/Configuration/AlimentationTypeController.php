<?php

namespace App\Http\Controllers\Admin\Configuration;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseMethodController;
use App\Model\api\Configuration\AlimentationTypeModel;

class AlimentationTypeController extends BaseMethodController {

	function __construct() {
		$this->apiModel = new AlimentationTypeModel();

		$this->config = (object) [
			'pathView' => 'admin/configuration/alimentationType',
			'urlAction' => 'admin/configuration/alimentationtype',
		];
	}

	public function list(Request $request) {
		$this->config->fileView = 'list';
		$this->config->toView['title_page'] = 'Listar';
		$this->config->toView['url_page_action'] = '';

		$dataTable = new \stdClass();
		$dataTable->data = AlimentationTypeModel::withTrashed()->get();

		$dataTable->header = [
			(object) [
				'label' => 'ID',
				'column' => 'id',
			],
			(object) [
				'label' => 'Descrição pt',
				'column' => 'description_pt',
			],
			(object) [
				'label' => 'Descrição en',
				'column' => 'description_en',
			],
			(object) [
				'label' => 'Descrição es',
				'column' => 'description_es',
			],
		];

		$this->config->toView['dataTable'] = $dataTable;

		return parent::list($request);
	}
}
