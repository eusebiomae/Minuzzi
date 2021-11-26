@extends('layouts.app')

@section('title', $config->title)

@section('css')
@parent
@endsection

@section('content')
@include($config->header)

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>{{$config->contentTitle}}</h5>
        </div>

        <div class="ibox-content">
          <div class="tabs-container">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#tab-enable"> Ativos</a></li>
              <li><a data-toggle="tab" href="#tab-disable"> Inativos</a></li>
            </ul>

            <div class="tab-content">

              <div id="tab-enable" class="tab-pane active">
                <div class="panel-body">
                  <div class="col-lg-12 animated fadeInLeft">
                    @include('admin.components.dataTablesJs', ['id' => 'enable', 'dataTable' => $dataTable['enable']])
                  </div>
                </div>
              </div>

              <div id="tab-disable" class="tab-pane">
                <div class="panel-body">
                  <div class="col-lg-12 animated fadeInLeft">
                    @include('admin.components.dataTablesJs', ['id' => 'disable', 'dataTable' => $dataTable['disable']])
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

@section('scripts')
@parent

@endsection
