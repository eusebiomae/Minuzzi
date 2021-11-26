<?php

namespace App\Http\Controllers\Admin\RoutineManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseMethodSystemController;
use Illuminate\Support\Facades\DB;

class DashboardController extends BaseMethodSystemController
{

	public function dashboard() {
		return view('admin.routineManagement.dashboardRoutineManagement', [
			'header' => 'layouts.header',
			'group_page' => 'Gestão Rotina',
			'url_group' => '/admin/routine_management/dashboard',
			'module_page' => 'Dashboard',
			'url_page' => '/admin/routine_management/dashboard',
			'title_page' => 'Dashboard Gestão Rotina',
			'fileView' => '',
		]);
	}

}
