@extends('layouts.app')

@section('title', 'Instrução')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Lista de Vídeos Diversas</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/admin') }}">Home</a>
			</li>
			<li>
				<a href="{{ url('/admin/prospection/video' ) }}">Vídeos Diversas</a>
			</li>
			<li class="active">
				<strong>Listar Vídeos Diversas</strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2" style="padding-top: 30px; text-align: right">
		<a href="{{ url('/admin/prospection/video/insert') }}">
			<button class="btn btn-primary"><i class="fa fa-plus"></i> Novo</button>
		</a>
	</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Vídeos Diversas <small>Todos os vídeos em um só local</small></h5>
				</div>
				<div class="ibox-content">

					<div class="table-responsive">
						@include('admin._components.dataTablesJs')
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
