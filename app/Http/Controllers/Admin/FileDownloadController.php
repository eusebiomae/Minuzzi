<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseMethodController;

use App\Model\api\Prospection\FileModel;
use App\Model\api\Prospection\CourseModel;
use Storage;

class FileDownloadController extends BaseMethodController {

  function __construct() {
		$this->pathFile = 'storage/file';
		$this->apiModel = new FileModel();

		$this->config = (object) [
			'pathView' => 'admin/prospection/file',
			'urlAction' => 'admin/prospection/file_download',
			'toView' => [
				'header' => 'layouts.header',
				'group_page' => 'Arquivos',
				'url_group' => '#',
				'module_page' => 'Download',
				'url_page' => 'admin/prospection/file_download',
				'pathFile' => '/admin/prospection/file/download/',
			],
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->course = CourseModel::all();

		return $list;
	}

	public function list(Request $request) {
		$this->config->fileView = 'download';
		$this->config->toView['title_page'] = 'Listar';
		$this->config->toView['url_page_action'] = '';

		$listSelectBox = $this->getListSelectBox();

		$view = parent::list($request)
		->with('listSelectBox', $listSelectBox);

		$view->data = FileModel::all();

		return $view;
	}

	public function download(Request $request, $nameFile) {
		$pathToFile = '../public' . Storage::url('file/'. $nameFile);

		return response()->download($pathToFile, $nameFile);
	}

}
