@extends('layouts.app')

@section('title', 'Inscrição')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/sweetalert/sweetalert.css') !!}">
<link rel="stylesheet" href="{!! asset('cetcc/css/icon_fonts/css/all_icons.min.css') !!}" >
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>{{ $config->title }}</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/admin') }}">Home</a>
			</li>
			<li>
				<a href="{{ url('/admin/student') }}">Lista de Inscrição</a>
			</li>
			<li class="active">
				<strong>{{ $config->title }}</strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2">

	</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>
						Dados do Curso
					</h5>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-lg-12">
							<div class="tab-content">
								<div class="panel-body">
									<div class="col-lg-5">
										<form name="form" method="post">
											<div class="row">
												<div class="col-sm-4">
													<b>Nome:</b> {{ getValueByColumn($payload['data'], 'student.name') }}<br />
													<b>E-mail:</b> {{ getValueByColumn($payload['data'], 'student.email') }} <br />
													<b>Valor:</b> R$ {{ formatNumber($payload['data']->value / $payload['data']->number_parcel) }} <br />
													<b>Parcelas:</b> {{ getValueByColumn($payload['data'], 'number_parcel') }} <br />
													<b>Métodos de pagamento:</b>  {{ getValueByColumn($payload['data'], 'formPayment.description') }} <br />
													<b>Nº de inscrição:</b> {{ getValueByColumn($payload['data'], 'id') }} <br />
												</div>
												<div class="col-sm-4">
													<b>Data:</b> {{ getValueByColumn($payload['data'], 'created_at') }} <br />
													<b>Inscrição:</b> {{ getValueByColumn($payload['data'], 'courseFormPayment.course.title_pt') }}
													(
													{{ getValueByColumn($payload['data'], 'courseFormPayment.course.courseCategoryType.title') }},
													{{ getValueByColumn($payload['data'], 'courseFormPayment.course.courseCategory.description_pt') }},
													{{ getValueByColumn($payload['data'], 'courseFormPayment.course.courseSubcategory.description_pt') }}
													) <br />
													<b>Valor total:</b> R$ {{ formatNumber($payload['data']->value) }} <br />
													{{-- <b>Quantidade:</b> 1.00 --}}
												</div>
												<div class="col-sm-4">
													<div>
														<label class="m-t-xs control-label">Status</label>
														{{ getValueByColumn($payload['data'], 'statusLabel') }}
														{{-- <select name="status" class="select2_demo_1 form-control"></select> --}}
													</div>
													<div>
														{{-- TRASER APENAS OS USUARIOS CUJO TENHA COMO CONSULTOR DE VENDAS ATIVADO --}}
														<label class="m-t-xs m-b-xs control-label">Responsável pela venda</label>
														<select name="responsible_id" class="select2_demo_1 form-control"></select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-11 gp-card-dashed">
													<div class="col-sm-12">
														<h5>{{ getValueByColumn($payload['data'], 'formPayment.description') }}</h5>
														@if (false && isset($payload['data']) && getValueByColumn($payload['data'], 'formPayment.flg_type') == 'card')
															Número do Cartão: <b>{{ getValueByColumn($payload['data'], 'number_card') }}</b> <br />
															Cód. de Segurança: <b>{{ getValueByColumn($payload['data'], 'security_code') }}</b> <br />
															Validade: <b>{{ getValueByColumn($payload['data'], 'shelf_life') }}</b> <br />
															Nome do Titular: <b>{{ getValueByColumn($payload['data'], 'cardholder') }}</b> <br />
															CPF do Titular: <b>{{ getValueByColumn($payload['data'], 'cpf') }}</b> <br />
														@endif
													</div>
													<div class="col-sm-12">
														@if (!count($payload['data']->orderParcel))
														<a class="btn btn-success" onclick="openFormModalGenerateTransaction('order', {{ $payload['data'] }})">Gerar Transação</a>
														@endif
													</div>
												</div>

												@if (count($payload['data']->errorAsaas))
												<fieldset class="col-sm-11 alert alert-danger" style="margin: 20px; padding: 20px;">
													<legend class="alert-danger" style="border: solid 1px transparent;border-radius: 5px;padding: 0px 10px;margin-bottom:0;width: auto;">Erros de integração</legend>
													@foreach ($payload['data']->errorAsaas as $errorAsaas)
														@foreach ($errorAsaas->json->errors as $errors)
															<p>{{ $errors->description }}</p>
														@endforeach
													@endforeach
												</fieldset>
												@else
												<div class="col-sm-11 gp-card-dashed">
													<div class="col-sm-6">
														<h5>Contrato</h5><br />
														@if (empty($payload['data']->contract))
														<a href="/admin/student/generateContract/{{ getValueByColumn($payload['data'], 'id') }}" class="btn gp-btn-green">Gerar Contrato</a>
														@else
														<a href="/admin/student/viewContract/{{ getValueByColumn($payload['data'], 'id') }}" class="btn btn-success">Visualizar Contrato</a>
														@endif
													</div>
													<div class="col-sm-6 text-center">
														<i class="fa fa-file-pdf-o fa-5x " style="color:#acacac47; margin-top:30px;"></i>
													</div>
												</div>
												@endif

											</div>
										</form>
										<div class="form-group text-right">
											@if ($payload['data']->status != 'AP')
												<button class="btn gp-btn-green gp-alert" type="button" data-gp-alert="approveMatriculation">{{ $payload['data']->status == 'LC' ? 'Reativar' : 'Aprovar' }}</button>
											@endif
											@if ($payload['data']->status != 'LC')
											<button class="btn btn-warning gp-alert" type="button" data-gp-alert="lockMatriculation">Trancar</button>
											@endif
											@if ($payload['data']->status != 'CA')
											<button class="btn btn-danger gp-alert" type="button" data-gp-alert="cancelMatriculation">Cancelar</button>
											@endif
											@if ($payload['data']->status != 'FI')
											<button class="btn btn-info gp-alert" type="button" data-gp-alert="finishMatriculation">Finalizar</button>
											@endif
											{{-- <button class="btn btn-white gp-alert" type="button">Remanejar Aluno</button> --}}
										</div>
									</div>
									<div class="col-lg-7">
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px;" >
												<thead>
													<tr>
														<th width="25">Nº</th>
														<th width="50">Status</th>
														<th width="115">Valor da Fatura</th>
														<th width="100">Vencimento</th>
														<th width="115">Valor Pago</th>
														<th width="100">Data de Pag.</th>
														<th width="150">Ações</th>
														<th width="120">Documetos</th>
													</tr>
												</thead>
												<tbody>
													@foreach ($payload['data']->orderParcel as $orderParcel)
													<tr data-json="{{ json_encode($orderParcel) }}">
														<td class="aling-y text-center">{{ $orderParcel->n }}</td>
														<td class="aling-y text-center">{!! $orderParcel->statusLabel !!}</td>
														<td class="aling-y">R$ {{ formatNumber($orderParcel->value) }}</td>
														<td class="aling-y">{{ $orderParcel->due_date }}</td>
														<td class="aling-y">R$ {{ formatNumber($orderParcel->value_paid) }}</td>
														<td class="aling-y">{{ $orderParcel->payday }}</td>
														<td class="aling-y" class="center ">
															<div class="gp-block-ruby">
																@if($orderParcel->status != 'Pg' && $orderParcel->status != 'Ca'  )
																	<button type="button" class="btn btn-circle gp-btn-green btn-md gp-mr-1" onclick="openModalInformTransactionGenerated('orderParcel', {{ $orderParcel }})">
																		<i class="fa fa-check " title="Pago"></i>
																	</button>
																	<button type="button" class="btn btn-circle btn-default gp-mr-1 gp-alert" disabled data-gp-alert="orderParcel-notPay"><i class="fa fa-times" title="Não Pago"></i></button>
																	<button type="button" class="btn btn-circle btn-danger gp-alert gp-mr-1" data-gp-alert="orderParcel-delete"><i class="fa fa-minus" title="Cancelar Fatura"></i></button>
																@elseif($orderParcel->status === 'Ca')
																	<button type="button" class="btn btn-circle btn-default btn-md gp-mr-1" disabled onclick="openModalInformTransactionGenerated('orderParcel', {{ $orderParcel }})"><i class="fa fa-check " title="Pago"></i></button>
																	<button type="button" class="btn btn-circle btn-default gp-mr-1 gp-alert" disabled data-gp-alert="orderParcel-notPay"><i class="fa fa-times" title="Não Pago"></i></button>
																	<button type="button" class="btn btn-circle btn-default gp-alert gp-mr-1" disabled data-gp-alert="orderParcel-delete"><i class="fa fa-minus" title="Cancelar Fatura"></i></button>
																@else
																	<button type="button" class="btn btn-circle btn-default btn-md gp-mr-1" disabled onclick="openModalInformTransactionGenerated('orderParcel', {{ $orderParcel }})"><i class="fa fa-check " title="Pago"></i></button>
																	<button type="button" class="btn btn-circle btn-warning gp-mr-1 gp-alert" data-gp-alert="orderParcel-notPay"><i class="fa fa-times" title="Não Pago"></i></button>
																	<button type="button" class="btn btn-circle btn-default gp-alert gp-mr-1" disabled data-gp-alert="orderParcel-delete"><i class="fa fa-minus" title="Cancelar Fatura"></i></button>
																@endif
															</div>
														</td>
														<td>
															@if (isset($orderParcel->asaas_json))
															<a href="{{ $orderParcel->asaas_json->bankSlipUrl }}" target="_blank" title="Boleto" class="btn btn-sm <?= (in_array($orderParcel->status, ['At', 'Ab', 'Pd'])) ? 'btn-info"' : 'btn-default" disabled' ?>>
																<i class="fa fa-dollar"></i>
															</a>
															@endif

															<a href="/bill/orderParcel/{{ $orderParcel->id }}" target="_blank" title="Recibo" class="btn btn-sm <?= (in_array($orderParcel->status, ['Pg'])) ? 'btn-ciano"' : 'btn-default" disabled' ?>>
																<i class="fa fa-file-text"></i>
															</a>

															{{-- <a href="/bill/orderParcel/{{ $orderParcel->id }}" target="_blank" title="Nota Fiscal" class="btn btn-sm < ?= (in_array($orderParcel->status, ['Pg'])) ? 'gp-btn-green"' : 'btn-default" disabled' ?>>
																<i class="fa fa-file-text"></i>
															</a> --}}
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- MODAL  --}}
<div class="modal inmodal" id="modalInformTransactionGenerated" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<i class="modal-icon fa fa-dollar"></i>
				<h4 class="modal-title">Informação de Pagamento</h4>
			</div>
			<form name="formModal" method="post" action="/admin/student/transactionGenerated" onsubmit="saveFormModal(event)" class="form-horizontal">
				{{ csrf_field() }}
				<input name="id" type="hidden">
				<input name="key" type="hidden">
				<div class="modal-body gp-m-1">
					<div class="form-group row">
						<div class="col-sm-6">
							<label class="">Forma de Pagamento:</label>
							<select name="form_payment_id" class="form-control"></select>
						</div>
						<div class="col-sm-6">
							<label class="">Conta:</label>
							<select name="bank_id" class="form-control"></select>
						</div>
						<div class="col-sm-6">
							<label class="gp-mt-1">Data:</label>
							<div class="input-group date">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input type="text" name="payday" class="form-control" value="<?= date('d/m/Y'); ?>" readonly>
							</div>
						</div>
						<div class="col-sm-6">
							<label class="gp-mt-1">Valor:</label>
							<input type="text" placeholder="" name="value_paid" class="form-control mask-currency">
							<small>Não é permitido valor menor que o valor da parcela</small>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white gp-alert" data-gp-alert="cancel" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Salvar Mudanças</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal inmodal" id="modalGenerateTransaction" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<i class="modal-icon fa fa-dollar"></i>
				<h4 class="modal-title">Gerar Transação</h4>
			</div>
			<form name="formModalGenerateTransaction" method="post" action="/admin/student/generateTransaction" onsubmit="saveFormModal(event)" class="form-horizontal">
				{{ csrf_field() }}
				<input name="id" type="hidden">
				<input name="key" type="hidden">
				<div class="modal-body">
					<div class="form-group row">
						<div class="col-sm-6">
							<label class="">Forma de Pagamento:</label>
							<select name="form_payment_id" class="form-control"></select>
						</div>
						<div class="col-sm-6">
							<label class="">Nº de Parcela:</label>
							<select name="course_form_payment_id" class="form-control"></select>
						</div>
						<div class="col-sm-6">
							<label>Valor Total:</label>
							<input type="text" name="value_total" class="form-control mask-currency" readonly />
						</div>
						<div class="col-sm-6">
							<label>Valor Parcela:</label>
							<input type="text" name="value_parcel" class="form-control mask-currency" readonly />
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('scripts')
@parent

<!-- Mainly scripts -->
<script src="{!! asset('js/plugins/metisMenu/jquery.metisMenu.js') !!}"></script>
<script src="{!! asset('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}"></script>

<!-- Custom and plugin javascript -->
<script src="{!! asset('js/inspinia.js') !!}"></script>
<script src="{!! asset('js/plugins/pace/pace.min.js') !!}"></script>
<!-- Page-Level Scripts -->
<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>
<script src="{!! asset('js/plugins/sweetalert/sweetalert.min.js') !!}"></script>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		try {
			// if (APP.listSelectBox.status) {
			// 	populateSelectBox({
			// 		list: APP.listSelectBox.status,
			// 		target: document.forms.form.status,
			// 		columnValue: "flg",
			// 		columnLabel: "label",
			// 		selectBy: APP.payload.data ? [ APP.payload.data.order.status ] : null,
			// 	});
			// }

			if (APP.listSelectBox.responsible) {
				populateSelectBox({
					list: APP.listSelectBox.responsible,
					target: document.forms.form.responsible_id,
					columnValue: "id",
					columnLabel: "name",
					emptyOption: {
						label: "Selecione..."
					},
				});
			}

			if (APP.listSelectBox.formPayment) {
				populateSelectBox({
					list: APP.listSelectBox.formPayment,
					target: document.forms.formModal.form_payment_id,
					columnValue: "id",
					columnLabel: "description",
					emptyOption: {
						label: "Selecione..."
					},
				});
			}

			if (APP.listSelectBox.bank) {
				populateSelectBox({
					list: APP.listSelectBox.bank,
					target: document.forms.formModal.bank_id,
					columnValue: "id",
					columnLabel: "name",
					emptyOption: {
						label: "Selecione..."
					},
				});
			}

			// if (APP.payload.data) {
			// 	populate(document.forms.form, APP.payload.data);
			// }

			if (APP.listSelectBox.courseFormPayment) {
				var courseFormPayment = APP.listSelectBox.courseFormPayment

				var formPayment = {}

				for (i = 0; i < courseFormPayment.length; i++) {
					var item = courseFormPayment[i]
					formPayment[item.form_payment_id] = item.form_payment
				}

				populateSelectBox({
					list: Object.values(formPayment),
					target: document.forms.formModalGenerateTransaction.form_payment_id,
					columnValue: "id",
					columnLabel: "description",
					emptyOption: {
						label: "Selecione..."
					},
				})

				document.forms.formModalGenerateTransaction.form_payment_id.addEventListener('change', function(event) {
					var value = event.target.value
					if (event.target.value) {
						var courseFormPaymentOpt = courseFormPayment.filter(function(item) {
							return item.form_payment_id == event.target.value
						})
					}

					document.forms.formModalGenerateTransaction.value_total.value = 0
					document.forms.formModalGenerateTransaction.value_parcel.value = 0

					populateSelectBox({
						list: courseFormPaymentOpt || [],
						target: document.forms.formModalGenerateTransaction.course_form_payment_id,
						columnValue: "id",
						columnLabel: "parcel",
						emptyOption: {
							label: "Selecione..."
						},
					})
				})

				document.forms.formModalGenerateTransaction.course_form_payment_id.addEventListener('change', function(event) {
					var value = event.target.value
					var current = null

					if (value) {
						current = courseFormPayment.find(function(item) { return item.id == value })
					}

					document.forms.formModalGenerateTransaction.value_total.value = current ? current.full_value : 0
					document.forms.formModalGenerateTransaction.value_parcel.value = current ? current.value : 0
				})
			}

			function openFormModalGenerateTransaction(key, data) {
				$('#modalGenerateTransaction').modal('show')

				APP.modalInformTransactionGenerated = {
					key: key,
					id: data.id,
					data: data,
				}
			}

			function openModalInformTransactionGenerated(key, data) {
				$('#modalInformTransactionGenerated').modal('show')

				try {
					document.forms.formModal.form_payment_id.value = APP.payload.data.form_payment_id
					document.forms.formModal.bank_id.value = APP.payload.data.bank_id
					document.forms.formModal.value_paid.value = parseFloat(data.value).toFixed(2)
				} catch (error) {
					console.warn(error);
				}

				APP.modalInformTransactionGenerated = {
					key: key,
					id: data.id,
					data: data,
				}
			}

			function saveFormModal(event) {
				var target = event.target
				target.key.value = APP.modalInformTransactionGenerated.key
				target.id.value = APP.modalInformTransactionGenerated.id

				if (target.name == 'formModal') {

					try {
						var value = strToNumber(target.value_paid.value)

						if (value < APP.modalInformTransactionGenerated.data.value) {
							event.preventDefault()

							swal({
								title: "Valor de pagamento não pode ser menor que o valor da parcela",
								confirmButtonColor: "#DD6B55",
								confirmButtonText: "OK",
							})

						}
					} catch (error) {
						console.warn(error)
						swal({
							title: "Houve um erro no processo, confirme se todos os dados estão corretos",
							confirmButtonColor: "#DD6B55",
							confirmButtonText: "OK",
						})
						event.preventDefault()
					}
				}

			}

			function changeOrder(params) {
				$.ajax({
					url: '/admin/student/save',
					method: 'post',
					data: params
				}).then(function(resp) {
					location.reload()
				})
			}

			//  Sweet alert
			$('.gp-alert').click(function (event) {
				try {
					var gpAlertKey = event.target.closest('button').dataset.gpAlert;
					var mapAlert = {
						'orderParcel-notPay': {
							params: {
								title: "Deseja excluir a transação?",
								text: "Essa ação exclui todas as transações desta fatura e é IRREVERSÍVEL.",
								type: "warning",
							},
							callback: function() {
								var data = $(event.target).parents('tr[data-json]').data('json')

								$.ajax({
									url: '/admin/student/orderParcel',
									methods: 'get',
									data: {
										id: data.id,
										action: 'notPay',
									}
								}).then(function(resp) {
									location.reload()
									swal("Feito!", "Excluir a transação.", "success");
								})

							}
						},
						'orderParcel-delete': {
							params: {
								title: "Deseja excluir esta fatura?",
								text: "Essa ação é IRREVERSÍVEL",
								type: "warning",
							},
							callback: function () {
								var data = $(event.target).parents('tr[data-json]').data('json')

								$.ajax({
									url: '/admin/student/orderParcel',
									methods: 'get',
									data: {
										id: data.id,
										action: 'delete',
									}
								}).then(function(resp) {
									location.reload()
									swal("Feito!", "Excluido esta fatura.", "success");
								})
							}
						},
						cancel: {
							params: {
								title: "Cancelado",
								text: "As modificações não foram salvas",
								type: "error",
								showCancelButton: false,
								confirmButtonText: "Ok",
								confirmButtonColor: "#1a7bb9"
							}
						},
						save: {
							params: {
								title: "Salvo com Sucesso",
								text: "As modificações foram salvas",
								type: "success",
								showCancelButton: false,
								confirmButtonText: "Ok",
								confirmButtonColor: "#1a7bb9"
							}
						},
						approveMatriculation: {
							params: {
								title: "Deseja Aprovar Matrícula?",
								text: "",
								type: "warning",
							},
							callback: function() {
								changeOrder({
									id: APP.payload.data.id,
									status: 'AP',
								})
							}
						},
						cancelMatriculation:{
							params: {
								title: "Deseja Cancelar a Matrícula?",
								text: "",
								type: "warning",
							},
							callback: function() {
								changeOrder({
									id: APP.payload.data.id,
									status: 'CA',
								})
							}
						},
						lockMatriculation: {
							params: {
								title: "Deseja Trancar a Matrícula?",
								text: "",
								type: "warning",
							},
							callback: function() {
								changeOrder({
									id: APP.payload.data.id,
									status: 'LC',
								})
							}
						},
						finishMatriculation: {
							params: {
								title: "Deseja Finalizar Matrícula?",
								text: "",
								type: "warning",
							},
							callback: function() {
								changeOrder({
									id: APP.payload.data.id,
									status: 'FI',
								})
							}
						},
					}

					swal(Object.assign({
						title: "Tem certeza disso?",
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Sim",
						showCancelButton: true,
						closeOnConfirm: false
					}, mapAlert[gpAlertKey].params), mapAlert[gpAlertKey].callback);
				} catch (error) {
					console.warn(error)
				}
			});

			$(document).ready(function() {
				// $('.gp-value-mask').inputmask('R$ 99.999,99', { numericInput: true });

				// Datepicker
				function setDatePicker() {
					$('.input-group.date').datepicker({
						todayBtn: "linked",
						keyboardNavigation: false,
						forceParse: false,
						calendarWeeks: true,
						autoclose: true,
						format: 'dd/mm/yyyy'
					});
				}
				setDatePicker()
			});

			document.forms.form.responsible_id.addEventListener('change', function(event) {
				changeOrder({
					id: APP.payload.data.id,
					responsible_id: event.target.value,
				})
			})
		} catch(error) {
			console.warn(error);
		}
	})
</script>
@endsection
