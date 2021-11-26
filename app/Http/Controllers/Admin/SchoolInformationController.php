<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;
use App\Model\api\SchoolInformationModel;

use App\Model\api\Configuration\StateModel;
use App\Model\ParametersAppModel;
use File;

class SchoolInformationController extends BaseMethodAdminController {

	function __construct() {
		$this->apiModel = SchoolInformationModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/schoolinformation',
			'urlAction' => '/admin/schoolinformation/save',
			'pathView'  => 'admin.pages.schoolinformation',
			'pathViewInclude'  => 'admin.pages.schoolinformation.form',
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
					'label' => 'Informações da escola',
				],
			],
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->state = (new StateModel())->get();

		return $list;
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Informações';
		$this->config->contentTitle = 'Lista de Informações';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'width' => '10px','data' => 'id', ],
			[ 'title' => 'Nome', 'data' => 'name', ],
			[ 'title' => 'Cidade', 'data' => 'city', ],
			[ 'title' => 'UF', 'data' => 'state.abbreviation', ],
			[ 'title' => 'Telefone Principal', 'data' => 'phone1', ],
			[ 'title' => 'Celular Principal', 'data' => 'cell_phone1', ],
			[ 'title' => 'E-mail Principal', 'data' => 'email1', ],

			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center', 'width' => '10px','btnDel' => $this->config->urlBase ],
		];

		return parent::list($request)
		->with('dataTable', parent::getListEnableDisable((object) [
			'dataTableHeader' => $dataTableHeader,
			'apiModel' => $this->apiModel::query(),
		]));
	}

	function insert(Request $request) {
		$this->config->title = 'Inserir Informação';
		$this->config->contentTitle = 'Criar nova Informação';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		$this->config->title = 'Editar Informação';
		$this->config->contentTitle = 'Editar Informação';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];
		return parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),])
		->with('parametersApp', (isset($parametersApp) ? json_decode($parametersApp->payload) : null))
		->with('listSelectBox', $this->getListSelectBox());
	}

	function save(Request $request) {
		if (!empty($request->file('fileImage'))) {
			$fileName = formatNameFile($request->file('fileImage')->getClientOriginalName());

			$request->file('fileImage')->move('storage/scholinformation', $fileName);
			$request['image'] = $fileName;
		}

		$parametersApp = $request->get('parametersApp');

		if ($parametersApp) {
			ParametersAppModel::whereNull('user_id')->update([
				'payload' => json_encode($parametersApp),
			]);
		}

		return parent::save($request);
	}

}
