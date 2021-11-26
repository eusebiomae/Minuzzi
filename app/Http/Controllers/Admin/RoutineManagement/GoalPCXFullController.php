<?php

namespace App\Http\Controllers\Admin\RoutineManagement;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodSystemController;
use App\Model\api\Configuration\LeadsStatusModel;
use App\Model\api\Prospection\LeadsPhoneCallModel;
use App\Model\api\RoutineManagement\GoalPCXModel;
use App\Model\api\RoutineManagement\GoalPCXFullPcxModel;
use App\Model\api\RoutineManagement\GoalPCXFullActivitiesModel;
use App\Model\api\UserModel;
use DateTime;

class GoalPCXFullController extends BaseMethodSystemController
{

	function __construct()
	{
		$this->apiModel = new GoalPCXModel();

		$this->config = (object) [
			'fileView' => 'formFull',
			'pathView' => 'admin/routineManagement/goalPCX',
			'urlAction' => 'admin/routine_management/goal_pcx/full',
			'toView' => [
				'header' => 'layouts.header',
				'group_page'  => 'Gestão Rotina',
				'url_group'   => '#',
				'module_page' => 'Meta PCX Full',
				'url_page'    => 'admin/routine_management/goal_pcx',
			],
		];
	}

	private function getListSelectBox()
	{
		$list = [];

		$list['sellers'] = UserModel::where('consultant', 'S')->get();
		$list['leadsStatus'] = LeadsStatusModel::all();

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

	public function insert(Request $request)
	{
		$this->config->toView['title_page'] = 'Inserir';
		$this->config->toView['url_page_action'] = '/insert';
		$this->config->toView['title'] = 'Cadastro de Meta PCX';
		$this->config->toView['subtitle'] = 'Cadastre todas as informações referente a meta PCX.';
		$this->config->toView['headerBtn'] = [
			(object) [
				'url' => 'admin/routine_management/goal_pcx',
				'class' => 'btn-primary',
				'iconClass' => 'fa fa-plus',
				'label' => 'Lista',
			],
		];

		$listSelectBox = $this->getListSelectBox();

		return parent::insert($request)
			->with('configApp', $this->getConfigAppInsUpd($request))
			->with('listSelectBox', $listSelectBox);
	}

	public function update(Request $request)
	{
		$this->config->toView['title_page'] = 'Editar';
		$this->config->toView['url_page_action'] = '/update';
		$this->config->toView['title'] = 'Alteração da Meta PCX';
		$this->config->toView['subtitle'] = 'Altere todas as informações referente a meta PCX.';
		$this->config->toView['headerBtn'] = [
			(object) [
				'url' => 'admin/routine_management/goal_pcx',
				'class' => 'btn-primary',
				'iconClass' => 'fa fa-plus',
				'label' => 'Lista',
			],
		];

		$listSelectBox = $this->getListSelectBox();

		$view = parent::update($request)
			->with('configApp', $this->getConfigAppInsUpd($request))
			->with('listSelectBox', $listSelectBox)
			->with('listPCX', (new GoalPCXFullPcxModel)->getGoalPCXFull($request->id))
			->with('listActivities', (new GoalPCXFullActivitiesModel())->getGoalPCXFull($request->id));

			$date = DateTime::createFromFormat('d/m/Y', $view->data->date);
			$dateNow = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));

			$view->data->isEdited = $dateNow < $date ? 1 : ($dateNow > $date ? -1 : 0);

		return $view;
	}

	public function save(Request $request)
	{
		$request->paramsConfig = [
			'redirectBack' => false,
		];

		$request['flg_type'] = 'F';
		$request['finished'] = isset($request['finished']) ? $request['finished'] : null;
		$request['goal_planned'] = toNumberFormat(str_replace('R$ ', '', $request['goal_planned']));
		$request['goal_executed'] = toNumberFormat(str_replace('R$ ', '', $request['goal_executed']));

		$countPlanExecPCX = function($requestKey, $columnKey) use (&$request) {
			foreach ($request[$requestKey] as $value) {
				$request["{$columnKey}_planned"] += 1;

				if (isset($value['executed'])) {
					$request["{$columnKey}_executed"] += 1;
				}
			}
		};

		if (isset($request['P'])) {
			$request['p_planned'] = 0;
			$request['p_executed'] = 0;
			$countPlanExecPCX('P', 'p');
		}

		if (isset($request['C'])) {
			$request['c_planned'] = 0;
			$request['c_executed'] = 0;

			$countPlanExecPCX('C', 'c');
		}

		if (isset($request['X'])) {
			$request['x_planned'] = 0;
			$request['x_executed'] = 0;
			$countPlanExecPCX('X', 'x');
		}

		$save = parent::save($request);

		$extractData = function ($data, $fk, &$dataExtract) use ($save) {
			foreach ($data as $value) {
				$toSave = [
					'goal_pcx_id' => $save->data->id,
					$fk => $value['fk'],
					'executed' => isset($value['executed']) ? $value['executed'] : null,
				];

				if (isset($value['id']) && !empty($value['id'])) {
					$toSave['id'] = $value['id'];

					$dataExtract['upd'][] = $toSave;
				} else {
					$dataExtract['ins'][] = $toSave;
				}
			}
		};

		$leads = [
			'ins' => [],
			'upd' => [],
		];

		$activities = [
			'ins' => [],
			'upd' => [],
		];

		if (isset($request['P'])) {
			$extractData($request['P'], 'pcx_id', $leads);
		}

		if (isset($request['C'])) {
			$extractData($request['C'], 'pcx_id', $leads);
		}

		if (isset($request['X'])) {
			$extractData($request['X'], 'pcx_id', $leads);
		}

		if (isset($request['activities'])) {
			$extractData($request['activities'], 'activities_goal_pcx_id', $activities);
		}

		if (count($leads['ins'])) {
			GoalPCXFullPcxModel::insert($leads['ins']);
		}

		if (count($leads['upd'])) {
			for ($i = 0, $ii = count($leads['upd']); $i < $ii; $i++) {
				$data = $leads['upd'][$i];

				GoalPCXFullPcxModel::where('id', $data['id'])->update($data);
			}
		}

		if (count($activities['ins'])) {
			GoalPCXFullActivitiesModel::insert($activities['ins']);
		}

		if (count($activities['upd'])) {
			for ($i = 0, $ii = count($activities['upd']); $i < $ii; $i++) {
				$data = $activities['upd'][$i];

				GoalPCXFullActivitiesModel::where('id', $data['id'])->update($data);
			}
		}

		return redirect("/{$this->config->urlAction}/update/{$save->data->id}");
	}

	public function removePCXA(Request $request)
	{
		$fnDelete = function ($model, $id) {
			$data = $model->find($id);

			if (!$data) {
				return response()->json([
					'message'   => 'Record not found',
				], 404);
			}

			$data->delete();
		};

		if (in_array($request->type, ['P', 'C', 'X'])) {
			$fnDelete(new GoalPCXFullPcxModel, $request->id);
		} else
		if ($request->type == 'activities') {
			$fnDelete(new GoalPCXFullActivitiesModel, $request->id);
		}
	}

	public function phoneContactSave(Request $request)
	{
		$this->apiModel = new LeadsPhoneCallModel();

		return parent::save($request);
	}
}
