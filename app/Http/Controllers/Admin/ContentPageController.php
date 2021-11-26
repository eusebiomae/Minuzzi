<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseMethodAdminController;
use App\Model\api\ContentPageModel;
use App\Model\api\MetaTagModel;

class ContentPageController extends BaseMethodAdminController {

	function __construct() {
		$this->apiModel = ContentPageModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/contentpage',
			'urlAction' => '/admin/contentpage/save',
			'pathView'  => 'admin.pages.contentPage',
			'pathViewInclude'  => 'admin.pages.contentPage.form',
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
					'url' => '/admin/contentpage',
					'label' => 'Página',
				],
			],
		];
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Páginas';
		$this->config->contentTitle = 'Lista páginas';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'width' => '10px','data' => 'id', ],
			[ 'title' => 'Descrição', 'data' => 'description_pt', ],
			[ 'title' => 'Sequencia','width' => '20px', 'data' => 'sequence', ],

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
		$this->config->title = 'Inserir Página';
		$this->config->contentTitle = 'Criar nova páginas';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request);
	}

	function update(Request $request) {
		$this->config->title = 'Editar Página';
		$this->config->contentTitle = 'Alterar páginas';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		return parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),])
		->with('metaTag', MetaTagModel::query()->where('content_page_id', $request->id)->get());
	}

	public function save(Request $request) {
		$request->paramsConfig = [
			'redirectBack' => false,
		];

		if (!$request->get('show')) {
			$request['show'] = null;
		}
		if (!$request->get('target')) {
			$request['target'] = null;
		}

		$save = parent::save($request);

		$metaTagInsUpd = [ 'ins' => [], 'upd' => [], 'ids' => [] ];

		if ($request->get('metaTag')) {
			foreach ($request->get('metaTag') as $metaTag) {
				$metaTag['content_page_id'] = $save->id;

				if (empty($metaTag['id'])) {
					unset($metaTag['id']);
					$metaTagInsUpd['ins'][] = $metaTag;
				} else {
					$metaTagInsUpd['upd'][] = $metaTag;
					$metaTagInsUpd['ids'][] = $metaTag['id'];
				}
			}
		}

		$metaTagModel = MetaTagModel::query()->where('content_page_id', $save->id);
		if (count($metaTagInsUpd['ids'])) {
			$metaTagModel->whereNotIn('id', $metaTagInsUpd['ids']);
		}
		$metaTagModel->delete();

		if (count($metaTagInsUpd['ins'])) {
			MetaTagModel::insert($metaTagInsUpd['ins']);
		}

		if (count($metaTagInsUpd['upd'])) {
			foreach ($metaTagInsUpd['upd'] as $upd) {
				MetaTagModel::find($upd['id'])->update($upd);
			}
		}

		return redirect($this->config->urlBase);
	}
}
