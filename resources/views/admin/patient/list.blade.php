@extends('layouts.app')

@section('title', 'Paciente')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/sweetalert/sweetalert.css') !!}">

@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Lista de  Pacientes</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li>
        <a href="{{ url('/admin/patient' ) }}"> Pacientes</a>
      </li>
      <li class="active">
        <strong>Listar  Pacientes</strong>
      </li>
    </ol>
  </div>
  <div class="col-lg-2" style="padding-top: 30px; text-align: right">
    <a href="{{ url('/admin/patient/insert') }}">
      <button class="btn btn-primary"><i class="fa fa-plus"></i> Novo</button>
    </a>
  </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5> Pacientes <small>Lista dos pacientes cadastrados.</small></h5>
        </div>
        <div class="ibox-content">

          <div class="table-responsive">
            @include('admin.patient.dataTables')
          </div>

        </div>
      </div>
    </div>
    <div class="modal inmodal" id="forward" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
          <form name="form" action="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-mail-forward modal-icon"></i>
                <h4 class="modal-title">Encaminhar</h4>
                <small class="font-bold">Encaimnhe este paciente NOME para um profissional</small>
            </div>
            <div class="modal-body ">
              <div class="">
                <label class="control-label">Psicólogo(a)*</label>
                <div class="">
                  <select class="form-control m-b" name="psychologist_id">
                  </select>
                  <span class="help-block m-b-none">Selecione o Psicólogo(a)</span>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-white gp-alert" data-gp-alert="cancel" type="submit">Cancelar</button>
              <button class="btn btn-primary gp-alert" data-gp-alert="save" type="submit">Salvar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="{!! asset('js/plugins/sweetalert/sweetalert.min.js') !!}"></script>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		try {
			APP.scope.form = <?=isset($data) ? json_encode($data) : 'null'?>;
			APP.scope.listSelectBox = {!! isset($listSelectBox) ? json_encode($listSelectBox) : '{}' !!};

			try {
					populateSelectBox({
						list: APP.scope.listSelectBox.psychologist,
						target: document.forms.form.psychologist_id,
						columnValue: "id",
						columnLabel: "name",
						selectBy: [ ],
						emptyOption: {
							label: "Selecione ..."
						}
					})
				} catch (error) {

				}
			//  Sweet alert
			$('.gp-alert').click(function ($event) {
				try {
					var gpAlertKey = $event.target.dataset.gpAlert;

					var mapAlert = {
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

		} catch (error) {
			console.warn(error);
		}
	});
</script>
@endsection
