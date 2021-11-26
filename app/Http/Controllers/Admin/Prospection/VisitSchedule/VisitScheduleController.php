<?php

namespace App\Http\Controllers\Admin\Prospection\VisitSchedule;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodController;
use App\Model\api\Prospection\LeadsVisitModel;

use App\Model\api\Configuration\StateModel;
use App\Model\api\Configuration\CityModel;
use App\Model\api\Prospection\CourseModel;
use App\Model\api\UserModel;

class VisitScheduleController extends BaseMethodController
{

	function __construct()
	{
		// $this->pathView = 'admin/prospection/visitSchedule';

		$this->config = (object) [
			'pathView' => 'admin/prospection/visitSchedule',
			'urlAction' => 'admin/prospection/visitSchedule',
			'toView' => [
				'header' => 'layouts.header',
				'group_page' => 'Gestão Clientes',
				'url_group' => '#',
				'module_page' => 'Agenda de Visita',
				'url_page' => 'admin/prospection/visitSchedule',
				'modal' => true,
				'data_target_modal' => 'myModalLeadVisit',
			],
		];
	}

	public function list(Request $request)
	{
		$this->config->fileView = 'visitSchedule';
		$this->config->toView['title_page'] = 'View';
		$this->config->toView['url_page_action'] = '';

		$data = LeadsVisitModel::all();

		//return view($this->pathView . '/visitSchedule')

		$listSelectBox = [
			'state' => StateModel::all(),
			'city' => CityModel::all(),
			'course' => CourseModel::all(),
			'usersConsultant' => UserModel::where('consultant', 'S')->get(),
		];

		return parent::list($request)
			->with('data', $data)
			->with('listSelectBox', $listSelectBox);
	}

	public function scheduleSave(Request $request)
	{
		$this->apiModel = new LeadsVisitModel();

		return parent::save($request);
	}
}
