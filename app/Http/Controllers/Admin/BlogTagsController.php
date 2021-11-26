<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;
use App\Model\api\Configuration\BlogTagModel;

class BlogTagsController extends BaseMethodAdminController {

	function __construct() {
		$this->apiModel = new BlogTagModel();
		$this->config = (object) [
			'urlBase' => '/admin/blog/tags',
			'urlAction' => '/admin/blog/tags/save',
			'pathView'  => 'admin.pages.blogTags',
			'pathViewInclude'  => 'admin.pages.blogTags.form',
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
					'url' => '/admin/blog/tags',
					'label' => 'Tags Blog',
				],
			],
		];
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Tags Blog';
		$this->config->contentTitle = 'Lista Tags Blog';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Descrição', 'data' => 'description', ],

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
		$this->config->title = 'Inserir Tag Blog';
		$this->config->contentTitle = 'Criar nova Tag Blog';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request);
	}

	function update(Request $request) {
		$this->config->title = 'Editar Tag Blog';
		$this->config->contentTitle = 'Alterar Tag Blog';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		$view = parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),]);

		return $view;
	}

	// public function json(Request $request)
	// {
	// 	return BlogTagModel::select('id', 'description')->orderBy('description')->get();
	// }
}
