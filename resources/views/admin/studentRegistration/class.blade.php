@extends('layouts.app')

@section('title', 'Fazer a inscrição do aluno')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/select2/select2.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/sweetalert/sweetalert.css') !!}">
@endsection

@section('scripts')
@parent
<script src="{!! asset('js/plugins/select2/select2.full.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/dataTables/datatables.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/sweetalert/sweetalert.min.js') !!}"></script>
<script>
	APP = {}
	APP.payload = {!! json_encode($payload) !!}

	function onChangeClass(elem) {
		$('#dataTablesStudent').DataTable({}).ajax.reload(null, true)
	}

	function onChangeCourse(elem) {
		var dataJson = elem.options[elem.options.selectedIndex].dataJson

		document.forms.classStudentRegistration.class.innerHTML = ''
		if (dataJson.course.class) {
			populateSelectBox({
				list: dataJson.course.class,
				target: document.forms.classStudentRegistration.class,
				columnValue: "id",
				columnLabel: "name",
				emptyOption: {
					label: "Selecione...",
				}
			})
		}

		$(document.forms.classStudentRegistration.class).select2()
	}

	$(function() {
		if (APP.payload.course) {
			populateSelectBox({
				list: APP.payload.course.map(function(item) { return { id: item.id, label: "("+ item.course_category_type.title +") " + item.course_category.description_pt + " | "  + item.title_pt, course: item } }),
				target: document.forms.classStudentRegistration.course,
				columnValue: "id",
				columnLabel: "label",
				emptyOption: {
					label: "Selecione..."
				}
			})
		}

		$('.select2').select2()
		$('#dataTablesStudent').DataTable({
			pageLength: 50,
			processing: true,
			responsive: true,
			searching: false,
			ajax: {
				url: '/admin/class_student_registration/get_order',
				dataSrc: "",
				method: 'post',
				data: function (d) {
					d.classId = document.forms.classStudentRegistration.class.value;
				}
			},
			initComplete: function(settings, json) {
				console.log('settings, json')
			},
			columns: [
				{ title: "ID", data: 'student.id' },
				{ title: "Nome", data: 'student.name' },
				{ title: "E-mail", data: 'student.email' },
				{ title: "CPF", data: 'student.cpf' },
				{ title: "Telefone", data: 'student.phone' },
				{ title: "Celular", data: 'student.cell_phone' },
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
				emptyTable: "Nenhuma incrição feita pra essa turma",
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
			dom: '<"text-left"l><"text-right"B>t<"bottom"fip>r<"clear">',
			buttons: {
				buttons: [
					{
						text: "Inscrever novo Aluno",
						action: function(e, dt, node, config) {
							var classId = document.forms.classStudentRegistration.class.value
							if (classId) {
								$('#makeStudentRegistration').modal('show')
							} else {
								swal({
									title: 'É necessário selecionar uma turma antes',
									type: "warning",
									confirmButtonColor: "#4E96D3",
									// confirmButtonText: "Sim",
									// closeOnConfirm: true
								})
							}
						}
					}
				],
				dom: {
					button: {
						tag: "button",
						className: "btn btn-info dataTablesStudentNewStudent",
					},
				}
			},
		})
	})
</script>
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-sm-9">
    <h2>Fazer a inscrição do aluno</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li class="active">
        <strong>Fazer a inscrição do aluno</strong>
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
        </div>
        <div class="ibox-content">

					<fieldset>
						<legend>Inscrição</legend>
						<form name="classStudentRegistration" action="/admin/make_student_registration" method="POST">
							{{ csrf_field() }}
							<div class="row form-group">
								<div class="col-sm-12">
								<div class="col-sm-6">
									<label class="control-label">Curso</label>
									<select name="course" class="form-control select2" onchange="onChangeCourse(this)"></select>
								</div>
								<div class="col-sm-6">
									<label class="control-label">Turma</label>
									<select name="class" class="form-control select2" onchange="onChangeClass(this)"></select>
								</div>
								<div class="col-sm-12 text-right" style="padding-top: 15px">
									<button type="button" class="btn btn-w-m btn-primary">Buscar</button>
								</div>
							</div>
						</form>
					</fieldset>
					<hr>
          <div class="table-responsive">
						<table id="dataTablesStudent" class="table table-striped table-bordered table-hover" style="font-size: 12px;"></table>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

{{-- MODALS --}}

<div class="modal inmodal" id="makeStudentRegistration" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Fazer a inscrição do aluno na turma</h4>
			</div>
			<div class="modal-body">
				<form name="makeStudentRegistration" action="/admin/make_student_registration" method="POST">
					{{ csrf_field() }}
					<div class="row form-group">
						<div class="col-sm-12">
							<label class="control-label">Aluno</label>
							<select name="student" class="form-control select2" required></select>
						</div>
						<div class="col-sm-12 row">
							<div class="col-sm-6">
								<label class="control-label">Forma de Pagamento</label>
								<select name="formPayment" class="form-control select2"></select>
							</div>
							<div class="col-sm-2">
								<label class="control-label">Parcelas</label>
								<input type="number" name="parcel" class="form-control  mask-currency" value="1" onkeyup="recalcFormsPayment('parcel')" onchange="recalcFormsPayment('parcel')">
							</div>
							<div class="col-sm-2">
								<label class="control-label">Valor</label>
								<input type="tel" name="value" class="form-control  mask-currency" onkeyup="recalcFormsPayment('value')" value="0">
							</div>
							<div class="col-sm-2">
								<label class="control-label">Total</label>
								<input type="tel" name="full_value" class="form-control  mask-currency" readonly value="0">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button class="btn btn-white" type="button">Cancelar</button>
				<button class="btn btn-primary" type="button">Salvar</button>
			</div>
		</div>
	</div>
</div>
@endsection


