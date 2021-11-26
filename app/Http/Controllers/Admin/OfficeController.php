<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;
use App\Model\api\Configuration\OfficeModel;

class OfficeController extends BaseMethodAdminController {

	function __construct() {
		$this->apiModel = OfficeModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/office',
			'urlAction' => '/admin/office/save',
			'pathView'  => 'admin.pages.office',
			'pathViewInclude'  => 'admin.pages.office.form',
			'header' => 'admin.layouts.header',
			'breadcrumbs' => [
				[
					'url' => '/admin',
					'label' => 'Home',
				],
				[
					'label' => 'Gestão Site',
				],
				[
					'url' => '/admin/office',
					'label' => 'Cargo',
				],
			],
		];
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Cargo';
		$this->config->contentTitle = 'Lista de Cargos';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Descrição pt', 'data' => 'description_pt', ],
			[ 'title' => 'Flg', 'data' => 'flg', ],
			// [ 'title' => 'Descrição es', 'data' => 'description_es', ],

			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnDel' => $this->config->urlBase ],
		];

		return parent::list($request)
		->with('dataTable', parent::getListEnableDisable((object) [
			'dataTableHeader' => $dataTableHeader,
			'apiModel' => $this->apiModel::query(),
		]));
	}

	function insert(Request $request) {
		$this->config->title = 'Inserir Cargo';
		$this->config->contentTitle = 'Criar novo Cargo';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request);
	}

	function update(Request $request) {
		$this->config->title = 'Editar Cargo';
		$this->config->contentTitle = 'Alterar Cargo';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		$view = parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),]);

		return $view;
	}
}
