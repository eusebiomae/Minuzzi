<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodAdminController;
use App\Model\api\Prospection\VideoModel;

class VideoController extends BaseMethodAdminController {
	function __construct() {
		$this->apiModel = VideoModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/video',
			'urlAction' => '/admin/video/save',
			'pathView'  => 'admin.pages.video',
			'pathViewInclude'  => 'admin.pages.video.form',
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
					'url' => '/admin/video',
					'label' => 'Vídeos',
				],
			],
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		return $list;
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Vídeos';
		$this->config->contentTitle = 'Lista vídeos';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'width' => '10px','data' => 'id', ],
			[ 'title' => 'Name','data' => 'title', ],
			[ 'title' => 'Descrição', 'data' => 'description', ],
			[ 'title' => 'Tipo', 'data' => 'show_site_label', ],

			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center', 'width' => '10px','btnDel' => $this->config->urlBase ],
		];

		return parent::list($request)
		->with('dataTable', parent::getListEnableDisable((object) [
			'dataTableHeader' => $dataTableHeader,
			'apiModel' => $this->apiModel::query(),
		]));
	}

	public function insert(Request $request) {
		$this->config->title = 'Inserir Vídeo';
		$this->config->contentTitle = 'Criar novo vídeo';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request);
	}

	function update(Request $request) {
		$this->config->title = 'Editar Vídeo';
		$this->config->contentTitle = 'Alterar vídeo';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		return parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),]);
	}

	public function save(Request $request) {
		if (empty($request['show_site'])) {
			$request['show_site'] = null;
		}
		if (!empty($request->file('fileImage'))) {
			$fileName = formatNameFile($request->file('fileImage')->getClientOriginalName());

			$request->file('fileImage')->move('storage/video', $fileName);
			$request['image'] = $fileName;
		}

		return parent::save($request);
	}
}
