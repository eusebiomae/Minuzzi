@extends('layouts.app')

@section('title', $dataPage->title)

@section('css')
@parent

@endsection

@section('scripts')
@parent

<script>
	document.addEventListener('DOMContentLoaded', function() {
		try {
			APP.scope.data = {!! isset($data) ? json_encode($data) : 'null' !!};

			if (APP.scope.data) {
				populate(document.forms.formData, APP.scope.data);
			}

		} catch (error) {
			console.warn(error);
		}
	});
</script>

@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading ">

	<div class="col-lg-10">
		<h2>{{ $dataPage->titlePage }}</h2>
		<ol class="breadcrumb">
			@foreach ($dataPage->breadcrumbs as $breadcrumb)
				<li>
					@if (isset($breadcrumb->url))
						<a href="{{ url($breadcrumb->url) }}">{{ $breadcrumb->label }}</a>
					@else
						<strong>{{ $breadcrumb->label }}</strong>
					@endif
				</li>
			@endforeach
		</ol>
	</div>

	<div class="col-lg-2" style="padding-top: 30px; text-align: right">
		@foreach ($dataPage->btnTopRight as $btnTopRight)
			<a href="{{ url($btnTopRight->url) }}">
				<button class="btn {{ $btnTopRight->class }}">
					<i class="{{ $btnTopRight->icon }}"></i>
					{{ $btnTopRight->label }}
				</button>
			</a>
		@endforeach
	</div>

</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>{{$dataPage->title}}</h5>
		</div>
		<div class="ibox-content">
			<form name="formData" method="post" action="{{ $dataPage->urlAction }}" class="form-horizontal">
				{{ csrf_field() }}
				<input type="hidden" id="id" name="id">

				@include($dataPage->pathView)

				<div class="form-group">
					<div class="col-sm-12 text-right">
						<button class="btn btn-primary" type="submit">Salvar alterações</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
