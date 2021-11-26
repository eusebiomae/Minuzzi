<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use App\Model\api\PageConfigModel;
use App\Model\api\PageUserProfileModel;
use App\Model\api\UserModel;
use App\Model\api\UserProfileModel;
use Illuminate\Http\Request;

class UserProfileController extends BaseMethodAdminController
{
	function __construct()
	{
		$this->apiModel = UserProfileModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/profile',
			'urlAction' => '/admin/profile/save',
			'pathView'  => 'admin.profile',
			'pathViewInclude'  => 'admin.profile.form',
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
					'url' => '/admin/profile',
					'label' => 'Perfil de usuário',
				],
			],
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->user = UserModel::orderBy('name')->get();
		$list->pageUserProfile = PageUserProfileModel::get();
		$list->pageConfig = PageConfigModel::get();

		return $list;
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Perfil do Usuário';
		$this->config->contentTitle = 'Lista de Perfis do Usuário';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Nome', 'data' => 'desc', ],

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
		$this->config->title = 'Cadastro de Perfil do Usuário';
		$this->config->contentTitle = 'Cadastre todas as informações referente ao Perfil do Usuário.';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		$this->config->title = 'Editar Perfil do Usuário';
		$this->config->contentTitle = 'Alterar Perfil do Usuário';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		$listSelectBox = $this->getListSelectBox();

		$view = parent::update($request);

		return $view
		->with('payload', [
			'data' => $this->apiModel::find($request->id),
		])
			->with('listSelectBox', $listSelectBox);
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
