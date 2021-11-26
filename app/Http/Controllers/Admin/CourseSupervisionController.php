<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodController;
use App\Model\api\CourseSupervisionCoursesModel;
use App\Model\api\CourseSupervisionModel;
use App\Model\api\Prospection\CourseModel;
use App\Model\api\TeamModel;

class CourseSupervisionController extends BaseMethodController {
	function __construct() {
		$this->apiModel = new CourseSupervisionModel();

		$this->config = (object) [
			'pathView' => 'admin/courseSupervision',
			'urlAction' => 'admin/course_supervision',
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->course = CourseModel::orderBy('title_pt')->get();
		$list->teacher = TeamModel::orderBy('name')->get();

		return $list;
	}

	public function list(Request $request) {
		$this->config->fileView = 'list';
		$this->config->toView['title_page'] = 'Listar';
		$this->config->toView['url_page_action'] = '';

		$dataTable = new \stdClass();
		$dataTable->data = CourseSupervisionModel::withTrashed()->get();

		$dataTable->header = [
			(object) [
				'label' => 'ID',
				'column' => 'id',
			],
			(object) [
				'label' => 'Data',
				'column' => 'date',
			],
			(object) [
				'label' => 'Ex-alunos do CETCC',
				'column' => 'value_1',
				'classColumn' => 'mask-money',
			],
			(object) [
				'label' => 'Avulsos',
				'column' => 'value_2',
				'classColumn' => 'mask-money',
			],
		];

		$this->config->toView['dataTable'] = $dataTable;

		return parent::list($request);
	}

	function insert(Request $request) {
		$this->config->fileView = 'form';
		$this->config->toView['title_page'] = 'Editar';
		$this->config->toView['url_page_action'] = '/insert';
		$this->config->toView['title'] = 'Cadastro de Supervisões';
		$this->config->toView['subtitle'] = 'Edite todas as informações referente a supervisão em um único lugar.';

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		$this->config->fileView = 'form';
		$this->config->toView['title_page'] = 'Editar';
		$this->config->toView['url_page_action'] = '/update';
		$this->config->toView['title'] = 'Cadastro de Supervisões';
		$this->config->toView['subtitle'] = 'Edite todas as informações referente a supervisão em um único lugar.';

		$view = parent::update($request)
		->with('listSelectBox', $this->getListSelectBox());

		$courseIds = CourseSupervisionCoursesModel::where('course_supervision_id', $view->data['id'])->get();

		$view->data['course_id'] = [];

		foreach ($courseIds as &$courseId) {
			$view->data['course_id'][] = $courseId->course_id;
		}

		$view->data['value_1'] = number_format($view->data['value_1'], 2, '.', '');
		$view->data['value_2'] = number_format($view->data['value_2'], 2, '.', '');

		return $view;
	}

	function save(Request $request) {
		$request->paramsConfig = [
			'redirectBack' => false,
		];

		$save = parent::save($request);

		$save->data->course()->sync($request->get('course_id'));

		if ($save->action === 'I') {
			return redirect("/{$this->config->urlAction}/update/{$save->data->id}");
		} else {
			return redirect()->back();
		}
	}
}
