<?php

namespace App\Http\Controllers\Admin\Prospection\Leads;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseMethodAdminController;
use App\Model\api\Configuration\AnswerModel;
use App\Model\api\Prospection\LeadsModel;
use App\Model\api\Prospection\LeadsPhoneCallModel;

use App\Model\api\Configuration\StateModel;
use App\Model\api\Configuration\CityModel;
use App\Model\api\Configuration\LeadsStatusModel;
use App\Model\api\Prospection\CourseCategoryModel;
use App\Model\api\Prospection\CourseModel;
use App\Model\api\ResponsibleSellerModel;
use App\Model\api\UserModel;
use App\Model\ConfigAppModel;

use File;

class LeadsController extends BaseMethodAdminController
{

	function __construct() {
		$this->apiModel = new LeadsModel;
		$this->config = (object) [
			'urlBase' => '/admin/prospection/prospect',
			'urlAction' => '/admin/prospection/prospect/save',
			'pathView'  => 'admin.pages.leads',
			'pathViewInclude'  => 'admin.pages.leads.form',
			'pathFile' => 'storage/prospect',
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
					'url' => '/admin/prospection/prospect',
					'label' => 'Prospects',
				],
				[
					'label' => 'Lista',
				],
			],
		];
	}

	private function updateTypeUrl(Request $request)
	{
		switch ($request->flg_type) {
			case 'C':
				$this->config->urlAction = $this->config->toView['url_page'] = 'admin/prospection/client';
				$this->config->toView['module_page'] = 'Clientes';
				break;
			case 'X':
				$this->config->urlAction = $this->config->toView['url_page'] = 'admin/prospection/former_client';
				$this->config->toView['module_page'] = 'Ex clientes';
				break;
		}
	}

	private function getListSelectBox()
	{
		$list = [];

		$list['state'] = StateModel::all();
		$list['city'] = CityModel::all();
		$list['course'] = CourseModel::all();
		$list['courseCategory'] = CourseCategoryModel::all();

		return $list;
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components.view';
		$this->config->pathViewInclude = 'admin.pages.leads.list';
		$this->config->fileView = '';
		$this->config->title = 'Listar';
		$this->updateTypeUrl($request);

		$dataTable = new \stdClass();
		// $dataTable->urlPage = $this->config->urlAction;
 		// $dataTable->header = (new ConfigAppModel())->getShowListFields('leads', $request->user()->id);
		// $dataTable->classColumn = [
		// 	'phone' => 'mask-cellphone',
		// 	'whatsapp' => 'mask-cellphone',
		// ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', ],
			[ 'title' => 'Nome', 'data' => 'name', ],

			[ 'title' => '', 'className' => 'center', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center', 'btnDel' => $this->config->urlBase ],
		];

		$dataTable->header = $dataTableHeader;
		$dataTable->data = $this->getDataTables($request);

		return parent::list($request)
			->with('dataTable', $dataTable)
			->with('flgType', $request['flgType'])
			->with('filter', [
				'is_formed_in_psychology' => $request->get('is_formed_in_psychology'),
				'course' => $request->get('course'),
			])
			->with(
				'listSelectBox',
				[
					'courseCategory' => CourseCategoryModel::all(),
					'course' => CourseModel::all(),
				]
			);
	}

	public function insert(Request $request)
	{
		$this->updateTypeUrl($request);
		$showFormFields = (new ConfigAppModel())->getShowFormFields('leads', $request->user()->id, $this->apiModel->fillable);

		// $this->config->fileView = 'form';
		// $this->config->toView['title_page'] = 'Inserir';
		// $this->config->toView['url_page_action'] = '/insert';
		// $this->config->toView['title'] = 'Ficha cadastral do Aluno';
		// $this->config->toView['subtitle'] = 'Cadastre todas as informações referente ao aluno em um único lugar.';

		$this->config->pathView = 'admin.components.form';
		$this->config->pathViewInclude = 'admin.pages.leads.form';
		$this->config->fileView = '';
		$this->config->title = 'Editar';
		$this->updateTypeUrl($request);

		$listSelectBox = $this->getListSelectBox();
		$listSelectBox['usersConsultant'] = UserModel::where('consultant', 'S')->get();
		$listSelectBox['leadsStatus'] = LeadsStatusModel::all();

		return parent::insert($request)
			->with('listSelectBox', $listSelectBox)
			->with(
				'configApp',
				(object) [
					'showFormFields' => $showFormFields,
				]
			);
	}

	public function update(Request $request)
	{
		$this->updateTypeUrl($request);
		$showFormFields = (new ConfigAppModel())->getShowFormFields($this->apiModel->getTable(), $request->user()->id, $this->apiModel->fillable);

		$this->config->fileView = 'form';
		$this->config->toView['title_page'] = 'Editar';
		$this->config->toView['url_page_action'] = '/update';
		$this->config->toView['title'] = 'Ficha de edição do Lead';
		$this->config->toView['subtitle'] = 'Edite todas as informações referente ao lead em um único lugar.';

		$listSelectBox = $this->getListSelectBox();
		$listSelectBox['usersConsultant'] = UserModel::where('consultant', 'S')->get();
		$listSelectBox['leadsStatus'] = LeadsStatusModel::all();

		$view = parent::update($request);

		$view->data->is_formed_in_psychology = $view->data->is_formed_in_psychology == 'Sim' ? 1 : null;

		foreach ($this->apiModel->levelOfInterest as $key => $value) {
			if ($value == $view->data->level_of_interest) {
				$view->data->level_of_interest = $key;
				break;
			}
		}

		$phoneCall = $this->phoneContactList($request);

		if ($view->data) {
			$responsibleSellers = ResponsibleSellerModel::where('leads_id', $view->data->id)->get();
			$view->data->responsibleSeller = [];

			foreach ($responsibleSellers as $responsibleSeller) {
				$view->data->responsibleSeller[] = $responsibleSeller->user_id;
			}
		}

		return $view
			->with('listSelectBox', $listSelectBox)
			->with('phoneCall', $phoneCall)
			->with('configApp', (object) [
				'showFormFields' => $showFormFields,
			]);
	}

	public function save(Request $request)
	{
		$this->updateTypeUrl($request);

		$request->paramsConfig = [
			'redirectBack' => false,
		];

		if (!empty($request->file('fileImage'))) {
			$fileName = formatNameFile($request->file('fileImage')->getClientOriginalName());

			$request->file('fileImage')->move($this->pathFile, $fileName);
			$request['img'] = $fileName;
		}

		if (!isset($request->is_formed_in_psychology)) {
			$request['is_formed_in_psychology'] = null;
		}

		$save = parent::save($request);

		$save->data->seller()->sync($request->get('responsibleSeller') ? $request->get('responsibleSeller') : []);

		return redirect("/{$this->config->urlAction}/update/{$save->data->id}");
	}

	public function phoneContactList(Request $request)
	{
		$leadsPhoneCallModel = new LeadsPhoneCallModel;
		$dataTable = new \stdClass();
		$dataTable->data = $leadsPhoneCallModel->with('answers.question')->withTrashed()->where('leads_id', $request->id)->get();
		$dataTable->header = (new ConfigAppModel())->getShowListFields($leadsPhoneCallModel->getTable(), $request->user()->id);
		$dataTable->dataHidden = true;

		return [
			'url_page' => 'admin/prospection/prospect/phone_contact',
			'modal' => true,
			'data_target_modal' => 'myModal',
			'dataTable' => $dataTable,
			'questions' => $leadsPhoneCallModel->getQuestions(),
		];
	}

	public function phoneContactSave(Request $request)
	{
		$request->paramsConfig = [
			'redirectBack' => false,
		];

		$this->apiModel = new LeadsPhoneCallModel();

		$save = parent::save($request);

		$question = $request->get('question');

		if ($question) {
			$questionAnswer = [];

			foreach ($question as $questionId => $alternative) {
				foreach ($alternative as $flgType => $answer) {
					switch ($flgType) {
						case '1':
						case '2':
						case '4':
							$questionAnswer[] = [
								'leads_phone_call_id' => $save->data->id,
								'question_id' => $questionId,
								'answer' => $answer,
							];
							break;
						case '3':
							for ($i= count($answer) - 1; $i > -1 ; $i--) {
								$questionAnswer[] = [
									'leads_phone_call_id' => $save->data->id,
									'question_id' => $questionId,
									'answer' => $answer[$i],
								];
							}
							break;
					}
				}
			}

			AnswerModel::where('leads_phone_call_id', $save->data->id)->delete();
			AnswerModel::insert($questionAnswer);
		}

		return redirect()->back();
	}

	function phoneContactDelete(Request $request, $id)
	{
		$data = LeadsPhoneCallModel::find($id);

		if (!$data) {
			return response()->json([
				'message'   => 'Record not found',
			], 404);
		}

		$data->delete();

		return redirect()->back();
	}

	function phoneContactEnable(Request $request, $id)
	{
		$data = LeadsPhoneCallModel::withTrashed()->find($id);

		if (!$data) {
			return response()->json([
				'message'   => 'Record not found',
			], 404);
		}

		$data->restore();

		return redirect()->back();
	}

	public function getJson(Request $request)
	{
		$list = LeadsModel::where('flg_type', $request->flg_type)
			->with('leadsVisit')
			->with('leadsVisit.course')
			->with('leadsVisit.consultant')
			->get();

		return $list;
	}

	public function getDataTables(Request $request)
	{
		$list = LeadsModel::withTrashed()->with(['course', 'courseCategory'])->where('flg_type', $request->flg_type);

		if ($request->get('is_formed_in_psychology') == '1') {
			$list->where('is_formed_in_psychology', $request->get('is_formed_in_psychology'));
		} else
		if ($request->get('is_formed_in_psychology') == '0') {
			$list->whereNull('is_formed_in_psychology');
		}

		if (!empty($request->get('course_category'))) {
			$list->where('course_category_id',  $request->get('course_category'));
		}

		if (!empty($request->get('course'))) {
			$list->where('course_id',  $request->get('course'));
		}

		if (empty($request->get('course')) && empty($request->get('is_formed_in_psychology'))) {
			$list->whereRaw('created_at > CURRENT_DATE - INTERVAL 12 MONTH');
		}

		return [ 'data' => $list->get() ];
	}

	public function import(Request $request)
	{
		set_time_limit(3600);
		if ($request->file('import')) {

			$dataXlsx = normalizeDataSpreadsheet($request->file('import'));
			$header = [];

			foreach ($dataXlsx['header'] as $idx => $label) {
				if (preg_match('/nome/i', $label)) {
					$header[$idx] = 'student_name';
				} elseif (preg_match('/email|e[ _-]mail/i', $label)) {
					$header[$idx] = 'email';
				} elseif (preg_match('/whatsapp/i', $label)) {
					$header[$idx] = 'whatsapp';
				} elseif (preg_match('/telefone/i', $label)) {
					$header[$idx] = 'phone';
				} elseif (preg_match('/cidade/i', $label)) {
					$header[$idx] = 'city';
				} elseif (preg_match('/formado.+em.psicologia/i', $label)) {
					$header[$idx] = 'is_formed_in_psychology';
				} elseif (preg_match('/(n(i|í)vel).interesse/i', $label)) {
					$header[$idx] = 'level_of_interest';
				}
			}

			$sellers = UserModel::where('consultant', 'S')->get();
			$sellersCount = count($sellers);

			$rows = [];
			for ($i = 0, $ii = count($dataXlsx['rows']); $i < $ii; $i++) {
				$row = $dataXlsx['rows'][$i];
				$data = [];

				foreach ($header as $idx => $column) {
					$value = $row[$idx];

					switch ($column) {
						case 'whatsapp':
						case 'phone':
							$value = preg_replace('/\D/', '', $value);
							break;
						case 'is_formed_in_psychology':
							$value = preg_match('/sim/i', $value) ? 1 : null;
							break;
						case 'level_of_interest':
							$value = preg_match('/im(é|e)diato/i', $value, $matches) ? 1 : (preg_match('/futuro/i', $value) ? 2 : (preg_match('/n(a|ã)o.sei.responder/i', $value) ? 3 : null));
							break;
					}

					$data[$column] = $value;
				}

				if (isset($data['email']) && !LeadsModel::where('email', $data['email'])->whereOr('commercial_email', $data['email'])->exists()) {
					$data['course_category_id'] = $request->course_category;
					$data['flg_type'] = $request->flg_type;
					// $rows[] = $this->normalizeToSave($data);
					$lead = LeadsModel::create($this->normalizeToSave($data));
					$lead->seller()->sync([ $sellers[rand(0, $sellersCount - 1)]->id ]);
				}
			}

			// if (count($rows)) {
			// 	$this->apiModel->insert($rows);
			// }
		}

		return redirect()->back();
	}

	public function existsEmail(Request $request)
	{

		$dao = LeadsModel::where('email', $request->email)->whereOr('commercial_email', $request->email);

		if (isset($request->id)) {
			$dao->where('id', '!=', $request->id);
		}

		$data = $dao->first();

		return $data ? $data->id : null;
	}
}
