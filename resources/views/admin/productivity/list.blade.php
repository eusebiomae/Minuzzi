@extends('layouts.app')

@section('title', 'Produtividade')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Lista de Produtividade</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li>
        <a href="{{ url('/admin/routine_management/productivity') }}">Produtividade</a>
      </li>
      <li class="active">
        <strong>Listar de Produtividade</strong>
      </li>
    </ol>
  </div>
  <div class="col-lg-2" style="padding-top: 30px; text-align: right">
    <a href="{{ url('/admin/routine_management/productivity/insert') }}">
      <button class="btn btn-primary"><i class="fa fa-plus"></i> Novo</button>
    </a>
  </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Lista de Produtividade cadastradas </h5>
        </div>
        <div class="ibox-content">

          <div class="table-responsive">
            @include('admin._components.dataTables')
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
	$(document).ready(function() {
		try {
			APP = {
				scope: {
					dataFilter: <?= isset($dataFilter) ? json_encode($dataFilter) : 'null' ?>,
					listSelectBox: <?= isset($listSelectBox) ? json_encode($listSelectBox) : 'null' ?>
				},
			};

			if (APP.scope.listSelectBox.sellers) {
				populateSelectBox({
					list: APP.scope.listSelectBox.sellers,
					target: document.forms.formFilterGoalPCX.user_id,
					columnValue: "id",
					columnLabel: "name",
					emptyOption: {
						label: "Vendedor..."
					}
				});
			}

			if (APP.scope.listSelectBox.months) {
				populateSelectBox({
					list: APP.scope.listSelectBox.months,
					target: document.forms.formFilterGoalPCX.month,
					columnValue: "key",
					columnLabel: "label",
					emptyOption: {
						label: "Mês..."
					}
				});
			}

			if (APP.scope.dataFilter) {
				populate(document.forms.formFilterGoalPCX, APP.scope.dataFilter);
			}
		} catch (error) {
			console.warn(error);
		}

	});
</script>
@endsection