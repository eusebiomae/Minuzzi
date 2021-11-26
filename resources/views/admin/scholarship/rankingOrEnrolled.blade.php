@extends('layouts.app')

@section('title', $title)

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
@endsection

@section('content')

@include($header)

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>{{$subtitle}} Bolsa "{{$scholarship->title}}"</h5>
		</div>
		<div class="ibox-content">
			<div class="tabs-container">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#tab-active">Ativos</a></li>
					<li><a data-toggle="tab" href="#tab-inative">Inativos</a></li>
				</ul>
				<div class="tab-content">
					<div id="tab-active" class="tab-pane active">
						<div class="panel-body">
							<div class="col-lg-12 animated fadeInLeft">
								@if (isset($dataTableActive))
									@include('admin._components.dataTablesJs', ['dataTable' => $dataTableActive])
								@endif
							</div>
						</div>
					</div>

					<div id="tab-inative" class="tab-pane ">
						<div class="panel-body">
							<div class="col-lg-12 animated fadeInLeft">
								@if (isset($dataTableInative))
									@include('admin._components.dataTablesJs', ['dataTable' => $dataTableInative])
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
  </div>
</div>
@endsection
