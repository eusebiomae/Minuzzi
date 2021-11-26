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
	@if ($fieldPageConfig->show('description'))
	<div class="col-sm-10">
		<label class="control-label">Forma de Pagamento</label>
		<input type="text" name="description" class="form-control" {!! $fieldPageConfig->attr('description') !!}/>
	</div>
	@endif
	@if ($fieldPageConfig->show('flg_web'))
	<div class="col-sm-1">
		<div class="i-checks"><label class="m-t-lg">
			<input type="checkbox" value="1" name="flg_web" {!! $fieldPageConfig->attr('flg_web') !!}> <i></i> Mostrar no Site </label>
		</div>
	</div>
	@endif
	@if ($fieldPageConfig->show('flg_free'))
	<div class="col-sm-1">
		<div class="i-checks"><label class="m-t-lg">
			<input type="checkbox" value="1" name="flg_free" {!! $fieldPageConfig->attr('flg_free') !!}> <i></i> Gratis </label>
		</div>
	</div>
	@endif
</div>

<fieldset class="form-group">
	<legend>Campos de dados do Contrato</legend>
	@if ($fieldPageConfig->show('clause4_1b'))
	<div class="col-sm-6">
		<label for="" class="control-label">Cláusula: 4.1 B</label>
		<textarea name="clause4_1b" cols="30" rows="10" class="form-control" {!! $fieldPageConfig->attr('clause4_1b') !!}></textarea>
	</div>
	@endif

	@if ($fieldPageConfig->show('clause4_2_1'))
	<div class="col-sm-6">
		<label for="" class="control-label">Cláusula: 4.2.1</label>
		<textarea name="clause4_2_1" cols="30" rows="10" class="form-control" {!! $fieldPageConfig->attr('clause4_2_1') !!}></textarea>
	</div>
	@endif
</fieldset>
