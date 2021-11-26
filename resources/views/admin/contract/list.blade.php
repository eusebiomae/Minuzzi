@extends('layouts.app')

@section('title', 'Contratos')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/sweetalert/sweetalert.css') !!}">
<link rel="stylesheet" href="{!! asset('font-awesome/css/font-awesome.css') !!}">

@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Lista de Contratos</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li>
        <a href="{{ url('/admin/contract' ) }}">Lista de Contratos</a>
      </li>
      <li class="active">
        <strong>Lista  Contratos</strong>
      </li>
    </ol>
  </div>
  <div class="col-lg-2" style="padding-top: 30px; text-align: right">
    <a href="{{ url('/admin/contract/insert') }}">
      <button class="btn btn-primary"><i class="fa fa-plus"></i> Novo</button>
    </a>
  </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Lista de Contratos <small>Deixe tudo cadastrado para facil acesso.</small></h5>
        </div>
        <div class="ibox-content">

          <div class="table-responsive">
            @include('admin.contract.dataTables')
          </div>

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
			//  Sweet alert
			$('.gp-alert').click(function ($event) {
				try {
					var gpAlertKey = $event.target.dataset.gpAlert;
					var json = JSON.parse($event.target.dataset.json);

					console.log(json);

					var mapAlert = {
						valido: {
							params: {
    						title: "Tem certeza que deseja colocar em contrato Vigente?",
								text: "Ao mudar este contrato não podera mais ser editado",
							},
              callback: function () {
								$.ajax({
									url: '/admin/contract/save',
									method: 'post',
									data: {
										isAjax: true,
										id: json.id,
										status: 'current',
									},
								}).then(function(resp) {
									swal("Feito!", "Mudado o status p/ Vigente.", "success");
									window.location.reload()
								})
							}
						},
						inativo: {
							params: {
    						title: "Tem certeza que deseja colocar em contrato Inativo?",
								text: "Ao mudar este contrato não podera mais ser usado",
							},
              callback: function (ret) {
								if (ret) {
									$.ajax({
										url: '/admin/contract/save',
										method: 'post',
										data: {
											isAjax: true,
											id: json.id,
											status: 'inactive',
										},
									}).then(function(resp) {
										swal("Feito!", "Mudado o status p/ Inativo.", "success");
										window.location.reload()
									})
								}

							}
						},
					}

					swal(Object.assign({
						title: "Tem certeza disso?",
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Sim",
						type: "warning",
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
