<?php

namespace App\Http\Controllers\Admin\Configuration;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseMethodController;
use App\Model\api\Configuration\AlimentationCategoryModel;

class AlimentationCategoryController extends BaseMethodController {

	function __construct() {
		$this->apiModel = new AlimentationCategoryModel();

		$this->config = (object) [
			'pathView' => 'admin/configuration/alimentationCategory',
			'urlAction' => 'admin/configuration/alimentationcategory',
		];
	}

	public function list(Request $request) {
		$this->config->fileView = 'list';
		$this->config->toView['title_page'] = 'Listar';
		$this->config->toView['url_page_action'] = '';

		$dataTable = new \stdClass();
		$dataTable->data = AlimentationCategoryModel::withTrashed()->get();

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

	public function insert(Request $request) {

		return parent::insert($request)
		->with('listSelectBox', new \stdClass());
	}

	public function update(Request $request) {
		$view = parent::update($request);

		return $view
			->with('listSelectBox', new \stdClass());
	}
}
