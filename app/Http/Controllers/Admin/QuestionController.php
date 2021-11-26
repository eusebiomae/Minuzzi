<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;

use App\Model\api\QuestionModel;
use App\Model\api\Configuration\AlternativeModel;
use App\Model\api\Prospection\CourseCategoryModel;

class QuestionController extends BaseMethodAdminController
{

	function __construct()
	{
		$this->apiModel = QuestionModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/question',
			'urlAction' => '/admin/question/save',
			'pathView'  => 'admin.pages.question',
			'pathViewInclude'  => 'admin.pages.question.form',
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
					'url' => '/admin/question',
					'label' => 'Perguntas',
				],
			],
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->courseCategory = CourseCategoryModel::all();

		return $list;
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Perguntas';
		$this->config->contentTitle = 'Lista de Perguntas';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Nome Pergunta', 'data' => 'title', ],
			[ 'title' => 'Categoria', 'data' => 'category.description_pt', ],
			[ 'title' => 'Tipo', 'data' => 'type', ],

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
		$this->config->title = 'Cadastro de Pergunta';
		$this->config->contentTitle = 'Cadastre todas as informações referente a pergunta.';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		$this->config->title = 'Editar Pergunta';
		$this->config->contentTitle = 'Alterar Pergunta';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		$view = parent::update($request)
		->with('listSelectBox', $this->getListSelectBox())
		->with('payload', ['data' => $this->apiModel::with([ 'alternative' ])->find($request->id),]);

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
					'flg_correct' => isset($value['flg_correct']) ? $value['flg_correct'] : null,
				];

				if (isset($value['id']) && !empty($value['id'])) {
					$toSave['id'] = $value['id'];

					$dataExtract['upd'][] = $toSave;
				} else {
					$dataExtract['ins'][] = $toSave;
				}
			}
		};

		if (in_array($request->flg_type, ['2', '3', '4'])) {

			$alternatives = [
				'ins' => [],
				'upd' => [],
			];

			$extractData($request->alternative[$request->flg_type], $alternatives);

			if (count($alternatives['ins'])) {
				AlternativeModel::insert($alternatives['ins']);
			}

			if (count($alternatives['upd'])) {
				for ($i = 0, $ii = count($alternatives['upd']); $i < $ii; $i++) {
					$data = $alternatives['upd'][$i];

					AlternativeModel::where('id', $data['id'])->update($data);
				}
			}
		}

		return redirect($this->config->urlBase);
	}

	public function alternativeRemove(Request $request)
	{
		$data = AlternativeModel::find($request->id);

		if (!$data) {
			return response()->json([
				'message'   => 'Record not found',
			], 404);
		}

		return $data->delete();
	}
}
