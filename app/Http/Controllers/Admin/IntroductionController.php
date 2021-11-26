<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;

use App\Model\api\Financial\IntroductionModel;
use App\Model\api\FormPaymentModel;

class IntroductionController extends BaseMethodAdminController {
	function __construct() {
		$this->apiModel = IntroductionModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/introduction',
			'urlAction' => '/admin/introduction/save',
			'pathView'  => 'admin.pages.introduction',
			'pathViewInclude'  => 'admin.pages.introduction.form',
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
					'url' => '/admin/introduction',
					'label' => 'Frases',
				],
			],
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->form_payment = FormPaymentModel::orderBy('description')->get();

		return $list;
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Instruções';
		$this->config->contentTitle = 'Lista de instruções';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Name', 'data' => 'title', ],
			[ 'title' => 'Forma de Pagamento', 'data' => 'form_payment.description', ],

			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnDel' => $this->config->urlBase ],
		];

		return parent::list($request)
		->with('dataTable', parent::getListEnableDisable((object) [
			'dataTableHeader' => $dataTableHeader,
			'apiModel' => $this->apiModel::query()->with([
				'formPayment',
			]),
		]));
	}

	function insert(Request $request) {
		$this->config->title = 'Cadastro de Instrução';
		$this->config->contentTitle = 'Edite todas as informações referente a Instrução em um único lugar.';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		$this->config->title = 'Cadastro de Instrução';
		$this->config->contentTitle = 'Edite todas as informações referente a Instrução em um único lugar.';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		$view = parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),])
		->with('listSelectBox', $this->getListSelectBox());

		return $view;
	}
}
