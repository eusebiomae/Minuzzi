<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;
use App\Model\api\ContentPageModel;
use App\Model\api\TypeFileModel;
use App\Model\api\FileSiteModel;

use File;

class FileSiteController extends BaseMethodAdminController {

  function __construct() {
		$this->pathFile = 'storage/fileSite';
		$this->apiModel = FileSiteModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/file_site',
			'urlAction' => '/admin/file_site/save',
			'pathView'  => 'admin.pages.file_site',
			'pathViewInclude'  => 'admin.pages.file_site.form',
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
					'url' => '/admin/file_site',
					'label' => 'Arquivos',
				],
			],
		];
	}

	private function getListSelectBox() {
		$list = (object) [];
		$list->typeFile = TypeFileModel::all();
		$list->contentPage = ContentPageModel::all();

		return $list;
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Arquivos Download Site';
		$this->config->contentTitle = 'Lista de Arquivos';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Titulo', 'data' => 'title', ],
			[ 'title' => 'Nome arquivo', 'data' => 'name', ],

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
		$this->config->title = 'Inserir Arquivo';
		$this->config->contentTitle = 'Criar nova Arquivo';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		$this->config->title = 'Editar Arquivo';
		$this->config->contentTitle = 'Alterar Arquivo';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		$view = parent::update($request)
		->with('payload', ['data' => $this->apiModel::with([ 'contentPage'])->find($request->id),])
		->with('listSelectBox', $this->getListSelectBox());

		return $view;
	}
	public function save(Request $request) {
		$request->paramsConfig = [
			'redirectBack' => false,
		];

		if (!empty($request->file('fileDoc') )) {
			$request['extension'] = $request->file('fileDoc')->getClientOriginalExtension();

			if (empty($request->name)) {
				$request['name'] = preg_replace("/\.{$request['extension']}$/", '', $request->file('fileDoc')->getClientOriginalName());
			}

			$fileName = formatNameFile($request['name']) . '.' . $request['extension'];

			$request->file('fileDoc')->move($this->pathFile . '/doc', $fileName);
			$request['link'] = $fileName;
		}

		if (!empty($request->file('fileImage') )) {
			$fileName = formatNameFile($request->file('fileImage')->getClientOriginalName());
			$request->file('fileImage')->move($this->pathFile . '/img', $fileName);
			$request['img'] = $fileName;
		}

		$saveData = parent::save($request);

		$saveData->contentPage()->sync($request->contentPage);

		return redirect($this->config->urlBase);
	}

}
