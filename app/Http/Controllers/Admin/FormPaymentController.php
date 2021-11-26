<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;
use App\Model\api\FormPaymentModel;

class FormPaymentController extends BaseMethodAdminController {

	function __construct() {
		$this->apiModel = FormPaymentModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/form_payment',
			'urlAction' => '/admin/form_payment/save',
			'pathView'  => 'admin.pages.form_payment',
			'pathViewInclude'  => 'admin.pages.form_payment.form',
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
					'url' => '/admin/form_payment',
					'label' => 'Forma de Pagamento',
				],
			],
		];
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Formas de pagamentos';
		$this->config->contentTitle = 'Lista de Formas de pagamentos';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Forma de pagamento', 'data' => 'description', ],
			[ 'title' => 'Mostrar no site', 'data' => 'labelFlgWeb', ],

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
		$this->config->title = 'Inserir Forma de pagamento';
		$this->config->contentTitle = 'Criar nova Forma de pagamento';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request);
	}

	function update(Request $request) {
		$this->config->title = 'Editar Forma de pagamento';
		$this->config->contentTitle = 'Alterar Forma de pagamento';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		$view = parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),]);

		return $view;
	}

}
