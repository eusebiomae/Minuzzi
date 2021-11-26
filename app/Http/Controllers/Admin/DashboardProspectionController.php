<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseMethodSystemController;
use Illuminate\Support\Facades\DB;

class DashboardProspectionController extends BaseMethodSystemController
{

	function __construct() {
		$this->config = (object) [
			'title' => 'Dashboard',
			'header' => 'admin.layouts.header',
			'breadcrumbs' => [
				[
					'url' => '/admin',
					'label' => 'Home',
				],
				[
					'label' => 'Gestão Clientes',
				],
				[
					'label' => 'Dashboard',
				],
			],
		];
	}

	public function dashboard() {
		return view('admin.pages.dashboards.dashboardProspection')->with('config', $this->config);
	}

	public function dashboardModelo() {
		[
			'header' => 'layouts.header',
			'group_page' => 'Prospecção',
			'url_group' => '/admin/prospection/dashboard',
			'module_page' => 'Dashboard',
			'url_page' => '/admin/prospection/dashboard',
			'title_page' => 'Dashboard',
			'fileView' => '',
		];

		return view('admin.pages.dashboards.dashboardProspection')->with('config', $this->config);
	}

	public function last30DaysPCX()
	{
		$result = DB::select("SELECT DATE_FORMAT(created_at, '%d/%m') AS date, flg_type, COUNT(1) AS count
		FROM leads
		WHERE deleted_at IS NULL AND created_at BETWEEN DATE_ADD(CURRENT_DATE(), INTERVAL -30 DAY) AND CURRENT_DATE()
		GROUP BY created_at, flg_type");

		$mappingResult = [];

		for ($i = count($result) - 1; $i > -1; $i--) {
			$mappingResult[$result[$i]->date][$result[$i]->flg_type] = $result[$i]->count;
		}

		$mapping = [];

		for ($i = 30; $i > -1; $i--) {
			$key = date('d/m', strtotime("-{$i} day"));

			$mapping['labels'][] = $key;
			$mapping['P'][] = isset($mappingResult[$key]['P']) ? $mappingResult[$key]['P'] : 0;
			$mapping['C'][] = isset($mappingResult[$key]['C']) ? $mappingResult[$key]['C'] : 0;
			$mapping['X'][] = isset($mappingResult[$key]['X']) ? $mappingResult[$key]['X'] : 0;
		}

		return $mapping;
	}
}
