@extends('layouts.app')

@section('title', 'Paciente')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
<link rel="stylesheet" href="{!! asset('cetcc/css/icon_fonts/css/all_icons.min.css') !!}" >
<link rel="stylesheet" href="{!! asset('css/plugins/sweetalert/sweetalert.css') !!}">


@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Inserir Paciente</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/admin') }}">Home</a>
			</li>
			<li>
				<a href="{{ url('/admin/patient') }}">Lista de Pacientes</a>
			</li>
			<li class="active">
				<strong>Inserir Paciente</strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2">

	</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>Paciente <small>Cadastro de Paciente.</small></h5>
		</div>

		<div class="ibox-content">
			<form name="form" method="post" action="{{ url($urlAction) }}" enctype="multipart/form-data" class="form-horizontal">
				<div class="row">
					<input type="hidden" name="id">
					@if ($fieldPageConfig->show('name'))
					<label class="col-sm-2 control-label">Nome*</label>
					<div class="col-sm-10">
						<input type="text" name="name" class="form-control" {!! $fieldPageConfig->attr('name') !!}>
						<span class="help-block m-b-none">Digite o Nome.</span>
					</div>
					@endif
				</div>
				<div class="row m-t-sm">
					@if ($fieldPageConfig->show('phone'))
					<label class="col-sm-2 control-label">Telefone*</label>
					<div class="col-sm-3">
						<input type="text" name="phone" data-mask="(99) 9999-9999" maxlength="16" class="form-control" {!! $fieldPageConfig->attr('phone') !!}>
						<span class="help-block m-b-none">Digite o Telefone.</span>
					</div>
					@endif
					@if ($fieldPageConfig->show('whatsapp'))
					<label class="col-sm-1 control-label">WhatsApp*</label>
					<div class="col-sm-3">
						<input type="text" name="whatsapp" data-mask="(99) 9 9999-9999" maxlength="16" class="form-control" {!! $fieldPageConfig->attr('whatsapp') !!}>
						<span class="help-block m-b-none">Digite o WhatsApp.</span>
					</div>
					@endif
					@if ($fieldPageConfig->show('email'))
					<label class="col-sm-1 control-label">E-mail*</label>
					<div class="col-sm-2">
						<input type="email" name="email" class="form-control" {!! $fieldPageConfig->attr('email') !!}>
						<span class="help-block m-b-none">Digite o E-mail.</span>
					</div>
					@endif
				</div>
				<div class="row m-t-sm">
					@if ($fieldPageConfig->show('recommendation'))
					<label class="col-sm-2 control-label">Recomendação*</label>
					<div class="col-sm-3">
						<input type="text" name="recommendation" class="form-control" {!! $fieldPageConfig->attr('recommendation') !!}>
						<span class="help-block m-b-none">Digite o Recomendação.</span>
					</div>
					@endif
					@if ($fieldPageConfig->show('initial_complaint'))
					<label class="col-sm-1 control-label">Queixa inicial*</label>
					<div class="col-sm-6">
						<input type="text" name="initial_complaint" class="form-control" {!! $fieldPageConfig->attr('initial_complaint') !!}>
						<span class="help-block m-b-none">Digite o CRP.</span>
					</div>
					@endif
				</div>
				{{-- ADRESS --}}
				<div class="row m-t-sm">
					@if ($fieldPageConfig->show('address'))
					<label class="col-sm-2 control-label">Endereço*</label>
					<div class="col-sm-7">
						<input type="text" name="address" class="form-control" {!! $fieldPageConfig->attr('address') !!}>
						<span class="help-block m-b-none">Digite o Endereço.</span>
					</div>
					@endif
					@if ($fieldPageConfig->show('number'))
					<label class="col-sm-1 control-label">Nº*</label>
					<div class="col-sm-2">
						<input type="text" name="number" class="form-control" {!! $fieldPageConfig->attr('number') !!}>
						<span class="help-block m-b-none">Digite o Nº.</span>
					</div>
					@endif
				</div>
				<div class="row m-t-sm">
					@if ($fieldPageConfig->show('neighborhood'))
					<label class="col-sm-2 control-label">Bairro*</label>
					<div class="col-sm-3">
						<input type="text" name="neighborhood" class="form-control" {!! $fieldPageConfig->attr('neighborhood') !!}>
						<span class="help-block m-b-none">Digite o Bairro.</span>
					</div>
					@endif
					@if ($fieldPageConfig->show('city'))
					<label class="col-sm-1 control-label">Cidade*</label>
					<div class="col-sm-3">
						<input type="text" name="city" class="form-control" {!! $fieldPageConfig->attr('city') !!}>
						<span class="help-block m-b-none">Digite o Cidade.</span>
					</div>
					@endif
					@if ($fieldPageConfig->show('state_id'))
					<label class="col-sm-1 control-label">Estado</label>
					<div class="col-sm-2">
						<select class="form-control m-b" name="state_id" {!! $fieldPageConfig->attr('state_id') !!}></select>
						<span class="help-block m-b-none">Selecione o Estado</span>
					</div>
					@endif
				</div>
				<div class="row m-t-sm">
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

<!-- SUMMERNOTE -->
<script src="{!! asset('js/plugins/jasny/jasny-bootstrap.min.js')!!}"></script>
<script src="{!! asset('js/plugins/sweetalert/sweetalert.min.js') !!}"></script>

<!-- switch -->


<script>
	document.addEventListener('DOMContentLoaded', function() {
		try {
			APP.scope.form = <?=isset($data) ? json_encode($data) : 'null'?>;
			APP.scope.listSelectBox = {!! isset($listSelectBox) ? json_encode($listSelectBox) : '{}' !!};

			try {
					populateSelectBox({
						list: APP.scope.listSelectBox.states,
						target: document.forms.form.state_id,
						columnValue: "id",
						columnLabel: "abbreviation",
						selectBy: [ ],
						emptyOption: {
							label: ""
						}
					})
				} catch (error) {

				} finally {
					if (APP.scope.listSelectBox.states) {
						populate(document.forms.form);
						$('[data-mask]').trigger('input')
					}
				}
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
