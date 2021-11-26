<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseMethodAdminController;
use Illuminate\Http\Request;

use App\Model\api\Configuration\BankModel;
use App\Model\api\ContractModel;
use App\Model\api\CourseFormPaymentModel;
use App\Model\api\ErrorAsaasModel;
use App\Model\api\FormPaymentModel;
use App\Model\api\OrderModel;
use App\Model\api\OrderParcelModel;
use App\Model\api\SchoolInformationModel;
use App\Model\api\UserModel;
use App\Utils\ConfirmPaymentUtils;
use App\Utils\StudentClassControlUtils;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Storage;
use stdClass;

class StudentController extends BaseMethodAdminController {
	function __construct() {
		$this->apiModel = OrderModel::class;
		$this->config = (object) [
			'urlBase' => '/admin/student',
			'urlAction' => '/admin/student/save',
			'pathView'  => 'admin.pages.student',
			'pathViewInclude'  => 'admin.pages.student.form',
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
					'url' => '/admin/student',
					'label' => 'Estudantes',
				],
			],
		];
	}

	private function getListSelectBox() {
		$listSelectBox = new stdClass;

		$listSelectBox->status = OrderModel::getStatusList();
		$listSelectBox->bank = BankModel::orderBy('name')->get();
		$listSelectBox->formPayment = FormPaymentModel::orderBy('description')->get();
		$listSelectBox->responsible = UserModel::orderBy('name')->get();

		return $listSelectBox;
	}

	public function list(Request $request) {
		$this->config->pathView = 'admin.components';
		$this->config->fileView = '.list';
		$this->config->title = 'Listar Estudantes';
		$this->config->contentTitle = 'Lista de Estudantes';
		$this->config->breadcrumbs[] = [ 'label' => 'Listar' ];

		$dataTableHeader = [
			[ 'title' => 'ID', 'data' => 'id', 'width' => '10px', ],
			[ 'title' => 'Status', 'className' => 'center', 'data' => 'statusIcon', ],
			[ 'title' => 'Nome', 'data' => 'student.name', ],
			[ 'title' => 'CPF', 'data' => 'student.cpf', ],
			// [ 'title' => 'E-mail', 'data' => 'student.email', ],
			[ 'title' => 'Tipo', 'data' => 'course.course_category_type.title', ],
			[ 'title' => 'Categoria', 'data' => 'course.course_category.description_pt', ],
			[ 'title' => 'Subcategoria', 'data' => 'course.course_subcategory.description_pt', ],
			[ 'title' => 'Curso', 'data' => 'course.title_pt', ],
			[ 'title' => 'Turma', 'data' => 'class.name', ],
			[ 'title' => 'Data', 'data' => 'created_at', ],
			// [ 'title' => 'Responsavel da Venda', 'data' => 'responsible.name', ],
			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnUpd' => $this->config->urlBase ],
			[ 'title' => '', 'className' => 'center', 'width' => '10px', 'btnDel' => $this->config->urlBase ],
		];

		$dataTable = parent::getListEnableDisable((object) [
			'dataTableHeader' => $dataTableHeader,
			'apiModel' => $this->apiModel::query()->with([
				'student',
				'course.courseCategoryType',
				'course.courseCategory',
				'course.courseSubcategory',
				'class',
				// 'responsible',
			]),
		]);

		return parent::list($request)->with('dataTable', $dataTable);
	}

	public function listSupervision(Request $request) {
		return view('admin/prospection/student/listSupervision', [
			'payload' => (object) [
				'order' => OrderModel::whereNotNull('supervision_id')->get(),
			],
		]);
	}

	function update(Request $request) {
		$this->config->title = 'Alterar a Inscrição';

		$payloadData = OrderModel::with([
			'student.state',
			'formPayment',
			'orderParcel' => function($query) {
				$query->withTrashed();
			},
			'courseFormPayment' => function($query) {
				$query->with([
					'formPayment',
					'course' => function($query) {
						$query->with([
							'courseCategory',
							'courseCategoryType',
							'courseSubcategory',
						]);
					},
				]);
			},
			'errorAsaas',
		])->find($request->id);

		$listSelectBox = $this->getListSelectBox();

		$listSelectBox->courseFormPayment = CourseFormPaymentModel::where('course_id', $payloadData->course_id)->with([
			'formPayment',
		])->get();

		return parent::update($request)
			->with('listSelectBox', $listSelectBox)
			->with('payload', [ 'data' => $payloadData ]);
	}

	function save(Request $request) {
		$orderModel = OrderModel::find($request->get('id'));

		if ($orderModel) {
			$orderModel->fill($request->all())->save();
			(new StudentClassControlUtils)->generateByOrder($request->get('id'));
		}

		return redirect()->back();
	}

	function orderParcel(Request $request) {
		$orderParcelModel = OrderParcelModel::where('id', $request->get('id'));

		switch ($request->get('action')) {
			case 'pay': return $orderParcelModel->update([
				'payday' => \Carbon\Carbon::now(),
			]);
			case 'notPay': return $orderParcelModel->update([
				'payday' => null,
			]);
			case 'delete': return $orderParcelModel->delete();
		}

		return $request->all();
	}

	function transactionGenerated(Request $request) {
		switch ($request->get('key')) {
			case 'order': OrderModel::find($request->get('id'))->fill($request->all())->save();
			break;
			case 'orderParcel': OrderParcelModel::find($request->get('id'))->fill($request->all())->save();
			break;
		}

		return redirect()->back();
	}

	function generateContract(Request $request, $id) {
		$contract = ContractModel::where('status', 'current')->first();

		if ($contract) {
			$company = SchoolInformationModel::with('state')->first();

			$order = OrderModel::with([
				'student.state',
				'formPayment',
				'course' => function($query) {
					$query->with([
						'courseCategory',
						'courseCategoryType',
						'courseSubcategory',
					]);
				},
				'class',
			])->find($id);

			$valueParcel = $order->value / $order->number_parcel;

			try {
				$contractCourseMinValueWorkload = $order->course->hours_load / 100 * $order->course->min_percentage_workload;
			} catch (\Throwable $th) {
				$contractCourseMinValueWorkload = 0;
			}

			$tags = [
				'#contractCompanyName#' => $company->name,
				'#contractCompanyCNPJ#' => formatValue($company->cnpj, 'cnpjCpf'),
				'#contractCompanyAddress#' => $company->fullAddress,
				'#contractCourseName#' => $order->course->title_pt,
				'#contractCourseAcademicDegree#' => $order->course->subtitle_pt,
				'#contractCourseStartDate#' => $order->class->start_date,
				'#contractOrderValue#' => formatNumber($order->value) . ' ('. numberByExtense($order->value, true) .')',
				'#contractOrderNumberParcel#' => $order->number_parcel,
				'#contractOrderValueParcel#' => formatNumber($valueParcel). ' ('. numberByExtense($valueParcel, true) .')',
				'#contractCourseSubcategory#' => $order->course->courseSubcategory->description_pt,
				'#contractCourseStartWeek#' => $order->class->days_week,
				'#contractCourseHourPeriod#' => $order->course->duration,
				'#contractCourseDuration#' => $order->course->hours_load . ' (' . numberByExtense($order->course->hours_load) . ')',
				'#contractCourseMinPercentWorkload#' => $order->course->min_percentage_workload,
				'#contractCourseMinValueWorkload#' => $contractCourseMinValueWorkload,
				'#contractCourseServiceHours#' => $order->course->service_hours,
				'#contractCourseHoursMonitoredSupervision#' => $order->course->hours_monitored_supervision,
				'#contractStudentFullName#' => $order->student->name,
				'#contractStudentCPF#' => formatValue($order->student->cpf, 'cnpjCpf'),
				'#contractStudentZipCode#' => formatValue($order->student->zip_code, 'zipCode'),
				'#contractStudentAddress#' => $order->student->address,
				'#contractStudentAddressNumber#' => $order->student->n,
				'#contractStudentCity#' => $order->student->city,
				'#contractStudentState#' => $order->student->state->abbreviation,
				'#contractStudentPhone#' => $order->student->phones,
				'#contractStudentEmail#' => $order->student->email,
				'#contractClause4.1B#' => $order->formPayment->clause4_1b,
				'#contractClause4.2.1#' => $order->formPayment->clause4_2_1,
				'#contractDateGenerateContract#' => Carbon::now()->getTranslatedMonthName() . ' de ' . Carbon::now()->format('Y'),
			];

			$htmlContract = str_replace(array_keys($tags), array_values($tags), $contract->content);

			$htmlContract = '<html>
			<head>
			<style>
				@page {
					margin: 125px 25px;
				}

				.gp-bkg-contract{
					background-image: url("cetcc/img/contract_bkg.jpeg");
					position: fixed;
					bottom: -130px;
					opacity: 0.25;
					left: -30px;
					right: 1px;
					width:210cm;
					height:297cm;
				}

				body{
					font-family: Arial, Helvetica, sans-serif;
					font-size: 16px;
					color: black;
				}

				header {
					position: fixed;
					top: -95px;
					left: 0px;
					right: 0px;
				}
				footer {
					position: fixed;
					bottom: 0px;

					border: 2px solid gray;
					border-style: solid none none none;
					padding-top:20px;
				}
				main{
					margin:30px 2cm 0 2cm;
				}

				.container{
					max-width: 100%;
					display: flex;
				}
				.item{
					margin: 5px;
					font-size: 1.5em;
					flex: 1;
				}
				.gp-header, footer{
					font-size: 15px;
					color: gray;
				}
				.gp-header{
					text-align: right;
					border: 2px solid gray;
					border-style: none none solid none;
					padding-bottom:20px;
				}
				.gp-img{
					margin:5px 0 10px 10px;
				}
				.gp-text-center{
					text-align:center;
				}

			</style>
			</head>
				<body>
					<div class="gp-bkg-contract"></div>

					<header>
						<div class="container">
							<div class="item">
								<img class="gp-img" src="cetcc/img/logo_small.png" alt="Logo CETCC"  height="80">
							</div>
							<div class="item">
								<p class="gp-header">
								'. $company->name .' <br />
									CNPJ: '. $company->cnpj .'
								</p>
							</div>
						</div>
					</header>

					<footer>
						<div class="gp-text-center">' . $company->fullAddress . '<br />
							Fone: '. $company->phone .' <br />
							' . $company->email . '
						</div>
					</footer>

					<main style="z-index:10;">' . $htmlContract . '</main>

				</body>
			</html>';

			$dompdf = new Dompdf();
			$dompdf->loadHtml($htmlContract);
			$dompdf->setPaper('A4', 'portrait');

			$dompdf->render();
			// header("Content-type:application/pdf");
			// die($dompdf->output());

			$pathFile = "contract/{$order->id}/contact.pdf";
			Storage::put($pathFile, $dompdf->output());

			$order->fill([ 'contract' => $pathFile ])->save();

			return redirect()->back();
		}

	}

	function viewContract(Request $request, $id) {
		return Storage::download(OrderModel::find($id)->contract);
		// return view('student_area.course.contract')->with('payload', OrderModel::find($id));
	}

	function generateTransaction(Request $request) {
		$confirmPaymentUtils = new ConfirmPaymentUtils;
		$order = OrderModel::find($request->get('id'));

		$confirmPaymentUtils->setByCourseFormPayment($order, $request->all());

		ErrorAsaasModel::where('order_id', $order->id)->forceDelete();

		if (in_array($order->form_payment, [ 'card', 'bankSlip' ])) {
			$confirmPaymentUtils->paymentAsaas([
				'order' => $order,
			]);
		} else {
			(new ConfirmPaymentUtils)->orderParcel($order->id);
		}

		return redirect()->back();
	}
}
