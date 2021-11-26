@extends('layouts.app')

@section('title', $module_page . ' ('. $title_page .')')

@section('css')
@parent
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/clockpicker/clockpicker.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/switchery/switchery.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/iCheck/custom.css') !!}" />
@endsection

@section('content')
@include($header)
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><?= $title_page ?> <?= $module_page ?></h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-lg-12">
							<div class="panel blank-panel">

								<div class="panel-heading">
									<div class="panel-title m-b-md">
										<h4>Edite os dados do cliente ou faça anotações do contato!</h4>
									</div>
									<div class="panel-options">

										<ul class="nav nav-tabs">
											<li class="active">
												<a data-toggle="tab" href="#tab-1">Dados da Matrícula</a>
											</li>
											<li class="disabled">
												<a class="disabled" data-toggle="tab" href="#tab-2">Histórico de Pagamentos</a>
											</li>
											<li class="disabled">
												<a class="disabled" data-toggle="tab" href="#tab-3">Contatos Telefônicos</a>
											</li>
										</ul>
									</div>
								</div>

								<div class="panel-body">
									<div class="tab-content">
										<div id="tab-1" class="tab-pane active">

											<form name="formRegistry" method="post" action="{{ url($urlAction) }}" class="form-horizontal">
												<div class="form-group">
													<div class="row">
														<div class=" col-md-12">
															<div class=" col-lg-12">
																<label>Pesquise uma lead cadastrado</label>
																<input type="text" placeholder="item..." class="typeahead_2 form-control" /><br>
															</div>
														</div>
													</div>
												</div>
												<div class="modal-body">
													<div class="form-group">
														<div class="row">
															<div class="panel-body">
																<div class="panel-group" id="accordion">
																	<div class="panel panel-default">
																		<div class="panel-heading">
																			<h5 class="panel-title">
																				<a data-toggle="collapse" data-parent="#accordion" href="#lead">Dados do Aluno</a>
																			</h5>
																		</div>
																		<div id="lead" class="panel-collapse collapse in">
																			<div class="panel-body">
																				{{ csrf_field() }}
																				<input name="id" type="hidden">
																				@include('admin.prospection.leads.formLeads')
																			</div>
																		</div>
																	</div>

																	<div class="panel panel-default">
																		<div class="panel-heading">
																			<h4 class="panel-title">
																				<a data-toggle="collapse" data-parent="#accordion" href="#responsiblePayment">Dados do Responsável Financeiro</a>
																			</h4>
																		</div>
																		<div id="responsiblePayment" class="panel-collapse collapse">
																			<div class="panel-body">
																				@include('admin.prospection.registry.formResponsiblePayment')
																			</div>
																		</div>
																	</div>
																	<div class="panel panel-default">
																		<div class="panel-heading">
																			<h4 class="panel-title">
																				<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Dados da Matrícula</a>
																			</h4>
																		</div>
																		<div id="collapseThree" class="panel-collapse collapse">
																			<div class="panel-body">

																				<div class="col-lg-12">
																					<div class="form-group">
																						{{-- <div class=" col-lg-4">
																							<label>Curso </label>
																							<select class="form-control m-b " name="course_id"></select>
																						</div> --}}
																						@if ($fieldPageConfig->show('class_id'))
																						<div class=" col-lg-4">
																							<label>Turma </label>
																							<select class="form-control m-b " name="class_id" required {!! $fieldPageConfig->attr('class_id') !!}></select>
																						</div>
																						@endif

																						@if ($fieldPageConfig->show('city_id'))
																						<div class=" col-lg-4">
																							<label>Cidade </label>
																							<select class="form-control m-b " name="city_id" required {!! $fieldPageConfig->attr('city_id') !!}></select>
																						</div>
																						@endif

																					</div>

																					<div class="form-group">

																						@if ($fieldPageConfig->show('consultant'))
																						<div class=" col-lg-6">
																							<label>Consultor </label>
																							<select class="form-control m-b " name="consultant" required {!! $fieldPageConfig->attr('consultant') !!}></select>
																						</div>
																						@endif

																						@if ($fieldPageConfig->show('start_payment_date'))
																						<div class="col-lg-3">
																							<div class="form-group col-lg-12 date">
																								<label>Primeira Parcela </label>
																								<div class="input-group date">
																									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																									<input type="text" id="start_payment_date" name="start_payment_date" class="form-control" required {!! $fieldPageConfig->attr('start_payment_date') !!} readonly />
																								</div>
																							</div>
																						</div>
																						@endif

																						@if ($fieldPageConfig->show('form_payment'))
																						<div class=" col-lg-3">
																							<label>Forma de Pagamento </label>
																							<select class="form-control m-b " name="form_payment" required {!! $fieldPageConfig->attr('form_payment') !!}>
																								<option value="">Selecione...</option>
																								<option value="D">Dinheiro</option>
																								<option value="B">Boleto</option>
																								<option value="C">Cheque</option>
																								<option value="CC">Cartão</option>
																								<option value="O">Outro</option>
																							</select>
																						</div>
																						@endif

																					</div>

																					<div class="form-group">

																						@if ($fieldPageConfig->show('total_value'))
																						<div class="col-sm-4">
																							<label class=" control-label">Valor</label>
																							<input type="text" id="total_value" name="total_value" class="form-control" value="" required {!! $fieldPageConfig->attr('total_value') !!} />
																						</div>
																						@endif

																						@if ($fieldPageConfig->show('discount'))
																						<div class="col-sm-4">
																							<label class=" control-label">Desconto</label>
																							<input type="text" id="discount" name="discount" class="form-control" value="" required {!! $fieldPageConfig->attr('discount') !!} />
																						</div>
																						@endif

																						@if ($fieldPageConfig->show('total_payble'))
																						<div class="col-sm-4">
																							<label class=" control-label">Total a Pagar</label>
																							<input type="text" id="total_payble" name="total_payble" class="form-control" value="" required {!! $fieldPageConfig->attr('total_payble') !!} />
																						</div>
																						@endif

																					</div>

																					<div class="form-group">

																						@if ($fieldPageConfig->show('number_installments'))
																						<div class="col-sm-3">
																							<label class=" control-label">Qdt Parcelas</label>
																							<input type="text" id="number_installments" name="number_installments" class="form-control" value="" required {!! $fieldPageConfig->attr('number_installments') !!} />
																						</div>
																						@endif

																						@if ($fieldPageConfig->show('installments_sd'))
																						<div class="col-sm-3">
																							<label class=" control-label">Parcela SD</label>
																							<input type="text" id="installments_sd" name="installments_sd" class="form-control" value="" required {!! $fieldPageConfig->attr('installments_sd') !!} />
																						</div>
																						@endif

																						@if ($fieldPageConfig->show('installments_cd'))
																						<div class="col-sm-3">
																							<label class=" control-label">Parcela CD</label>
																							<input type="text" id="installments_cd" name="installments_cd" class="form-control" value="" required {!! $fieldPageConfig->attr('installments_cd') !!} />
																						</div>
																						@endif

																						@if ($fieldPageConfig->show('expiry_payment_day'))
																						<div class="col-sm-3">
																							<label class=" control-label">Dia do Vencimento</label>
																							<input type="text" id="expiry_payment_day" name="expiry_payment_day" class="form-control" value="" required {!! $fieldPageConfig->attr('expiry_payment_day') !!} />
																						</div>
																						@endif

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

												<div class="modal-footer">
													<button type="reset" class="btn btn-default">Cancelar</button>
													<button type="submit" class="btn btn-primary">Salvar</button>
												</div>
												{{ csrf_field() }}
												<input type="hidden" name="id">
												<input type="hidden" name="leads_id">
											</form>
										</div>
										<div id="tab-2" class="tab-pane">
											<form name="formPaymentHistory" method="post" action="{{ url('/admin/prospection/registry/payment_history') }}" class="form-horizontal" onsubmit="return paymentHistories.submit(event)">
												<div class="modal-body">
													<div class="form-group">
														<div class="modal-body">
															<div class="form-group">
																<div class="row">
																	<div class="panel-body">
																		<div class="form-group col-md-6">
																			<div class="ibox float-e-margins">
																				<div class="ibox-title">
																					<h5>Histórico de Pagamento</h5>
																				</div>
																				<div class="ibox-content">
																					<div class="col-lg-12">

																						<table class="table">
																							<thead>
																								<tr>
																									<th>#</th>
																									<th>Data</th>
																									<th>Valor</th>
																									<th>E</th>
																									<th>D</th>
																								</tr>
																							</thead>
																							<tbody id="toTmplPaymentHistory">

																							</tbody>
																							<tfoot>
																								<tr>
																									<th colspan="2">Valor Total</th>
																									<th colspan="3">R$ <span data-payment-history-total>0,00</span></th>
																								</tr>
																							</tfoot>
																						</table>
																					</div>
																				</div>

																			</div>
																		</div>
																		<div class="form-group col-md-6">
																			<div class="ibox float-e-margins">
																				<div class="ibox-title">
																					<h5>Adicionar Pagamento</h5>
																				</div>
																				<div class="ibox-content">
																					<div class="col-lg-12">
																						<div class="contact-box center-version">
																							<div style="padding: 20px;">
																								<div class="date">
																									<label>Data do Pagamento </label>
																									<div class="input-group date">
																										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																										<input type="text" name="payment_date" class="form-control"  readonly>
																									</div>
																								</div>

																								<div>
																									<label class=" control-label">Valor</label>
																									<input type="text" name="value" class="form-control" >
																								</div>
																							</div>

																							<div class="contact-box-footer">
																								<div class="m-t-xs btn-group">
																									<button type="submit" class="btn btn-xs btn-white">
																										<i class="fas fa-pencil-alt"></i>
																										Adicionar Pagamento
																									</button>
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
													</div>
												</div>
												<div class="modal-footer"></div>
												{{ csrf_field() }}
												<input name="registry_id" type="hidden">
												<input name="id" type="hidden">
											</form>
										</div>
										<div id="tab-3" class="tab-pane">
											<div class="panel-body">
												<div class="row">
													<div class="col-lg-12">
														<div class="col-lg-11">
															<h2>Contatos Telefônicos</h2>
															<p>Histôrico dos contatos telefônico com o Lead</p>
														</div>
														<div class="col-lg-1">
															<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-phone" title="Ligação Realizada"></i></button>
														</div>
														<div class="grid">
															@if(isset($phoneCall))
															@foreach($phoneCall as $item)

															<div class="grid-item">
																<div class="ibox">
																	<div class="ibox-content">
																		<h4 class="font-bold">{{ $item->subject }}</h4>
																		<p><?= $item->observation ?></p>
																	</div>
																</div>
															</div>

															@endforeach
															@endif
														</div>
														@include('admin.prospection.leads.phoneContact')
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
		</div>
	</div>
</div>

<script id="tmplPaymentHistory" type="text/x-dot-template">
	<tr data-id-context="@{{= it.id }}">
		<td>@{{= it.id }}</td>
		<td>@{{= it.payment_date }}</td>
		<td>R$ @{{= it.value }}</td>
		<td><i class="fas fa-pencil-alt" onclick="paymentHistories.edit(@{{= it.id }})" title="Editar"></i></td>
		<td><i class="far fa-trash-alt demo4" title="Excluir" onclick="paymentHistories.delete(@{{= it.id }})"></i></td>
	</tr>
</script>
@endsection

@section('scripts')
@parent
<script src="{!! asset('js/plugins/switchery/switchery.js') !!}"></script>
<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}"></script>
<script>

	try {
		var elem = document.querySelector('.js-switch');
		var switchery = new Switchery(elem, {
			color: '#1AB394'
		});

		APP.scope.lead = <?= isset($lead) ? json_encode($lead) : 'null' ?>;
		APP.scope.listSelectBox = <?= isset($listSelectBox) ? json_encode($listSelectBox) : 'null' ?>;

		if (APP.scope.listSelectBox.leadsStatus) {
			populateSelectBox({
				list: APP.scope.listSelectBox.leadsStatus,
				target: document.forms.formPhoneContact.leads_status_id,
				columnValue: "id",
				columnLabel: "description_pt",
				emptyOption: {
					label: "Selecione..."
				}
			});
		}

		if (APP.scope.listSelectBox.course) {
			populateSelectBox({
				list: APP.scope.listSelectBox.course,
				target: document.forms.formRegistry.course_id,
				columnValue: "id",
				columnLabel: "name_pt",
				emptyOption: {
					label: "Selecione..."
				}
			});
		}

		if (APP.scope.listSelectBox.city) {
			populateSelectBox({
				list: APP.scope.listSelectBox.city,
				target: document.forms.formRegistry.city_id,
				columnValue: "id",
				columnLabel: "name",
				emptyOption: {
					label: "Selecione..."
				}
			});
		}

		if (APP.scope.listSelectBox.class) {
			populateSelectBox({
				list: APP.scope.listSelectBox.class,
				target: document.forms.formRegistry.class_id,
				columnValue: "id",
				columnLabel: "name",
				emptyOption: {
					label: "Selecione..."
				}
			});
		}

		if (APP.scope.listSelectBox.state) {
			populateSelectBox({
				list: APP.scope.listSelectBox.state,
				target: [
					document.forms.formRegistry.state,
					document.forms.formRegistry.responsible_state
				],
				columnValue: "id",
				columnLabel: "description",
				emptyOption: {
					label: "Selecione..."
				}
			});
		}

		if (APP.scope.lead) {
			APP.scope.lead.leads_id = APP.scope.lead.id;
			delete APP.scope.lead.id;

			populate(document.forms.formRegistry, APP.scope.lead);
		}

		$('.summernote').summernote({
			height: 100,
			toolbar: false,
			placeholder: 'Digite seu conteúdo',
		});
	} catch (error) {
		console.warn(error);
	}
</script>
@endsection
