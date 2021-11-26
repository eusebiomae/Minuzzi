<?php

namespace App\Http\Controllers\Admin\RoutineManagement;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseMethodSystemController;
use App\Model\api\UserModel;

class ReportGoalPCXController extends BaseMethodSystemController {
	private function getGoalPCX($dateColumn, $valueColumn, $dateWhere)
	{
		return DB::select("SELECT {$dateColumn} AS date, {$valueColumn}
		FROM goal_pcx
		WHERE deleted_at IS NULL
			AND {$dateColumn} = '{$dateWhere}'
		GROUP BY {$dateColumn}");
	}

	private function getGoalMonth($params)
	{
		return DB::select("SELECT DATE_FORMAT(date, '%d') AS date
			, goal
			, IF(finished = 1, 'OK', '-') AS finished
			, goal_executed
			, goal_planned
			, p_executed
			, c_executed
			, x_executed
			, p_planned
			, c_planned
			, x_planned
		FROM goal_pcx
		WHERE deleted_at IS NULL
			AND DATE_FORMAT(date, '%m/%Y') = '{$params['date']}'
			AND user_id = '{$params['seller']}'
		ORDER BY DATE_FORMAT(date, '%d')");
	}

	public function report(Request $request)
	{
		$sellers = UserModel::orderby('name')->get();

		return view('admin.routineManagement.reportGoalPCX', [
			'header' => 'layouts.header',
			'group_page' => 'Gestão Rotina',
			'url_group' => '/admin/routine_management/dashboard',
			'module_page' => 'Relatório',
			'url_page' => '/admin/routine_management/dashboard',
			'title_page' => 'Relatório Gestão Rotina',
			'fileView' => '',
			'sellers' => $sellers,
			'filter' => [
				'month' => date('m'),
				'seller' => $request->user()->id,
			],
		]);
	}

	public function getData(Request $request)
	{
		$day = $request->get('day');
		$month = $request->get('month');
		$year = $request->get('year');
		$previousMonth = ((int) $month) - 1;
		$previousMonth = $previousMonth < 10 ? '0' . $previousMonth : $previousMonth;
		$previousYear = ((int) $year) - 1;

		$date = "{$month}/{$year}";
		$salesMonth = $this->getGoalPCX('DATE_FORMAT(date, \'%m/%Y\')', '
			  SUM(goal_executed) AS value
			, SUM(goal_planned) AS goal_planned
			, SUM(p_executed) AS p_executed
			, SUM(c_executed) AS c_executed
			, SUM(x_executed) AS x_executed
			, SUM(p_planned) AS p_planned
			, SUM(c_planned) AS c_planned
			, SUM(x_planned) AS x_planned
		', $date);
		$salesMonth = count($salesMonth) ? $salesMonth[0] : [
			'date' => $date,
			'value' => 0,
		];

		$date = "{$day}/{$month}/{$year}";
		$salesDay = $this->getGoalPCX('DATE_FORMAT(date, \'%d/%m/%Y\')', 'SUM(goal_executed) AS value', $date);
		$salesDay = count($salesDay) ? $salesDay[0] : [
			'date' => $date,
			'value' => 0,
		];

		$previousYearComparison = DB::select("SELECT DATE_FORMAT(date, '%Y') AS date
				, SUM(p_executed) AS p_executed
				, SUM(c_executed) AS c_executed
				, SUM(x_executed) AS x_executed
			FROM goal_pcx
			WHERE deleted_at IS NULL
				AND DATE_FORMAT(date, '%Y') = '{$previousYear}'
			GROUP BY DATE_FORMAT(date, '%Y')");
		$previousYearComparison = count($previousYearComparison) ? (array) $previousYearComparison[0] : [
			'date' => $previousYear,
			'p_executed' => 0,
			'c_executed' => 0,
			'x_executed' => 0,
		];
		$previousYearComparison['total'] = $previousYearComparison['p_executed'] + $previousYearComparison['c_executed'] + $previousYearComparison['x_executed'];

		$yearComparison = DB::select("SELECT DATE_FORMAT(date, '%m/%Y') AS date
				, SUM(IFNULL(p_executed, 0) + IFNULL(c_executed, 0) + IFNULL(x_executed, 0)) AS executed
				, SUM(IFNULL(p_planned, 0) + IFNULL(c_planned, 0) + IFNULL(x_planned, 0)) AS planned
			FROM goal_pcx
			WHERE deleted_at IS NULL
				AND DATE_FORMAT(date, '%Y') = '{$year}'
			GROUP BY DATE_FORMAT(date, '%m/%Y')
			ORDER BY DATE_FORMAT(date, '%m/%Y')");

		$monthComparison = DB::select("SELECT DATE_FORMAT(date, '%d/%m/%Y') AS date
				, SUM(IFNULL(p_executed, 0) + IFNULL(c_executed, 0) + IFNULL(x_executed, 0)) AS executed
				, SUM(IFNULL(p_planned, 0) + IFNULL(c_planned, 0) + IFNULL(x_planned, 0)) AS planned
			FROM goal_pcx
			WHERE deleted_at IS NULL
				AND DATE_FORMAT(date, '%m/%Y') = '{$month}/{$year}'
			GROUP BY DATE_FORMAT(date, '%d/%m/%Y')
			ORDER BY DATE_FORMAT(date, '%d/%m/%Y')");

		$date = "{$previousMonth}/{$year}";
		$previousMonthComparison = DB::select("SELECT DATE_FORMAT(date, '%m/%Y') AS date
				, SUM(p_executed) AS p_executed
				, SUM(c_executed) AS c_executed
				, SUM(x_executed) AS x_executed
				, SUM(p_planned) AS p_planned
				, SUM(c_planned) AS c_planned
				, SUM(x_planned) AS x_planned
				, SUM(goal_executed) AS goal_executed
				, SUM(goal_planned) AS goal_planned
			FROM goal_pcx
			WHERE deleted_at IS NULL
				AND DATE_FORMAT(date, '%m/%Y') = '{$date}'
			GROUP BY DATE_FORMAT(date, '%m/%Y')");

		$previousMonthComparison = count($previousMonthComparison) ? (array) $previousMonthComparison[0] : [
			'date' => $date,
			'p_executed' => 0,
			'c_executed' => 0,
			'x_executed' => 0,
		];

		$previousMonthComparison['total'] = $previousMonthComparison['p_executed'] + $previousMonthComparison['c_executed'] + $previousMonthComparison['x_executed'];

		$date = "{$day}/{$month}/{$year}";
		$dayComparison = $this->getGoalPCX(
			'DATE_FORMAT(date, \'%d/%m/%Y\')',
			'SUM(IFNULL(p_executed, 0) + IFNULL(c_executed, 0) + IFNULL(x_executed, 0)) AS executed
				, SUM(IFNULL(p_planned, 0) + IFNULL(c_planned, 0) + IFNULL(x_planned, 0)) AS planned',
			$date
		);
		$dayComparison = count($dayComparison) ? $dayComparison[0] : [
			'date' => $date,
			'executed' => 0,
			'planned' => 0,
		];

		return [
			'salesMonth' => $salesMonth,
			'salesDay' => $salesDay,
			'yearComparison' => $yearComparison,
			'monthComparison' => $monthComparison,
			'dayComparison' => $dayComparison,
			'previousMonthComparison' => $previousMonthComparison,
			'previousYearComparison' => $previousYearComparison,
		];
	}

	public function getReport(Request $request) {
		$seller = $request->get('seller');
		$month = $request->get('month');
		$year = $request->get('year');
		$data = [];

		$date = "{$month}/{$year}";
		$data['goalMonth'] = $this->getGoalMonth([
			'date' => $date,
			'seller' => $seller,
		]);

		return $data;
	}
}
