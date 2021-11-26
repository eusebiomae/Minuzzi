<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;
use App\Model\api\FileContentCourseModel;
use App\Model\api\Prospection\ContentCourseModel;
use App\Model\api\Prospection\FileModel;

use File;

class FileController extends BaseMethodAdminController {

  function __construct() {
		$this->pathFile = 'storage/file';
		$this->apiModel = FileModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/file',
			'urlAction' => '/admin/file/save',
			'pathView'  => 'admin.pages.file',
			'pathViewInclude'  => 'admin.pages.file.form',
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
					'url' => '/admin/file',
					'label' => 'Arquivos',
				],
			],
		];
	}

	private function getListSelectBox() {
		$list = (object) [];
		$list->contentCourse = ContentCourseModel::all();

		return $list;
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Arquivos';
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
		->with('payload', ['data' => $this->apiModel::with([ 'fileContentCourse' ])->find($request->id),])
		->with('listSelectBox', $this->getListSelectBox());

		return $view;
	}
	public function save(Request $request) {
		$request->paramsConfig = [
			'redirectBack' => false,
		];

		if (!empty($request->file('fileImage'))) {
			$request['extension'] = $request->file('fileImage')->getClientOriginalExtension();

			if (empty($request->name)) {
				$request['name'] = preg_replace("/\.{$request['extension']}$/", '', $request->file('fileImage')->getClientOriginalName());
			}

			$fileName = formatNameFile($request['name']) . '.' . $request['extension'];

			$request->file('fileImage')->move($this->pathFile, $fileName);
			$request['link'] = $fileName;
		}

		$saveData = parent::save($request);

		$saveData->contentCourse()->sync($request->contentCourse);

		return redirect($this->config->urlBase);
	}

}
