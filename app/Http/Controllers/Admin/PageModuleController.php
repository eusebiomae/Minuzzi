<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodAdminController;
use App\Model\api\PageModuleModel;

class PageModuleController extends BaseMethodAdminController {
	function __construct() {
		$this->pageKey = 'pageModule';

		$this->pathFile = 'storage/pageModule';
		$this->apiModel = PageModuleModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/config/page_module',
			'urlAction' => '/admin/config/page_module/save',
			'pathView'  => 'admin.pages.pageModule',
			'pathViewInclude'  => 'admin.pages.pageModule.form',
			'header' => 'admin.layouts.header',
			'breadcrumbs' => [
				[
					'url' => '/admin',
					'label' => 'Home',
				],
				[
					'label' => 'Configurações',
				],
				// [
				// 	'url' => '/admin/config/page_module',
				// 	'label' => 'Módulo de página',
				// ],
			],
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->pageModule = PageModuleModel::query()->get();

		return $list;
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Módulo de página';
		$this->config->contentTitle = 'Lista de Módulos de página';

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Módulo superior', 'data' => 'pageModule.desc', ],
			[ 'title' => 'Módulo de página', 'data' => 'desc', ],

			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnDel' => $this->config->urlBase ],
		];

		return parent::list($request)->with('dataTable', parent::getListEnableDisable((object) [
			'dataTableHeader' => $dataTableHeader,
			'apiModel' => $this->apiModel::query()->with([ 'pageModule' ]),
		]));

	}

	function insert(Request $request) {
		$this->config->title = 'Inserir Módulo de página';
		$this->config->contentTitle = 'Criar Módulo de página';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		$this->config->title = 'Editar Módulo de página';
		$this->config->contentTitle = 'Alterar Módulo de página';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		return parent::update($request)
		->with('listSelectBox', $this->getListSelectBox())
		->with('payload', ['data' => $this->apiModel::find($request->id),]);
	}

}
