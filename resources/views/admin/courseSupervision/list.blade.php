@extends('layouts.app')

@section('title', 'Supervisão')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Lista de Supervisão</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/admin') }}">Home</a>
			</li>
			<li>
				<a href="{{ url('/admin/course_supervision' ) }}">Supervisão</a>
			</li>
			<li class="active">
				<strong>Listar Supervisão</strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2" style="padding-top: 30px; text-align: right">
		<a href="{{ url('/admin/course_supervision/insert') }}">
			<button class="btn btn-primary"><i class="fa fa-plus"></i> Novo</button>
		</a>
	</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Supervisão <small>Ano letívo e permantes.</small></h5>
				</div>
				<div class="ibox-content">

					<div class="tabs-container">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#tab-active"> Ativo</a></li>
							<li><a data-toggle="tab" href="#tab-finished"> Finalizado</a></li>
							<li><a data-toggle="tab" href="#tab-inactive"> Inativo</a></li>
						</ul>

						<div class="tab-content">

							<div id="tab-active" class="tab-pane active">
								<div class="panel-body">
									<div class="col-lg-12 animated fadeInLeft">
										@include('admin._components.dataTablesJs', ['dataTable' => $dataTable['active']])
									</div>
								</div>
							</div>

							<div id="tab-finished" class="tab-pane">
								<div class="panel-body">
									<div class="col-lg-12 animated fadeInLeft">
										@include('admin._components.dataTablesJs', ['dataTable' => $dataTable['finished']])
									</div>
								</div>
							</div>

							<div id="tab-inactive" class="tab-pane">
								<div class="panel-body">
									<div class="col-lg-12 animated fadeInLeft">
										@include('admin._components.dataTablesJs', ['dataTable' => $dataTable['inactive']])
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
