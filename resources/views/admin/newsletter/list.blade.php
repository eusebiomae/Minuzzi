@extends('layouts.app')

@section('title', 'Newsletter')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-sm-9">
    <h2>Lista de Vídeos Diversas</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li class="active">
        <strong>Newsletters</strong>
      </li>
    </ol>
  </div>
  <div class="col-sm-3" style="padding-top: 30px; text-align: right">
    {{-- <a href="{{ url('/admin/prospection/video/insert') }}">
      <button class="btn btn-primary"><i class="fa fa-plus"></i> Novo</button>
    </a> --}}
  </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
        </div>
        <div class="ibox-content">

          <div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px;" >
							<thead>
								<tr>
									<th>Id</th>
									<th>Nome</th>
									<th>E-mail</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($payload->newsletter as $newsletter)
								<tr>
									<td>{{ $newsletter->id }}</td>
									<td>{{ $newsletter->name }}</td>
									<td>{{ $newsletter->email }}</td>
								</tr>
								@endforeach
							</tbody>
							<tfoot>
								<tr>
									<th>Id</th>
									<th>Nome</th>
									<th>E-mail</th>
								</tr>
							</tfoot>
						</table>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection


