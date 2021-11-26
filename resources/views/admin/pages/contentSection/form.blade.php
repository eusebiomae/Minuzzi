<div class="form-group">
	<div class="col-sm-4">
		<label class="control-label">Página</label>
		<select class="form-control m-b" name="content_page_id" id="content_page_id" required>
			<option value="">Selecione a página</option>
			@foreach($listSelectBox->contentPage as $item)
			<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
			@endforeach
		</select>
	</div>

	<div class="col-sm-4">
		<label class="control-label">Flag do Componente</label>
		<input type="text" id="component" name="component" class="form-control">
	</div>

	<div class="col-sm-4">
		<label class="control-label">Ordem do Componente</label>
		<input type="text" id="component_order" name="component_order" class="form-control" value="1">
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">Título</label>
	<div class="col-sm-10">
		<input type="text" id="description_pt" name="description_pt" class="form-control">
		<span class="help-block m-b-none">Digite a título.</span>
	</div>
</div>
{{-- <div class="form-group">
	<label class="col-sm-2 control-label">Título EN</label>
	<div class="col-sm-10">
		<input type="text" id="description_en" name="description_en" class="form-control">
		<span class="help-block m-b-none">Digite a Título em Inglês.</span>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">Título ES</label>
	<div class="col-sm-10">
		<input type="text" id="description_es" name="description_es" class="form-control">
		<span class="help-block m-b-none">Digite a Título em Espanhol.</span>
	</div>
</div> --}}
<div class="form-group">
	<label class="col-sm-2 control-label">Subtítulo</label>
	<div class="col-sm-10">
		<input type="text" id="subtitle_pt" name="subtitle_pt" class="form-control">
		<span class="help-block m-b-none">Digite a Subtítulo.</span>
	</div>
</div>
{{-- <div class="form-group">
	<label class="col-sm-2 control-label">Subtítulo EN</label>
	<div class="col-sm-10">
		<input type="text" id="subtitle_en" name="subtitle_en" class="form-control">
		<span class="help-block m-b-none">Digite a Subtítulo em Inglês.</span>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">Subtítulo ES</label>
	<div class="col-sm-10">
		<input type="text" id="subtitle_es" name="subtitle_es" class="form-control">
		<span class="help-block m-b-none">Digite a Subtítulo em Espanhol.</span>
	</div>
</div> --}}

@section('scripts')
@parent
<script>
document.addEventListener('DOMContentLoaded', function() {
	try {
		APP.scope.contentSection = <?=isset($data) ? json_encode($data) : 'null'?>;

		if (APP.scope.contentSection) {
			populate(document.forms.formContentSection, APP.scope.contentSection);
		}
	} catch (error) {
		console.warn(error);
	}
});
</script>
@endsection
