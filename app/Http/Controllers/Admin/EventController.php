<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;

use App\Model\api\EventModel;

use App\Model\api\Configuration\CalendarModel;
use App\Model\api\Configuration\CalendarPrivacyModel;
//use App\Model\api\Configuration\AulaStatusModel;

class EventController extends BaseMethodAdminController {

	function __construct() {
		$this->apiModel = EventModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/event',
			'urlAction' => '/admin/event/save',
			'pathView'  => 'admin.pages.event',
			'pathViewInclude'  => 'admin.pages.event.form',
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
					'url' => '/admin/event',
					'label' => 'Evento',
				],
			],
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->calendar = (new CalendarModel())->get();
		$list->calendarPrivacy = (new CalendarPrivacyModel())->get();

		return $list;
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Eventos';
		$this->config->contentTitle = 'Lista de Eventos';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Título', 'data' => 'title_pt', ],
			[ 'title' => 'Data', 'data' => 'event_date', ],
			[ 'title' => 'Hora', 'data' => 'event_time', ],
			[ 'title' => 'Local', 'data' => 'localization', ],
			[ 'title' => 'Calendário', 'data' => 'calendar.description_pt', ],
			[ 'title' => 'Privacidade', 'data' => 'calendar_privacy.description_pt', ],
			[ 'title' => 'Status', 'data' => 'status_label', ],
			[ 'title' => 'Reperir Todo ano', 'data' => 'annual_repeat_label', ],

			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnDel' => $this->config->urlBase ],
		];

		return parent::list($request)
		->with('dataTable', parent::getListEnableDisable((object) [
			'dataTableHeader' => $dataTableHeader,
			'apiModel' => $this->apiModel::query()->with([ 'calendar','calendarPrivacy' ]),
		]));
	}

	function insert(Request $request) {
		$this->config->title = 'Inserir Evento';
		$this->config->contentTitle = 'Criar novo Evento';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox());
	}

	function update(Request $request) {
		$this->config->title = 'Editar Evento';
		$this->config->contentTitle = 'Alterar Evento';
		$this->config->breadcrumbs[] = [ 'label' => 'Editar' ];

		$view = parent::update($request)
		->with('payload', ['data' => $this->apiModel::find($request->id),])
		->with('listSelectBox', $this->getListSelectBox());

		return $view;
	}

	function save(Request $request) {
		$date = empty($request['event_date']) ? null : preg_replace('/(\d{2})\/(\d{2})\/(\d{4})/', '$3-$2-$1', $request['event_date']);
		$time = empty($request['event_time']) ? '00:00' : $request['event_time'];

		if (empty($request['status'])) {
			$request['status'] = null;
		}
		if (empty($request['annual_repeat'])) {
			$request['annual_repeat'] = null;
		}

		$request['event_datetime'] = "{$date} {$time}:00";

		return parent::save($request);
	}

}
