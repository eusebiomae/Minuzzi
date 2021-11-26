<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use App\Model\api\PageConfigModel;
use App\Model\api\PageModuleModel;
use App\Model\api\PageUserProfileModel;
use App\Model\api\UserModel;
use App\Model\api\UserProfileModel;
use Illuminate\Http\Request;

class SystemScreenController extends BaseMethodAdminController
{
	function __construct()
	{
		$this->apiModel = PageUserProfileModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/system_screen',
			'urlAction' => '/admin/system_screen/save',
			'pathView'  => 'admin.pageUserProfile',
			'pathViewInclude'  => 'admin.pageUserProfile.form',
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
					'url' => '/admin/system_screen',
					'label' => 'Telas do Sistema',
				],
			],
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->pageModule = PageModuleModel::orderBy('desc')->get();
		$list->pageConfig = PageConfigModel::orderBy('desc')->get();
		$list->userProfile = UserProfileModel::orderBy('desc')->get();
		$list->user = UserModel::orderBy('name')->get();

		return $list;
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Telas do Sistema';
		$this->config->contentTitle = 'Lista de Telas do Sistema';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Perfil do Usuário', 'data' => 'user_profile.desc', ],
			[ 'title' => 'Módulo', 'data' => 'page_module.desc', ],
			[ 'title' => 'Página', 'data' => 'page_config.desc', ],

			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnDel' => $this->config->urlBase ],
		];

		return parent::list($request)
		->with('dataTable', parent::getListEnableDisable((object) [
			'dataTableHeader' => $dataTableHeader,
			'apiModel' => $this->apiModel::query()->with([
				'userProfile',
				'pageModule',
				'pageConfig',
			]),
		]));
	}

	function insert(Request $request) {
		$this->config->title = 'Cadastro de Telas do Sistema';
		$this->config->contentTitle = 'Cadastre todas as informações referente ao Telas do Sistema.';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		$this->config->title = 'Editar Telas do Sistema';
		$this->config->contentTitle = 'Alterar Telas do Sistema';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		$view = parent::update($request)
		->with('payload', [
			'data' => $this->apiModel::find($request->id),
		])
		->with('listSelectBox', $this->getListSelectBox());

		return $view;
	}

	public function save(Request $request)
	{
		$request->paramsConfig = [
			'redirectBack' => false,
		];

		$save = parent::save($request);

		return redirect($this->config->urlBase);
	}
}
