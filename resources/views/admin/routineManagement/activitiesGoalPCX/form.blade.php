@extends('layouts.app')
@section('title', $module_page . ' ('. $title_page .')')

@section('css')
@parent
<link rel="stylesheet" href="{!! asset('css/plugins/switchery/switchery.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />

@endsection

@section('content')
@include($header)

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-lg-12">
							<div class="panel-body">
								<form name="formGoalPCX" method="post" action="{{ url($urlAction) }}" enctype="multipart/form-data"
								class="form-horizontal">
								{{ csrf_field() }}
								<input name="id" type="hidden">
								@include('admin.routineManagement.goalPCX.formGoalPCX')
								<div class="col-lg-12">
									<div class="col-lg-10"></div>
									<div class="col-lg-2">
										<div class="form-group">
											<button type="submit" class="btn btn-w-m btn-primary">Salvar</button>
										</div>
									</div>
								</div>
							</form>
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
<script src="{!! asset('js/plugins/switchery/switchery.js') !!}"></script>
<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>

<script>
	$(document).ready(function() {
		try {
			APP = {
				scope: {
					goalPCX: <?= isset($data) ? json_encode($data) : 'null' ?>,
					listSelectBox: <?= isset($listSelectBox) ? json_encode($listSelectBox) : 'null' ?>
				}
			};

			if (APP.scope.listSelectBox.sellers) {
				populateSelectBox({
					list: APP.scope.listSelectBox.sellers,
					target: document.forms.formGoalPCX.user_id,
					columnValue: "id",
					columnLabel: "name",
					emptyOption: {
						label: "Selecione..."
					}
				});
			}

			if (APP.scope.goalPCX) {
				populate(document.forms.formGoalPCX, APP.scope.goalPCX);
			}
		} catch (error) {
			console.warn(error);
		}

		var elem = document.querySelector('.js-switch');
		var switchery = new Switchery(elem, {
			color: '#1AB394'
		});
	});
</script>
@endsection
