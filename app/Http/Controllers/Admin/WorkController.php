<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodController;
use App\Model\api\WorkWithUsModel;

use App\Model\api\Configuration\FunctionModel;
use App\Model\api\Configuration\GraduationModel;
use App\Model\api\Configuration\OfficeModel;
use App\Model\api\Configuration\EnglishLevelModel;

class WorkController extends BaseMethodController {

	function __construct() {
		$this->apiModel = new WorkWithUsModel();

		$this->config = (object) [
			'pathView' => 'admin/work',
			'urlAction' => 'admin/work',
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->function = FunctionModel::all();
		$list->graduation = GraduationModel::all();
		$list->office = OfficeModel::all();
		$list->englishLevel = EnglishLevelModel::all();

		return $list;
	}

	public function list(Request $request) {
		$this->config->fileView = 'list';
		$this->config->toView['title_page'] = 'Listar';
		$this->config->toView['url_page_action'] = '';

		$dataTable = new \stdClass();
		$dataTable->data = WorkWithUsModel::withTrashed()->get();

		$dataTable->header = [
			(object) [
				'label' => 'ID',
				'column' => 'id',
			],
			(object) [
				'label' => 'Nome Completo',
				'column' => 'full_name',
			],
			(object) [
				'label' => 'E-mail',
				'column' => 'email1',
			],
			(object) [
				'label' => 'Telefone',
				'column' => 'phone1',
			],
			(object) [
				'label' => 'Celular',
				'column' => 'cell_phone1',
			],
			(object) [
				'label' => 'Função Desejada',
				'column' => 'function_id',
			],
			(object) [
				'label' => 'Cargo Desejado',
				'column' => 'office_id',
			],
			(object) [
				'label' => 'Nível de Inglês',
				'column' => 'english_level_id',
			],
			(object) [
				'label' => 'Formação',
				'column' => 'graduation_id',
			],
			(object) [
				'label' => 'Profissão',
				'column' => 'profession',
			],
		];

		$this->config->toView['dataTable'] = $dataTable;

		return parent::list($request);
	}

	function insert(Request $request) {
		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		return parent::update($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function view(Request $request) {
		return parent::view($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function save(Request $request) {
		if (!empty($request->file('fileCurriculum'))) {
			$fileName = $request->file('fileCurriculum')->getClientOriginalName();

			$path = $request->file('fileCurriculum')->move('storage/work/curriculum', $fileName);
			$request['curriculum'] = $fileName;
		}

		if (!empty($request->file('fileVideo'))) {
			$fileName = $request->file('fileVideo')->getClientOriginalName();

			$path = $request->file('fileVideo')->move('storage/work/video', $fileName);
			$request['video'] = $fileName;
		}

		return parent::save($request);
	}

}
