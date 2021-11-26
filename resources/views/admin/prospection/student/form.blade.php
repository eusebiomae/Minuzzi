@extends('layouts.app')

@section('title', 'Inscrição')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/sweetalert/sweetalert.css') !!}">
<link rel="stylesheet" href="{!! asset('cetcc/css/icon_fonts/css/all_icons.min.css') !!}" >
<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/basic.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/dropzone.css') !!}" />

@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Inserir Inscrição</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/admin') }}">Home</a>
			</li>
			<li>
				<a href="{{ url('/admin/prospection/student') }}">Lista de Inscrição</a>
			</li>
			<li class="active">
				<strong>Inserir Inscrição</strong>
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
										<form name="formOrder" method="post" action="/admin/prospection/student/save" enctype="multipart/form-data">
											<div class="row">
												<div class="col-sm-12">
													<h3><b>Nome:</b> {{ getValueByColumn($payload, 'student.name') }}</h3>
												</div>

												<div class="col-sm-6">
													<b>CPF:</b> {{ getValueByColumn($payload, 'student.cpf') }} <br />
													<b>E-mail:</b> {{ getValueByColumn($payload, 'student.email') }} <br />
													<b>Cel:</b> {{ getValueByColumn($payload, 'student.cell_phone') }} <br />

													<div>
														<label class="m-t-xs control-label">Status:</label>
														<span >{!! getValueByColumn($payload, 'statusIcon') !!} {{ getValueByColumn($payload, 'statusLabel') }}</span>
														{{-- <select name="status" class="select2_demo_1 form-control"></select> --}}
													</div>
													<div>
														{{-- TRASER APENAS OS USUARIOS CUJO TENHA COMO CONSULTOR DE VENDAS ATIVADO --}}
														<label class="m-t-xs m-b-xs control-label">Responsável pela venda</label>
														<select name="responsible_id" class="select2_demo_1 form-control" {{ in_array($payload->status, ['CA', 'TR', 'FI']) ? 'disabled' : '' }}></select>
													</div>
												</div>

												<div class="col-sm-6">
													<b>Nº de inscrição:</b> {{ getValueByColumn($payload, 'id') }} <br />
													<b>Data:</b> {{ getValueByColumn($payload, 'created_at') }} <br />
													<b>Valor parcela:</b> R$ {{ formatNumber($payload->value) }} <br />
													<b>Qtd. Parcelas:</b> {{ getValueByColumn($payload, 'number_parcel') }} <br />
													<b>Valor total:</b> R$ {{ formatNumber($payload->full_value) }} <br />
													<b>Métodos de pagamento:</b>  {{ getValueByColumn($payload, 'formPayment.description') }} <br />
												</div>

												<div class="col-sm-11 gp-card-dashed">
													<b>Tipo:</b> {{ getValueByColumn($payload, 'course.courseCategoryType.title') }} <br />
													<b>Categoria:</b> {{ getValueByColumn($payload, 'course.courseCategory.description_pt') }} <br />
													<b>Subcategoria:</b> {{ getValueByColumn($payload, 'course.courseSubcategory.description_pt') }} <br />
													<b>Courso:</b> {{ getValueByColumn($payload, 'course.title_pt') }} <br />
													<b>Turma:</b> {{ getValueByColumn($payload, 'class.name') }} <br />
												</div>
											</div
											>
											<div class="row">
												<div class="col-sm-11 gp-card-dashed">
													<div class="col-sm-12">
														<h5>{{ getValueByColumn($payload, 'formPayment.description') }}</h5>
														@if (false && isset($payload) && getValueByColumn($payload, 'formPayment.flg_type') == 'card')
															Número do Cartão: <b>{{ getValueByColumn($payload, 'number_card') }}</b> <br />
															Cód. de Segurança: <b>{{ getValueByColumn($payload, 'security_code') }}</b> <br />
															Validade: <b>{{ getValueByColumn($payload, 'shelf_life') }}</b> <br />
															Nome do Titular: <b>{{ getValueByColumn($payload, 'cardholder') }}</b> <br />
															CPF do Titular: <b>{{ getValueByColumn($payload, 'cpf') }}</b> <br />
														@endif
													</div>

													<div class="col-sm-12">
														@isset($payload)
															@if (!count($payload->orderParcel) && !in_array($payload->status, ['CA', 'TR', 'FI']))
																<a class="btn btn-success" onclick="openFormModalGenerateTransaction('order', {{ $payload }})">Gerar Transação</a>
															@endif
														@endisset
													</div>
												</div>

												@if (count($payload->errorAsaas))
													<fieldset class="col-sm-11 alert alert-danger" style="margin: 20px; padding: 20px;">
														<legend class="alert-danger" style="border: solid 1px transparent;border-radius: 5px;padding: 0px 10px;margin-bottom:0;width: auto;">Erros de integração</legend>
														@foreach ($payload->errorAsaas as $errorAsaas)
															@foreach ($errorAsaas->json->errors as $errors)
																<p>{{ $errors->description }}</p>
															@endforeach
														@endforeach
													</fieldset>
												@elseif(!in_array($payload->status, ['CA', 'TR', 'FI']))
													<div class="col-sm-11 gp-card-dashed">
														@if (old('generateContractErrors'))
															<div class="alert alert-danger">
																@foreach (old('generateContractErrors') as $error)
																	<p>{{ $error }}</p>
																@endforeach
															</div>
														@endif
														<div class="col-sm-6">
															<label class="control-label">Contrato</label><br />
															@if (empty($payload->contract))
																<a href="/admin/prospection/student/generateContract/{{ getValueByColumn($payload, 'id') }}" class="btn gp-btn-green">Gerar Contrato</a>
															@else
															<a href="/admin/prospection/student/viewContract/{{ getValueByColumn($payload, 'id') }}" class="btn btn-success">Visualizar Contrato</a>
															@endif
														</div>
														<div class="col-sm-6 text-center">
															<i class="fa fa-file-pdf-o fa-5x " style="color:#acacac47; margin-top:30px;"></i>
														</div>
														@if (empty($payload->contract))
														<br>OU<br><br>
														<div class="col-sm-12"><label class="control-label">Selecionar Contrato</label>
														</div>
														<div class="col-sm-10">
															<div class="form-group">
																<div class="fileinput fileinput-new input-group" data-provides="fileinput">
																	<div class="form-control" data-trigger="fileinput">
																		<i class="glyphicon glyphicon-file fileinput-exists"></i>
																		<span class="fileinput-filename" id="fileinput-filename_doc"></span>
																	</div>
																	<span class="input-group-addon btn btn-default btn-file">
																		<span class="fileinput-new">Selecionar</span>
																		<span class="fileinput-exists">Alterar</span>
																		<input type="file" id="contractFile" name="contractFile" value="">
																	</span>
																	<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
																</div>
															</div>
														</div>
														<div class="col-sm-2">
															<button type="submit" class="btn btn-success" title="Enviar Contrato">Enviar</button>
														</div>
														@endif
													</div>
												@endif
												{{ csrf_field() }}
												<input name="id" type="hidden">
											</div>
										</form>
										<div class="form-group text-right">
											@if (!in_array($payload->status, ['CA', 'TR', 'FI']))
												@if ($payload->status != 'AP')
													<button class="btn gp-btn-green gp-alert" type="button" data-gp-alert="approveMatriculation">
														@if ($payload->status == 'PE')
															Aprovar
														@elseif ($payload->status == 'BL')
															Desbloquear
														@else
															Reativar
														@endif
													</button>
												@endif

												@if ($payload->status != 'LC')
													<button class="btn btn-warning gp-alert" type="button" data-gp-alert="lockMatriculation">Trancar</button>
													@endif

												@if ($payload->status != 'RG')
													<button class="btn btn-primary gp-alert" type="button" data-gp-alert="renegMatriculation">Renegociação</button>
													@endif


												@if ($payload->status != 'CA')
													<button class="btn btn-danger gp-alert" type="button" data-gp-alert="cancelMatriculation">Cancelar</button>
												@endif

												@if ($payload->status != 'FI')
													<button class="btn btn-info gp-alert" type="button" data-gp-alert="finishMatriculation">Finalizar</button>
												@endif

												@if ($payload->status == 'AP')
													<button class="btn text-white" style="background: #0777a4;" type="button" onclick="matriculationTransfer()">Transferir</button>
												@endif

												@if ($payload->status == 'AP')
													<button class="btn btn-success" type="button" onclick="matriculationTransfer('TRC')">Trocar curso</button>
												@endif
											@endif
											{{-- <button class="btn btn-white gp-alert" type="button">Remanejar Aluno</button> --}}
										</div>
									</div>
									<div class="col-lg-7">
										<div class="row">
											@if (isset($payload->asaas_fine) && $payload->asaas_fine)
												<div class="col-sm-11 gp-card-dashed">
													<a target="_blank" href="{{ $payload->asaas_fine->bankSlipUrl }}">Link do Boleto da Multa do cancelamento</a>
												</div>
											@endif
										</div>

										@include('admin.prospection.student.orderParcelTable')

										@isset($payload->subOrder)
											@foreach ($payload->subOrder as $subOrder)
												@include('admin.prospection.student.orderParcelTable', [ 'payload' => $subOrder ])
											@endforeach
										@endisset
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
			<form name="formModal" method="post" action="/admin/prospection/student/transactionGenerated" onsubmit="saveFormModal(event)" class="form-horizontal">
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
			<form name="formModalGenerateTransaction" method="post" action="/admin/prospection/student/generateTransaction" onsubmit="saveFormModal(event)" class="form-horizontal">
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

<div class="modal inmodal" id="modalInformReceiptOfCheck" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<i class="modal-icon fa fa-dollar"></i>
				<h4 class="modal-title">Informar Recebimento de Cheques</h4>
			</div>
			<form name="formModalInformReceiptOfCheck" method="post" action="/admin/prospection/student/transactionGenerated" onsubmit="saveFormModal(event)" class="form-horizontal">
				{{ csrf_field() }}
				<input name="id" type="hidden">
				<input name="key" type="hidden">
				<input name="status" type="hidden">
				<div class="modal-body">
					<div class="form-group row">

						<div class="col-sm-6">
							<label>Número:</label>
							<input type="tel" name="number_check" class="form-control mask-numeric" maxlength="8" />
						</div>

						<div class="col-sm-6">
							<label>Pré-datado para:</label>
							<div class="input-group date">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input type="text" name="pre_dated_to" class="form-control" value="" readonly>
							</div>
						</div>

						<div class="col-sm-6">
							<label>Valor:</label>
							<input type="tel" name="value_check" class="form-control mask-currency" />
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

<div class="modal inmodal" id="modalBankTransfer" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<i class="modal-icon fa fa-dollar"></i>
				<h4 class="modal-title">Anexar Comprovante</h4>
			</div>
			<form name="formModalBankTransfer" method="post" action="/admin/prospection/student/transactionGenerated" onsubmit="saveFormModal(event)" class="form-horizontal" enctype="multipart/form-data">
				{{ csrf_field() }}
				<input name="id" type="hidden">
				<input name="key" type="hidden">
				<input name="status" type="hidden">
				<input name="informed_receipt" id="informedReceipt" type="hidden" value="1">
				<div class="modal-body">
					<div class="row">

						<div class="form-group col-sm-12">
							<label>Pago no dia:</label>
							<div class="input-group date">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input type="text" name="payday" class="form-control" value="" readonly>
							</div>
						</div>

						<div class="form-group col-sm-12">
							<label>Anexar comprovante:</label>

							<div class="fileinput fileinput-new input-group" data-provides="fileinput">
								<div class="form-control" data-trigger="fileinput">
									<i class="glyphicon glyphicon-file fileinput-exists"></i>
									<span class="fileinput-filename" id="fileinput-receipt_file"></span>
								</div>
								<span class="input-group-addon btn btn-default btn-file">
									<span class="fileinput-new">Selecionar</span>
									<span class="fileinput-exists">Alterar</span>
									<input type="file" name="receipt_file" value="" accept="image/*" onchange="document.getElementById('fileinput-receipt_file').innerText = this.files[0].name">
								</span>
								<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
							</div>

						</div>

					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn text-white" style="background: #0777a4;" onclick="document.getElementById('informedReceipt').value = 0">Aprovar sem Comprovante</button>
					<button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>

{{--
<div class="modal inmodal" id="modalMatriculationTransfer" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<i class="modal-icon fa fa-exchange-alt"></i>
				<h4 class="modal-title">Transferir</h4>
			</div>
			<form name="formModalMatriculationTransfer" method="post" action="/admin/prospection/student/matriculationTransfer" class="form-horizontal" enctype="multipart/form-data">
				{{ csrf_field() }}
				<input name="id" type="hidden">

				<div class="modal-body">
					<div class="row">

						<div class="col-sm-6">
							<label class="">Curso:</label>
							<select name="course_id" class="form-control" onchange="populateClassMatriculationTransfer(this.value)"></select>
						</div>

						<div class="col-sm-6">
							<label class="">Turma:</label>
							<select name="class_id" class="form-control"></select>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Transferir</button>
				</div>
			</form>
		</div>
	</div>
</div>
--}}

<div class="modal inmodal" id="modalMatriculationCancel" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<i class="modal-icon fa fa-exchange-alt"></i>
				<h4 class="modal-title">Cancelamento</h4>
			</div>
			<form name="formModalMatriculationCancel" method="post" action="/admin/prospection/student/cancellationProcess" class="form-horizontal">
				{{ csrf_field() }}
				<input name="id" type="hidden">
				<input name="notGenerateFine" id="notGenerateFine" type="hidden">

				<div class="modal-body">
					<div class="row">

						<div class="col-sm-6">
							<label class="gp-mt-1">Valor não pago:</label>
							<input type="text" name="valueNotPaid" class="form-control mask-currency" disabled>
						</div>

						<div class="col-sm-6">
							<label class="gp-mt-1">Valor de multa:</label>
							<input type="text" name="fineValue" class="form-control mask-currency" disabled>
						</div>

						<div class="col-sm-6">
							<label class="gp-mt-1">Forma de pagamento da multa:</label>
							<select name="formpayment_of_fine" class="form-control">
								<option value="bankSlip">Boleto Bancário</option>
								{{-- <option value="card">Cartão de Crédito</option> --}}
								<option value="cash">Dinheiro</option>
							</select>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn text-white" style="background: #0777a4;" onclick="document.getElementById('notGenerateFine').value = 1">Cancelar sem cobrar multa</button>
					<button type="button" class="btn btn-white" data-dismiss="modal">Voltar</button>
					<button type="submit" class="btn btn-primary">Confirmar</button>
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
	try {
		APP.scope.form = <?=isset($payload) ? json_encode($payload) : 'null'?>;
		APP.scope.listSelectBox = {!! isset($listSelectBox) ? json_encode($listSelectBox) : '{}' !!};

		// if (APP.scope.listSelectBox.status) {
		// 	populateSelectBox({
		// 		list: APP.scope.listSelectBox.status,
		// 		target: document.forms.form.status,
		// 		columnValue: "flg",
		// 		columnLabel: "label",
		// 		selectBy: APP.scope.form ? [ APP.scope.form.order.status ] : null,
		// 	});
		// }

		if (APP.scope.listSelectBox.responsible) {
			populateSelectBox({
				list: APP.scope.listSelectBox.responsible,
				target: document.forms.formOrder.responsible_id,
				columnValue: "id",
				columnLabel: "name",
				emptyOption: {
					label: "Selecione..."
				},
			});
		}

		if (APP.scope.listSelectBox.formPayment) {
			populateSelectBox({
				list: APP.scope.listSelectBox.formPayment,
				target: document.forms.formModal.form_payment_id,
				columnValue: "id",
				columnLabel: "description",
				emptyOption: {
					label: "Selecione..."
				},
			});
		}

		if (APP.scope.listSelectBox.bank) {
			populateSelectBox({
				list: APP.scope.listSelectBox.bank,
				target: document.forms.formModal.bank_id,
				columnValue: "id",
				columnLabel: "name",
				emptyOption: {
					label: "Selecione..."
				},
			});
		}

		if (APP.scope.form) {
			populate(document.forms.formOrder, APP.scope.form);
		}

		if (APP.scope.listSelectBox.courseFormPayment) {
			var courseFormPayment = APP.scope.listSelectBox.courseFormPayment
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

		function toApprove(key, data) {
			switch (APP.scope.form.form_payment.flg_type) {
				case 'postdatedChecks': openModalInformReceiptOfCheck(key, data)
				break
				case 'bankTransfer': openModalBankTransfer(key, data)
				break
				default: openModalInformTransactionGenerated(key, data)
			}
		}

		function openModalInformReceiptOfCheck(key, data) {
			$('#modalInformReceiptOfCheck').modal('show')

			var $formModalInformReceiptOfCheck = $('#modalInformReceiptOfCheck [name="formModalInformReceiptOfCheck"]')

			$formModalInformReceiptOfCheck.find('[name="key"]').val(key)
			$formModalInformReceiptOfCheck.find('[name="id"]').val(data.id)
			$formModalInformReceiptOfCheck.find('[name="status"]').val('AP')

			APP.modalInformReceiptOfCheck = {
				key: key,
				data: data,
			}
		}

		function openModalBankTransfer(key, data) {
			$('#modalBankTransfer').modal('show')

			var $formModalBankTransfer = $('#modalBankTransfer [name="formModalBankTransfer"]')

			$formModalBankTransfer.find('[name="key"]').val(key)
			$formModalBankTransfer.find('[name="id"]').val(data.id)
			$formModalBankTransfer.find('[name="status"]').val('AP')

			APP.modalBankTransfer = {
				key: key,
				data: data,
			}
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
				document.forms.formModal.form_payment_id.value = APP.scope.form.form_payment_id
				document.forms.formModal.bank_id.value = APP.scope.form.bank_id
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
				url: '/admin/prospection/student/save',
				method: 'post',
				data: params
			}).then(function(resp) {
				console.log(resp)

				if (resp == 'OK') {
					location.reload()
				}
			})
		}

		function matriculationTransfer(status) {
			swal({
				type: 'warning',
				title: "Tem certeza disso?",
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Sim",
				showCancelButton: true,
				closeOnConfirm: true,
			}, function(resp) {
				if (resp) {
					location.href = '/admin/prospection/student/matriculationTransfer/' + APP.scope.form.id + '/' + (status || '')
				}
			})


			// $modalMatriculationTransfer = $('#modalMatriculationTransfer')

			// $modalMatriculationTransfer.find('[name="id"]').val(APP.scope.form.id)

			// populateSelectBox({
			// 	list: APP.scope.listSelectBox.course,
			// 	target: $modalMatriculationTransfer.find('[name="course_id"]')[0],
			// 	columnValue: "id",
			// 	columnLabel: "title_pt",
			// 	selectBy: [ APP.scope.form.course_id ],
			// })

			// populateClassMatriculationTransfer(APP.scope.form.course_id)

			// $modalMatriculationTransfer.modal('show')
		}

		function populateClassMatriculationTransfer(idCourse) {
			var course = APP.scope.listSelectBox.course.find(function(itemCourse) {
				return itemCourse.id == idCourse
			})

			console.log(course);

			populateSelectBox({
				list: course ? course.class : [],
				target: document.querySelector('#modalMatriculationTransfer [name="class_id"]'),
				columnValue: "id",
				columnLabel: "name",
				selectBy: [ APP.scope.form.class_id ],
			})

			$('#modalMatriculationTransfer').modal('show')
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
								url: '/admin/prospection/student/orderParcel',
								method: 'get',
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
								url: '/admin/prospection/student/orderParcel',
								method: 'get',
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
							title: APP.scope.form.status == 'PE' ? "Deseja Aprovar Matrícula?" : 'Deseja Reativar Matrícula?',
							text: "",
							type: "warning",
						},
						callback: function() {
							switch (APP.scope.form.form_payment.flg_type) {
								case 'postdatedChecks': openModalInformReceiptOfCheck('order', APP.scope.form)
								break
								case 'bankSlip':
								case 'bankTransfer': openModalBankTransfer('order', APP.scope.form)
								break
								default:
									changeOrder({
										id: APP.scope.form.id,
										status: 'AP',
									})
							}

							swal.close()
						}
					},
					cancelMatriculation:{
						params: {
							title: "Deseja Cancelar a Matrícula?",
							text: "",
							type: "warning",
						},
						callback: function() {
							$.ajax({
								url: '/admin/prospection/student/getValueNotPaid',
								method: 'post',
								data: {
									id: APP.scope.form.id,
								}
							}).then(function(resp) {
								console.log(resp);

								populate(document.forms.formModalMatriculationCancel, {
									id: APP.scope.form.id,
									fineValue: resp.fineValue,
									valueNotPaid: resp.valueNotPaid,
								})

								swal.close()
								$('#modalMatriculationCancel').modal('show')
							})

							// changeOrder({
							// 	id: APP.scope.form.id,
							// 	status: 'CA',
							// })
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
								id: APP.scope.form.id,
								status: 'LC',
							})
						}
					},
					renegMatriculation: {
						params: {
							title: "Deseja Renegociar a Matrícula?",
							text: "",
							type: "warning",
						},
						callback: function() {
							changeOrder({
								id: APP.scope.form.id,
								status: 'RG',
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
								id: APP.scope.form.id,
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
					closeOnConfirm: true,
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

			if (document.getElementById('contractFile')) {
				document.getElementById('contractFile').addEventListener('change', function(event) {
					document.getElementById('fileinput-filename_doc').innerText = event.target.files[0].name;
				})
			}
		});

		document.forms.formOrder.responsible_id.addEventListener('change', function(event) {
			changeOrder({
				id: APP.scope.form.id,
				responsible_id: event.target.value,
			})
		})
	} catch(error) {
		console.warn(error);
	}
</script>
@endsection
