<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodAdminController;
use App\Model\api\LinkFooterModel;

class LinkFooterController extends BaseMethodAdminController {

	function __construct() {
		$this->apiModel = LinkFooterModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/link_footer',
			'urlAction' => '/admin/link_footer/save',
			'pathView'  => 'admin.pages.linkFooter',
			'pathViewInclude'  => 'admin.pages.linkFooter.form',
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
					'url' => '/admin/link_footer',
					'label' => 'Links Footer',
				],
			],
		];
	}

	private function getListSelectBox() {
		$list = (object) [];
		return $list;
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Links de Rodapé';
		$this->config->contentTitle = 'Lista de links de Rodapé';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'width' => '10px','data' => 'id', ],
			[ 'title' => 'Label', 'data' => 'label', ],
			[ 'title' => 'Link', 'data' => 'url', ],

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
		$this->config->title = 'Inserir Links de Rodapé';
		$this->config->contentTitle = 'Criar novo links de Rodapé';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		$this->config->title = 'Editar Links de Rodapé';
		$this->config->contentTitle = 'Alterar links de Rodapé';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		return parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),])
		->with('listSelectBox', $this->getListSelectBox());
	}

	function view(Request $request) {
		$this->config->title = 'Visualizar Links de Rodapé';
		$this->config->contentTitle = 'Vizualizar links de Rodapé';
		$this->config->breadcrumbs[] = [ 'label' => 'Ver' ];

		return parent::view($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function save(Request $request) {
		return parent::save($request);
	}

}
