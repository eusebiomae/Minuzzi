<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;
use App\Model\api\Configuration\GraduationModel;

class GraduationController extends BaseMethodAdminController {

	function __construct() {
		$this->apiModel = GraduationModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/graduation',
			'urlAction' => '/admin/graduation/save',
			'pathView'  => 'admin.pages.graduation',
			'pathViewInclude'  => 'admin.pages.graduation.form',
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
					'url' => '/admin/graduation',
					'label' => 'Frases',
				],
			],
		];
	}
	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Graduações';
		$this->config->contentTitle = 'Lista de Graduações';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Descrição pt', 'data' => 'description_pt', ],
			[ 'title' => 'Descrição en', 'data' => 'description_en', ],
			[ 'title' => 'Descrição es', 'data' => 'description_es', ],

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
		$this->config->title = 'Inserir Graduação';
		$this->config->contentTitle = 'Criar nova Graduações';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request);
	}

	function update(Request $request) {
		$this->config->title = 'Editar Graduação';
		$this->config->contentTitle = 'Alterar Graduação';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		$view = parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),]);

		return $view;
	}
}
