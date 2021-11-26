<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodController;
use App\Model\api\ConstructionModel;

use App\Model\api\SchoolInformationModel;
use App\Model\api\Configuration\ConstructionCategoryModel;

use File;

class ConstructionController extends BaseMethodController {

	function __construct() {
		$this->pathFile = 'storage/construction';
		$this->apiModel = new ConstructionModel();

		$this->config = (object) [
			'pathView' => 'admin/construction',
			'urlAction' => 'admin/construction',
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->schoolInformation = SchoolInformationModel::all();
		$list->constructionCategory = ConstructionCategoryModel::all();

		return $list;
	}

	public function list(Request $request) {
		$this->config->fileView = 'list';
		$this->config->toView['title_page'] = 'Listar';
		$this->config->toView['url_page_action'] = '';

		$dataTable = new \stdClass();
		$dataTable->data = ConstructionModel::withTrashed()->get();

		$dataTable->header = [
			(object) [
				'label' => 'ID',
				'column' => 'id',
			],
			(object) [
				'label' => 'Name',
				'column' => 'name_pt',
			],
			(object) [
				'label' => 'Descrição',
				'column' => 'description_pt',
			],
			(object) [
				'label' => 'Unidade',
				'column' => 'school_information_id',
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

	function save(Request $request) {
		if (!empty($request->file('fileImage'))) {
			$fileName = formatNameFile($request->file('fileImage')->getClientOriginalName());

			$path = $request->file('fileImage')->move($this->pathFile, $fileName);
			$request['image'] = $fileName;
		}

		return parent::save($request);
	}

}
