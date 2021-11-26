<?php

namespace App\Http\Controllers\Admin\RoutineManagement;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodSystemController;

use App\Model\api\RoutineManagement\GoalPCXModel;
use App\Model\api\UserModel;
use DateTime;

class GoalPCXController extends BaseMethodSystemController
{

	function __construct()
	{
		$this->apiModel = new GoalPCXModel();

		$this->config = (object) [
			'pathView'  => 'admin/routineManagement/goalPCX',
			'urlAction' => 'admin/routine_management/goal_pcx',
			'toView' => [
				'header' => 'layouts.header',
				'group_page'  => 'Gestão Rotina',
				'url_group'   => '#',
				'module_page' => 'Meta PCX',
				'url_page'    => 'admin/routine_management/goal_pcx',
			],
		];
	}

	private function getListSelectBox()
	{
		$list = [];

		$list['sellers'] = UserModel::where('consultant', 'S')->get();

		return $list;
	}

	private function getConfigAppInsUpd($request)
	{

		$showFormFields = getShowFormFields(
			[
				'table' => $this->apiModel->getTable(),
				'idUser' => $request->user()->id,
				'fillable' => $this->apiModel->fillable,
			]
		);

		return (object) [
			'showFormFields' => $showFormFields,
			'configParameters' => $request->session()->get('configParameters'),
		];
	}

	public function list(Request $request)
	{
		$this->config->fileView = 'list';
		$this->config->toView['title_page'] = 'Listar';
		$this->config->toView['url_page_action'] = '';

		$this->config->toView['headerBtn'] = [
			(object) [
				'url' => 'admin/routine_management/goal_pcx/insert',
				'class' => 'btn-primary',
				'iconClass' => 'fa fa-plus',
				'label' => 'Novo',
			],
			(object) [
				'url' => 'admin/routine_management/goal_pcx/full/insert',
				'class' => 'btn-secondary',
				'iconClass' => 'fa fa-plus',
				'label' => 'Novo Full',
			],
		];

		$dataTable = new \stdClass();

		$list = $this->apiModel->with('user');

		if (!$request->get('user_id')) {
			$request['user_id'] = $request->user()->id;
		}

		if (!$request->get('month')) {
			$request['month'] = date('m');
		}

		$list->where('user_id', $request->get('user_id'))
			->whereMonth('date', '=', $request->get('month'))
			->whereYear('date', '=', date('Y'));

		$dataTable->data = $list->get();

		$dataTable->header = getShowListFields(['table' => $this->apiModel->getTable(), 'idUser' => $request->user()->id,]);

		$configParameters = $request->session()->get('configParameters');

		if ($configParameters->valueOfMeta === '1') {
			$dataTable->classColumn = [
				'goal_planned' => 'mask-money'
			];
		}

		$listSelectBox = $this->getListSelectBox();

		$listSelectBox['months'] = getMonths();

		return parent::list($request)
			->with('dataFilter', $request->all())
			->with('dataTable', $dataTable)
			->with('listSelectBox', $listSelectBox);
	}

	public function insert(Request $request)
	{

		$this->config->fileView = 'form';
		$this->config->toView['title_page'] = 'Inserir';
		$this->config->toView['url_page_action'] = '/insert';
		$this->config->toView['title'] = 'Cadastro de Meta PCX';
		$this->config->toView['subtitle'] = 'Cadastre todas as informações referente a meta PCX.';

		$listSelectBox = $this->getListSelectBox();

		return parent::insert($request)
			->with('configApp', $this->getConfigAppInsUpd($request))
			->with('listSelectBox', $listSelectBox);
	}

	public function update(Request $request)
	{
		$data = GoalPCXModel::where('id', $request->id)->first();

		if ($data->flg_type === 'F') {
			return redirect("/{$this->config->urlAction}/full/update/{$data->id}");
		}

		$this->config->fileView = 'form';
		$this->config->toView['title_page'] = 'Inserir';
		$this->config->toView['url_page_action'] = '/update';
		$this->config->toView['title'] = 'Alteração da Meta PCX';
		$this->config->toView['subtitle'] = 'Altere todas as informações referente a meta PCX.';

		$listSelectBox = $this->getListSelectBox();

		$view = parent::update($request)
			->with('configApp', $this->getConfigAppInsUpd($request))
			->with('listSelectBox', $listSelectBox);

		$date = DateTime::createFromFormat('d/m/Y', $view->data->date);
		$dateNow = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));

		// return [$dateNow->format('Y-m-d'), $date->format('Y-m-d')];
		$view->data->isEdited = $dateNow < $date ? 1 : ($dateNow > $date ? -1 : 0);

		return $view;
	}

	public function save(Request $request)
	{
		$request->paramsConfig = [
			'redirectBack' => false,
		];

		$request['finished'] = isset($request['finished']) ? $request['finished'] : null;
		$request['goal_planned'] = toNumberFormat(str_replace('R$ ', '', $request['goal_planned']));
		$request['goal_executed'] = toNumberFormat(str_replace('R$ ', '', $request['goal_executed']));

		$save = parent::save($request);

		return redirect("/{$this->config->urlAction}/update/{$save->data->id}");
	}
}
