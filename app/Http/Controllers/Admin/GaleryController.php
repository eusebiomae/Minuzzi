<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodAdminController;

use App\Model\api\ContentPageModel;
use App\Model\api\ContentSectionModel;

use App\Model\api\GaleryModel;
use App\Model\api\PhotoGaleryModel;
use File;

class GaleryController extends BaseMethodAdminController {

  function __construct() {
		$this->apiModel = GaleryModel::class;
    $this->config = (object) [
			'urlBase' => '/admin/galery',
			'urlAction' => '/admin/galery/save',
			'pathView'  => 'admin.pages.galery',
			'pathViewDefault'  => 'admin.pages.galery.form',
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
					'url' => '/admin/galery',
					'label' => 'Galeria',
				],
			],
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
    $this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Seção de Página';
		$this->config->contentTitle = 'Lista de seção de páginas';
    $this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

    $dataTableHeader = [
			[ 'title' => 'ID', 'width' => '10px','data' => 'id', ],
			[ 'title' => 'Página', 'width' => '20%','data' => 'content_page.description_pt', ],
			[ 'title' => 'Seção', 'width' => '20%','data' => 'content_section.description_pt', ],
			[ 'title' => 'Título', 'data' => 'title_pt', ],

			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center', 'width' => '10px','btnDel' => $this->config->urlBase ],
    ];

		return parent::list($request)
		->with('dataTable', parent::getListEnableDisable((object) [
			'dataTableHeader' => $dataTableHeader,
      'apiModel' => $this->apiModel::query()
			->with([ 'contentPage', 'contentSection']),

		]));
  }

  public function insert(Request $request) {
    $this->config->title = 'Inserir Galeria de Fotos';
		$this->config->contentTitle = 'Criar nova galeria de ';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

    return parent::insert($request)
    ->with('listSelectBox', $this->getListSelectBox());
  }

  public function update(Request $request) {
    $this->config->title = 'Editar Seção de Página';
		$this->config->contentTitle = 'Alterar seção de páginas';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

    $id = $request->id;

    return parent::update($request)
    ->with('payload', ['data' => $this->apiModel::find($request->id),])
    ->with('imgs', PhotoGaleryModel::where('galery_id', '=', $id)->get())
		->with('listSelectBox', $this->getListSelectBox());
  }

  public function save(Request $request) {
    $this->apiModel = new GaleryModel();

    $request->paramsConfig = [
      'redirectBack' => false,
    ];

    $apiModel = parent::save($request);

    if (!empty($request->file('fileImage'))) {
			$fileName = formatNameFile($request->file('fileImage')->getClientOriginalName());

			$request->file('fileImage')->move('storage/galery/' . $apiModel->id, $fileName);
      GaleryModel::where('id', $apiModel->id)->update([ 'image' => $fileName ]);
    }

    return redirect($this->config->urlBase);
  }

  public function saveImgs(Request $request) {
    $this->apiModel = new PhotoGaleryModel();

    $request->paramsConfig = [
      'redirectBack' => false,
    ];

    $pathFile = 'storage/galery/' . $request['galery_id'];
    if (!empty($request->file('fileImage'))) {

      $fileName = formatNameFile(empty($request['title_pt']) ? $request->file('fileImage')->getClientOriginalName() : $request['title_pt'] .'.'. $request->file('fileImage')->getClientOriginalExtension());

      $path = $request->file('fileImage')->move($pathFile, $fileName);
      $request['file'] = $fileName;

      $mimeType = $request->file('fileImage')->getClientMimeType();
      $size = $request->file('fileImage')->getClientSize();

      $save = parent::save($request);

      return [
        'files' => [
          $save->data,
        ],
      ];
    }

    return [
      'error' => 'Não foi possivel realiar a operação',
    ];
  }

  public function delImg(Request $request, $id) {
    $data = PhotoGaleryModel::find($id);

    if(!$data) {
      return response()->json([
        'message'   => 'Record not found',
      ], 404);
    }

    $data->delete();

    return $data;
  }

}
