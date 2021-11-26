<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;

use App\Model\api\Prospection\ContentCourseModel;
use App\Model\api\Prospection\CourseCategoryModel;

use File;

class ContentCourseController extends BaseMethodAdminController {

  function __construct() {
		$this->pathFile = 'storage/contentCourse';
		$this->apiModel = new ContentCourseModel();
		$this->config = (object) [
			'urlBase' => '/admin/content_course',
			'urlAction' => '/admin/content_course/save',
			'pathView'  => 'admin.pages.contentCourse',
			'pathViewInclude'  => 'admin.pages.contentCourse.form',
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
					'url' => '/admin/content_course',
					'label' => 'Módulos',
				],
			],
		];
	}

	private function getListSelectBox() {
		$list = (object) [];
		$list->courseCategory = CourseCategoryModel::all();

		return $list;
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Módulos';
		$this->config->contentTitle = 'Lista de Módulos';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Categoria', 'data' => 'course_category.description_pt', ],
			[ 'title' => 'Título', 'data' => 'title_pt', ],

			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnDel' => $this->config->urlBase ],
		];

		return parent::list($request)
		->with('dataTable', parent::getListEnableDisable((object) [
			'dataTableHeader' => $dataTableHeader,
			'apiModel' => $this->apiModel::query()->with([
				'courseCategory',
			]),
		]));
	}

	function insert(Request $request) {
		$this->config->title = 'Inserir';
		$this->config->contentTitle = 'Criar novo Módulo';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}
	function update(Request $request) {
		$this->config->title = 'Ficha de edição do Módulo';
		$this->config->contentTitle = 'Edite todas as informações referente ao Módulo.';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		$view = parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),])
		->with('listSelectBox', $this->getListSelectBox());

		return $view;
	}

	public function save(Request $request) {
		$request->paramsConfig = [
			'redirectBack' => false,
		];

		if (!empty($request->file('fileImage'))) {
			$fileName = formatNameFile($request->file('fileImage')->getClientOriginalName());

			$path = $request->file('fileImage')->move($this->pathFile, $fileName);
			$request['img'] = $fileName;
		}

		$save = parent::save($request);

		if ($save->action === 'I') {
			return redirect("/{$this->config->urlAction}/update/{$save->data->id}");
		} else {
			return redirect()->back();
		}
	}

}
