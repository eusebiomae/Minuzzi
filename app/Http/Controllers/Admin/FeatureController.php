<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodAdminController;
use App\Model\api\FeatureModel;
use App\Model\api\ContentPageModel;

use File;

class FeatureController extends BaseMethodAdminController {

	function __construct() {
		$this->apiModel = FeatureModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/feature',
			'urlAction' => '/admin/feature/save',
			'pathView'  => 'admin.pages.feature',
			'pathViewInclude'  => 'admin.pages.feature.form',
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
					'url' => '/admin/contentsection',
					'label' => 'Feature',
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
		$this->config->title = 'Listar Feature';
		$this->config->contentTitle = 'Lista de features';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'width' => '10px','data' => 'id', ],
			[ 'title' => 'Página', 'width' => '20%','data' => 'content_page.description_pt', ],
			[ 'title' => 'Icon', 'width' => '20%','data' => 'icon', ],
			[ 'title' => 'Título', 'data' => 'title', ],
			[ 'title' => 'Descrição', 'data' => 'description', ],

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
		$this->config->title = 'Inserir Feature';
		$this->config->contentTitle = 'Criar nova features';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		$this->config->title = 'Editar Feature';
		$this->config->contentTitle = 'Alterar features';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		return parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),])
		->with('listSelectBox', $this->getListSelectBox());
	}

	function save(Request $request) {
		if (!empty($request->file('fileImage'))) {
			$fileName = formatNameFile($request->file('fileImage')->getClientOriginalName());

			$request->file('fileImage')->move('storage/feature', $fileName);
			$request['image'] = $fileName;
		}

		return parent::save($request);
	}

}
