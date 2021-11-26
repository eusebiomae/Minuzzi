@extends('layouts.app')

@section('title', 'Feature')

@section('css')
<link rel="stylesheet" href="{!! asset('cetcc/css/icon_fonts/css/all_icons.min.css') !!}" >
<link rel="stylesheet" href="{!! asset('css/plugins/sweetalert/sweetalert.css') !!}">


@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Inserir Conta Bancária</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/admin') }}">Home</a>
			</li>
			<li>
				<a href="{{ url('/admin/bank_account') }}">Lista de Contas Bancárias</a>
			</li>
			<li class="active">
				<strong>Inserir Contas Bancária</strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2">

	</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>Conta Bancária <small>Cadastro de Conta Bancária.</small></h5>
		</div>

		<div class="ibox-content">
			<form name="form" method="post" action="{{ url($urlAction) }}" enctype="multipart/form-data" class="form-horizontal">
				<div class="row">
					<input type="hidden" id="id" name="id">
					@if ($fieldPageConfig->show('description'))
						<div class="col-sm-4">
							<label class="control-label">Descrição*</label>
							<input type="text" name="description" class="form-control" {!! $fieldPageConfig->attr('description') !!}>
							<span class="help-block m-b-none">Digite o nome para identificação</span>
						</div>
					@endif

					@if ($fieldPageConfig->show('name'))
						<div class="col-sm-4">
							<label class="control-label">Nome do Titular ou Razão social*</label>
							<input type="text" name="name" class="form-control" {!! $fieldPageConfig->attr('name') !!}>
							<span class="help-block m-b-none">Digite o nome do titular ou razão social.</span>
						</div>
					@endif

					@if ($fieldPageConfig->show('cpf'))
						<div class="col-sm-4">
							<label class="control-label">CPF ou CNPJ*</label>
							<input type="text" name="cpf" class="form-control" {!! $fieldPageConfig->attr('cpf') !!}>
							<span class="help-block m-b-none">Digite o CPF do titular ou CNPJ da empresa.</span>
						</div>
					@endif
				</div>

				<div class="row">
					@if ($fieldPageConfig->show('bank_id'))
						<div class="col-sm-2">
							<label class="control-label">Banco*</label>
							<select name="bank_id" class="form-control m-b" {!! $fieldPageConfig->attr('bank_id') !!}></select>
						</div>
					@endif

					@if ($fieldPageConfig->show('bank_account_type_id'))
						<div class="col-sm-2">
							<label class="control-label">Tipo de conta*</label>
							<select name="bank_account_type_id" class="form-control m-b" {!! $fieldPageConfig->attr('bank_account_type_id') !!}></select>
						</div>
					@endif

					@if ($fieldPageConfig->show('agency'))
						<div class="col-sm-4">
							<label class="control-label">Agência*</label>
							<input type="text" name="agency" class="form-control" {!! $fieldPageConfig->attr('agency') !!}>
							<span class="help-block m-b-none">Digite o Agência do titular.</span>
						</div>
					@endif

					@if ($fieldPageConfig->show('account'))
						<div class="col-sm-4">
							<label class="control-label">Nº Conta*</label>
							<input type="text" name="account" class="form-control" {!! $fieldPageConfig->attr('account') !!}>
							<span class="help-block m-b-none">Digite o Nº da Conta.</span>
						</div>
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

<!-- SUMMERNOTE -->

<script src="{!! asset('js/plugins/sweetalert/sweetalert.min.js') !!}"></script>

<!-- switch -->


<script>
	document.addEventListener('DOMContentLoaded', function() {
		try {
			APP.scope.form = <?=isset($data) ? json_encode($data) : 'null'?>;
			APP.scope.listSelectBox = {!! isset($listSelectBox) ? json_encode($listSelectBox) : '{}' !!};

			if (APP.scope.listSelectBox.bank) {
				populateSelectBox({
					list: APP.scope.listSelectBox.bank,
					target: document.forms.form.bank_id,
					columnValue: "id",
					columnLabel: "name",
					emptyOption: {
						label: "Selecione..."
					}
				});
			}

			if (APP.scope.listSelectBox.bank_account_type) {
				populateSelectBox({
					list: APP.scope.listSelectBox.bank_account_type,
					target: document.forms.form.bank_account_type_id,
					columnValue: "id",
					columnLabel: "name",
					emptyOption: {
						label: "Selecione..."
					}
				});
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
