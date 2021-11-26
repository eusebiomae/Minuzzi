@extends('layouts.app')

@section('title', $payload->config->title)

@section('css')
@parent
<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />

@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>{{ $payload->config->title }}</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/admin') }}">Home</a>
			</li>
			<li>
				<a href="{{ url($payload->config->urlAction) }}">Lista</a>
			</li>
			<li class="active">
				<strong>{{ $payload->config->title }}</strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2" style="padding-top: 30px; text-align: right">
		<a href="{{ url($payload->config->urlAction) }}">
			<button type="button" class="btn btn-primary">
				<i class="fa fa-list"></i> Lista
			</button>
		</a>
		<a href="{{ url($payload->config->urlAction . '/insert') }}">
      <button class="btn btn-primary"><i class="fa fa-plus"></i> Novo</button>
    </a>
	</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>{{ $payload->config->title }} <small>{{ $payload->config->subtitle }}</small></h5>
		</div>

		<div class="ibox-content">
			<form name="form" method="post" action="{{ url($payload->config->urlAction . '/save') }}" class="form-horizontal">
				<div class="row">
					{{ csrf_field() }}
					<input type="hidden" name="id">

					@if ($fieldPageConfig->show('title'))
						<div class="col-sm-3">
							<label class="control-label">Título*</label>
							<input type="text" name="title" class="form-control" required maxlength="255" {!! $fieldPageConfig->attr('title') !!}/>
						</div>
					@endif

					@if ($fieldPageConfig->show('shelf_life'))
						<div class="col-sm-2">
							<label class="control-label">Validade</label>
							<div class="input-group date">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input type="text" name="shelf_life" class="form-control" readonly {!! $fieldPageConfig->attr('shelf_life') !!}>
							</div>
						</div>
					@endif

					@if ($fieldPageConfig->show('qtd'))
						<div class="col-sm-1">
							<label class="control-label">Quant.</label>
							<input type="tel" name="qtd" class="form-control mask-numeric" {!! $fieldPageConfig->attr('qtd') !!}/>
						</div>
					@endif

					@if ($fieldPageConfig->show('value'))
						<div class="col-sm-2">
							<label class="control-label">Valor</label>
							<input type="tel" name="value" class="form-control mask-money" {!! $fieldPageConfig->attr('value') !!}/>
						</div>
					@endif

					@if ($fieldPageConfig->show('percentage'))
						<div class="col-sm-2">
							<label class="control-label">Porcentagem</label>
							<input type="tel" name="percentage" class="form-control mask-percentage" {!! $fieldPageConfig->attr('percentage') !!}/>
						</div>
					@endif

					@if ($fieldPageConfig->show('code'))
						<div class="col-sm-2">
							<label class="control-label">Código*</label>
							<input type="tel" name="code" class="form-control" required maxlength="32" {!! $fieldPageConfig->attr('code') !!}/>
						</div>
					@endif

				</div>

				<div class="row m-t-md">
					<div class="col-sm-12 text-right">
						<button type="button" class="btn btn-white" onclick="location.href='{{ url($payload->config->urlAction) }}'">Cancelar</button>
						<button class="btn btn-primary" type="submit">Salvar alterações</button>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>
@endsection


@section('scripts')
@parent
<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		try {
			APP.payload = {!! isset($payload) ? json_encode($payload) : 'null' !!}


			if (APP.payload && APP.payload.data) {
				APP.payload.data.value = APP.payload.data.value.toString().replace('.', ',')
				populate(document.forms.form, APP.payload.data);
			}

			setDatePicker('.date')
		} catch (error) {
			console.warn(error);
		}
	});
</script>
@endsection
