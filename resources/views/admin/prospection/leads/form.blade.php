@extends('layouts.app')

@section('css')
@parent
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/clockpicker/clockpicker.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/switchery/switchery.css') !!}" />

<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/basic.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/dropzone.css') !!}" />
@endsection

@section('content')
@include($header)

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-lg-12">
							<div class="tabs-container">
								<ul class="nav nav-tabs">
									<li class="active"><a data-toggle="tab" href="#tab-1"> Dados Prospecto</a></li>
									<li class="disabled"><a class="disabled" disabled data-toggle="tab" href="#tab-2">Dados Telefônicos</a></li>
								</ul>
								<div class="tab-content">
									<div id="tab-1" class="tab-pane active">
										<div class="panel-body">
											<form name="formLeads" method="post" action="{{ url($urlAction) }}" enctype="multipart/form-data" class="form-horizontal">
												{{ csrf_field() }}
												<input name="id" type="hidden">
												@include('admin.prospection.leads.formLeads')
												<div class="col-lg-12">
													<div class="col-lg-10">
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<button type="submit" class="btn btn-w-m btn-primary">Salvar</button>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
									<div id="tab-2" class="tab-pane">
										<div class="panel-body">
											<div class="wrapper wrapper-content animated fadeInRight">

												<div class="row">
													<div class="col-lg-12">
														<div class="ibox">
															<div class="ibox-content">
																<div class="row">
																	<div class="col-lg-10">
																		<h2>Contatos Telefônicos</h2>
																		<p>Histórico dos contatos telefônico com o responsável do aluno</p>
																	</div>
																	<div class="col-lg-2">
																		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-phone" title="Ligação Realizada"></i></button>
																		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalLeadVisit"><i class="fa fa-calendar" title="Agendar Visita"></i></button>
																	</div>
																</div>
																<div class="row">
																	@if(isset($phoneCall))
																	@include('admin._components.dataTables', $phoneCall)
																	@endif
																</div>
																	@if(isset($phoneCall))
																		@include('admin.prospection.leads.phoneContact', $phoneCall)
																	@endif
																	@include('admin.prospection.leads.schedule')
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
<!-- SUMMERNOTE -->
<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}"></script>

<!-- Page-Level Scripts -->
<script src="{!! asset('js/plugins/dataTables/datatables.min.js') !!}"></script>
<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>
<script src="{!! asset('js/plugins/clockpicker/clockpicker.js') !!}"></script>
<script src="{!! asset('js/plugins/switchery/switchery.js') !!}"></script>
<script src="{!! asset('js/plugins/dropzone/dropzone.js') !!}"></script>
<script>
	try {
		APP = {
			scope: {
				leads: <?= isset($data) ? json_encode($data) : 'null' ?>,
				phoneCall: <?= isset($phoneCall) ? json_encode($phoneCall) : 'null' ?>,
				listSelectBox: <?= isset($listSelectBox) ? json_encode($listSelectBox) : 'null' ?>,
			}
		};
	} catch (error) {
		console.warn(error);
	}

	initSwitchery();

	function updateCoursesByCategory() {
		var courseCategoryId = document.forms.formLeads.course_category_id.value

		var courses = []
		var courseIds = []
		if (courseCategoryId) {
			if (APP.scope.leads && APP.scope.leads.course_id) {
				courseIds.push(APP.scope.leads.course_id)
			}

			courses = APP.scope.listSelectBox.course.filter(function(item) { return item.course_category_id == courseCategoryId })
		}

		var populateSelectBoxOptions = {
			list: courses,
			columnValue: "id",
			columnLabel: "title_pt",
			selectBy: courseIds,
			emptyOption: {
				label: "Selecione..."
			}
		}

		populateSelectBoxOptions.target = document.forms.formLeads.course_id
		populateSelectBox(populateSelectBoxOptions);
		populateSelectBoxOptions.target = document.forms.formSchedule.course_id
		populateSelectBox(populateSelectBoxOptions);
	}

	$(document).ready(function() {
		try {
			if (APP.scope.listSelectBox) {
				if (APP.scope.listSelectBox.state) {
					var stateParams = {
						list: APP.scope.listSelectBox.state,
						target: document.forms.formLeads.state,
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

				if (APP.scope.listSelectBox.courseCategory) {
					populateSelectBox({
						list: APP.scope.listSelectBox.courseCategory,
						target: document.forms.formLeads.course_category_id,
						columnValue: "id",
						columnLabel: "description_pt",
						emptyOption: {
							label: "Selecione..."
						}
					});
				}

				if (APP.scope.listSelectBox.usersConsultant) {
					populateSelectBox({
						list: APP.scope.listSelectBox.usersConsultant,
						target: document.forms.formLeads['responsibleSeller[]'],
						columnValue: "id",
						columnLabel: "name",
					});
				}
			}

			if (APP.scope.leads) {
				populate(document.forms.formLeads, APP.scope.leads);

				document.querySelectorAll('input[name="leads_id"]').forEach(function(elem) {
					elem.value = APP.scope.leads.id;
				});

				document.forms.formPhoneContact.contact_name.value = APP.scope.leads.student_name + (APP.scope.leads.student_last_name ? " " + APP.scope.leads.student_last_name : "");

				updateCoursesByCategory()
			}

		} catch (error) {
			console.warn(error);
		}

		$('.summernote').summernote({
			height: 100,
			toolbar: false,
			placeholder: 'Digite seu conteúdo',
			required: true
		});

		$('#birth_date').on('change', function(event) {
			calculateSetBirthdate(event.target.value);
		});

		$('.date .input-group.date').datepicker({
			todayBtn: "linked",
			startView: 2,
			keyboardNavigation: true,
			forceParse: false,
			calendarWeeks: true,
			autoclose: true,
			format: "dd/mm/yyyy",
			container: "body",
			locale: {
				daysOfWeek: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
				monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
				firstDay: 1
			}
		});

	});

	function calculateSetBirthdate(value) {
		var age = 0;

		// if (value) {
		// 	age = calculateBirthdate(value);
		// }

		// $('#age').val(age);
	}

	try {
		if (APP.scope.leads && APP.scope.leads.birth_date) {
			calculateSetBirthdate(APP.scope.leads.birth_date);
		}
	} catch (error) {
		console.warn(error);
	}


</script>
@endsection
