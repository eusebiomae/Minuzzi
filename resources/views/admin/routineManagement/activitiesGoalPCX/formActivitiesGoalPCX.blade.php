@section('css')
@parent

@endsection

<div class="row form-group">
	@if($configApp->showFormFields ? $configApp->showFormFields->description : true)
	<div class="col-sm-12">
		<label class="control-label">Atividade</label>
		<input type="text" name="description" class="form-control" maxlength="255">
	</div>
	@endif
</div>

@section('scripts')
@parent
<script>

</script>
@endsection
