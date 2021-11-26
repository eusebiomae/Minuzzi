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
					<div class="full-height-scroll">
						@include('admin._components.dataTables')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal inmodal" id="modalActivitiesGoalPcx" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-fs">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<i class="fa fa-align-left modal-icon"></i>
				<h4 class="modal-title">Atividades Meta PCX</h4>
				<small class="font-bold">Registre aqui as atividades de meta PCX.</small>
			</div>
			<form method="post" name="formPhoneContact" action="{{ url( $url_page . '/save') }}" class="form-horizontal">
				<div class="modal-body">
					{{ csrf_field() }}
					<input name="id" type="hidden">
					@include('admin.routineManagement.activitiesGoalPCX.formActivitiesGoalPCX')
				</div>
				<div class="modal-footer" style="margin-top: 0">
					<button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
	$(document).ready(function() {
		$('.dataTables-example').DataTable({
			pageLength: 50,
			responsive: true,
			dom: '<"html5buttons"B>lTfgitp',
			buttons: [{
				extend: 'copy'
			},
			{
				extend: 'csv',
				title: 'Bee Happy - Lista de Atividades Meta PCX'
			},
			{
				extend: 'excel',
				title: 'Bee Happy - Lista de Atividades Meta PCX'
			},
			{
				extend: 'pdf',
				title: 'Bee Happy - Lista de Atividades Meta PCX'
			},

			{
				extend: 'print',
				customize: function(win) {
					$(win.document.body).addClass('white-bg');
					$(win.document.body).css('font-size', '10px');

					$(win.document.body).find('table')
					.addClass('compact')
					.css('font-size', 'inherit');
				}
			}
			]

		});

		try {
			APP = {
				scope: {
				},
			};
		} catch (error) {
			console.warn(error);
		}

	});
</script>
@endsection
