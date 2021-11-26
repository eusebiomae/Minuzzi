<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodController;
use App\Model\api\ContentModel;

use App\Model\api\ContentPageModel;
use App\Model\api\ContentSectionModel;

use File;

class ContentController extends BaseMethodController {
	function __construct() {
		$this->pageKey = 'pageContent';

		$this->apiModel = new ContentModel();

		$this->config = (object) [
			'pathView' => 'admin/content',
			'urlAction' => 'admin/content',
		];
	}

	private function getListSelectBox($data = null) {
		$list = (object) [];

		$list->contentPage = (new ContentPageModel())->get();
		$list->contentSection = [];

		if ($data) {
			$list->contentSection = ContentSectionModel::where('content_page_id', $data['content_page_id'])->get();
		}

		return $list;
	}

	public function list(Request $request) {
		$this->config->fileView = 'list';
		$this->config->toView['title_page'] = 'Listar';
		$this->config->toView['url_page_action'] = '';

		$dataTable = new \stdClass();
		$dataTable->data = ContentModel::withTrashed()->with([
			'contentPage', 'contentSection'
		])->get();

		$dataTable->header = [
			(object) [
				'label' => 'ID',
				'column' => 'id',
			],
			(object) [
				'label' => 'Título',
				'column' => 'title_pt',
			],
			(object) [
				'label' => 'Página',
				'column' => 'contentPage.description_pt',
			],
			(object) [
				'label' => 'Seção',
				'column' => 'contentSection.description_pt',
			],
		];

		$this->config->toView['dataTable'] = $dataTable;

		return parent::list($request);
	}

	function insert(Request $request) {
		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {

		$view = parent::update($request);

		return $view->with('listSelectBox', $this->getListSelectBox($view->data));
	}

	function save(Request $request) {
		if($request->get('visible_event')){
			ContentModel::where('visible_event', 1)->update(['visible_event' => 0]);
		}else{
			$request['visible_event'] = 0;
		}

		if (!empty($request->file('fileImage'))) {
			$fileName = formatNameFile($request->file('fileImage')->getClientOriginalName());

			$path = $request->file('fileImage')->move('storage/content', $fileName);
			$request['image'] = $fileName;
		}

		if (!empty($request->file('fileImageBG'))) {
			$fileName = formatNameFile($request->file('fileImageBG')->getClientOriginalName());

			$path = $request->file('fileImageBG')->move('storage/content', $fileName);
			$request['image_bg'] = $fileName;
		}

		return parent::save($request);
	}

}
