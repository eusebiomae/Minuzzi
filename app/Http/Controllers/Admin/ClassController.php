<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;
use App\Model\api\ClassesModel;
use App\Model\api\ClassTeacherModel;
use App\Model\api\Prospection\ClassModel;
use App\Model\api\Prospection\CourseModel;
use App\Model\api\Configuration\CityModel;
use App\Model\api\CourseDefaultValueModel;
use App\Model\api\CourseFormPaymentModel;
use App\Model\api\Configuration\StateModel;
use App\Model\api\TeamModel;
use App\Model\api\PlaceModel;
use App\Model\api\Configuration\FunctionModel;
use App\Model\api\Configuration\GraduationModel;
use App\Model\api\Configuration\OfficeModel;
use App\Model\api\ContractModel;
use App\Model\api\CourseModuleModel;
use App\Model\api\OrderModel;
use App\Model\api\PeriodicityModel;
use App\Model\api\Prospection\ContentCourseModel;
use App\Model\api\Prospection\CourseCategoryModel;
use App\Model\api\Prospection\CourseCategoryTypeModel;
use App\Model\api\Prospection\CourseSubcategoryModel;
use App\Model\api\Prospection\VideoModel;
use App\Utils\StudentClassControlUtils;

class ClassController extends BaseMethodAdminController {

  function __construct() {
		$this->apiModel = ClassModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/class',
			'urlAction' => '/admin/class/save',
			'pathView'  => 'admin.pages.classGroup',
			'pathViewInclude'  => 'admin.pages.classGroup.form',
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
					'url' => '/admin/class',
					'label' => 'Turmas',
				],
			],
		];
	}

	private function getListSelectBox() {
		$list = new \stdClass();

		$list->courseCategoryType = CourseCategoryTypeModel::orderBy('title')->get();
		$list->courseCategory = CourseCategoryModel::orderBy('description_pt')->get();
		$list->courseSubcategory = CourseSubcategoryModel::orderBy('description_pt')->get();
		$list->contentCourse = ContentCourseModel::orderBy('description_pt')->get();
		$list->course = CourseModel::with('contentCourse')->orderBy('title_pt')->get();
		$list->city = CityModel::orderBy('name')->get();
		$list->team = TeamModel::orderBy('name')->get();
		$list->place = PlaceModel::orderBy('description')->get();
		$list->state = StateModel::orderBy('abbreviation')->get();
		$list->function = FunctionModel::orderBy('description_pt')->get();
		$list->graduation = GraduationModel::orderBy('description_pt')->get();
		$list->office = OfficeModel::orderBy('description_pt')->get();
		$list->video = VideoModel::orderBy('title')->where('type', 'A')->get();
		$list->contract = ContractModel::orderBy('title')->get();
		$list->periodicity = PeriodicityModel::get();

		return $list;
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Turmas';
		$this->config->contentTitle = 'Lista de Turmas';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Nome', 'data' => 'name', ],
			[ 'title' => 'Cidade', 'data' => 'city.name', ],
			[ 'title' => 'Curso', 'data' => 'course.title_pt', ],
			[ 'title' => 'Data Início', 'data' => 'start_date', ],
			[ 'title' => 'Data prevista de finalização', 'data' => 'end_date', ],

			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnDel' => $this->config->urlBase ],
		];

		return parent::list($request)
		->with('dataTable', parent::getListEnableDisable((object) [
			'dataTableHeader' => $dataTableHeader,
			'apiModel' => $this->apiModel::query()->with([
				'course',
				'city',
			]),
		]));
	}

	public function insert(Request $request) {
		$this->config->title = 'Inserir Turma';
		$this->config->contentTitle = 'Cadastre todas as informações referente a Turma.';
		$this->config->breadcrumbs[] = [ 'label' => 'Inserir' ];

		return parent::insert($request)
		->with('listSelectBox', $this->getListSelectBox())
		->with('payload', null);
	}

	public function update(Request $request) {
		$this->config->title = 'Editar Turma';
		$this->config->fileView = 'form';

		$listSelectBox = $this->getListSelectBox();

		$data = $this->apiModel::with([
			'teacher',
			'courseFormPayment',
			'courseModule',
			'classes',
			'courseDefaultValue',
		])->find($request->id);

		return parent::update($request)
		->with('listSelectBox', $listSelectBox)
		->with('payload', [ 'data' => $data ]);


		// ->with('payload', (object) [
		// 	'courseDefaultValue' => CourseDefaultValueModel::where('course_id', $view->data['course_id'])->where('class_id', $view->data['id'])->first(),
		// 	'teacher' => ClassTeacherModel::with(['team'])->where('class_id', $view->data['id'])->orderBy('description')->get(),
		// 	'courseFormPayment' => CourseFormPaymentModel::where('class_id', $view->data['id'])->orderBy('id')->get(),
		// 	'courseModule' => CourseModuleModel::where('class_id', $view->data['id'])->whereNull('course_id')->orderBy('sequence')->get(),
		// 	'classes' => ClassesModel::with([ 'videoLesson' ])->where('class_id', $view->data['id'])->orderBy('sequence')->get(),
		// ]);
	}

	public function save(Request $request) {
		$request->paramsConfig = [
			'redirectBack' => false,
		];

		// busca os dados antigos da turma para comparar se ouve alterações no curso
		$class = null;
		if ($request->get('id')) {
			$class = $this->apiModel::find($request->get('id'));
		}

		$saveData = parent::save($request);

		// altera o curso de todas as inscrições que dessa turma
		if ($class && $request->get('course_id') != $class->course_id) {
			OrderModel::where('class_id', $class->id)->update([
				'course_id' => $request->get('course_id'),
			]);
		}

		if ($request->get('course_default_value')) {
			$courseDefaultValue = CourseDefaultValueModel::where('course_id', $request->get('course_id'))->first();

			if (!$courseDefaultValue) {
				$courseDefaultValue = new CourseDefaultValueModel;
			}

			$courseDefaultValue->fill([
				'course_id' => $request->get('course_id'),
				'class_id' => $saveData->id,
			])->save();
		}

		// $formPayment = $request->get('formPayment');
		// if (empty($formPayment)) {
		// 	$courseDefaultValue = CourseDefaultValueModel::with('courseFormPayment')->where('course_id', $request->get('course_id'))->first();

		// 	if ($courseDefaultValue) {
		// 		$formPayment = [];
		// 		foreach ($courseDefaultValue->courseFormPayment as $courseFormPayment) {
		// 			$formPayment[] = [
		// 				'form_payment_id' => $courseFormPayment->form_payment_id,
		// 				'value' => $courseFormPayment->value,
		// 				'parcel' => $courseFormPayment->parcel,
		// 				'flg_main' => $courseFormPayment->flg_main,
		// 			];
		// 		}
		// 	}
		// } else {

		// 	foreach ($formPayment as $key => &$value) {
		// 		if (empty($value['form_payment_id'])) {
		// 			unset($formPayment[$key]);
		// 			continue;
		// 		}

		// 		if (empty($value['id'])) {
		// 			unset($value['id']);
		// 		}
		// 	}
		// }
		// $saveData->formPayment()->sync($formPayment);

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
		$saveData->teacher()->sync($teacher);

		$module = $request->get('module');
		CourseModuleModel::where('class_id', $saveData->id)->delete();
		if (!empty($module)) {
			foreach ($module as $key => &$value) {
				if (empty($value['content_course_id'])) {
					unset($module[$key]);
					continue;
				}

				$value['class_id'] = $saveData->id;

				if (empty($value['id'])) {
					unset($value['id']);
				}

				(new CourseModuleModel)->fill($value)->save();
			}
		}

		$classes = $request->get('classes');

		if (empty($classes)) {
			ClassesModel::where('class_id', $saveData->id)->delete();
		} else {
			$classIds = [];
			foreach ($classes as $key => &$value) {
				if (empty($value['content_course_id'])) {
					continue;
				}

				if (empty($value['id'])) {
					unset($value['id']);
					$classesModel = new ClassesModel;
				} else {
					$classesModel = ClassesModel::find($value['id']);

					if (!$classesModel) {
						$classesModel = new ClassesModel;
					}
				}

				$value['class_id'] = $saveData->id;
				$value['course_id'] = $saveData->course_id;

				$videoLessons = [];

				if (isset($value['videoLessons'])) {
					for ($i = 0, $ii = count($value['videoLessons']); $i < $ii; $i++) {
						$videoLessons[] = [
							'video_lesson_id' => $value['videoLessons'][$i],
						];
					}
				}

				unset($value['videoLessons']);

				$classesModel->fill($value)->save();
				$classesModel->videoLesson()->sync($videoLessons);
				$classIds[] = $classesModel->id;
			}

			if (count($classIds)) {
				ClassesModel::where('class_id', $saveData->id)->whereNotIn('id', $classIds)->delete();
			}
		}
		// (new StudentClassControlUtils)->generateByClass($saveData->id);

		/*$contentCourse = $request->get('contentCourse');
		ClassContentCourseModel::where('class_id', $saveData->id)->delete();
		if (!empty($contentCourse)) {

			foreach ($contentCourse as $key => &$value) {
				if (empty($value['content_course_id'])) {
					unset($contentCourse[$key]);
					continue;
				}

				$videoLessons = [];

				if (isset($value['videoLessons'])) {
					for ($i = 0, $ii = count($value['videoLessons']); $i < $ii; $i++) {
						$videoLessons[] = [
							'video_lesson_id' => $value['videoLessons'][$i],
						];
					}
				}

				unset($value['videoLessons']);

				$classContentCourse = new ClassContentCourseModel;

				if (empty($value['id'])) {
					unset($value['id']);
					$value['class_id'] = $saveData->id;
				} else {
					$classContentCourse = $classContentCourse::withTrashed()->find($value['id']);
					$classContentCourse->restore();
				}

				$classContentCourse->fill($value)->save();

				$classContentCourse->videoLesson()->sync($videoLessons);
			}
		}*/

		return redirect($this->config->urlBase);
	}

	public function delete(Request $request, $id) {
		$withInput = [ 'swal' => null ];

		if (OrderModel::where('class_id', $id)->first()) {
			$withInput['swal'] = [
				'type' => 'warning',
				'title' => 'Não é possível inativar essa turma, pois existe inscrição ativa vinculada a mesma',
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
