<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;

use App\Model\api\Prospection\CourseCategoryModel;
use App\Model\api\Prospection\CourseModel;

class CourseCategoryController extends BaseMethodAdminController {

  function __construct() {
		$this->apiModel = CourseCategoryModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/course_category',
			'urlAction' => '/admin/course_category/save',
			'pathView'  => 'admin.pages.courseCategory',
			'pathViewInclude'  => 'admin.pages.courseCategory.form',
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
					'url' => '/admin/course_category',
					'label' => 'Categoria de Cursos',
				],
			],
		];
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar';
		$this->config->contentTitle = 'Lista de Categoria de Produtos';
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
		$this->config->title = 'Ficha de Categoria de Produtos';
		$this->config->contentTitle = 'Cadastre todas as informações referente a Categoria de Produtos.';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request);
	}

	function update(Request $request) {
		$this->config->title = 'Ficha de edição de Categoria de Produtos';
		$this->config->contentTitle = 'Edite todas as informações referente a Categoria de Produtos.';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		return parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),]);
	}

	public function save(Request $request) {
		$request->paramsConfig = [
			'redirectBack' => false,
		];

		if (!empty($request->file('fileImage'))) {
			$fileName = formatNameFile($request->file('fileImage')->getClientOriginalName());

			$request->file('fileImage')->move('storage/course_category', $fileName);
			$request['image'] = $fileName;
		}

		$save = parent::save($request);

		if ($save->action === 'I') {
			return redirect("/{$this->config->urlAction}/update/{$save->data->id}");
		} else {
			return redirect()->back();
		}
	}

	public function delete(Request $request, $id) {
		$withInput = [ 'swal' => null ];

		if (CourseModel::where('course_category_id', $id)->first()) {
			$withInput['swal'] = [
				'type' => 'warning',
				'title' => 'Não é possível inativar essa categoria, pois existe produto ativo vinculado a mesma',
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
