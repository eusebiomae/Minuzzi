<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;
use App\Model\api\Configuration\BlogCategoryModel;
use App\Model\api\Prospection\CourseCategoryModel;

class BlogCategoryController extends BaseMethodAdminController  {
	function __construct() {
		$this->apiModel = BlogCategoryModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/blog/category',
			'urlAction' => '/admin/blog/category/save',
			'pathView'  => 'admin.pages.blogCategory',
			'pathViewInclude'  => 'admin.pages.blogCategory.form',
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
					'url' => '/admin/blog/category',
					'label' => 'Categoria Blog',
				],
			],
		];
	}

	private function getListSelectBox()
	{
		$list = (object) [];

		$list->courseCategory = CourseCategoryModel::orderBy('description_pt')->get();

		return $list;
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Categorias Blog';
		$this->config->contentTitle = 'Lista de  Categorias Blog';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Tipo', 'data' => 'label_flg_type', ],
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
		$this->config->title = 'Inserir Categoria Blog';
		$this->config->contentTitle = 'Criar nova Categoria Blog';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	public function update(Request $request) {
		$this->config->title = 'Editar Categoria Blog';
		$this->config->contentTitle = 'Alterar Categoria Blog';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];
		$this->config->toView['listSelectBox'] = $this->getListSelectBox();

		$view = parent::update($request)
		->with('payload', ['data' => $this->apiModel::with([
			'correspondingCourseCategory' => function($query) {
				$query->select('blog_category_id', 'course_category_id');
			}
		])->find($request->id),])
		->with('listSelectBox', $this->getListSelectBox());


		return $view;
	}

	function save(Request $request) {
		$request->paramsConfig = [
			'redirectBack' => false,
		];

		$saveData = parent::save($request);

		$saveData->courseCategory()->sync($request->get('correspondingCourseCategory'));

		return redirect($this->config->urlBase);

	}
}
