@extends('layouts.app')

@section('title', $dataPage->title)

@section('css')
@parent
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
@endsection

@section('content')
	<div class="row wrapper border-bottom white-bg page-heading">
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
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">

					<div class="ibox-title">
						<h5>{{ $dataPage->titlePage }}</h5>
					</div>

					<div class="ibox-content">
						<div class="table-responsive">
							@include('admin._components.dataTables', [ 'dataTable' => $dataPage->dataTable ])
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
@parent

@endsection
