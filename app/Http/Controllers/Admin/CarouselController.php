<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodAdminController;
use App\Model\api\CarouselModel;

use App\Model\api\ContentPageModel;

use File;

class CarouselController extends BaseMethodAdminController {

	function __construct() {
		$this->apiModel = CarouselModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/carousel',
			'urlAction' => '/admin/carousel/save',
			'pathView'  => 'admin.pages.carousel',
			'pathViewInclude'  => 'admin.pages.carousel.form',
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
					'url' => '/admin/carousel',
					'label' => 'carousel',
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
		$this->config->title = 'Listar Carousel';
		$this->config->contentTitle = 'Lista de Carousel';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'width' => '10px','data' => 'id', ],
			[ 'title' => 'Página', 'width' => '20%','data' => 'content_page.description_pt', ],
			[ 'title' => 'Título', 'data' => 'title_pt', ],
			// [ 'title' => 'Tipo', 'data' => 'labelFlgType', ],

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
		$this->config->title = 'Inserir Carousel';
		$this->config->contentTitle = 'Criar novo Carousel';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request)->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		$this->config->title = 'Editar Carousel';
		$this->config->contentTitle = 'Criar novo Carousel';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		return parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),])
		->with('listSelectBox', $this->getListSelectBox());
	}

	function save(Request $request) {
		if (!empty($request->file('imageMain'))) {
			$fileName = formatNameFile($request->file('imageMain')->getClientOriginalName());

			$request->file('imageMain')->move('storage/carousel', $fileName);
			$request['image_main'] = $fileName;
		}

		if (!empty($request->file('imageAdditional1'))) {
			$fileName = formatNameFile($request->file('imageAdditional1')->getClientOriginalName());

			$request->file('imageAdditional1')->move('storage/carousel', $fileName);
			$request['image_additional_1'] = $fileName;
		}

		if (!empty($request->file('imageAdditional2'))) {
			$fileName = formatNameFile($request->file('imageAdditional2')->getClientOriginalName());

			$request->file('imageAdditional2')->move('storage/carousel', $fileName);
			$request['image_additional_2'] = $fileName;
		}

		if (!empty($request->file('imageAdditional3'))) {
			$fileName = formatNameFile($request->file('imageAdditional3')->getClientOriginalName());

			$request->file('imageAdditional3')->move('storage/carousel', $fileName);
			$request['image_additional_3'] = $fileName;
		}

		if (!empty($request->file('imageAdditional4'))) {
			$fileName = formatNameFile($request->file('imageAdditional4')->getClientOriginalName());

			$request->file('imageAdditional4')->move('storage/carousel', $fileName);
			$request['image_additional_4'] = $fileName;
		}

		if (!empty($request->file('imageAdditional5'))) {
			$fileName = formatNameFile($request->file('imageAdditional5')->getClientOriginalName());

			$request->file('imageAdditional5')->move('storage/carousel', $fileName);
			$request['image_additional_5'] = $fileName;
		}



		return parent::save($request);
	}

}
