<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;

use App\Model\api\FAQModel;

class FaqController extends BaseMethodAdminController {

	function __construct() {
		$this->apiModel = FAQModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/faq',
			'urlAction' => '/admin/faq/save',
			'pathView'  => 'admin.pages.faq',
			'pathViewInclude'  => 'admin.pages.faq.form',
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
					'label' => 'FAQ',
				],
			],
		];
	}


	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar FAQ';
		$this->config->contentTitle = 'Lista de FAQ';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'width' => '10px','data' => 'id', ],
			[ 'title' => 'Questão', 'data' => 'question', ],
			[ 'title' => 'Resposta', 'data' => 'answer', ],

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
		$this->config->title = 'Inserir FAQ';
		$this->config->contentTitle = 'Criar nova FAQ';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request);
	}

	function update(Request $request) {
		$this->config->title = 'Editar FAQ';
		$this->config->contentTitle = 'Criar nova FAQ';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		return parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),]);
	}

	function save(Request $request) {
		return parent::save($request);
	}

}
