<?php

use App\Model\api\AvaliationModel;
use App\Model\api\ClassesModel;
use App\Model\api\ConfigModel;
use App\Model\api\ContentModel;
use App\Model\api\OrderModel;
use App\Model\api\PageConfigModel;
use App\Model\api\Prospection\ClassModel;
use App\Model\api\Prospection\CourseCategoryModel;
use App\Model\api\Prospection\CourseCategoryTypeModel;
use App\Model\api\Prospection\CourseModel;
use App\Model\api\Prospection\CourseSubcategoryModel;
use App\Model\api\ScholarshipModel;
use App\Model\api\ScholarshipStudentModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

class GigaGetData
{

	const STATUS_ASAAS = [
		'PENDING' => 'Aguardando pagamento',
		'RECEIVED' => 'Recebida (saldo já creditado na conta)',
		'CONFIRMED' => 'Pagamento confirmado (saldo ainda não creditado)',
		'OVERDUE' => 'Vencida',
		'REFUNDED' => 'Estornada',
		'RECEIVED_IN_CASH' => 'Recebida em dinheiro (não gera saldo na conta)',
		'REFUND_REQUESTED' => 'Estorno Solicitado',
		'CHARGEBACK_REQUESTED' => 'Recebido chargeback',
		'CHARGEBACK_DISPUTE' => 'Em disputa de chargeback (caso sejam apresentados documentos para contestação)',
		'AWAITING_CHARGEBACK_REVERSAL' => 'Disputa vencida, aguardando repasse da adquirente',
		'DUNNING_REQUESTED' => 'Em processo de recuperação',
		'DUNNING_RECEIVED' => 'Recuperada',
		'AWAITING_RISK_ANALYSIS' => 'Pagamento em análise',
		'CANCELED' => 'Cancelado',
	];

	static public function filterDefaultClass()
	{
		return [
			'categoryType' => CourseCategoryTypeModel::orderBy('title')->get(),
			'category' => CourseCategoryModel::orderBy('description_pt')->get(),
			'subCategory' => CourseSubcategoryModel::orderBy('description_pt')->get(),
			'course' => CourseModel::orderBy('title_pt')->get(),
			'class' => ClassModel::orderBy('name')->get(),
		];
	}

	static public function getCategoryType()
	{
		return CourseCategoryTypeModel::select('id', 'flg', 'title')->orderBy('title')->get();
	}

	static public function getEvent()
	{
		return ContentModel::select('id', 'title_pt', 'link')->where('visible_event', 1)->first();
	}

	static public function pageConfig()
	{
		$userModel = Auth::user();
		$pageConfig = [];

		$pagesUserProfile = DB::select('SELECT
		pup.user_profile_id,
		pup.user_id,
		pup.page_config_id,
		pc.page_module_id,
		pup.create,
		pup.read,
		pup.update,
		pup.delete,
		pc.icon,
		pc.desc,
		pc.name_key,
		pc.url,
		pc.sequence
		FROM page_user_profile pup
		INNER JOIN page_config pc ON pc.deleted_at IS NULL AND pc.id = pup.page_config_id
		LEFT JOIN page_module pm ON pm.deleted_at IS NULL AND pm.id = pc.page_module_id
		WHERE pup.deleted_at IS NULL
		AND pup.user_profile_id = ?
		ORDER BY IFNULL(pm.SEQUENCE, 100), pc.sequence', [$userModel->user_profile_id,]);

		foreach ($pagesUserProfile as &$pageUserProfile) {
			$pageModules = [];
			$pageModuleId = $pageUserProfile->page_module_id;

			do {
				$pageModule = DB::select('SELECT
				pm.id,
				pm.name_key,
				pm.icon,
				pm.sequence,
				pm.page_module_id,
				pm.desc
				FROM page_module pm
				WHERE pm.deleted_at IS NULL
				AND id = ? ', [$pageModuleId]);

				if (count($pageModule)) {
					$pageModuleId = $pageModule[0]->page_module_id;
					$pageModules[] = $pageModule[0];
				} else {
					$pageModuleId = null;
				}
			} while ($pageModuleId);

			$pageModulesCount = count($pageModules);

			if ($pageModulesCount == 0) {
				if(!isset($pageConfig[0])){
					$pageConfig[0] = new stdClass;
				}

				$pageConfig[0]->pages[] = $pageUserProfile;
			} else
			if ($pageModulesCount == 1) {
				$pageModule = $pageModules[0];

				if (!isset($pageConfig[$pageModule->id])) {
					$pageConfig[$pageModule->id] = (object) [
						'module' => $pageModule,
					];
				}

				$pageConfig[$pageModule->id]->pages[] = $pageUserProfile;
			} else {
				$pageModule = $pageModules[$pageModulesCount - 1];

				if (!isset($pageConfig[$pageModule->id])) {
					$pageConfig[$pageModule->id] = (object) [
						'module' => $pageModule,
						'subModule' => [],
					];
				}

				$subModule = &$pageConfig[$pageModule->id];

				for ($i = $pageModulesCount - 2; $i > -1; $i--) {
					$pageModule = &$pageModules[$i];

					if (!isset($subModule->subModule[$pageModule->id])) {
						$subModule->subModule[$pageModule->id] = (object) [
							'module' => $pageModule,
							'subModule' => [],
						];
					}

					$subModule = &$subModule->subModule[$pageModule->id];
				}

				$subModule->pages[] = $pageUserProfile;
			}
		}

		return $pageConfig;
	}

	static public function avaliationData()
	{
		$studentId = Auth::guard('studentArea')->user()->id;

		$order = OrderModel::query()
			->with(['course'])
			->where('student_id', $studentId)
			->where('status', 'AP')
			->orderBy('created_at', 'desc')
			->first();

		if ($order) {
			$avaliation = AvaliationModel::query()
				->where('category_id', $order->course->course_category_id)
				->first();
		}

		return (object) [
			'studentId' => $studentId,
			'orderId' => $order->id ?? null,
			'categoryId' => $order->course->course_category_id ?? null,
			'startAvaliation' => $order->start_avaliation ?? null,
			'avaliationId' => $avaliation->id ?? null,
		];
	}

	static public function getPageConfig($pageKey)
	{
		$userModel = Auth::user();

		$pagesUserProfile = DB::select('SELECT
		pup.user_profile_id,
		pup.user_id,
		pup.page_config_id,
		pc.page_module_id,
		pup.create,
		pup.read,
		pup.update,
		pup.delete,
		pc.icon,
		pc.desc,
		pc.name_key,
		pc.url,
		pc.sequence
		FROM page_user_profile pup
		INNER JOIN page_config pc ON pc.deleted_at IS NULL AND pc.id = pup.page_config_id
		LEFT JOIN page_module pm ON pm.deleted_at IS NULL AND pm.id = pc.page_module_id
		WHERE pup.deleted_at IS NULL
		AND pup.user_profile_id = ?
		AND pc.name_key = ?
		', [
			$userModel->user_profile_id,
			$pageKey,
		]);

		return count($pagesUserProfile) == 0 ? null : $pagesUserProfile[0];
	}

	static public function fieldPageConfig($pageKey)
	{
		if (is_array($pageKey)) {
			return [];
		} else {
			return new FieldPageConfig($pageKey);
		}
	}

	static public function getStudentClasses($params)
	{
		$classes = ClassesModel::{ is_array($params->id) ? 'whereIn' : 'where'}($params->keyId, $params->id)
			->with([
				'team',
				'contentCourse',
				'videoLesson.historicVideo' => function ($query) use ($params) {
					$query->where('order_id', $params->orderId);
				},
				'fileContentCourse' => function ($query) {
					$query->whereHas('file');
					$query->with(['file']);
				},
				'studentClassControl' => function ($query) use ($params) {
					$query->where('order_id', $params->orderId);
				},
				'avaliation' => function ($query) use ($params) {
					$query->with([
						'avaliationStudent' => function ($query) use ($params) {
							$query->where('order_id', $params->orderId);
						},
						'recuperation.avaliationStudent' => function ($query) use ($params) {
							$query->where('order_id', $params->orderId);
						},
					]);
				},
			])
			->orderBy('orientative', 'desc')
			->orderBy('start_date')
			->orderBy('sequence')
			->orderBy('id')
			->get();

		$config = ConfigModel::first();

		foreach ($classes as &$itemClasses) {
			if ($itemClasses->avaliation) {
				$itemClasses->avaliation['_average'] = GigaGetData::getAvaliationAverage($itemClasses->avaliation);

				if ($itemClasses->avaliation['_average'] < $config->average) {
					$itemClasses->avaliation['recuperation'] = AvaliationModel::where('avaliation_id', $itemClasses->avaliation->id)->first();
				}
			}
		}

		return $classes;
	}

	static public function renderModuleClasses($params)
	{
		$order = OrderModel::with([
			'course.courseCategoryType',
		])->find($params->orderId);

		$classesModel = GigaGetData::getStudentClasses($params);

		$classesCards = [];

		foreach ($classesModel as &$classes) {
			$classesCards[$classes->id] = view('student_area.components.modulesCourseDetails', [
				'order' => $order,
				'classClasses' => [ $classes ],
			])->render();
		}

		return $classesCards;
	}

	static public function getAvaliationAverage(AvaliationModel $avaliation) {
		$average = 0;

		foreach ($avaliation->avaliationStudent as &$avaliationStudent) {
			if ($avaliationStudent->avaliation_file) {
				$average = $avaliationStudent->score;
			} else
			if (in_array($avaliationStudent->right_wrong, [-1, 1])) {
				$average += $avaliationStudent->score;
			}
		}

		return $average;
	}

	static public function getConfigApp() {
		return ConfigModel::first();
	}

	static public function asyncStudentClassControlByClass($idClasses) {
		$curl = curl_init();

		curl_setopt_array($curl, [
			CURLOPT_URL => "https://{$_SERVER['HTTP_HOST']}/admin/ays/generateByClass?class={$idClasses}",
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_RETURNTRANSFER => false,
			CURLOPT_TIMEOUT_MS => 1,
		]);

		curl_exec($curl);
		curl_close($curl);

		// if ($err) {
		// 	die($err);
		// }

		return null;
	}

	static public function hasScholarship(): bool {
		$hasScholarship = ScholarshipStudentModel::where('student_id', Auth::guard('studentArea')->user()->id)->first();

		return !!$hasScholarship;
	}
}

class FieldPageConfig
{

	function __construct($pageKey)
	{
		$userModel = Auth::user();

		$pageConfig = PageConfigModel::where('name_key', $pageKey)->with([
			'fieldPageConfig.fieldUserProfile' => function ($query) use ($userModel) {
				$query
					->where('user_profile_id', $userModel->user_profile_id);
			},
		])->first();

		$this->pageConfig = $this->normalizer($pageConfig);
	}

	function show($column)
	{
		$fieldConfig = $this->pageConfig[$column] ?? null;

		return is_null($fieldConfig) ? true : ($fieldConfig->create || $fieldConfig->read || $fieldConfig->update);
	}

	function attr($column) {
		$fieldConfig = $this->pageConfig[$column] ?? null;

		if (is_null($fieldConfig)) {
			return '';
		}

		$attrs = [];

		if ($fieldConfig->defaultValue) {
			$attrs[] = "value=\"{$fieldConfig->defaultValue}\"";
		}

		if ($fieldConfig->maxlength) {
			$attrs[] = "maxlength=\"{$fieldConfig->maxlength}\"";
		}

		if ($fieldConfig->required) {
			$attrs[] = 'required';
		}

		if ($fieldConfig->update != 1 && $fieldConfig->readonly) {
			$attrs[] = 'readonly';
		}

		return implode(' ', $attrs);
	}

	private function normalizer($pageConfigModel)
	{
		$pageConfig = [];

		if (isset($pageConfigModel->fieldPageConfig)) {
			foreach ($pageConfigModel->fieldPageConfig as $fieldPageConfig) {
				$pageConfig[$fieldPageConfig->column] = (object) [
					'column' => $fieldPageConfig->column,
					'label' => $fieldPageConfig->label,
					'type' => $fieldPageConfig->type,
					'maxlength' => $fieldPageConfig->maxlength,
					'required' => $fieldPageConfig->required,
					'readonly' => $fieldPageConfig->readonly,
					'defaultValue' => $fieldPageConfig->default_value,

					'create' => $fieldPageConfig->fieldUserProfile->create ?? 1,
					'read' => $fieldPageConfig->fieldUserProfile->read ?? 1,
					'update' => $fieldPageConfig->fieldUserProfile->update ?? 1,
					'delete' => $fieldPageConfig->fieldUserProfile->delete ?? 1,
				];
			}
		}

		return $pageConfig;
	}
}
