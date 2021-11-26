<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;

use App\Model\api\TestemonialModel;

use App\Model\api\ContentPageModel;

class TestemonialController extends BaseMethodAdminController {
	function __construct() {
		$this->apiModel = TestemonialModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/testemonial',
			'urlAction' => '/admin/testemonial/save',
			'pathView'  => 'admin.pages.testemonial',
			'pathViewInclude'  => 'admin.pages.testemonial.form',
			'header' => 'admin.layouts.header',
			'breadcrumbs' => [
				[
					'url' => '/admin',
					'label' => 'Home',
				],
				[
					'label' => 'Gestão Depoimentos',
				],
				[
					'url' => '/admin/testemonial',
					'label' => 'Depoimento',
				],
			],
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->contentPage = (new ContentPageModel())->get();

		return $list;
	}

	public function list(Request $request) {

		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Depoimentos';
		$this->config->contentTitle = 'Lista Depoimentos';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'width' => '10px','data' => 'id', ],
			[ 'title' => 'Nome', 'data' => 'name', ],
			[ 'title' => 'Resumo', 'data' => 'abstract_pt', ],
			[ 'title' => 'Status', 'data' => 'status', ],

			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center', 'width' => '10px','btnDel' => $this->config->urlBase ],
		];

		return parent::list($request)
		->with('dataTable', parent::getListEnableDisable((object) [
			'dataTableHeader' => $dataTableHeader,
			'apiModel' => $this->apiModel::query(),
		]));
	}

	function insert(Request $request) {
		$this->config->title = 'Inserir Depoimento';
		$this->config->contentTitle = 'Criar novo Depoimento';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		$this->config->title = 'Editar Depoimento';
		$this->config->contentTitle = 'Editar novo Depoimento';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),])
		->with('listSelectBox', $this->getListSelectBox());
	}

	function save(Request $request) {
		if (!$request->get('status')) {
			$request['status'] = null;
		}

		if (!empty($request->file('fileImage'))) {
			$fileName = formatNameFile($request->file('fileImage')->getClientOriginalName());

			$path = $request->file('fileImage')->move('storage/testemonial', $fileName);
			$request['image'] = $fileName;
		}

		return parent::save($request);
	}

}
