<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodAdminController;
use App\Model\api\TeamModel;

use App\Model\api\Configuration\FunctionModel;
use App\Model\api\Configuration\GraduationModel;
use App\Model\api\Configuration\OfficeModel;

class TeamController extends BaseMethodAdminController {

	function __construct() {
		$this->apiModel = TeamModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/team',
			'urlAction' => '/admin/team/save',
			'pathView'  => 'admin.pages.team',
			'pathViewInclude'  => 'admin.pages.team.form',
			'header' => 'admin.layouts.header',
			'breadcrumbs' => [
				[
					'url' => '/admin',
					'label' => 'Home',
				],
				[
					'label' => 'Gestão Equipe',
				],
				[
					'url' => '/admin/team',
					'label' => 'Equipe',
				],
			],
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->function = FunctionModel::all();
		$list->graduation = GraduationModel::all();
		$list->office = OfficeModel::all();

		return $list;
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar';
		$this->config->contentTitle = 'Lista de Pessoas';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px'],
			[ 'title' => 'Nome', 'data' => 'name', ],
			[ 'title' => 'Função', 'data' => 'function.description_pt', ],
			[ 'title' => 'Graduação', 'data' => 'graduation.description_pt', ],
			[ 'title' => 'Cargo', 'data' => 'office.description_pt', ],

			[ 'title' => '', 'className' => 'center','width' => '10px', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center','width' => '10px', 'btnDel' => $this->config->urlBase ],
		];


		return parent::list($request)
		->with('dataTable', parent::getListEnableDisable((object) [
			'dataTableHeader' => $dataTableHeader,
			'apiModel' => $this->apiModel::query()->with([
				'Function',
				'Graduation',
				'Office',
			]),
		]));
	}

	function insert(Request $request) {
		$this->config->title = 'Inserir Pessoa';
		$this->config->contentTitle = 'Criar nova Pessoa';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		$this->config->title = 'Editar Pessoa';
		$this->config->contentTitle = 'Alterar Pessoa';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		$view = parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),])
		->with('listSelectBox', $this->getListSelectBox());

		return $view;
	}

	function save(Request $request) {
		if (!empty($request->file('fileImage'))) {
			$fileName = formatNameFile($request->file('fileImage')->getClientOriginalName());
			$request->file('fileImage')->move('storage/team', $fileName);
			$request['image'] = $fileName;
		}

		return parent::save($request);
	}

}
