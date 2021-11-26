<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseMethodAdminController;
use App\Model\api\Configuration\CityModel;

class CityController extends BaseMethodAdminController {

	function __construct() {
		$this->apiModel = CityModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/city',
			'urlAction' => '/admin/city/save',
			'pathView'  => 'admin.pages.city',
			'pathViewInclude'  => 'admin.pages.city.form',
			'header' => 'admin.layouts.header',
			'breadcrumbs' => [
				[
					'url' => '/admin',
					'label' => 'Home',
				],
				[
					'label' => 'Gestão Clientes',
				],
				[
					'label' => 'Configurações',
				],
				[
					'url' => '/admin/city',
					'label' => 'Cidade de Atuação',
				],
			],
		];
	}


	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar';
		$this->config->contentTitle = 'Lista de Cidades';

		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Nome', 'data' => 'name', ],

			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnDel' => $this->config->urlBase ],
		];

		$dataTableEnable = new \stdClass();
		$dataTableEnable->data = $this->apiModel::get();
		$dataTableEnable->header = $dataTableHeader;

		$dataTableDisable = new \stdClass();
		$dataTableDisable->data = $this->apiModel::onlyTrashed()->get();
		$dataTableDisable->header = $dataTableHeader;

		return parent::list($request)->with('dataTable', [
			'enable' => $dataTableEnable,
			'disable' => $dataTableDisable,
		]);
	}

	public function insert(Request $request) {
		$this->config->title = 'Inserir';
		$this->config->contentTitle = 'Cadastrar nova Cidade';

		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request);
	}

	public function update(Request $request) {
		$this->config->title = 'Editar';
		$this->config->contentTitle = 'Alterar Cidade';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		return parent::update($request)
		->with('payload', [
			'data' => $this->apiModel::find($request->id),
		]);
	}
}
