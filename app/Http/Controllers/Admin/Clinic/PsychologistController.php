<?php

namespace App\Http\Controllers\Admin\Clinic;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodController;
use App\Model\api\Configuration\StateModel;
use App\Model\api\Clinic\PsychologistModel;
use App\Model\api\Clinic\PatientModel;

class PsychologistController extends BaseMethodController {
	function __construct() {
		$this->apiModel = new PsychologistModel();


		$this->config = (object) [
			'pathView' => 'admin/psychologist',
			'urlAction' => 'admin/psychologist',
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->patient = PatientModel::orderBy('name')->get();
		$list->states = StateModel::orderBy('abbreviation')->get();

		return $list;
	}

	public function list(Request $request) {
		$this->config->fileView = 'list';
		$this->config->toView['title_page'] = 'Listar';
		$this->config->toView['url_page_action'] = '';

		$dataTable = new \stdClass();
		$dataTable->data = PsychologistModel::withTrashed()->get();

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
				'label' => 'WhatsApp',
				'column' => 'whatsapp',
			],
			(object) [
				'label' => 'E-mail',
				'column' => 'email',
			],
			(object) [
				'label' => 'Especialidade',
				'column' => 'specialties',
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
		$this->config->toView['title'] = 'Cadastro de Psicólogo';
		$this->config->toView['subtitle'] = 'Edite todas as informações referente a(o) Psicólogo(a) em um único lugar.';

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		$this->config->fileView = 'form';
		$this->config->toView['title_page'] = 'Editar';
		$this->config->toView['url_page_action'] = '/update';
		$this->config->toView['title'] = 'Alteração de Psicólogo';
		$this->config->toView['subtitle'] = 'Edite todas as informações referente a(o) Psicólogo(a) em um único lugar.';

		$view = parent::update($request)
		->with('listSelectBox', $this->getListSelectBox())
		->with('patientHistory', []);

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
