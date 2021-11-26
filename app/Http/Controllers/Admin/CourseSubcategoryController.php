<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;
use App\Model\api\Prospection\CourseModel;
use App\Model\api\Prospection\CourseSubcategoryModel;

class CourseSubcategoryController extends BaseMethodAdminController {

  function __construct() {
		$this->apiModel = CourseSubcategoryModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/course_subcategory',
			'urlAction' => '/admin/course_subcategory/save',
			'pathView'  => 'admin.pages.courseSubcategory',
			'pathViewInclude'  => 'admin.pages.courseSubcategory.form',
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
					'url' => '/admin/course_subcategory',
					'label' => 'Subcategoria de Cursos',
				],
			],
		];
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Subcategoria';
		$this->config->contentTitle = 'Lista de Subcategoria';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Descrição', 'data' => 'description_pt', ],

			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnDel' => $this->config->urlBase ],
		];

		return parent::list($request)
		->with('dataTable', parent::getListEnableDisable((object) [
			'dataTableHeader' => $dataTableHeader,
			'apiModel' => $this->apiModel::query(),
		]));

	}

	function insert(Request $request) {
		$this->config->title = 'Ficha cadastral Subcategoria Produto';
		$this->config->contentTitle = 'Cadastre todas as informações Subcategoria Produto.';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request);
	}

	function update(Request $request) {
		$this->config->title = 'Editar';
		$this->config->contentTitle = 'Alterar todas as informações Subcategoria Produto.';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		$view = parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),]);

		return $view;
	}

	public function delete(Request $request, $id) {
		$withInput = [ 'swal' => null ];

		if (CourseModel::where('course_subcategory_id', $id)->first()) {
			$withInput['swal'] = [
				'type' => 'warning',
				'title' => 'Não é possível inativar essa subcategoria, pois existe produto ativo vinculado a mesma',
				'confirmButtonColor' => '#DD6B55',
			];
		} else {
			$data = $this->apiModel::find($id);

			if ($data) {
				$data->delete();
			}
		}

		return redirect()->back()->withInput($withInput);
	}
}
