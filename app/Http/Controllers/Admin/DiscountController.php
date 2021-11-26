<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use App\Model\api\DiscountModel;
use App\Model\api\CourseDiscountModel;
use Illuminate\Http\Request;

class DiscountController extends BaseMethodAdminController {
	function __construct() {
		$this->apiModel = DiscountModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/discount',
			'urlAction' => '/admin/discount/save',
			'pathView'  => 'admin.pages.discount',
			'pathViewInclude'  => 'admin.pages.discount.form',
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
					'url' => '/admin/discount',
					'label' => 'Cupom de Desconto',
				],
			],
		];
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Cupons de Descontos';
		$this->config->contentTitle = 'Lista de Cupons de Descontos';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Adicional', 'data' => 'title', ],
			[ 'title' => 'Validade', 'data' => 'shelf_life', ],
			[ 'title' => 'Código', 'data' => 'code', ],

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
		$this->config->title = 'Cadastro de Cupom de desconto';
		$this->config->contentTitle = 'Inserir todas as informações referente a Cupom de desconto.';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request);
	}

	function update(Request $request) {
		$this->config->title = 'Editar Cupom de desconto';
		$this->config->contentTitle = 'Alterar todas as informações referente a Cupom de desconto.';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		$view = parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),]);

		return $view;
	}
}
