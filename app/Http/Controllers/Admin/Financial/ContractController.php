<?php

namespace App\Http\Controllers\Admin\Financial;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodController;
use App\Model\api\ContractModel;

class ContractController extends BaseMethodController {
	function __construct() {
		$this->apiModel = new ContractModel();

		$this->config = (object) [
			'pathView' => 'admin/contract',
			'urlAction' => 'admin/contract',
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->status = ContractModel::getStatusList();

		return $list;
	}

	public function list(Request $request) {
		$this->config->fileView = 'list';
		$this->config->toView['title_page'] = 'Listar';
		$this->config->toView['url_page_action'] = '';

		$dataTable = new \stdClass();
		$dataTable->data = ContractModel::withTrashed()->get();

		$dataTable->header = [
			(object) [
				'label' => 'ID',
				'column' => 'id',
			],
			(object) [
				'label' => 'Título do contrato',
				'column' => 'title',
			],
			(object) [
				'label' => 'Status',
				'column' => 'statusData.label',
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
