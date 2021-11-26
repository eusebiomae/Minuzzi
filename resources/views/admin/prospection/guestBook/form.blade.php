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
												<a data-toggle="tab" href="#tab-1">Dados da Visita</a>
											</li>
											<li class="disabled">
												<a class="disabled" data-toggle="tab" href="#tab-2">Pós Visita</a>
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
											<h2 id="leads_visit"></h2>
											<form name="formVisit" method="post" action="{{ url($urlAction) }}" class="form-horizontal">
												<div class="modal-body">
													<div class="form-group">
														<div class="row">
															<div class="form-group col-md-6">
																<div class="ibox float-e-margins">
																	<div class="ibox-title">
																		<h5>Dados</h5>
																	</div>
																	<div class="ibox-content">
																		<div class=" col-lg-12">
																			<label>Nome</label>
																			<input type="text" name="typeahead_lead" placeholder="Lead..."
																				class="typeahead_2 form-control" /><br>
																		</div>
																		<div class="col-lg-12">
																			<div id="toTmplLead" class="contact-box center-version">

																			</div>
																		</div>
																	</div>

																</div>
															</div>
															<div class="form-group col-md-6">
																<div class="ibox float-e-margins">
																	<div class="ibox-title">
																		<h5>Dados do agendamento da visita</h5>
																	</div>
																	<div class="ibox-content">
																		<div class=" col-lg-12">
																			<label>Visitas relacionadas</label>
																			<select class="form-control m-b required" name="leads_visit_id"></select>
																		</div>
																		<div class="col-lg-12">
																			<div id="toTmplLeadVisit" class="contact-box center-version"></div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="modal-footer">
													@if(isset($data))
														<a href="{{ url('/admin/prospection/registry/insert/' . $data['leads_id']) }}" class="btn btn-success">Matrícula</a>
													@endif
													<button type="reset" class="btn btn-default">Cancelar</button>
													<button type="submit" class="btn btn-primary">Salvar</button>
												</div>
												{{ csrf_field() }}
												<input type="hidden" name="id">
												<input type="hidden" name="leads_id">
											</form>
										</div>
										<div id="tab-2" class="tab-pane">
											<form name="formPosVisit" method="post"
												action="{{ url('/admin/prospection/guestbook/pos_visit') }}" class="form-horizontal">
												<div class="modal-body">
													<div class="form-group">
														<div class="row">
															<input type="hidden" name="guest_book_id">
															{{ csrf_field() }}
															<input type="hidden" name="id">
															<div class="row" id="HTMLquestionPCX"></div>
															<div class="modal-footer">
																<button type="reset" class="btn btn-default">Cancelar</button>
																<button type="submit" class="btn btn-primary">Salvar</button>
															</div>
														</div>
													</div>
												</div>
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
															<button type="button" class="btn btn-primary" data-toggle="modal"
																data-target="#myModal"><i class="fa fa-phone" title="Ligação Realizada"></i></button>
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
														@include('admin.prospection.guestBook.phoneContact', $phoneCall)
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

<script id="tmplLead" type="text/x-dot-template">
	<div style="padding: 20px;">

		<h3 class="m-b-xs"><strong>@{{= it.badge_name || '' }}</strong></h3>
		<div class="font-bold">@{{= it.full_name || '' }}</div>

		<personaldata class="m-t-md">
			<br><br>
			<strong>Dados Pessoais</strong><br>
			<abbr title="Data de Nascimento"><strong>Dat. Nasc: </strong></abbr> @{{= it.birth_date || '' }}<br>
			<abbr title="Como se denomina"><strong>Gênero: </strong></abbr>@{{= it.gender || '' }}<br>
			<abbr title="Cadastro de Pessoa Física"><strong>CPF: </strong></abbr> @{{= it.cpf || '' }}<br>
			<abbr title="Registro Geral | Órgão Expedidor"><strong>RG: </strong></abbr> @{{= it.rg || '' }} | @{{= it.dispatcher_organ || '' }}<br>
		</personaldata>

		<address class="m-t-md">
			<strong>Dados de Contato</strong><br>
			<abbr title="Endereço Residencial, Número"><strong>End:</strong> </abbr> @{{= it.address || '' }}, @{{= it.number || '' }}<br>
			<abbr title="Complemento"><strong>Comp: </strong></abbr> @{{= it.complement || '' }}<br>
			<abbr title="Referência"><strong>Ref: </strong></abbr> @{{= it.reference || '' }}<br>
			<abbr title="Bairro"><strong>Bairro: </strong> </abbr> @{{= it.district || '' }}<br>
			<abbr title="Cidade - UF"><strong>Cidade: </strong> </abbr> @{{= it.city || '' }} - @{{= it.state || '' }}<br>
			<abbr title="CEP"><strong>CEP: </strong> </abbr>@{{= it.zip_code || '' }}<br>
			<abbr title="Telefone Residencial"><strong>Tel: </strong></abbr> @{{= it.phone || '' }}<br>
			<abbr title="Celular (Whatsapp)"><strong>Cel: </strong></abbr> @{{= it.cel_phone || '' }}<br>
			<abbr title="E-mail Pessoal"><strong>Email: </strong></abbr> @{{= it.email || '' }}<br>
		</address>

		<company class="m-t-md">
			<br><br>
			<strong>Dados Profissionais</strong><br>
			<abbr title="Nome da Empresa"><strong>Empresa: </strong></abbr> @{{= it.company_name || '' }}<br>
			<abbr title="Qual a função na Empresa"><strong>Cargo: </strong></abbr>@{{= it.office || '' }}<br>
			<abbr title="Setor ou Ramo de trabalho"><strong>Departamento: </strong></abbr> @{{= it.department || '' }}<br>
			<abbr title="Telefone Comercial | RAmal"><strong>Tel: </strong></abbr> @{{= it.commercial_phone || '' }} | @{{= it.branch_line || '' }}<br>
			<abbr title="Número para Envio de FAX"><strong>FAX: </strong></abbr> @{{= it.fax || '' }}<br>
			<abbr title="E-mail Comercial"><strong>Email: </strong></abbr> @{{= it.commercial_email || '' }}<br>
		</company>
	</div>
	<div class="contact-box-footer">
		<div class="m-t-xs btn-group">
			<a class="btn btn-xs btn-white" href="mailto:@{{= it.commercial_email || '' }}" target="_top"><i class="fa fa-envelope"></i> Email</a>
			<a class="btn btn-xs btn-white" data-toggle="modal" data-target="#myModalLead"><i class="fas fa-pencil-alt"></i> Editar</a>
		</div>
	</div>
</script>

<div class="modal inmodal" id="myModalLead" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
						class="sr-only">Close</span></button>
				<i class="fa fa-phone modal-icon"></i>
				<h4 class="modal-title">Dados Prospecto</h4>
				<small class="font-bold"></small>
			</div>
			<form method="post" name="formLead" action="{{ url( $url_page . '/lead') }}" class="form-horizontal">
				{{ csrf_field() }}
				<input name="id" type="hidden">
				@include('admin.prospection.leads.formLeads')
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script id="tmplLeadVisit" type="text/x-dot-template">
	<div style="padding: 20px;">

		<h3 class="m-b-xs"><strong>@{{= it ? it.subject || '' : '' }}</strong></h3>
		<div class="font-bold">@{{= it && it.course ? it.course.name_pt : '' }}</div>
		<div>Consultor</div>
		<div class="font-bold">@{{= it && it.consultant ? it.consultant.name : '' }}</div>

		<personaldata class="m-t-md">
			<br><br>
			<strong>Informações da Visita</strong><br>
			<abbr title="Data e Hora da Visita"><strong>Quando: </strong></abbr> @{{= it ? it.visit_date || '' : '' }} às @{{= it ? it.visit_time || '' : '' }}<br>
			<abbr title="Assunto em Destaque"><strong>Assunto: </strong></abbr>@{{= it ? it.subject || '' : '' }}<br>
			<abbr title="Observações Importantes"><strong>Importante: </strong></abbr>@{{= it ? it.observation || '' : '' }}<br>
		</personaldata>

		<address class="m-t-md">
			<strong>Local da Visita</strong><br>
			<abbr title="Descrição do Local"><strong>Local:</strong> </abbr> @{{= it ? it.location_description || '' : '' }}<br>
			<abbr title="Endereço Residencial, Número"><strong>End:</strong> </abbr> @{{= it ? it.address || '' : '' }}, @{{= it ? it.number || '' : '' }}<br>
			<abbr title="Complemento"><strong>Comp: </strong></abbr> @{{= it ? it.complement || '' : '' }}<br>
			<abbr title="Referência"><strong>Ref: </strong></abbr> @{{= it ? it.reference || '' : '' }}<br>
			<abbr title="Bairro"><strong>Bairro: </strong> </abbr> @{{= it ? it.district || '' : '' }}<br>
			<abbr title="Cidade - UF"><strong>Cidade: </strong> </abbr> @{{= it ? it.city || '' : '' }} - @{{= it ? it.state || '' : '' }}<br>
			<abbr title="CEP"><strong>CEP: </strong> </abbr>@{{= it ? it.zip_code || '' : '' }}<br>
		</address>

	</div>
	<div class="contact-box-footer">
		<div class="m-t-xs btn-group">
			<a class="btn btn-xs btn-white" data-toggle="modal" data-target="#myModalLeadVisit"><i class="fas fa-pencil-alt"></i> Editar</a>
			<a class="btn btn-xs btn-white" href="@{{= (it ? it.url + it.leads_id + '/' + it.id : '') }}"><i class="fas fa-eye"></i> Acessar visita</a>
		</div>
	</div>
</script>
@include('admin.prospection.leads.schedule')

@endsection

@section('scripts')
@parent
<!-- Mainly scripts -->
<script src="{!! asset('js/plugins/metisMenu/jquery.metisMenu.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}" type="text/javascript"></script>


<!-- Custom and plugin javascript -->
<script src="{!! asset('js/inspinia.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/pace/pace.min.js') !!}" type="text/javascript"></script>
<!-- SUMMERNOTE -->
<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}" type="text/javascript"></script>

<!-- Page-Level Scripts -->
<script src="{!! asset('js/plugins/dataTables/datatables.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/clockpicker/clockpicker.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/switchery/switchery.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/iCheck/icheck.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/typehead/bootstrap3-typeahead.min.js') !!}" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		$('.summernote').summernote({
			height: 100,
			toolbar: false,
			placeholder: 'Digite seu conteúdo',
		});

		$('.i-checks').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green'
		});

		try {
			APP.scope.guestBook = <?= isset($data) ? json_encode($data) : 'null' ?>;
			APP.scope.params = <?= isset($params) ? json_encode($params) : 'null' ?>;
			APP.scope.listSelectBox = <?= isset($listSelectBox) ? json_encode($listSelectBox) : 'null' ?>;
			APP.scope.HTMLquestionPCX = {};

			if (APP.scope.guestBook) {
				document.forms.phoneContact.guest_book_id.value = APP.scope.guestBook.id;

				if (!document.forms.formPosVisit.guest_book_id.value) {
					document.forms.formPosVisit.guest_book_id.value = APP.scope.guestBook.id;
				}

				populate(document.forms.formVisit, APP.scope.guestBook);

				if (APP.scope.guestBook.guest_book) {
					populate(document.forms.formPosVisit, APP.scope.guestBook.guest_book);
				}
			}

			if (APP.scope.listSelectBox) {
				if (APP.scope.listSelectBox.usersConsultant) {
					populateSelectBox({
						list: APP.scope.listSelectBox.usersConsultant,
						target: document.forms.formSchedule.consultant,
						columnValue: "id",
						columnLabel: "name",
						emptyOption: {
							label: "Selecione..."
						}
					});
				}

				if (APP.scope.listSelectBox.state) {
					var stateParams = {
						list: APP.scope.listSelectBox.state,
						target: document.forms.formLead.state,
						columnValue: "id",
						columnLabel: "description",
						emptyOption: {
							label: "Selecione..."
						}
					};

					populateSelectBox(stateParams);

					stateParams.target = document.forms.formSchedule.state;
					populateSelectBox(stateParams);
				}

				if (APP.scope.listSelectBox.city) {
					populateSelectBox({
						list: APP.scope.listSelectBox.city,
						target: document.forms.formSchedule.city_id,
						columnValue: "id",
						columnLabel: "name",
						emptyOption: {
							label: "Selecione..."
						}
					});
				}

				if (APP.scope.listSelectBox.course) {
					populateSelectBox({
						list: APP.scope.listSelectBox.course,
						target: document.forms.formSchedule.course_id,
						columnValue: "id",
						columnLabel: "name_pt",
						emptyOption: {
							label: "Selecione..."
						}
					});
				}
			}

			function setTmpLead(data) {
				setTmpl({
					data: data,
					tmplId: 'tmplLead',
					toTmplId: 'toTmplLead',
				});
			}

			function setTmpLeadVisit(data) {
				if (data) {
					data.url = '{{ url('/admin/prospection/guestbook/insert/') }}/';
				}

				setTmpl({
					data: data,
					tmplId: 'tmplLeadVisit',
					toTmplId: 'toTmplLeadVisit',
				});
			}

			function setHTMLquestionPCX(flgType) {
				document.getElementById('HTMLquestionPCX').innerHTML = APP.scope.HTMLquestionPCX[flgType];
				initSwitchery();
				$('form[name="formPosVisit"] .i-checks').iCheck({
					checkboxClass: 'icheckbox_square-green',
					radioClass: 'iradio_square-green'
				});

				populateQuestionAnswers({
					answers: APP.scope.guestBook.answers,
					form: document.forms.formPosVisit
				});
			}

			function generateSelectLeadsVisit(selectBy) {
				document.forms.formVisit.leads_id.value = APP.scope.typeahead.lead.id;

				setTmpLead(APP.scope.typeahead.lead);

				if (APP.scope.typeahead.lead) {
					var flgType = APP.scope.typeahead.lead.flg_type;

					if (APP.scope.HTMLquestionPCX[flgType]) {
						setHTMLquestionPCX(flgType);
					} else {
						$.get('/admin/prospection/guestbook/getHTMLquestionPCX/' + flgType).then(function(data) {
							APP.scope.HTMLquestionPCX[flgType] = data;
							setHTMLquestionPCX(flgType);
						});
					}
				}

				populate(document.forms.formLead, APP.scope.typeahead.lead);

				var leadsVisit = APP.scope.typeahead.lead.leads_visit;

				if (selectBy && leadsVisit && leadsVisit.length) {
					var leadVisit = leadsVisit.filter(function(item) {
						return item.id == selectBy;
					});

					selectBy = selectBy ? [selectBy] : null;
					leadVisit = leadVisit.length ? leadVisit[0] : null;

					if (leadVisit) {
						var consultant = leadVisit.consultant ? (leadVisit.consultant.hasOwnProperty('id') ? leadVisit.consultant.id : leadVisit.consultant) : null;

						populate(document.forms.formSchedule, Object.assign({}, leadVisit, {
							consultant: consultant
						}));

						setTmpLeadVisit(leadVisit);
					}

				} else {
					setTmpLeadVisit();
					populate(document.forms.formSchedule, null);
				}

				populateSelectBox({
					list: leadsVisit || [],
					target: document.forms.formVisit.leads_visit_id,
					columnValue: "id",
					columnLabel: "subject",
					selectBy: selectBy || null,
					emptyOption: {
						label: "Selecione..."
					}
				});

			}

			Promise.all([
				$.get('/admin/prospection/prospect/json'),
				$.get('/admin/prospection/client/json'),
				$.get('/admin/prospection/former_client/json'),
			])
			.then(function(data) {
				APP.scope.leads = [].concat(data[0], data[1], data[2]);

				APP.scope.typeahead = {};

				if (APP.scope.params.idLead) {
					var lead = APP.scope.leads.filter(function(item) {
						return item.id == APP.scope.params.idLead;
					});

					if (lead.length) {
						lead = lead[0];
						APP.scope.typeahead.lead = lead;
						document.forms.formVisit.typeahead_lead.value = lead.full_name;

						var leadVisit = lead.leads_visit.filter(function(item) {
							return item.id == APP.scope.params.idLeadsVisit;
						});

						document.getElementById('leads_visit').innerText = leadVisit.length ? leadVisit[0].subject : "";

						generateSelectLeadsVisit(APP.scope.params.idLeadsVisit);
					}
				}

				$(".typeahead_2").typeahead({
					source: APP.scope.leads,
					autoSelect: true,
					displayText: function(item) {
						return item.full_name;
					},
					afterSelect: function(item) {
						APP.scope.typeahead.lead = item;

						generateSelectLeadsVisit();
					}
				});
			}, 'json');


			function changeLeadVisit(event) {
				generateSelectLeadsVisit(event.target.value);
			}

			document.forms.formVisit.leads_visit_id.removeEventListener('change', changeLeadVisit);
			document.forms.formVisit.leads_visit_id.addEventListener('change', changeLeadVisit);

			var elem = document.querySelector('.js-switch');
			var switchery = new Switchery(elem, {
				color: '#1AB394'
			});
		} catch (error) {
			console.warn(error);
		}

	});
</script>
@endsection
