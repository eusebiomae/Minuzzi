@extends('layouts.app')

@section('title', 'Instrução')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
<link rel="stylesheet" href="{!! asset('cetcc/css/icon_fonts/css/all_icons.min.css') !!}" >
<link rel="stylesheet" href="{!! asset('css/plugins/sweetalert/sweetalert.css') !!}">


@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Inserir Instrução</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/admin') }}">Home</a>
			</li>
			<li>
				<a href="{{ url('/admin/introduction') }}">Lista de Instrução</a>
			</li>
			<li class="active">
				<strong>Inserir Instrução</strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2">

	</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>Instrução <small>Cadastro de Instrução.</small></h5>
		</div>

		<div class="ibox-content">
			<form name="form" method="post" action="{{ url($urlAction) }}" enctype="multipart/form-data" class="form-horizontal">
				<div class="row">
					<input type="hidden" name="id">
					@if ($fieldPageConfig->show('title'))
					<div class="col-sm-6">
						<label class="control-label">Título*</label>
						<input type="text" name="title" class="form-control"  {!! $fieldPageConfig->attr('title') !!}>
						<span class="help-block m-b-none">Digite o Título.</span>
					</div>
					@endif
					@if ($fieldPageConfig->show('form_payment_id'))
					<div class="col-sm-6">
						<label class="control-label">Forma de Pagamento*</label>
						<select name="form_payment_id" class="form-control m-b"  {!! $fieldPageConfig->attr('form_payment_id') !!}>
						</select>
						<span class="help-block m-b-none">Digite o Forma de Pagamento.</span>
					</div>
					@endif
				</div>
				<div class="form-group">
					<div class="wrapper wrapper-content" style="padding-bottom:0px;">
						@if ($fieldPageConfig->show('description'))
						<div class="row">
							<div class="col-sm-12">
								<div class="ibox float-e-margins">
									<div class="ibox-title">
										<h5>Digite o conteúdo em Português*</h5>
									</div>
									<div class="ibox-content no-padding">
										<textarea name="description" class="summernote"  {!! $fieldPageConfig->attr('description') !!}></textarea>
									</div>
								</div>
							</div>
						</div>
						@endif
						<div class="row">
							<div class="col-sm-12 text-right">
								<button class="btn btn-white gp-alert" data-gp-alert="cancel" type="submit">Cancelar</button>
								<button class="btn btn-primary gp-alert" data-gp-alert="save" type="submit">Salvar alterações</button>
							</div>
						</div>
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
<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/sweetalert/sweetalert.min.js') !!}"></script>

<!-- switch -->


<script>
	document.addEventListener('DOMContentLoaded', function() {
		try {
			APP.scope.form = <?=isset($data) ? json_encode($data) : 'null'?>;
			APP.scope.listSelectBox = {!! isset($listSelectBox) ? json_encode($listSelectBox) : '{}' !!};

			if (APP.scope.listSelectBox.form_payment) {
				populateSelectBox({
					list: APP.scope.listSelectBox.form_payment,
					target: document.forms.form.form_payment_id,
					columnValue: "id",
					columnLabel: "description",
					emptyOption: {
						label: "Selecione..."
					}
				});
			}

			if (APP.scope.form) {
				populate(document.forms.form, APP.scope.form);
			}

			$('.summernote').summernote({
				minHeight: 300
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
