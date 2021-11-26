<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseMethodController;
use App\Model\api\Configuration\BankModel;
use App\Model\api\Configuration\StateModel;
use App\Model\api\FormPaymentModel;
use App\Model\api\OrderModel;
use App\Model\api\StudentModel;

class RegistrationController extends BaseMethodController {
	function __construct() {
		$this->apiModel = new StudentModel();

		$this->config = (object) [
			'pathView' => 'admin/pages/registration',
			'urlAction' => 'admin/registration',
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->states = StateModel::orderBy('abbreviation')->get();

		return $list;
	}

	public function list(Request $request) {
		$this->config->fileView = 'list';
		$this->config->toView['title_page'] = 'Listar';
		$this->config->toView['url_page_action'] = '';

		$dataTable = new \stdClass();

		$dataTable->data = StudentModel::whereHas('order', function($query) {
			$query->where('status', 'AP');
		})->get();

		$dataTable->header = [
			(object) [
				'label' => 'ID',
				'column' => 'id',
			],
			(object) [
				'label' => 'Nome',
				'column' => 'name',
			],
			(object) [
				'label' => 'CPF',
				'column' => 'cpf',
			],
			(object) [
				'label' => 'E-mail',
				'column' => 'email',
			],
			(object) [
				'label' => 'Telefone',
				'column' => 'phone',
			],
			(object) [
				'label' => 'WhatsApp',
				'column' => 'cell_phone',
			],
			(object) [
				'label' => 'Cidade',
				'column' => 'city',
			],
		];

		$this->config->toView['dataTable'] = $dataTable;

		return parent::list($request);
	}

	// function insert(Request $request) {
	// 	$this->config->fileView = 'form';
	// 	$this->config->toView['title_page'] = 'Inserir';
	// 	$this->config->toView['url_page_action'] = '/insert';
	// 	$this->config->toView['title'] = 'Cadastro de Instrução';
	// 	$this->config->toView['subtitle'] = 'Edite todas as informações referente a Instrução em um único lugar.';

	// 	return parent::insert($request)
	// 	->with('listSelectBox', $this->getListSelectBox());
	// }

	function update(Request $request) {
		$this->config->fileView = 'form';
		$this->config->toView['title_page'] = 'Editar';
		$this->config->toView['url_page_action'] = '/update';
		$this->config->toView['title'] = 'Cadastro de Instrução';
		$this->config->toView['subtitle'] = 'Edite todas as informações referente a Instrução em um único lugar.';

		// $dataTable = new \stdClass();
		// $dataTable->data = StudentModel::withTrashed()->get();

		// $dataTable->header = [
		// 	(object) [
		// 		'label' => 'ID',
		// 		'column' => 'id',
		// 	],
		// 	(object) [
		// 		'label' => 'Tipo',
		// 		'column' => 'order.course.courseCategoryType.title',
		// 	],
		// 	(object) [
		// 		'label' => 'Categoria',
		// 		'column' => 'order.course.courseCategory.description_pt',
		// 	],
		// 	(object) [
		// 		'label' => 'Subcategoria',
		// 		'column' => 'order.course.courseSubcategory.description_pt',
		// 	],
		// 	(object) [
		// 		'label' => 'Curso',
		// 		'column' => 'order.course.title_pt',
		// 	],
		// 	(object) [
		// 		'label' => 'Turma',
		// 		'column' => 'order.class.name',
		// 	],
		// 	(object) [
		// 		'label' => 'Data',
		// 		'column' => 'order.created_at',
		// 	],
		// ];

		// $this->config->toView['dataTable'] = $dataTable;

		$view = view('admin/pages/registration/form')
		->with('payload', (object) [
			'student' => StudentModel::find($request['id']),
			'states' => StateModel::orderBy('abbreviation')->get(),
			'orders' => OrderModel::whereNotNull('course_id')
				->where('student_id', $request['id'])
				->with([
					'course.courseCategoryType',
					'course.courseCategory',
					'course.courseSubcategory',
					'class',
				])->get(),
		]);

		return $view;
	}

	function save(Request $request) {
		$request->paramsConfig = [
			'redirectBack' => false,
		];

		$save = parent::save($request);

		if ($save->action === 'I') {
			return redirect("/{$this->config->urlAction}/update/{$save->data->id}");
		} else {
			return redirect()->back();
		}
	}
}
