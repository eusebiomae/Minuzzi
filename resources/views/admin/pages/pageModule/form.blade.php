<div class="row m-b-md">
	@if ($fieldPageConfig->show('page_module_id'))
	<div class="col-sm-12">
		<label class="control-label">Módulo superior</label>
		<select name="page_module_id" class="form-control m-b" {!! $fieldPageConfig->attr('page_module_id') !!}></select>
		<span class="help-block m-b-none">Intique qual o módulo superior caso este seja um sub-módulo.</span>
	</div>
	@endif

	@if ($fieldPageConfig->show('desc'))
	<div class="col-sm-12">
		<label class="control-label">Módulo de página*</label>
		<input type="text" name="desc" class="form-control" {!! $fieldPageConfig->attr('desc') !!} maxlength="64">
		<span class="help-block m-b-none">Digite o Módulo de página.</span>
	</div>
	@endif

	@if ($fieldPageConfig->show('name_key'))
	<div class="col-sm-12">
		<label class="control-label">Key*</label>
		<input type="text" name="name_key" class="form-control" {!! $fieldPageConfig->attr('name_key') !!} maxlength="64">
		<span class="help-block m-b-none">Chave de indentificação na configuração de rotas.</span>
	</div>
	@endif
</div>

@section('scripts')
@parent
<script>
	$(document).ready(function() {
		try {
			if (APP.listSelectBox) {

				if (APP.listSelectBox.pageModule) {
					populateSelectBox({
						list: APP.listSelectBox.pageModule,
						target: document.forms.form['page_module_id'],
						columnValue: "id",
						columnLabel: "desc",
						emptyOption: {
						label: "Selecione..."
						},
						selectBy: (APP.payload && APP.payload.data && APP.payload.data.page_module_id) ? [APP.payload.data.page_module_id] : null,
					});
				}

			}

		} catch(error) {
			console.warn(error);
		}
	});
</script>
@endsection
