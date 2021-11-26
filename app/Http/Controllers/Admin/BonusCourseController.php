<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;

use App\Model\api\Prospection\BonusCourseModel;
use File;

class BonusCourseController extends BaseMethodAdminController {

  function __construct() {
		$this->pathFile = 'storage/bonusCourse';
		$this->apiModel = BonusCourseModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/bonus_course',
			'urlAction' => '/admin/bonus_course/save',
			'pathView'  => 'admin.pages.bonusCourse',
			'pathViewInclude'  => 'admin.pages.bonusCourse.form',
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
					'url' => '/admin/bonus_course',
					'label' => 'Vantagens',
				],
			],
		];
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar';
		$this->config->contentTitle = 'Lista Bonus Curso';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Título', 'data' => 'title_pt', ],

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
		$this->config->title = 'Inserir Bonus';
		$this->config->contentTitle = 'Criar nova Bonus Curso';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request);
	}

	function update(Request $request) {
		$this->config->title = 'Editar Bonus Curso';
		$this->config->contentTitle = 'Alterar Bonus Curso';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		$view = parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),]);
		return $view;
	}

	function save(Request $request) {
		if (!empty($request->file('fileImage'))) {
			$fileName = formatNameFile($request->file('fileImage')->getClientOriginalName());

			$request->file('fileImage')->move('storage/bonus_course', $fileName);
			$request['img'] = $fileName;
		}

		return parent::save($request);
	}
}
