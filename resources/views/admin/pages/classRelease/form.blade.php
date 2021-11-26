@extends('layouts.app')

@section('title', 'Fazer a inscrição do aluno')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-sm-9">
    <h2>Liberação Aulas para Alunos</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
			<li class="active">
        Gestão Alunos
			</li>
			<li>
        Liberação de Aulas
			</li>
			<li class="active">
        <strong>Liberação de Aulas Aluno</strong>
      </li>
    </ol>
  </div>
	<div class="col-sm-3" style="padding-top: 30px; text-align: right">
  </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          Lista de aulas por aluno
        </div>
        <div class="ibox-content">
					<form name="form" method="post" action="/admin/class_release/save" class="form-horizontal">
						<div class="row">
							{{ csrf_field() }}
							<input type="hidden" name="id">
							<div class="col-sm-2">
								<label class="control-label">Tipo</label>
								<input type="text" name="typeName" class="form-control" disabled>
							</div>

							<div class="col-sm-3">
								<label class="control-label">Categoria</label>
								<input type="text" name="categoryName" class="form-control" disabled>
							</div>

							<div class="col-sm-2">
								<label class="control-label">Subcategoria</label>
								<input type="text" name="subcategoryName" class="form-control" disabled>
							</div>

							<div class="col-sm-5">
								<label class="control-label">Curso</label>
								<input type="text" name="courseName" class="form-control" disabled>
							</div>
							<div class="col-sm-4">
								<label class="control-label">Turma</label>
								{{-- Deixar apenas para visualização --}}
								<input type="text" name="className" class="form-control" disabled>
							</div>

							<div class="col-sm-8">
								<label class="control-label">Nome*</label>
								{{-- Deixar apenas para visualização --}}
								<input type="text" name="studentName" class="form-control" disabled>
							</div>

							<div class="col-sm-3">
								<label class="control-label">Data Início*</label>
								{{-- Deve trazer já a data de aprovação da inscrição --}}
								<input type="text" name="register_date" class="form-control" required readonly>
								<span class="help-block m-b-none">Data de início do curso.</span>
							</div>

							<div class="col-sm-3">
								<label class="control-label">Repetição*</label>
								{{-- Deve trazer já a repetição cadastrado na turma --}}
								<input type="text" name="repetition" class="form-control" required>
								<span class="help-block m-b-none">Liberar aula a cada quantos dias?</span>
							</div>

							<div class="col-sm-3">
								<label class="control-label">Permanência*</label>
								{{-- Deve trazer já a repetição cadastrado na turma --}}
								<input type="text" name="permanence" class="form-control" required value="0">
								<span class="help-block m-b-none">Quantos dias essa aula deve permanecer ativa.</span>
							</div>

							<div class="col-sm-3">
								<label class="control-label" style="padding-bottom: 10px">Permanência Aprovação matrícula</label>
								<div class="switch">
									<div class="onoffswitch">
										<input type="hidden" name="permanence_all" value="0">
										<input type="checkbox" class="onoffswitch-checkbox" id="formClassPermanenceAll" onchange="document.forms.form.permanence_all.value = this.checked ? '1' : '0'">
										<label class="onoffswitch-label" for="formClassPermanenceAll">
											<span class="onoffswitch-inner"></span>
											<span class="onoffswitch-switch"></span>
										</label>
									</div>
								</div>
								<span class="help-block m-b-none">Permanência a partir da data de início</span>
							</div>

						</div>
						<div class="row m-t-sm m-b-md">
							<div class="col-sm-12 text-right">
								<button class="btn btn-primary gp-alert" data-gp-alert="save" type="submit">Salvar</button>
							</div>
						</div>
						<div class="table-responsive">
							<table id="dataTablesStudentClassControl" class="table table-striped table-bordered table-hover" style="font-size: 12px;"></table>
						</div>
					</form>

				</div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@parent
<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>
<script src="{!! asset('js/plugins/dataTables/datatables.min.js') !!}" type="text/javascript"></script>
<script>
	var appPayload = {!! isset($payload) ? json_encode($payload) : '{}' !!}

	if (appPayload.order) {
		var form = document.forms.form

		form.id.value = appPayload.order.id
		form.className.value = appPayload.order.class.name
		form.studentName.value = appPayload.order.student.name
		form.register_date.value = appPayload.order.register_date
		form.repetition.value = appPayload.order.repetition
		form.permanence.value = appPayload.order.permanence
		form.permanence_all.value = appPayload.order.permanence_all

		form.typeName.value = appPayload.order.course.course_category_type && appPayload.order.course.course_category_type.title
		form.categoryName.value = appPayload.order.course.course_category && appPayload.order.course.course_category.description_pt
		form.subcategoryName.value = appPayload.order.course.course_subcategory && appPayload.order.course.course_subcategory.description_pt
		form.courseName.value = appPayload.order.course.title_pt

		if (appPayload.order.permanence_all == '1') {
			document.getElementById('formClassPermanenceAll').checked = true
		}
	}

	$(document).ready(function() {
		setDatePicker('form [name="register_date"]')

    $('#dataTablesStudentClassControl').DataTable({
			data: appPayload.order.studentClassControl,
			paging: false,
			ordering: false,
			responsive: true,
      searching: false,
      columns: [
				{ title: "Liberação", data: 'start_date' },
        { title: "Finalização", data: 'end_date' },
        { title: "Sequência", data: 'classes.sequence' },
        { title: "Módulo", data: 'content_course.title_pt' },
        {
          title: "Liberado?",
          render: function ( data, type, row, meta ) {
						var idx = meta.row + '' + meta.col;
						return '<div class="switch">\
							<div class="onoffswitch">\
								<input type="checkbox" name="studentClassControl['+ row.classes_id +'][status]"' +  (row.status ? ' checked ' : ' ')  + 'class="onoffswitch-checkbox" id="checkStatus-' + idx + '" value="1">\
								<label class="onoffswitch-label" for="checkStatus-' + idx + '">\
									<span class="onoffswitch-inner"></span>\
									<span class="onoffswitch-switch"></span>\
								</label>\
							</div>\
						</div>'
					}
        },
        {
          title: "Finalizado?",
          render: function ( data, type, row, meta ) {
						var idx = meta.row + '' + meta.col;
						return '<div class="switch">\
							<div class="onoffswitch">\
								<input type="checkbox" name="studentClassControl['+ row.classes_id +'][presence]"' +  (row.presence ? ' checked ' : ' ')  + 'class="onoffswitch-checkbox" id="checkPresence-' + idx + '" value="1">\
								<label class="onoffswitch-label" for="checkPresence-' + idx + '">\
									<span class="onoffswitch-inner"></span>\
									<span class="onoffswitch-switch"></span>\
								</label>\
							</div>\
						</div>'
					}
        },
      ],
      language: {
        processing: "Buscando outras incrições dessa turma ...",
        search: "Pesquisar",
        lengthMenu: "Mostrar _MENU_ elementos",
        info: "Mostrando item _START_ à _END_ de _TOTAL_ elementos",
        infoEmpty: "Mostrando item 0 à 0 de 0 elementos",
        infoFiltered: "(filtro de _MAX_ elementos ao total)",
        infoPostFix: "",
        loadingRecords: "Carregando ...",
        zeroRecords: "Não há nenhum elemento a ser exibido",
        emptyTable: "Nenhuma incrição feita para essa turma",
        paginate: {
          first: "Primeiro",
          previous: "Anterior",
          next: "Próximo",
          last: "Último"
        },
        aria: {
          sortAscending:  ": ativar para classificar a coluna em ordem crescente",
          sortDescending: ": ativar para classificar a coluna em ordem decrescente"
        }
      },
    })
  })
</script>
@endsection
