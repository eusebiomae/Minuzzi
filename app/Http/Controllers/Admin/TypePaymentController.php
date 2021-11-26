<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;
use App\Model\api\TypePaymentModel;

class TypePaymentController extends BaseMethodAdminController {
	function __construct() {
		$this->apiModel = TypePaymentModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/type_payment',
			'urlAction' => '/admin/type_payment/save',
			'pathView'  => 'admin.pages.type_payment',
			'pathViewInclude'  => 'admin.pages.type_payment.form',
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
					'url' => '/admin/type_payment',
					'label' => 'Tipo de Pagamento',
				],
			],
		];
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Frases';
		$this->config->contentTitle = 'Lista de frases da área do aluno';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Tipo de pagamento', 'data' => 'description', ],

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
		$this->config->title = 'Inserir Tipo de pagamento';
		$this->config->contentTitle = 'Cadastro de Tipo de pagamento';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request);
	}

	function update(Request $request) {
		$this->config->title = 'Edição de Tipo de pagamento';
		$this->config->contentTitle = 'Alterar Tipo de pagamento';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		$view = parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),]);

		return $view;
	}
}
