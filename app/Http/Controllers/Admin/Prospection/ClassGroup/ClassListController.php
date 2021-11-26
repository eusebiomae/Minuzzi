<?php

namespace App\Http\Controllers\Admin\Prospection\ClassGroup;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseMethodController;

use App\Model\api\Configuration\CityModel;
use App\Model\api\Prospection\RegistryModel;
use App\Model\api\Prospection\ClassModel;
use App\Model\api\Prospection\CourseModel;
use App\Model\api\Prospection\CourseCategoryModel;

class ClassListController extends BaseMethodController {

  function __construct() {
		$this->apiModel = new ClassModel();

		$this->config = (object) [
			'pathView' => 'admin/prospection/classGroup',
			'urlAction' => 'admin/prospection/class_list',
			'toView' => [
				'header' => 'layouts.header',
				'group_page' => 'Turma',
				'url_group' => '#',
				'module_page' => 'Lista Alunos',
				'url_page' => 'admin/prospection/class_list',
			],
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->city           = CityModel::all();
		$list->course         = CourseModel::all();
		$list->class          = ClassModel::all();
		$list->courseCategory = CourseCategoryModel::all();

		return $list;
	}

	public function list(Request $request) {
		$this->config->fileView = 'class';
		$this->config->toView['title_page'] = 'Listar';
		$this->config->toView['url_page_action'] = '';

		$listSelectBox = $this->getListSelectBox();

		$view = parent::list($request)
		->with('listSelectBox', $listSelectBox);

		$view->with('data', RegistryModel::with('leads')->get());
		return $view;
	}

	public function insert(Request $request) {
		$this->config->fileView = 'form';
		$this->config->toView['title_page'] = 'Inserir';
		$this->config->toView['url_page_action'] = '/insert';
		$this->config->toView['title'] = 'Ficha cadastral do Aluno';
		$this->config->toView['subtitle'] = 'Cadastre todas as informações referente ao aluno em um único lugar.';

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	public function update(Request $request) {
		$this->config->fileView = 'form';
		$this->config->toView['title_page'] = 'Editar';
		$this->config->toView['url_page_action'] = '/update';
		$this->config->toView['title'] = 'Ficha de edição do Aluno';
		$this->config->toView['subtitle'] = 'Edite todas as informações referente ao aluno em um único lugar.';

		$listSelectBox = $this->getListSelectBox();

		$view = parent::update($request);

		return $view
			->with('listSelectBox', $listSelectBox);
	}
}
