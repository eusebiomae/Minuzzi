<?php

namespace App\Http\Controllers\Admin\Clinic;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodController;
use App\Model\api\Configuration\StateModel;
use App\Model\api\Clinic\PatientModel;
use App\Model\api\Clinic\PsychologistModel;

class PatientController extends BaseMethodController {
	function __construct() {
		$this->apiModel = new PatientModel();

		$this->config = (object) [
			'pathView' => 'admin/patient',
			'urlAction' => 'admin/patient',
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->psychologist = PsychologistModel::orderBy('name')->get();
		$list->states = StateModel::orderBy('abbreviation')->get();

		return $list;
	}

	public function list(Request $request) {
		$this->config->fileView = 'list';
		$this->config->toView['title_page'] = 'Listar';
		$this->config->toView['url_page_action'] = '';

		$dataTable = new \stdClass();
		$dataTable->data = PatientModel::withTrashed()->get();

		$dataTable->header = [
			(object) [
				'label' => 'ID',
				'column' => 'id',
			],
			(object) [
				'label' => 'Name',
				'column' => 'name',
			],
			(object) [
				'label' => 'Celular',
				'column' => 'phone',
			],
			(object) [
				'label' => 'WhatsApp',
				'column' => 'whatsapp',
			],
			(object) [
				'label' => 'Recomendação',
				'column' => 'recommendation',
			],
			(object) [
				'label' => 'Encaminhado',
				'column' => '',
			],
		];

		$this->config->toView['dataTable'] = $dataTable;

		return parent::list($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function insert(Request $request) {
		$this->config->fileView = 'form';
		$this->config->toView['title_page'] = 'Inserir';
		$this->config->toView['url_page_action'] = '/insert';
		$this->config->toView['title'] = 'Cadastro de Instrução';
		$this->config->toView['subtitle'] = 'Edite todas as informações referente a Instrução em um único lugar.';

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		$this->config->fileView = 'form';
		$this->config->toView['title_page'] = 'Editar';
		$this->config->toView['url_page_action'] = '/update';
		$this->config->toView['title'] = 'Cadastro de Instrução';
		$this->config->toView['subtitle'] = 'Edite todas as informações referente a Instrução em um único lugar.';

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
