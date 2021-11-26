<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;
use App\Model\api\TypeFileModel;

class TypeFileController extends BaseMethodAdminController {
	function __construct() {
		$this->apiModel = TypeFileModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/type_file',
			'urlAction' => '/admin/type_file/save',
			'pathView'  => 'admin.pages.type_file',
			'pathViewInclude'  => 'admin.pages.type_file.form',
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
					'url' => '/admin/type_file',
					'label' => 'Tipo de Arquivo',
				],
			],
		];
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Tipo de Arquivos';
		$this->config->contentTitle = 'Lista de tipo de arquivos';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Tipo de arquivo', 'data' => 'name', ],

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
		$this->config->title = 'Inserir Tipo de arquivo';
		$this->config->contentTitle = 'Cadastro de Tipo de arquivo';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request);
	}

	function update(Request $request) {
		$this->config->title = 'Edição de Tipo de arquivo';
		$this->config->contentTitle = 'Alterar Tipo de arquivo';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		$view = parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),]);

		return $view;
	}
}
