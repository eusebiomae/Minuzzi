<?php

namespace App\Http\Controllers\Admin\Prospection\GuestBook;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseMethodController;
use App\Model\api\Configuration\AnswerModel;
use App\Model\api\Configuration\CityModel;
use App\Model\api\Configuration\GuestBookStatusModel;
use App\Model\api\Configuration\QuestionModel;
use App\Model\api\Configuration\StateModel;
use App\Model\api\Prospection\CourseModel;
use App\Model\api\Prospection\GuestBookModel;
use App\Model\api\Prospection\GuestBookPhoneCallsModel;
use App\Model\api\Prospection\LeadsModel;
use App\Model\api\Prospection\LeadsVisitModel;
use App\Model\api\UserModel;

class GuestBookController extends BaseMethodController
{

	function __construct()
	{
		$this->pathView = 'admin/prospection/guestBook';
		$this->apiModel = new GuestBookModel();

		$this->config = (object) [
			'pathView'  => $this->pathView,
			'urlAction' => 'admin/prospection/guestbook',
			'toView' => [
				'header' => 'layouts.header',
				'group_page'  => 'Gestão Clientes',
				'url_group'   => 'prospection',
				'module_page' => 'Livro de Visitas',
				'url_page'    => 'admin/prospection/guestbook',
			],
		];
	}

	private function getListSelectBox()
	{
		$list = (object) [];

		return $list;
	}

	public function list(Request $request)
	{
		$this->config->fileView = 'list';
		$this->config->toView['title_page'] = 'Listar';
		$this->config->toView['url_page_action'] = '';

		$listSelectBox = $this->getListSelectBox();

		$dataTable = new \stdClass();
		$dataTable->data = GuestBookModel::withTrashed()->whereNull('guest_book_id')->with('leads')->with('leadsVisit')->get();
		$dataTable->header = [
			(object) [
				'label' => 'ID',
				'column' => 'id',
			],
			(object) [
				'label' => 'Nome',
				'column' => 'leads.full_name',
			],
			(object) [
				'label' => 'Tefenone',
				'column' => 'leads.phone',
			],
			(object) [
				'label' => 'Celular',
				'column' => 'leads.cel_phone',
			],
			(object) [
				'label' => 'E-mail',
				'column' => 'leads.email',
			],
			(object) [
				'label' => 'Data',
				'column' => 'leads_visit.visit_date',
			],
			(object) [
				'label' => 'Consultor',
				'column' => 'leads_visit.consultant',
			],
		];

		$this->config->toView['dataTable'] = $dataTable;

		return parent::list($request)
			->with('listSelectBox', $listSelectBox);
	}

	public function insert(Request $request)
	{
		$this->config->fileView = 'form';
		$this->config->toView['title_page'] = 'Inserir';
		$this->config->toView['url_page_action'] = '/insert';
		$this->config->toView['title'] = 'Ficha cadastral do Aluno';
		$this->config->toView['subtitle'] = 'Cadastre todas as informações referente ao aluno em um único lugar.';

		$view = parent::insert($request);

		$listSelectBox = $this->getListSelectBox();
		$listSelectBox->state  = StateModel::all();
		$listSelectBox->city   = CityModel::all();
		$listSelectBox->course = CourseModel::all();
		$listSelectBox->usersConsultant = UserModel::where('consultant', 'S')->get();

		return $view
			->with('listSelectBox', $listSelectBox)
			->with('params', [
				'idLead' => $request->idLead,
				'idLeadsVisit' => $request->idLeadsVisit,
			])
			->with('configApp', (object) [
				'showFormFields' => [],
			]);
	}

	public function update(Request $request)
	{
		$this->config->fileView = 'form';
		$this->config->toView['title_page'] = 'Editar';
		$this->config->toView['url_page_action'] = '/update';
		$this->config->toView['title'] = 'Ficha de edição do Aluno';
		$this->config->toView['subtitle'] = 'Edite todas as informações referente ao aluno em um único lugar.';

		$listSelectBox = $this->getListSelectBox();

		// $listSelectBox->state  = StateModel::all();
		// $listSelectBox->city   = CityModel::all();
		// $listSelectBox->course = CourseModel::all();

		$listSelectBox->status = GuestBookStatusModel::all();

		$request->paramsConfig = [
			'findItem' => false,
		];

		$view = parent::update($request);

		$data = GuestBookModel::with('guestBook')->with('answers.question')->find($request->id);

		$view->with('data', $data);

		$phoneCall = GuestBookPhoneCallsModel::where('guest_book_id', $view->data['id'])->get();

		$view->with('phoneCall', $phoneCall);

		return $view
			->with('listSelectBox', $listSelectBox)
			->with('params', [
				'idLead' => $view->data['leads_id'],
				'idLeadsVisit' => $view->data['leads_visit_id'],
			])
			->with('configApp', (object) [
				'showFormFields' => [],
			]);
	}

	public function save(Request $request)
	{
		$request->paramsConfig = [
			'redirectBack' => false,
		];

		$save = parent::save($request);

		return redirect("/{$this->config->urlAction}/update/{$save->data->id}");
	}

	public function savePosVisit(Request $request)
	{
		$request->paramsConfig = [
			'redirectBack' => false,
		];

		$question = $request->get('question');
		$guestBookId = $request->get('guest_book_id');

		if ($guestBookId && $question) {
			$questionAnswer = [];

			foreach ($question as $questionId => $alternative) {
				foreach ($alternative as $flgType => $answer) {
					switch ($flgType) {
						case '1':
						case '2':
						case '4':
							$questionAnswer[] = [
								'guest_book_id' => $guestBookId,
								'question_id' => $questionId,
								'answer' => $answer,
							];
							break;
						case '3':
							for ($i= count($answer) - 1; $i > -1 ; $i--) {
								$questionAnswer[] = [
									'guest_book_id' => $guestBookId,
									'question_id' => $questionId,
									'answer' => $answer[$i],
								];
							}
							break;
					}
				}
			}

			AnswerModel::where('guest_book_id', $guestBookId)->delete();
			AnswerModel::insert($questionAnswer);
		}

		// return $request->all();

		// $save = parent::save($request);

		return redirect("/{$this->config->urlAction}/update/{$guestBookId}");
	}

	public function savePhoneContact(Request $request)
	{
		$this->apiModel = new GuestBookPhoneCallsModel();

		return parent::save($request);
	}

	public function saveLead(Request $request)
	{
		$this->apiModel = new LeadsModel();

		$save = parent::save($request);

		return $save;
	}

	public function saveLeadsVisit(Request $request)
	{
		$this->apiModel = new LeadsVisitModel();

		$save = parent::save($request);

		return $save;
	}

	public function getHTMLquestionPCX(Request $request)
	{
		$questions = QuestionModel::where('flg_source', 'guest_book')
			->where('flg_pcx', $request->flgType)
			->with('alternative')->get();

		return view(
			'admin._components.form_question',
			[
				'questions' => $questions,
			]
		);
	}
}
