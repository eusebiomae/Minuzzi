<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;

use App\Model\api\AvaliationModel;
use App\Model\api\Prospection\CourseCategoryModel;
use App\Model\api\QuestionModel;
use App\Model\api\SlideModel;

class AvaliationController extends BaseMethodAdminController
{

	function __construct()
	{
		$this->apiModel = AvaliationModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/avaliation',
			'urlAction' => '/admin/avaliation/save',
			'pathView'  => 'admin.pages.avaliation',
			'pathViewInclude'  => 'admin.pages.avaliation.form',
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
					'url' => '/admin/avaliation',
					'label' => 'Avaliações',
				],
			],
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->courseCategory = CourseCategoryModel::all();
		$list->slide = SlideModel::all();
		$list->questions = QuestionModel::with('alternative')->get();

		return $list;
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Avaliações';
		$this->config->contentTitle = 'Lista de Avaliações';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Nome', 'data' => 'title', ],
			[ 'title' => 'Categoria', 'data' => 'category.description_pt', ],
			[ 'title' => 'Data', 'data' => 'date', ],

			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnDel' => $this->config->urlBase ],
		];

		return parent::list($request)
		->with('dataTable', parent::getListEnableDisable((object) [
			'dataTableHeader' => $dataTableHeader,
			'apiModel' => $this->apiModel::query()->with([
				'category',
			]),
		]));
	}

	function insert(Request $request) {
		$this->config->title = 'Cadastro de Avaliação';
		$this->config->contentTitle = 'Cadastre todas as informações referente a Avaliação.';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		$this->config->title = 'Editar Avaliação';
		$this->config->contentTitle = 'Alterar Avaliação';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		$view = parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),])
		->with('listSelectBox', $this->getListSelectBox());

		return $view;
	}

	public function save(Request $request)
	{
		$request->paramsConfig = [
			'redirectBack' => false,
		];

		$save = parent::save($request);

		$extractData = function ($data, &$dataExtract) use ($save, $request) {
			$order = 1;

			foreach ($data as $value) {
				if (empty($value['title'])) {
					continue;
				}

				$toSave = [
					'question_id' => $save->id,
					'title' => $value['title'],
					'flg_type' => $request->flg_type,
					'order' => $order++,
				];

				if (isset($value['id']) && !empty($value['id'])) {
					$toSave['id'] = $value['id'];

					$dataExtract['upd'][] = $toSave;
				} else {
					$dataExtract['ins'][] = $toSave;
				}
			}
		};


		return redirect($this->config->urlBase);
	}

}
