@section('css')
<link href="{!! asset('css/plugins/iCheck/custom.css')!!}" rel="stylesheet">
@parent

@endsection

@section('scripts')
<script src="{!! asset('js/plugins/iCheck/icheck.min.js')!!}"></script>
<script>
		$(document).ready(function () {
				$('.i-checks').iCheck({
						checkboxClass: 'icheckbox_square-green',
				});
		});
</script>
@parent

@endsection

<div class="form-group">
	<div class="col-sm-10">
		<label class="control-label">Forma de Pagamento</label>
		<input type="text" name="description" class="form-control" />
	</div>
	<div class="col-sm-1">
		<div class="i-checks"><label class="m-t-lg"> <input type="checkbox" value="1" name="flg_web"> <i></i> Mostrar no Site </label></div>
	</div>
	<div class="col-sm-1">
		<div class="i-checks"><label class="m-t-lg"> <input type="checkbox" value="1" name="flg_free"> <i></i> Grátis </label></div>
	</div>
</div>

<fieldset class="form-group">
	<legend>Campos de dados do Contrato</legend>
	<div class="col-sm-6">
		<label for="" class="control-label">Cláusula: 4.1 B</label>
		<textarea name="clause4_1b" cols="30" rows="10" class="form-control"></textarea>
	</div>

	<div class="col-sm-6">
		<label for="" class="control-label">Cláusula: 4.2.1</label>
		<textarea name="clause4_2_1" cols="30" rows="10" class="form-control"></textarea>
	</div>
</fieldset>
