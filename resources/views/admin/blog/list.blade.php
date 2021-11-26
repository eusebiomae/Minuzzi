@extends('layouts.app')

@section('title', 'Blog')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Lista de Post</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li>
        <a href="{{ url('/admin/blog') }}">Blog</a>
      </li>
      <li class="active">
        <strong>Lista de Post</strong>
      </li>
    </ol>
  </div>
  <div class="col-lg-2">

  </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-11"></div>
    <div class="col-lg-1" style="padding-bottom: 10px;">
      <a href="{{ url('/admin/blog/insert') }}">
        <button class="btn btn-primary"><i class="fa fa-plus"></i> Novo</button>
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Posts do Blog </h5>
        </div>
        <div class="ibox-content">

          <div class="table-responsive">
            <div class="tabs-container">
              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-1"> Blog</a></li>
                <li><a class="" data-toggle="tab" href="#tab-2">Artigo</a></li>
              </ul>
                <input name="id" type="hidden">

                <div class="tab-content">
                  <div id="tab-1" class="tab-pane active">

                    <div class="panel-body">
                      @include('admin._components.dataTables', [ 'dataTable' => $dataTableB ])
                    </div>
                  </div>

                  <div id="tab-2" class="tab-pane">
                    <div class="panel-body">
                      @include('admin._components.dataTables', [ 'dataTable' => $dataTableA ])
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
