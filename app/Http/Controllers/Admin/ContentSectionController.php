<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodAdminController;
use App\Model\api\ContentSectionModel;

use App\Model\api\ContentPageModel;

class ContentSectionController extends BaseMethodAdminController {

	function __construct() {
		$this->apiModel = ContentSectionModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/contentsection',
			'urlAction' => '/admin/contentsection/save',
			'pathView'  => 'admin.pages.contentSection',
			'pathViewInclude'  => 'admin.pages.contentSection.form',
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
					'url' => '/admin/contentsection',
					'label' => 'Página',
				],
			],
		];
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Seção de Página';
		$this->config->contentTitle = 'Lista de seção de páginas';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'width' => '10px','data' => 'id', ],
			[ 'title' => 'Página', 'width' => '20%','data' => 'content_page.description_pt', ],
			[ 'title' => 'Descrição', 'data' => 'description_pt', ],
			[ 'title' => 'Ordem', 'width' => '10px', 'data' => 'component_order', ],


			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center', 'width' => '10px','btnDel' => $this->config->urlBase ],
		];

		return parent::list($request)
		->with('dataTable', parent::getListEnableDisable((object) [
			'dataTableHeader' => $dataTableHeader,
			'apiModel' => $this->apiModel::query()->with([
				'contentPage',
			]),
		]));
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->contentPage = (new ContentPageModel())->get();

		return $list;
	}

	function insert(Request $request) {
		$this->config->title = 'Inserir Seção de Página';
		$this->config->contentTitle = 'Criar nova seção de páginas';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		$this->config->title = 'Editar Seção de Página';
		$this->config->contentTitle = 'Alterar seção de páginas';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		return parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),])
		->with('listSelectBox', $this->getListSelectBox());
	}

}
