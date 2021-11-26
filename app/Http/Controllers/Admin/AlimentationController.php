<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodController;
use App\Model\api\AlimentationModel;

use App\Model\api\Configuration\AlimentationTypeModel;
use App\Model\api\Configuration\AlimentationCategoryModel;
use App\Model\api\Configuration\WeekdayModel;

class AlimentationController extends BaseMethodController {

	function __construct() {
		$this->apiModel = new AlimentationModel();

		$this->config = (object) [
			'pathView' => 'admin/alimentation',
			'urlAction' => 'admin/alimentation',
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->alimentationType = AlimentationTypeModel::all();
		$list->alimentationCategory = AlimentationCategoryModel::all();
		$list->weekday = WeekdayModel::all();

		return $list;
	}

	public function list(Request $request) {
		$this->config->fileView = 'list';
		$this->config->toView['title_page'] = 'Listar';
		$this->config->toView['url_page_action'] = '';

		$dataTable = new \stdClass();
		$dataTable->data = AlimentationModel::withTrashed()
		->with('alimentationType')
		->with('alimentationCategory')
		->get();

		$dataTable->header = [
			(object) [
				'label' => 'ID',
				'column' => 'id',
			],
			(object) [
				'label' => 'Tipo',
				'column' => 'alimentation_type.description_pt',
			],
			(object) [
				'label' => 'Categoria',
				'column' => 'alimentation_category.description_pt',
			],
			(object) [
				'label' => 'Alimento',
				'column' => 'description_pt',
			],
			(object) [
				'label' => 'Dia',
				'column' => 'day_suffix',
			],
		];

		$this->config->toView['dataTable'] = $dataTable;

		return parent::list($request);
	}

	function insert(Request $request) {
		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		return parent::update($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

}
