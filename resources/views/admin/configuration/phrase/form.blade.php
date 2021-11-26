@extends('layouts.app')

@section('title', 'Frase')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
<link rel="stylesheet" href="{!! asset('cetcc/css/icon_fonts/css/all_icons.min.css') !!}" >
<link rel="stylesheet" href="{!! asset('css/plugins/sweetalert/sweetalert.css') !!}">

@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Inserir Frase</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/admin') }}">Home</a>
			</li>
			<li>
				<a href="{{ url('/admin/configuration/phrase') }}">Lista de Frases Cadastrados</a>
			</li>
			<li class="active">
				<strong>Inserir Frase</strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2">

	</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>Frases <small>Cadastro de Frase.</small></h5>
		</div>

		<div class="ibox-content">
			<form name="form" method="post" action="{{ url($urlAction) }}" enctype="multipart/form-data" class="form-horizontal">
				<div class="row">
					<input type="hidden" id="id" name="id">
					<div class="col-sm-12 m-t-sm">
						<label class="control-label">Nome*</label>
						<input type="text" name="name" class="form-control" required>
						<span class="help-block m-b-none">Digite o nome da Frase.</span>
					</div>

				</div>
				<div class="row">
					<div class="col-sm-12">
						<label class="control-label">Frase*</label>
						<textarea name="phrase" class="summernote" required></textarea>
						<span class="help-block m-b-none">Digite o nome da Frase.</span>
					</div>
				</div>

				<div class="form-group  m-t-sm">
					<label class="col-sm-2 control-label">Imagem de Perfil*</label>
					<div class="col-sm-10">
						<div class="fileinput fileinput-new input-group" data-provides="fileinput">
							<div class="form-control" data-trigger="fileinput">
								<i class="glyphicon glyphicon-file fileinput-exists"></i>
								<span class="fileinput-filename"></span>
							</div>
							<span class="input-group-addon btn btn-default btn-file">
								<span class="fileinput-new">Selecionar</span>
								<span class="fileinput-exists">Alterar</span>
								<input type="file" id="fileImage" name="fileImage">
							</span>
							<a href="#" class="input-group-addon btn btn-default fileinput-exists"
								data-dismiss="fileinput">Remover</a>
						</div>
					</div>
				</div>
				<div class="row center">
					@if(isset($data) && isset($data['image']))
						<img height="200" src="{{ $data['image'] }}" />
					@endif
				</div>
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

<!-- SUMMERNOTE -->
<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/dropzone/dropzone.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/sweetalert/sweetalert.min.js') !!}"></script>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		try {
			APP.scope.form = <?=isset($data) ? json_encode($data) : 'null'?>;

			if (APP.scope.form) {
				populate(document.forms.form, APP.scope.form);
			}

			$('.summernote').summernote({
				minHeight: 200
			});

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
