@extends('layouts.app')

@section('title', $title_page . ' ' . $module_page)

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2><?= $title_page ?> <?= $module_page ?></h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/admin') }}">Home</a>
			</li>
			<li>
				<a href="{{ url('/admin/prospection/student' ) }}"><?= $module_page ?> </a>
			</li>
			<li class="active">
				<strong><?= $title_page ?> <?= $module_page ?></strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2" style="padding-top: 30px; text-align: right">
		{{-- <a href="{{ url('/admin/prospection/student/insert') }}">
			<button class="btn btn-primary"><i class="fa fa-plus"></i> Novo</button>
		</a> --}}
	</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><?= $title_page ?> <?= $module_page ?></small></h5>
				</div>
				<div class="ibox-content">
					<div class="tabs-container">
						<ul class="nav nav-tabs">
							@if (isset($dataTableFree))
								<li><a data-toggle="tab" href="#tab-free">Gratuito</a></li>
							@endif
							@if (isset($dataTableActive))
								<li class="active"><a data-toggle="tab" href="#tab-active">Ativos</a></li>
							@endif
							@if (isset($dataTableFinish))
								<li><a data-toggle="tab" href="#tab-finish">Finalizados</a></li>
							@endif
							@if (isset($dataTableBlocked))
								<li><a data-toggle="tab" href="#tab-blocked">Bloqueados</a></li>
							@endif
							@if (isset($dataTableInative))
								<li><a data-toggle="tab" href="#tab-inative">Inativos</a></li>
							@endif
						</ul>

						<div class="tab-content">

							<div id="tab-free" class="tab-pane">
								<div class="panel-body">
									<div class="col-lg-12 animated fadeInLeft">
										@if (isset($dataTableFree))
											@include('admin._components.dataTablesJs', ['dataTable' => $dataTableFree])
										@endif
									</div>
								</div>
							</div>

							<div id="tab-active" class="tab-pane active">
								<div class="panel-body">
									<div class="col-lg-12 animated fadeInLeft">
										@if (isset($dataTableActive))
											@include('admin._components.dataTablesJs', ['dataTable' => $dataTableActive])
										@endif
									</div>
								</div>
							</div>

							<div id="tab-blocked" class="tab-pane ">
								<div class="panel-body">
									<div class="col-lg-12 animated fadeInLeft">
										@if (isset($dataTableBlocked))
											@include('admin._components.dataTablesJs', ['dataTable' => $dataTableBlocked])
										@endif
									</div>
								</div>
							</div>

							<div id="tab-finish" class="tab-pane ">
								<div class="panel-body">
									<div class="col-lg-12 animated fadeInLeft">
										@if (isset($dataTableFinish))
											@include('admin._components.dataTablesJs', ['dataTable' => $dataTableFinish])
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
	</div>
</div>
@endsection
