<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodAdminController;
use App\Model\api\SlideModel;

use App\Model\api\ContentPageModel;

use File;

class SlideController extends BaseMethodAdminController {

	function __construct() {
		$this->apiModel = SlideModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/slide',
			'urlAction' => '/admin/slide/save',
			'pathView'  => 'admin.pages.slide',
			'pathViewInclude'  => 'admin.pages.slide.form',
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
					'url' => '/admin/slide',
					'label' => 'Banner',
				],
			],
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->contentPage = (new ContentPageModel())->get();

		return $list;
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Slides';
		$this->config->contentTitle = 'Lista de slides';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'width' => '10px','data' => 'id', ],
			[ 'title' => 'Página', 'width' => '20%','data' => 'content_page.description_pt', ],
			[ 'title' => 'Título', 'data' => 'title_pt', ],
			// [ 'title' => 'Tipo', 'data' => 'labelFlgType', ],

			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center', 'width' => '10px','btnDel' => $this->config->urlBase ],
		];

		return parent::list($request)
		->with('dataTable', parent::getListEnableDisable((object) [
			'dataTableHeader' => $dataTableHeader,
			'apiModel' => $this->apiModel::query()
			->with([ 'contentPage' ]),
		]));
	}

	function insert(Request $request) {
		$this->config->title = 'Inserir Slide';
		$this->config->contentTitle = 'Criar novo slide';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request)->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		$this->config->title = 'Editar Slide';
		$this->config->contentTitle = 'Criar novo slide';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		return parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),])
		->with('listSelectBox', $this->getListSelectBox());
	}

	function save(Request $request) {
		if (!empty($request->file('fileImage'))) {
			$fileName = formatNameFile($request->file('fileImage')->getClientOriginalName());

			$request->file('fileImage')->move('storage/slides', $fileName);
			$request['image'] = $fileName;
		}

		return parent::save($request);
	}

}
