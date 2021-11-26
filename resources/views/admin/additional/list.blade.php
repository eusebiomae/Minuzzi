@extends('layouts.app')

@section('title', 'Adicionais')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Lista de Adicionais</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li class="active">
        <strong>Lista Adicionais</strong>
      </li>
    </ol>
  </div>
  <div class="col-lg-2" style="padding-top: 30px; text-align: right">
    <a href="{{ url('/admin/additional/insert') }}">
      <button class="btn btn-primary"><i class="fa fa-plus"></i> Novo</button>
    </a>
  </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Lista de Adicionais</h5>
        </div>

        <div class="ibox-content">
          @include('admin._components.dataTablesJs', ['dataTable' => $payload->dataTable])
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
