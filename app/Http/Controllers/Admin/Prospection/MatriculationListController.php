<?php

namespace App\Http\Controllers\System\Prospection;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseMethodSystemController;

use App\Model\api\StudentModel;

class MatriculationListController extends BaseMethodSystemController {

	function __construct() {
		$this->apiModel = new StudentModel();

		$this->config = (object) [
			'pathView' => 'system/prospection/',
			'urlAction' => 'prospection/dashboard',
			'toView' => [
				'header' => 'layouts.header',
				'group_page' => 'Prospecção',
				'url_group' => 'prospection',
				'module_page' => 'Dashboard',
				'url_page' => 'prospection/dashboard',
			],
		];
	}

	public function list(Request $request) {
		$this->config->fileView = 'matriculationList';
		$this->config->toView['title_page'] = 'Lista de Matrícula';

		$dataTable = new \stdClass();
		$dataTable->data = $this->apiModel->get();

		$dataTable->header = [
			(object) [
				'label' => 'ID',
				'column' => 'id',
			],
			(object) [
				'label' => 'Nome',
				'column' => 'initials',
			],
			(object) [
				'label' => 'Ano/Série',
				'column' => 'description_pt',
			],
			(object) [
				'label' => 'Turma',
				'column' => 'description_en',
			],
			(object) [
				'label' => 'Telefone',
				'column' => 'description_es',
			],
			(object) [
				'label' => 'Celular',
				'column' => 'description_es',
			],
			(object) [
				'label' => 'E-mail',
				'column' => 'description_es',
			],
		];

		$this->config->toView['dataTable'] = $dataTable;

		return parent::list($request);
	}

}
