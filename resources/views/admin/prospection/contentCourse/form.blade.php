@extends('layouts.app')

{{-- @section('title', $module_page . ' ('. $title_page .')') --}}

@section('css')
	<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/clockpicker/clockpicker.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/switchery/switchery.css') !!}" />

	<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/basic.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/dropzone.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/select2/select2.min.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/sweetalert/sweetalert.css') !!}"/>
	<link rel="stylesheet" href="{!! asset('css/plugins/radio-button-group/radio-button-group.css') !!}"/>

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
							<form name="formCourse" method="post" action="{{ url($urlAction) }}" class="form-horizontal" enctype="multipart/form-data">
								{{ csrf_field() }}
								<input id="id" name="id" type="hidden" value="">

								<div class="tabs-container">
									<ul class="nav nav-tabs">
										<li class="active"><a data-toggle="tab" href="#tab-contentCourse">Módulos</a></li>
										<li><a class="" data-toggle="tab" href="#tab-class">Turmas</a></li>
									</ul>

									<div class="tab-content">
										<div id="tab-contentCourse" class="tab-pane active">
											<div class="panel-body">
												<div class="animated fadeInRight">
													@include('admin.prospection.contentCourse.form_group')
												</div>
											</div>
										</div>

										<div id="tab-class" class="tab-pane">
											<div class="panel-body">
												<div class="animated fadeInRight">
													<div class="col-sm-10">
														<h3>Relacionamento de turmas</h3>
													</div>
													<div class="col-sm-2">
														<div class="text-right m-b-md">
															<button type="button" class="btn btn-primary" title="Adicionar novo" onclick="newModule()" >
																<i class="fa fa-plus"></i>
															</button>
														</div>
													</div>
													<div class="col-sm-12">
														<div id="targetModule"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group m-t-sm">
									<div class="col-sm-12 text-right">
										<button class="btn btn-white" type="reset">Cancelar</button>
										<button class="btn btn-primary" type="submit">Salvar alterações</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script id="tmplModule" type="text/x-dot-template">
	<div class="form-group" style="border-radius: 5px; border: 1px solid #ddd; padding-bottom: 5px" data-module="@{{= it.key }}">
		<input type="hidden" name="module[@{{= it.key }}][id]" value="@{{= it.id }}" />
		<div class="row p-w-sm">
			<div class="col-sm-6">
				<label class="control-label">Turma</label>
				<div class="gp-block-ruby">
					<select name="module[@{{= it.key }}][class_id]" class="select2 form-control" value="@{{= it.class_id || '' }}"></select>
				</div>
			</div>

			<div class="col-sm-2" style="padding-top: 25px; cursor: pointer;">
				<div class="radio-group radio-group-center">
					<input type="radio" id="presential_@{{= it.key }}" name="module[@{{= it.key }}][type]" value="presential" onchange="onChangeModulePresentialOnline(this, '@{{= it.key }}')">
					<label class="text-uppercase" for="presential_@{{= it.key }}">Presencial</label>
					<input type="radio" id="online_@{{= it.key }}" name="module[@{{= it.key }}][type]" value="online" onchange="onChangeModulePresentialOnline(this, '@{{= it.key }}')">
					<label class="text-uppercase" for="online_@{{= it.key }}">Online</label>
				</div>
			</div>

			<div class="col-sm-1">
				<label class="control-label">Sequência</label>
				<input type="number" name="module[@{{= it.key }}][sequence]" class="form-control" value="@{{= it.sequence || '' }}">
			</div>

			<div class="col-sm-2">
				<label class=" control-label">Data da Aula</label>
				<div class="input-group date">
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					<input type="text" name="module[@{{= it.key }}][start_date]" class="form-control" readonly value="@{{= it.start_date || '' }}">
				</div>
			</div>

			<div class="col-sm-1 text-right" style="padding-top: 25px; cursor: pointer; color: #f00">
				<button type="button" class="btn btn-danger p-2" title="Excluir" onclick="removeFormGroup(event)">
					<i class="fa fa-times"></i>
				</button>
			</div>
		</div>
	</div>
</script>

@endsection

@section('scripts')
	<!-- Mainly scripts -->
	<script src="{!! asset('js/plugins/metisMenu/jquery.metisMenu.js') !!}"></script>
	<script src="{!! asset('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}"></script>

	<!-- Custom and plugin javascript -->
	<script src="{!! asset('js/inspinia.js') !!}"></script>
	<!-- SUMMERNOTE -->
	<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}"></script>

	<!-- Page-Level Scripts -->
	<script src="{!! asset('js/plugins/dataTables/datatables.min.js') !!}"></script>
	<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>
	<script src="{!! asset('js/plugins/clockpicker/clockpicker.js') !!}"></script>
	<script src="{!! asset('js/plugins/switchery/switchery.js') !!}"></script>
	<script src="{!! asset('js/plugins/jasny/jasny-bootstrap.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/dropzone/dropzone.js') !!}"></script>
	<script src="{!! asset('js/plugins/select2/select2.full.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/sweetalert/sweetalert.min.js') !!}"></script>

<script>
	function onChangeModulePresentialOnline(target, key) {
		var row = target.closest('[data-module]')
		var elemSequence = row.querySelector('[name$="[sequence]"]')
		var elemStartDate = row.querySelector('[name$="[start_date]"]')

		if (target.value == 'presential') {
			elemSequence.disabled = true
			elemStartDate.disabled = false
		} else
		if (target.value == 'online') {
			elemSequence.disabled = false
			elemStartDate.disabled = true
		}
	}

	function removeFormGroup(event) {
		event.target.closest('.form-group').remove();
	}

	function newModule(data) {
		if (!data) {
			data = {
				id: '',
				content_course_id: '',
				type: 'presential',
				sequence: '',
			};
		}

		data.key = generateUniqueKey()

		var tmpl = setTmplInsertAdjacentHTML({
			tmpl: 'tmplModule',
			toTmpl: 'targetModule',
			data: data,
		});

		try {
			var selectElem = tmpl.querySelector('[name$="[class_id]"]')

			populateSelectBox({
				list: APP.scope.listSelectBox.class,
				target: selectElem,
				columnValue: "id",
				columnLabel: "name",
				selectBy: [ data.class_id ],
				emptyOption: {
					label: "Selecione..."
				}
			});

			$(selectElem).select2()

			if (data.type) {
				var elemType = tmpl.querySelector('[name$="[type]"][value="' + data.type + '"]')
				elemType.checked = true
				onChangeModulePresentialOnline(elemType, data.key)
			}

		} catch (error) {
			console.warn(error)
		}

		setDatePicker(tmpl.querySelector('[name$="[start_date]"]'))
	}

	APP.payload = {!! isset($payload) ? json_encode($payload) : '{}' !!}
	APP.scope = {
		course: <?=isset($data) ? json_encode($data) : 'null' ?>,
		listSelectBox: <?=isset($listSelectBox) ? json_encode($listSelectBox) : 'null' ?>,
		pathFile: <?=isset($pathFile) ? json_encode($pathFile) : 'null' ?>,
	}

	$(document).ready(function() {
		try {

			if (APP.scope.course) {
				populate(document.forms.formCourse, APP.scope.course);

				if (APP.scope.course.img) {
					var img = document.createElement('img');
					img.setAttribute('src', '/' + APP.scope.pathFile + '/' + APP.scope.course.img);
					img.style.maxHeight = '100px';

					document.getElementById('img').appendChild(img);
				}
			}

			if (APP.scope.listSelectBox) {
				if (APP.scope.listSelectBox.courseCategory) {

					populateSelectBox({
						list: APP.scope.listSelectBox.courseCategory,
						target: document.forms.formCourse['course_category_id[]'],
						columnValue: "id",
						columnLabel: "description_pt",
						selectBy: APP.scope.course ? APP.payload.courseCategory.map(function(item) { return item.id }) : null,
					});
				}
			}

			$('.summernote').summernote({
				height: 250,
				placeholder: 'Digite seu conteúdo'
			});

			$(".select2_demo_1").select2();

			if (APP.payload.courseModule && APP.payload.courseModule.length) {
				APP.payload.courseModule.forEach(newModule)
			} else {
				newModule()
			}

			//  Sweet alert
			/*
			$('.gp-alert').click(function ($event) {
				try {
					var gpAlertKey = $event.target.dataset.gpAlert;
					var mapAlert = {
						markPay: {
							params: {
								title: "Deseja excluir a transação?",
								text: "Essa ação exclui todas as transações desta fatura e é IRREVERSÍVEL.",
								type: "warning",
							},
							callback: function () {
								swal("Feito!", "Excluir a transação.", "success");
							}
						},
						delete: {
							params: {
								title: "Deseja excluir esta fatura?",
								text: "Essa ação é IRREVERSÍVEL",
								type: "warning",
							},
							callback: function () {
								swal("Feito!", "Excluido esta fatura.", "success");
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
			//  Sweet alert
			$('.gp-alert').click(function ($event) {
				try {
					var gpAlertKey = $event.target.dataset.gpAlert;
					var mapAlert = {
						markPay: {
							params: {
								title: "Deseja excluir a transação?",
								text: "Essa ação exclui todas as transações desta fatura e é IRREVERSÍVEL.",
								type: "warning",
							},
							callback: function () {
								swal("Feito!", "Excluir a transação.", "success");
							}
						},
						delete: {
							params: {
								title: "Deseja excluir esta fatura?",
								text: "Essa ação é IRREVERSÍVEL",
								type: "warning",
							},
							callback: function () {
								swal("Feito!", "Excluido esta fatura.", "success");
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
			});*/

		} catch(error) {
			console.warn(error);
		}
	});

</script>
@endsection
