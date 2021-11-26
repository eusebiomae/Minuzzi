<?php

namespace App\Http\Controllers\Admin\Configuration;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodController;
use App\Model\api\Configuration\BankModel;

class BankController extends BaseMethodController {
	function __construct() {
		$this->apiModel = new BankModel();

		$this->config = (object) [
			'pathView' => 'admin/configuration/bank',
			'urlAction' => 'admin/configuration/bank',
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		return $list;
	}

	public function list(Request $request) {
		$this->config->fileView = 'list';
		$this->config->toView['title_page'] = 'Listar';
		$this->config->toView['url_page_action'] = '';

		$dataTable = new \stdClass();
		$dataTable->data = BankModel::withTrashed()->get();

		$dataTable->header = [
			(object) [
				'label' => 'ID',
				'column' => 'id',
			],
			(object) [
				'label' => 'Nome',
				'column' => 'name',
			],
			(object) [
				'label' => 'Código',
				'column' => 'code',
			],
		];

		$this->config->toView['dataTable'] = $dataTable;

		return parent::list($request);
	}

	function insert(Request $request) {
		$this->config->fileView = 'form';
		$this->config->toView['title_page'] = 'Inserir';
		$this->config->toView['url_page_action'] = '/insert';
		$this->config->toView['title'] = 'Cadastro de Banco';
		$this->config->toView['subtitle'] = 'Edite todas as informações referente a Banco.';

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		$this->config->fileView = 'form';
		$this->config->toView['title_page'] = 'Editar';
		$this->config->toView['url_page_action'] = '/update';
		$this->config->toView['title'] = 'Edição de dados do Bancos';
		$this->config->toView['subtitle'] = 'Edite todas as informações referente a Banco.';

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
