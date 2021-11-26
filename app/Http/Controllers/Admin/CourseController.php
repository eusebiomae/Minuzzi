<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;
use App\Model\api\AdditionalModel;
use App\Model\api\CourseBonusCourseModel;
use App\Model\api\CourseFormPaymentModel;
use App\Model\api\CourseTeacherModel;
use App\Model\api\FormPaymentModel;
use App\Model\api\Prospection\CourseModel;
use App\Model\api\Prospection\CourseCategoryModel;
use App\Model\api\Prospection\CourseCategoryTypeModel;
use App\Model\api\Prospection\CourseSubcategoryModel;
use App\Model\api\Configuration\FunctionModel;
use App\Model\api\Configuration\GraduationModel;
use App\Model\api\Configuration\OfficeModel;
use App\Model\api\CourseAdditionalModel;
use App\Model\api\CourseDiscountModel;
use App\Model\api\PlaceModel;
use App\Model\api\Prospection\BonusCourseModel;
use App\Model\api\CourseModuleModel;
use App\Model\api\DiscountModel;
use App\Model\api\Prospection\ClassModel;
use App\Model\api\Prospection\ContentCourseModel;
use App\Model\api\TeamModel;

class CourseController extends BaseMethodAdminController {

  function __construct() {
		$this->pathFile = 'storage/course';
		$this->apiModel = CourseModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/course',
			'urlAction' => '/admin/course/save',
			'pathView'  => 'admin.pages.course',
			'pathViewDefault'  => 'admin.pages.course.form',
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
					'url' => '/admin/course',
					'label' => 'Cursos',
				],
			],
		];
	}

	private function getListSelectBox() {
		$list = (object) [];

		$list->courseCategory = CourseCategoryModel::orderBy('description_pt')->get();
		$list->place = PlaceModel::orderBy('description')->get();
		$list->team = TeamModel::orderBy('name')->get();
		$list->courseCategoryType = CourseCategoryTypeModel::orderBy('title')->get();
		$list->courseSubcategory = CourseSubcategoryModel::orderBy('description_pt')->get();
		$list->formPayment = FormPaymentModel::orderBy('description')->get();
		$list->bonusCourse = BonusCourseModel::orderBy('title_pt')->get();
		$list->function = FunctionModel::orderBy('description_pt')->get();
		$list->graduation = GraduationModel::orderBy('description_pt')->get();
		$list->office = OfficeModel::orderBy('description_pt')->get();
		$list->contentCourse = ContentCourseModel::orderBy('title_pt')->get();
		$list->additional = AdditionalModel::orderBy('title')->get();
		$list->discount = DiscountModel::orderBy('title')->get();

		return $list;
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar';
		$this->config->contentTitle = 'Lista de Produtos';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Tipo', 'data' => 'course_category_type.title', ],
			[ 'title' => 'Categoria', 'data' => 'course_category.description_pt', ],
			[ 'title' => 'Subcategoria', 'data' => 'course_subcategory.description_pt', ],
			[ 'title' => 'Titulo', 'data' => 'title_pt', ],

			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnDel' => $this->config->urlBase ],
		];

		return parent::list($request)
		->with('dataTable', parent::getListEnableDisable((object) [
			'dataTableHeader' => $dataTableHeader,
			'apiModel' => $this->apiModel::query()->with([
				'courseCategoryType',
				'courseCategory',
				'courseSubcategory',
			]),
		]));
	}

	function insert(Request $request) {
		$this->config->title = 'Inserir Produtos';
		$this->config->contentTitle = 'Cadastre todas as informações referente a Produtos.';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox())
		->with('payload', null);
	}

	public function update(Request $request) {
		$this->config->title = 'Editar Produtos';
		$this->config->fileView = 'form';

		$listSelectBox = $this->getListSelectBox();

		$data = $this->apiModel::with([
			'bonusCourse',
			'teacher',
			'courseModule',
			'courseFormPayment',
			'courseAdditional',
			'courseDiscount',
		])->find($request->id);

		// return $data->courseFormPayment;

		return parent::update($request)
		->with('listSelectBox', $listSelectBox)
		->with('payload', [ 'data' => $data ]);

		/*
		->with('payload', (object) [
			'bonusCourse' => CourseBonusCourseModel::where('course_id', $view->data['id'])->get(),
			'teacher' => CourseTeacherModel::where('course_id', $view->data['id'])->orderBy('description')->get(),
			'courseModule' => CourseModuleModel::where('course_id', $view->data['id'])->whereNull('class_id')->orderBy('sequence')->get(),
			'courseFormPayment' => CourseFormPaymentModel::where('course_id', $view->data['id'])->orderBy('id')->get(),
			'courseAdditional' => CourseAdditionalModel::where('course_id', $view->data['id'])->orderBy('id')->get(),
			'courseDiscount' => CourseDiscountModel::where('course_id', $view->data['id'])->whereHas('discount')->orderBy('id')->get(),
			'class' => [
				'data' => ClassModel::with([ 'city' ])->where('course_id', $view->data['id'])->orderBy('name')->get(),
				'header' => [
					[ 'title' => 'ID', 'data' => 'id', ],
					[ 'title' => 'Nome', 'data' => 'name', ],
					[ 'title' => 'Cidade', 'data' => 'city.name', ],
					[ 'title' => 'Data Início', 'data' => 'start_date', ],
					[ 'title' => 'Data prevista de finalização', 'data' => 'end_date', ],
					[
						'title' => 'Editar',
						'className' => 'center',
						'width' => '100px',
						'btnUpd' => '/admin/prospection/class',
					],
				]
			]
		]);*/
	}

	public function save(Request $request) {
		$request->paramsConfig = [
			'redirectBack' => false,
		];

		// return CourseModel::with('courseModule')->find($request->get('id'));

		if (!empty($request->file('fileImage'))) {
			$fileName = formatNameFile($request->file('fileImage')->getClientOriginalName());

			$request->file('fileImage')->move($this->pathFile, $fileName);
			$request['img'] = $fileName;
		}

		if (!$request->get('show_home')) {
			$request['show_home'] = null;
		}

		if (!$request->get('best_seller')) {
			$request['best_seller'] = " ";
		}

		if (!$request->get('new_flavor')) {
			$request['new_flavor'] = " ";
		}

		if (!$request->get('inactive')) {
			$request['inactive'] = null;
		}

		$save = parent::save($request);

		$formPayment = $request->get('formPayment');
		if (!empty($formPayment)) {
			foreach ($formPayment as $key => &$value) {
				if (empty($value['form_payment_id'])) {
					unset($formPayment[$key]);
					continue;
				}

				if (empty($value['id'])) {
					unset($value['id']);
				}

				$value = (new CourseFormPaymentModel($value))->toArray();
			}
		}

		$save->formPayment()->sync($formPayment);
		$save->bonusCourse()->sync($request->get('bonusCourse'));

		$teacher = $request->get('teacher');
		if (!empty($teacher)) {
			foreach ($teacher as $key => &$value) {
				if (empty($value['team_id'])) {
					unset($teacher[$key]);
					continue;
				}

				if (empty($value['id'])) {
					unset($value['id']);
				}
			}
		}
		$save->teacher()->sync($teacher);

		$module = $request->get('module');
		CourseModuleModel::where('course_id', $save->id)->delete();
		if (!empty($module)) {
			foreach ($module as $key => &$value) {
				if (empty($value['content_course_id'])) {
					unset($module[$key]);
					continue;
				}

				$value['course_id'] = $save->id;

				if (empty($value['id'])) {
					unset($value['id']);
				}

				(new CourseModuleModel)->fill($value)->save();
			}
		}

		$additional = $request->get('additional');

		$courseId = $save->id;
		if (empty($additional)) {
			CourseAdditionalModel::where('course_id', $courseId)->delete();
		} else {
			$additionalIds = [];
			foreach ($additional as $key => &$value) {
				if (empty($value['additional_id'])) {
					continue;
				}

				if (empty($value['id'])) {
					unset($value['id']);
					$courseAdditionalModel = new CourseAdditionalModel;
				} else {
					$courseAdditionalModel = CourseAdditionalModel::find($value['id']);

					if (!$courseAdditionalModel) {
						$courseAdditionalModel = new CourseAdditionalModel;
					}
				}

				$value['course_id'] = $courseId;

				$courseAdditionalModel->fill($value)->save();
				$additionalIds[] = $courseAdditionalModel->id;
			}

			if (count($additionalIds)) {
				CourseAdditionalModel::where('course_id', $courseId)->whereNotIn('id', $additionalIds)->delete();
			}
		}

		$discount = $request->get('discount');

		$courseId = $save->id;
		if (empty($discount)) {
			CourseDiscountModel::where('course_id', $courseId)->delete();
		} else {
			$discountIds = [];
			foreach ($discount as $key => &$value) {
				if (empty($value['discount_id'])) {
					continue;
				}

				if (empty($value['id'])) {
					unset($value['id']);
					$courseAdditionalModel = new CourseDiscountModel;
				} else {
					$courseAdditionalModel = CourseDiscountModel::find($value['id']);

					if (!$courseAdditionalModel) {
						$courseAdditionalModel = new CourseDiscountModel;
					}
				}

				$value['course_id'] = $courseId;

				$courseAdditionalModel->fill($value)->save();
				$discountIds[] = $courseAdditionalModel->id;
			}

			if (count($discountIds)) {
				CourseDiscountModel::where('course_id', $courseId)->whereNotIn('id', $discountIds)->delete();
			}
		}

		if ($save->action === 'I') {
			return redirect("/{$this->config->urlAction}/update/{$save->id}");
		} else {
			return redirect()->back();
		}
	}

	public function delete(Request $request, $id) {
		$withInput = [ 'swal' => null ];

		if (ClassModel::where('course_id', $id)->first()) {
			$withInput['swal'] = [
				'type' => 'warning',
				'title' => 'Não é possível inativar esse produto, pois existe turma ativa vinculada ao mesmo',
				'confirmButtonColor' => '#DD6B55',
			];
		} else {
			$data = $this->apiModel::find($id);

			if ($data) {
				$data->delete();
			}
		}

		return redirect()->back()->withInput($withInput);
	}

}
