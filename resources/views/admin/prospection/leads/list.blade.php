@extends('layouts.app')
@section('title', $module_page . ' ('. $title_page .')')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/clockpicker/clockpicker.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/switchery/switchery.css') !!}" />
{{-- <link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" /> --}}
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
				</div>
				<div class="ibox-content">
					<div class="row m-b">
						<form name="formFilter" method="get" action="" class="form-horizontal">
							<div class="col-lg-1">Filtro:</div>
							<div class="col-lg-4">
								<label class="control-label">É formado em psicologia?</label>
								<div class="i-checks">
									<label>
										<input type="radio" value="" name="is_formed_in_psychology"> <i></i>
										<span style="padding-left: 5px;">Todos</span>
									</label>
								</div>
								<div class="i-checks">
									<label>
										<input type="radio" value="0" name="is_formed_in_psychology"> <i></i>
										<span style="padding-left: 5px;">Não</span>
									</label>
								</div>
								<div class="i-checks">
									<label>
										<input type="radio" value="1" name="is_formed_in_psychology"> <i></i>
										<span style="padding-left: 5px;">Sim</span>
									</label>
								</div>
							</div>
							<div class="col-lg-3">
								<label class="control-label">Categoria de Curso</label>
								<select name="course_category" class="form-control m-b" onchange="updateCoursesByCategory()"><select>
							</div>
							<div class="col-lg-3">
								<label class="control-label">Curso</label>
								<select name="course" class="form-control m-b"><select>
							</div>
							<div class="col-lg-1">
								<button type="button" class="btn btn-primary" onclick="filterDataTables()">Filtrar</button>
							</div>
						</form>
					</div>

					<div class="full-height-scroll">
						@include('admin._components.dataTablesAjax')
					</div>
				</div>
			</div>
		</div>

		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Faça a importação de contatos</h5>
			</div>
			<div class="col-lg-12 ibox-content">
				<form action="/admin/prospection/prospect/import" method="post" enctype="multipart/form-data"
					class="form-horizontal" name="formImport">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-lg-3">
							<select name="course_category" class="form-control m-b" onchange="enableSubmitFormImport(event)"><select>
						</div>
						<div class="col-lg-6">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<span class="btn btn-default btn-file">
									<span class="fileinput-new">Selecionar arquivo excel pra importar</span>
									<span class="fileinput-exists">Alterar</span>
									<input type="file" name="import" accept=".xls,.xlsx,.csv" onchange="enableSubmitFormImport(event)" />
								</span>
								<span class="fileinput-filename"></span>
								<a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
							</div>
						</div>
						<div class="col-lg-3">
							<input type="submit" class="btn btn-primary" value="Importar" disabled name="btnSubmit" />
						</div>
						<script>
							function enableSubmitFormImport(event) {
								var form = event.target.form;
								setTimeout(function() {
									form.btnSubmit.disabled = !(form.course_category.value && form.import.value);
								}, 300);
							}
						</script>
				</form>
			</div>
		</div>
	</div>
</div>
</div>

@endsection

@section('scripts')
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
<script src="{!! asset('js/plugins/switchery/switchery.js') !!}" type="text/javascript"></script>
<!-- Page-Level Scripts -->

<!-- Jasny -->
{{-- <script src="{!! asset('js/plugins/jasny/jasny-bootstrap.min.js') !!}" type="text/javascript"></script> --}}

<script src="{!! asset('js/plugins/iCheck/icheck.min.js') !!}" type="text/javascript"></script>
<script>
	try {
		APP = {
			scope: {
				dataTable: {!! isset($dataTable) ? json_encode($dataTable) : 'null' !!},
				listSelectBox: <?= isset($listSelectBox) ? json_encode($listSelectBox) : 'null' ?>,
				filter: {!! isset($filter) ? json_encode($filter) : 'null' !!}
			}
		};

		if (APP.scope.listSelectBox) {
			if (APP.scope.listSelectBox.courseCategory) {
				var courseParams = {
					list: APP.scope.listSelectBox.courseCategory,
					target: document.forms.formImport.course_category,
					columnValue: "id",
					columnLabel: "description_pt",
					emptyOption: {
						label: "Selecione..."
					}
				};

				populateSelectBox(courseParams);
				courseParams.target = document.forms.formFilter.course_category;
				courseParams.emptyOption.label = "Todos";
				populateSelectBox(courseParams);
			}
		}

		if (APP.scope.filter) {
			populate(document.forms.formFilter, APP.scope.filter);
		}
	} catch (error) {
		console.warn(error);
	}

	function updateCoursesByCategory() {
		var courseCategoryId = document.forms.formFilter.course_category.value

		var courses = []
		var courseIds = []
		if (courseCategoryId) {
			// if (APP.scope.leads && APP.scope.leads.course_id) {
			// 	courseIds.push(APP.scope.leads.course_id)
			// }

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

		populateSelectBoxOptions.target = document.forms.formFilter.course
		populateSelectBox(populateSelectBoxOptions);
		// populateSelectBoxOptions.target = document.forms.formSchedule.course_id
		// populateSelectBox(populateSelectBoxOptions);
	}

	var dataTable = [];

	$(document).ready(function() {
		updateCoursesByCategory()

		dataTable[APP.scope.dataTable.id] = $('#' + APP.scope.dataTable.id).DataTable({
			"initComplete": function(settings, json) {
				updateInputMask();
			},
			ajax: {
				url: '/admin/prospection/{{ $flgType }}/dataTables',
				data: function (d) {
					$('form[name="formFilter"]').serializeArray().forEach(function(item) {
						d[item.name] = item.value;
					});
				}
			},
			columnDefs: [
				{
					"targets": -2,
					"data": "update",
					"render": function ( data, type, row, meta ) {
						if (row.deleted_at) {
							return "";
						}

						var url = APP.scope.dataTable.urlPage + "/update/" + row.id;
						return '<a href="/' + url + '"><i class="fas fa-pencil-alt" title="Editar"></i></a>';
					}
				},
				{
					"targets": -1,
					"data": "deleteEnable",
					"render": function ( data, type, row, meta ) {
						if (row.deleted_at) {
							var url = APP.scope.dataTable.urlPage + '/enable/' + row.id;
							return '<a href="/' + url + '"><i class="fas fa-check-circle" title="Habilitar"></i></a>';
						} else {
							var url = APP.scope.dataTable.urlPage + '/delete/' + row.id;
							return '<a href="/' + url + '"><i class="fas fa-trash-alt" title="Excluir"></i></a>';
						}
					}
				}
			],
			pageLength: 25,
			responsive: true,
			columns: [].concat(APP.scope.dataTable.header.map(function(item) {
				var className = "";

				if (APP.scope.dataTable.classColumn) {
					className = APP.scope.dataTable.classColumn[item.column] || "";
				}

				return { data: item.column, className: className };
			}), [{data: "update"}, {data: "deleteEnable"}]),
			dom: '<"html5buttons"B>lTfgitp',
			buttons: [{
					extend: 'copy',
					title: 'Lista de Unidades Escolares'
				},
				{
					extend: 'csv',
					title: 'Lista de Unidades Escolares'
				},
				{
					extend: 'excel',
					title: 'Lista de Unidades Escolares'
				},
				{
					extend: 'pdf',
					title: 'Lista de Unidades Escolares'
				},

				{
					extend: 'print',
					customize: function(win) {
						$(win.document.body).addClass('white-bg');
						$(win.document.body).css('font-size', '10px');

						$(win.document.body).find('table')
							.addClass('compact')
							.css('font-size', 'inherit');
					}
				}
			],
			language: {
				processing:     "Processando ...",
				search:         "Pesquisar",
				lengthMenu:    "Mostrar _MENU_ elementos",
				info:           "Mostrando item _START_ à _END_ de _TOTAL_ elementos",
				infoEmpty:      "Mostrando item 0 à 0 de 0 elementos",
				infoFiltered:   "(filtro de _MAX_ elementos ao total)",
				infoPostFix:    "",
				loadingRecords: "Carregando ...",
				zeroRecords:    "Não há nenhum elemento a ser exibido",
				emptyTable:     "Nenhum dado disponível na tabela",
				paginate: {
					first:      "Primeiro",
					previous:   "Anterior",
					next:       "Próximo",
					last:       "Último"
				},
				aria: {
					sortAscending:  ": ativar para classificar a coluna em ordem crescente",
					sortDescending: ": ativar para classificar a coluna em ordem decrescente"
				}
			}
		});

		$('#' + APP.scope.dataTable.id).on( 'page.dt', function () {
			setTimeout(updateInputMask, 300);
		});

	});

	function filterDataTables() {
		dataTable[APP.scope.dataTable.id].ajax.reload();
	}
</script>
@endsection
