<?php

namespace App\Http\Controllers\Admin\Financial;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodController;
use App\Model\api\Configuration\BankModel;
use App\Model\api\Financial\BankAccountModel;
use App\Model\api\Financial\BankAccountTypeModel;

class BankAccountController extends BaseMethodController {
	function __construct() {
		$this->apiModel = new BankAccountModel();

		$this->config = (object) [
			'pathView' => 'admin/bank_account',
			'urlAction' => 'admin/bank_account',
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->bank = BankModel::orderBy('name')->get();
		$list->bank_account_type = BankAccountTypeModel::orderBy('name')->get();

		return $list;
	}

	public function list(Request $request) {
		$this->config->fileView = 'list';
		$this->config->toView['title_page'] = 'Listar';
		$this->config->toView['url_page_action'] = '';

		$dataTable = new \stdClass();
		$dataTable->data = BankAccountModel::withTrashed()->get();

		$dataTable->header = [
			(object) [
				'label' => 'ID',
				'column' => 'id',
			],
			(object) [
				'label' => 'Descrição',
				'column' => 'description',
			],
			(object) [
				'label' => 'Nome do Titular ou Razão social',
				'column' => 'name',
			],
			(object) [
				'label' => 'Banco',
				'column' => 'bank.name',
			],
			(object) [
				'label' => 'Tipo de Conta',
				'column' => 'bank_account_type.name',
			],
		];

		$this->config->toView['dataTable'] = $dataTable;

		return parent::list($request);
	}

	function insert(Request $request) {
		$this->config->fileView = 'form';
		$this->config->toView['title_page'] = 'Inserir';
		$this->config->toView['url_page_action'] = '/insert';
		$this->config->toView['title'] = 'Cadastro de Conta Bancária';
		$this->config->toView['subtitle'] = 'Edite todas as informações referente a Conta Bancária em um único lugar.';

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		$this->config->fileView = 'form';
		$this->config->toView['title_page'] = 'Editar';
		$this->config->toView['url_page_action'] = '/update';
		$this->config->toView['title'] = 'Alteração de Conta Bancária';
		$this->config->toView['subtitle'] = 'Edite todas as informações referente a Conta Bancária em um único lugar.';

		$view = parent::update($request)
		->with('listSelectBox', $this->getListSelectBox());

		return $view;
	}

	function save(Request $request) {
		$request->paramsConfig = [
			'redirectBack' => false,
		];

		$save = parent::save($request);

		if ($save->action === 'I') {
			return redirect("/{$this->config->urlAction}/update/{$save->data->id}");
		} else {
			return redirect()->back();
		}
	}
}
