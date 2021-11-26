<div class="form-group">

	@include('admin.routineManagement.goalPCX.formHeader')

	<div class="row form-group">
		<div class="col-sm-2">
			<div class="goal-pcx-square" data-toggle="tooltip" data-placement="top"
			title="Prospects que serão contatados amanhã">P</div>
		</div>
		<div class="col-sm-5">
			<input type="text" name="p_planned" class="form-control mask-numeric" value="" data-toggle="tooltip" data-placement="top"
			title="Planejado" maxlength="3">
		</div>
		<div class="col-sm-5">
			<input type="text" name="p_executed" class="form-control mask-numeric" value="" data-toggle="tooltip" data-placement="top"
			title="Executado" maxlength="3">
		</div>
	</div>

	<div class="row form-group">
		<div class="col-sm-2">
			<div class="goal-pcx-square" data-toggle="tooltip" data-placement="top"
			title="Clientes que serão contatados amanhã">C</div>
		</div>
		<div class="col-sm-5">
			<input type="text" name="c_planned" class="form-control mask-numeric" value="" data-toggle="tooltip" data-placement="top"
			title="Planejado" maxlength="3">
		</div>
		<div class="col-sm-5">
			<input type="text" name="c_executed" class="form-control mask-numeric" value="" data-toggle="tooltip" data-placement="top"
			title="Executado" maxlength="3">
		</div>
	</div>

	<div class="row form-group">
		<div class="col-sm-2">
			<div class="goal-pcx-square" data-toggle="tooltip" data-placement="top"
			title="Ex-clientes que serão contatados amanhã">X</div>
		</div>
		<div class="col-sm-5">
			<input type="text" name="x_planned" class="form-control mask-numeric" value="" data-toggle="tooltip" data-placement="top"
			title="Planejado" maxlength="3">
		</div>
		<div class="col-sm-5">
			<input type="text" name="x_executed" class="form-control mask-numeric" value="" data-toggle="tooltip" data-placement="top"
			title="Executado" maxlength="3">
		</div>
	</div>
</div>


@section('scripts')
@parent
<script>
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	});
</script>
@endsection
