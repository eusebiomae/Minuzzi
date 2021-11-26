@extends('layouts.app')

@section('title', 'Fazer a inscrição do aluno')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/select2/select2.min.css') !!}" />
@endsection

@section('scripts')
@parent
<script src="{!! asset('js/plugins/select2/select2.full.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/dataTables/datatables.min.js') !!}" type="text/javascript"></script>
<script>
	APP = {}
	APP.payload = {!! json_encode($payload) !!}

	function onChangeStudent(elem) {
		$('#dataTablesClass').DataTable({}).ajax.reload(null, true)
	}

	function onChangeCourse(elem) {
		var dataJson = elem.options[elem.options.selectedIndex].dataJson

		document.forms.makeStudentRegistration.class.innerHTML = ''
		if (dataJson.course.class) {
			populateSelectBox({
				list: dataJson.course.class,
				target: document.forms.makeStudentRegistration.class,
				columnValue: "id",
				columnLabel: "name",
			})
		}

		$(document.forms.makeStudentRegistration.class).select2()
	}

	function recalcFormsPayment(name) {
		var elems = {}

		elems.fullValue = document.forms.makeStudentRegistration.full_value
		elems.parcel = document.forms.makeStudentRegistration.parcel
		elems.value = document.forms.makeStudentRegistration.value

		switch (name) {
			case 'parcel':
				// elems.value.value = (strToNumber(elems.fullValue.value) / elems.parcel.value).toFixed(2)
				elems.fullValue.value = (strToNumber(elems.value.value) * elems.parcel.value).toFixed(2)
				break;
			case 'value':
				// elems.parcel.value = (strToNumber(elems.fullValue.value) / strToNumber(elems.value.value))
				elems.fullValue.value = (strToNumber(elems.value.value) * elems.parcel.value).toFixed(2)
				break;
		}
	}

	$(function() {
		if (APP.payload.student) {
			populateSelectBox({
				list: APP.payload.student.map(function(item) { return { id: item.id, label: "("+ item.cpf +") " + item.name } }),
				target: document.forms.makeStudentRegistration.student,
				columnValue: "id",
				columnLabel: "label",
				emptyOption: {
					label: "Selecione..."
				}
			})
		}

		if (APP.payload.course) {
			populateSelectBox({
				list: APP.payload.course.map(function(item) { return { id: item.id, label: "("+ item.course_category_type.title +") " + item.course_category.description_pt + " | "  + item.title_pt, course: item } }),
				// list: APP.payload.course,
				target: document.forms.makeStudentRegistration.course,
				columnValue: "id",
				columnLabel: "label",
				emptyOption: {
					label: "Selecione..."
				}
			})
		}

		// if (APP.payload.formPayment) {
		// 	populateSelectBox({
		// 		list: APP.payload.formPayment,
		// 		target: document.forms.makeStudentRegistration.formPayment,
		// 		columnValue: "id",
		// 		columnLabel: "description",
		// 	})
		// }

		$('.select2').select2()
		$('#dataTablesClass').DataTable({
			pageLength: 50,
			processing: true,
			responsive: true,
			searching: false,
			ajax: {
				url: '/admin/make_student_registration/get_order',
				dataSrc: "",
				method: 'post',
				data: function (d) {
					d.studentId = document.forms.makeStudentRegistration.student.value;
				}
			},
			columns: [
				{ title: "Tipo", data: 'course.course_category_type.title' },
				{ title: "Categoria", data: 'course.course_category.description_pt' },
				{ title: "Sub Categoria", data: 'course.course_category.description_pt' },
				{ title: "Curso", data: 'course.title_pt' },
				{ title: "Turma", data: 'class.name' },
			],
			language: {
				processing: "Buscando outras incrições desse aluno ...",
				search: "Pesquisar",
				lengthMenu: "Mostrar _MENU_ elementos",
				info: "Mostrando item _START_ à _END_ de _TOTAL_ elementos",
				infoEmpty: "Mostrando item 0 à 0 de 0 elementos",
				infoFiltered: "(filtro de _MAX_ elementos ao total)",
				infoPostFix: "",
				loadingRecords: "Carregando ...",
				zeroRecords: "Não há nenhum elemento a ser exibido",
				emptyTable: "Nenhuma incrição feita pra esse aluno",
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
			}
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
						<form name="makeStudentRegistration" action="/admin/make_student_registration" method="POST">
							{{ csrf_field() }}
							<div class="row form-group">
								<div class="col-sm-12">
									<label class="control-label">Aluno</label>
									<select name="student" class="form-control select2" onchange="onChangeStudent(this)" required></select>
								</div>
								<div class="col-sm-6">
									<label class="control-label">Curso</label>
									<select name="course" class="form-control select2" onchange="onChangeCourse(this)"></select>
								</div>
								<div class="col-sm-6">
									<label class="control-label">Turma</label>
									<select name="class" class="form-control select2"></select>
								</div>
								{{-- <div class="col-sm-12 row">
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
								</div> --}}
								<div class="col-sm-12">
									<label class="control-label">Confirma Matricula?</label>
									<div class="switch">
										<div class="onoffswitch">
											<input type="checkbox" class="onoffswitch-checkbox" id="confirmsRegistration" name="confirms_registration" value="AP" checked>
											<label class="onoffswitch-label" for="confirmsRegistration">
												<span class="onoffswitch-inner"></span>
												<span class="onoffswitch-switch"></span>
											</label>
										</div>
									</div>
								</div>
								<div class="col-sm-12 text-right" style="padding-top: 15px">
									<button type="submit" class="btn btn-w-m btn-primary">Salvar</button>
								</div>
							</div>
						</form>
					</fieldset>
          <div class="table-responsive">
						<table id="dataTablesClass" class="table table-striped table-bordered table-hover" style="font-size: 12px;"></table>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection


