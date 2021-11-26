<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;
use App\Model\api\Prospection\CourseCategoryTypeModel;
use App\Model\api\Prospection\CourseModel;

class CourseCategoryTypeController extends BaseMethodAdminController {

  function __construct() {
		$this->apiModel = CourseCategoryTypeModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/course_category_type',
			'urlAction' => '/admin/course_category_type/save',
			'pathView'  => 'admin.pages.courseCategoryType',
			'pathViewInclude'  => 'admin.pages.courseCategoryType.form',
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
					'url' => '/admin/course_category_type',
					'label' => 'Tipo de Categoria do Cursos',
				],
			],
		];
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Tipos';
		$this->config->contentTitle = 'Lista de Tipos de Categoria do Produtos';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', ],
			[ 'title' => 'Título', 'data' => 'title', ],
			[ 'title' => 'Descrição', 'data' => 'description', ],

			[ 'title' => '', 'className' => 'center', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center', 'btnDel' => $this->config->urlBase ],
		];

		return parent::list($request)
		->with('dataTable', parent::getListEnableDisable((object) [
			'dataTableHeader' => $dataTableHeader,
			'apiModel' => $this->apiModel::query(),
		]));
	}

	public function insert(Request $request) {
		$this->config->title = 'Cadastro de Tipo de Categoria do Produtos';
		$this->config->contentTitle = 'Cadastre todas as informações referente ao Tipo de Categoria do Produtos.';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request);
	}

	public function update(Request $request) {
		$this->config->title = 'Edição de Tipo de Categoria do Produtos';
		$this->config->contentTitle = 'Edite todas as informações referente ao Tipo de Categoria do Produtos.';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		$view = parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),]);

		return $view;
	}

	public function save(Request $request) {
		if (!empty($request->file('fileImage'))) {
			$fileName = formatNameFile($request->file('fileImage')->getClientOriginalName());

			$request->file('fileImage')->move('storage/courseCategoryType', $fileName);
			$request['image'] = $fileName;
		}

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

	public function delete(Request $request, $id) {
		$withInput = [ 'swal' => null ];

		if (CourseModel::where('course_category_type_id', $id)->first()) {
			$withInput['swal'] = [
				'type' => 'warning',
				'title' => 'Não é possível inativar esse tipo de categoria, pois existe produto ativo vinculado a mesma',
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
