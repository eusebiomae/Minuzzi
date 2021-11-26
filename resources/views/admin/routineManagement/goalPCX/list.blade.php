@extends('layouts.app')
@section('title', $module_page . ' ('. $title_page .')')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />

@endsection

@section('content')
@include($header)

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><?= $title_page ?> <?= $module_page ?></h5>
				</div>
				<div class="ibox-content">
					<div class="row m-b">
						<form name="formFilterGoalPCX" method="get" action="" class="form-horizontal">
							<div class="col-lg-1">Filtro:</div>
							<div class="col-lg-4">
								<select name="user_id" class="form-control" placeholder="Vendedor"></select>
							</div>
							<div class="col-lg-3">
								<select name="month" class="form-control" placeholder="Mês"></select>
							</div>
							<div class="col-lg-1">
								<button type="submit" class="btn btn-primary">Filtrar</button>
							</div>
						</form>
					</div>
					<div class="full-height-scroll">
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
