<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Model\api\UserModel;

class UserController extends BaseMethodAdminController {
	function __construct() {
		$this->apiModel = UserModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/user',
			'urlAction' => '/admin/user/save',
			'pathView'  => 'admin.pages.user',
			'pathViewInclude'  => 'admin.pages.user.form',
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
					'url' => '/admin/user',
					'label' => 'Usuários',
				],
			],
		];
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Usuários';
		$this->config->contentTitle = 'Lista de Usuários';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Nome', 'data' => 'name', ],
			[ 'title' => 'Login', 'data' => 'user_name', ],
			[ 'title' => 'Autor', 'data' => 'author', ],
			[ 'title' => 'Tipo', 'data' => 'user_type_id', ],

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
		$this->config->title = 'Inserir Usuário';
		$this->config->contentTitle = 'Criar novo Usuário';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request);
	}

	function update(Request $request) {
		$this->config->title = 'Editar Usuário';
		$this->config->contentTitle = 'Alterar Usuário';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		$view = parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),]);

		return $view;
	}

	function save(Request $request) {
		if (!empty($request->password)) {
			$request['password'] = Hash::make($request->password);
		} else {
			unset($request['password']);
		}

		if (!empty($request->file('fileImage'))) {
			$fileName = formatNameFile($request->file('fileImage')->getClientOriginalName());

			$path = $request->file('fileImage')->move('storage/user', $fileName);
			$request['image'] = $fileName;
		}

		return parent::save($request);
	}

	function email(){
		$payload  = [
			'name' => 'Jonathas',
			'last_name' => 'Kranmer',
			'email' => 'jonathas@teste.com',
			'phone' => '(00) 0 0000-0000',
			'subject' => 'Titulo sobre o assunto',
			'description_pt' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repellat deserunt minus tenetur optio tempore iure laudantium esse nostrum explicabo quia, aliquam ipsa corporis reiciendis repudiandae minima excepturi accusantium? Sequi, quae! Lorem ipsum dolor, sit amet consectetur adipisicing elit. Perferendis voluptas animi voluptatibus vero nesciunt. Ullam rerum commodi, illum, corporis repellendus eum sequi labore asperiores eius blanditiis alias expedita et omnis.',
		];
		return view('email.contact-mail')->with('payload', $payload);
	}
}
