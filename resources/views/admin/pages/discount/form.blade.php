@section('css')
@parent
<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />

@endsection

<div class="row m-b-sm">

	<div class="col-sm-3">
		<label class="control-label">Título*</label>
		<input type="text" name="title" class="form-control" required maxlength="255"/>
	</div>

	<div class="col-sm-2">
		<label class="control-label">Validade</label>
		<div class="input-group date">
			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			<input type="text" name="shelf_life" class="form-control" readonly >
		</div>
	</div>

	<div class="col-sm-1">
		<label class="control-label">Quant.</label>
		<input type="tel" name="qtd" class="form-control mask-numeric" />
	</div>

	<div class="col-sm-2">
		<label class="control-label">Valor</label>
		<input type="tel" name="value" class="form-control mask-money" />
	</div>

	<div class="col-sm-2">
		<label class="control-label">Porcentagem</label>
		<input type="tel" name="percentage" class="form-control mask-percentage" />
	</div>

	<div class="col-sm-2">
		<label class="control-label">Código*</label>
		<input type="tel" name="code" class="form-control" required maxlength="32" />
	</div>

</div>

@section('scripts')
@parent
<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>
<script>
			setDatePicker('.date')
</script>
@endsection
