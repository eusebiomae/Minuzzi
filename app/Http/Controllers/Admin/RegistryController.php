<?php

namespace App\Http\Controllers\AdminRegistry;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseMethodController;

use App\Model\api\Configuration\CityModel;
use App\Model\api\Configuration\LeadsStatusModel;
use App\Model\api\Configuration\StateModel;
use App\Model\api\Prospection\ClassModel;
use App\Model\api\Prospection\CourseModel;
use App\Model\api\Prospection\LeadsModel;
use App\Model\api\Prospection\RegistryModel;
use App\Model\api\Prospection\RegistryPhoneCallsModel;
use App\Model\api\UserModel;
use App\Model\api\Prospection\PaymentHistoryModel;

class RegistryController extends BaseMethodController {

	function __construct() {
		$this->pathView = 'admin/registry';
		$this->apiModel = new RegistryModel();

		$this->config = (object) [
			'pathView'  => $this->pathView,
			'urlAction' => $this->pathView,
			'toView' => [
				'header' => 'layouts.header',
				'group_page'  => 'Turma',
				'url_group'   => '#',
				'module_page' => 'Registro de Matricula',
				'url_page'    => $this->pathView,
			],
		];
	}

	private function getShowFormFields(Request $request)
	{
		$leadsModel = new LeadsModel();

		$showFormFields = getShowFormFields(
			[
				'table' => $leadsModel->getTable(),
				'idUser' => $request->user()->id,
				'fillable' => $leadsModel->fillable,
			]
		);

		return $showFormFields;
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->course = CourseModel::all();
		$list->class = ClassModel::all();
		$list->state = StateModel::all();
		$list->city = CityModel::all();
		$list->leads = LeadsModel::all();
		$list->consultant = UserModel::all();
		$list->leadsStatus = LeadsStatusModel::all();

		return $list;
	}

	public function list(Request $request) {
		$this->config->fileView = 'list';
		$this->config->toView['title_page'] = 'Listar';
		$this->config->toView['url_page_action'] = '';

		$listSelectBox = $this->getListSelectBox();

		$dataTable = new \stdClass();
		$dataTable->data = RegistryModel::withTrashed()->with('leads')->get();
		$dataTable->header = [
			(object) [
				'label' => 'ID',
				'column' => 'id',
			],
			(object) [
				'label' => 'Nome Aluno',
				'column' => 'leads.full_name',
			],
			(object) [
				'label' => 'Responsável Pagamento',
				'column' => 'responsible_name ',
			],
			(object) [
				'label' => 'CPF/CNPJ',
				'column' => 'responsible_cpf',
			],
			(object) [
				'label' => 'RG/Insc. Est',
				'column' => 'responsible_rg',
			],
			(object) [
				'label' => 'Contato',
				'column' => 'responsible_contact_name',
			],
			(object) [
				'label' => 'Telefone',
				'column' => 'responsible_contact_phone',
			],
			(object) [
				'label' => 'Celular',
				'column' => 'responsible_contact_cel_phone',
			],
			(object) [
				'label' => 'Email',
				'column' => 'esponsible_contact_email',
			],
			(object) [
				'label' => 'Consultor',
				'column' => 'user.name',
			],

		];

		$this->config->toView['dataTable'] = $dataTable;

		return parent::list($request)
		->with('listSelectBox', $listSelectBox);
	}

	public function insert(Request $request) {
		$this->config->fileView = 'form';
		$this->config->toView['title_page'] = 'Inserir';
		$this->config->toView['url_page_action'] = '/insert';
		$this->config->toView['title'] = 'Ficha cadastral do Aluno';
		$this->config->toView['subtitle'] = 'Cadastre todas as informações referente ao aluno em um único lugar.';

		$view = parent::insert($request);

		$lead = null;
		if ($request->idLead) {
			 $lead = LeadsModel::find($request->idLead);
		}

		$view->with('params', [
			'idLead' => $request->idLead ? $request->idLead : null,
		]);

		return $view
		->with('lead', $lead)
		->with('listSelectBox', $this->getListSelectBox())
		->with('configApp', (object) [
			'showFormFields' => $this->getShowFormFields($request),
		]);
	}

	public function update(Request $request) {
		$this->config->fileView = 'form';
		$this->config->toView['title_page'] = 'Editar';
		$this->config->toView['url_page_action'] = '/update';
		$this->config->toView['title'] = 'Ficha de edição do Aluno';
		$this->config->toView['subtitle'] = 'Edite todas as informações referente ao aluno em um único lugar.';

		$listSelectBox = $this->getListSelectBox();

		$view = parent::update($request);

		$view->with('params', [
			'idLead' => $view->data['leads_id'],
		]);

		$lead = null;
		if ($view->data['leads_id']) {
			 $lead = LeadsModel::find($view->data['leads_id']);
		}

		$view->with('paymentHistories', PaymentHistoryModel::where('registry_id', '=', $view->data['id'])->get());

		$phoneCall = RegistryPhoneCallsModel::where('registry_id', '=', $view->data['id'])->get();
		$view->with('phoneCall', $phoneCall);

		return $view
			->with('lead', $lead)
			->with('listSelectBox', $listSelectBox)
			->with('configApp', (object) [
				'showFormFields' => $this->getShowFormFields($request),
			]);
	}

	public function save(Request $request) {
		$request->paramsConfig = [
			'redirectBack' => false,
		];

		$save = parent::save($request);

		return redirect("/{$this->config->urlAction}/update/{$save->data->id}");
	}

	public function savePaymentHistory(Request $request) {
		$request->paramsConfig = [
			'redirectBack' => false,
		];

		$this->apiModel = new PaymentHistoryModel();

		$save = parent::save($request);

		return $save->data;
	}

	public function deletePaymentHistory(Request $request, $id) {
		return PaymentHistoryModel::find($id)->delete() ? 'OK' : 'ERROR';
	}

	public function savePhoneContact(Request $request) {
		$request['registry_id'] = $request->get('guest_book_id');
		$request['registry_status_id'] = $request->get('guest_book_status_id');

		$this->apiModel = new RegistryPhoneCallsModel();

		return parent::save($request);
	}
}
