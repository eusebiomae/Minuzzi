<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use App\Model\api\AdditionalModel;
use App\Model\api\CourseAdditionalModel;
use Illuminate\Http\Request;

class AdditionalController extends BaseMethodAdminController {
	function __construct() {
		$this->apiModel = AdditionalModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/additional',
			'urlAction' => '/admin/additional/save',
			'pathView'  => 'admin.pages.additional',
			'pathViewInclude'  => 'admin.pages.additional.form',
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
					'url' => '/admin/additional',
					'label' => 'Adicionais',
				],
			],
		];
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Adicionais';
		$this->config->contentTitle = 'Lista de Adicionais';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Adicional', 'data' => 'title', ],

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
		$this->config->title = 'Inserir Adicional';
		$this->config->contentTitle = 'Criar novo Adicional';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request);
	}

	function update(Request $request) {
		$this->config->title = 'Editar Adicional';
		$this->config->contentTitle = 'Alterar Adicional';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		$view = parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),]);

		return $view;
	}

}
