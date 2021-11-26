<?php

namespace App\Http\Controllers\Admin\RoutineManagement;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodSystemController;
use App\Model\api\RoutineManagement\ActivitiesGoalPCXModel;

class ActivitiesGoalPCXController extends BaseMethodSystemController
{
	function __construct()
	{
		$this->apiModel = new ActivitiesGoalPCXModel();

		$this->config = (object) [
			'pathView'  => 'admin/routineManagement/activitiesGoalPCX',
			'urlAction' => 'admin/routine_management/activities',
			'toView' => [
				'header' => 'layouts.header',
				'group_page'  => 'Gestão Rotina',
				'url_group'   => '#',
				'module_page' => 'Meta PCX',
				'url_page'    => 'admin/routine_management/activities',
			],
		];
	}

	public function list(Request $request)
	{
		$this->config->fileView = 'list';
		$this->config->toView['title_page'] = 'Listar';
		$this->config->toView['url_page_action'] = '';
		$this->config->toView['data_target_modal'] = 'modalActivitiesGoalPcx';

		$this->config->toView['headerBtn'] = [
			(object) [
				'modal' => 'modalActivitiesGoalPcx',
				'class' => 'btn-primary',
				'iconClass' => 'fa fa-plus',
				'label' => 'Novo',
			],
		];

		$dataTable = new \stdClass();
		$dataTable->header = getShowListFields(['table' => $this->apiModel->getTable(), 'idUser' => $request->user()->id,]);
		$dataTable->data = $this->apiModel->withTrashed()->get();
		$dataTable->dataHidden = true;

		return parent::list($request)
			->with('dataTable', $dataTable)
			->with('configApp', (object) [
				'showFormFields' => getShowFormFields(
					[
						'table' => $this->apiModel->getTable(),
						'idUser' => $request->user()->id,
						'fillable' => $this->apiModel->fillable,
					]
				)
			]);
	}

	public function save(Request $request)
	{
		$request->paramsConfig = [
			'redirectBack' => true,
		];

		return parent::save($request);
	}

	public function getJson(Request $request)
	{
		$list = $this->apiModel->get();;

		return $list;
	}
}
