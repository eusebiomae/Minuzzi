<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;
use App\Model\api\PlaceModel;

use App\Model\api\Configuration\StateModel;

class PlaceController extends BaseMethodAdminController {
	function __construct() {
		$this->apiModel = PlaceModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/place',
			'urlAction' => '/admin/place/save',
			'pathView'  => 'admin.pages.place',
			'pathViewInclude'  => 'admin.pages.place.form',
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
					'url' => '/admin/place',
					'label' => 'Local',
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
		$this->config->title = 'Listar Lugares';
		$this->config->contentTitle = 'Lista de Lugares';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Local', 'data' => 'description', ],
			[ 'title' => 'Cidade', 'data' => 'city', ],

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
		$this->config->title = 'Inserir Local';
		$this->config->contentTitle = 'Criar novo Local';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	// public function update(Request $request, $id) {
	// 	$this->dataPage['urlAction'] = '/admin/place/save';
	// 	$this->dataPage['pathView'] = 'admin/place/form';
	// 	$this->dataPage['titlePage'] = 'Edição de Local';
	// 	$this->dataPage['breadcrumbs'] = [
	// 		[
	// 			'url' => '/admin',
	// 			'label' => 'Home',
	// 		],
	// 		[
	// 			'url' => '/admin/place',
	// 			'label' => 'Listas de Locais',
	// 		],
	// 		[
	// 			'label' => 'Editar o Local',
	// 		],
	// 	];

	// 	$this->dataPage['btnTopRight'] = [
	// 		[
	// 			'url' => '/admin/place',
	// 			'label' => 'Lista',
	// 			'icon' => 'fa fa-list',
	// 			'class' => 'btn-primary',
	// 		],
	// 	];

	// 	$data = $this->model::find($id);

	// 	return view('admin/_components/formDefault')
	// 	->with('data', $data)
	// 	->with('dataPage', toObject($this->dataPage))
	// 	->with('listSelectBox', $this->getListSelectBox());
	// }

	function update(Request $request) {
		$this->config->title = 'Editar Local';
		$this->config->contentTitle = 'Alterar Local';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		$view = parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),])
		->with('listSelectBox', $this->getListSelectBox());

		return $view;
	}
}
