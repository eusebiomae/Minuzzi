@extends('layouts.app')

@section('title', 'Feature')

@section('css')
<link rel="stylesheet" href="{!! asset('cetcc/css/icon_fonts/css/all_icons.min.css') !!}" >
<link rel="stylesheet" href="{!! asset('css/plugins/sweetalert/sweetalert.css') !!}">

@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Inserir Banco</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/admin') }}">Home</a>
			</li>
			<li>
				<a href="{{ url('/admin/configuration/bank') }}">Lista de Bancos Cadastrados</a>
			</li>
			<li class="active">
				<strong>Inserir Bancos</strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2">

	</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>Bancos <small>Cadastro de Bancos.</small></h5>
		</div>

		<div class="ibox-content">
			<form name="form" method="post" action="{{ url($urlAction) }}" enctype="multipart/form-data" class="form-horizontal">
				<div class="row">
					<input type="hidden" id="id" name="id">

					@if ($fieldPageConfig->show('name'))
					<div class="col-sm-6">
						<label class="control-label">Nome*</label>
						<input type="text" name="name" class="form-control" {!! $fieldPageConfig->attr('name') !!}>
						<span class="help-block m-b-none">Digite o nome do Banco.</span>
					</div>
					@endif

					@if ($fieldPageConfig->show('code'))
					<div class="col-sm-6">
						<label class="control-label">Código*</label>
						<input type="text" name="code" class="form-control" {!! $fieldPageConfig->attr('code') !!}>
						<span class="help-block m-b-none">Digite o Código do Banco.</span>
					</div>
				</div>
				@endif

				<div class="row">
					<div class="col-sm-12 text-right">
						<button class="btn btn-white gp-alert" data-gp-alert="cancel" type="submit">Cancelar</button>
						<button class="btn btn-primary gp-alert" data-gp-alert="save" type="submit">Salvar alterações</button>
					</div>
				</div>
				{{ csrf_field() }}
			</form>
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
<script src="{!! asset('js/plugins/sweetalert/sweetalert.min.js') !!}"></script>



<script>
	document.addEventListener('DOMContentLoaded', function() {
		try {
			APP.scope.form = <?=isset($data) ? json_encode($data) : 'null'?>;

			if (APP.scope.form) {
				populate(document.forms.form, APP.scope.form);
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
