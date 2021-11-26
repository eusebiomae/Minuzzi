@extends('layouts.app')

@section('title', $payload->config->title)

@section('css')
@parent

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
		<a href="{{ url('/admin/additional') }}">
			<button type="button" class="btn btn-primary">
				<i class="fa fa-list"></i> Lista
			</button>
		</a>
	</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>{{ $payload->config->title }} <small>{{ $payload->config->subtitle }}</small></h5>
		</div>

		<div class="ibox-content">
			<form name="form" method="post" action="/admin/additional/save" class="form-horizontal">
				<div class="row">
					{{ csrf_field() }}
					<input type="hidden" name="id">
					@if ($fieldPageConfig->show('title'))
						<div class="col-sm-12">
							<label class="control-label">Título*</label>
							<input type="text" name="title" class="form-control" {!! $fieldPageConfig->attr('title') !!}>
							{{-- <span class="help-block m-b-none">Digite o nome para identificação</span> --}}
						</div>
					@endif

				</div>

				<div class="row m-t-md">
					<div class="col-sm-12 text-right">
						<button class="btn btn-white" type="reset">Cancelar</button>
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
<script>
	document.addEventListener('DOMContentLoaded', function() {
		try {
			APP.payload = {!! isset($payload) ? json_encode($payload) : 'null' !!}


			if (APP.payload && APP.payload.data) {
				populate(document.forms.form, APP.payload.data);
			}

		} catch (error) {
			console.warn(error);
		}
	});
</script>
@endsection
