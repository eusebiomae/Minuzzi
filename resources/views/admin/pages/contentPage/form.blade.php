<div class="form-group">
	<div class="col-sm-6">
		<label class="control-label" for="description_pt">Página*</label>
		<input type="text" id="description_pt" name="description_pt" class="form-control" required>
		<span class="help-block m-b-none">Digite o nome da Página.</span>
	</div>
	<div class="col-sm-6">
		<label class="control-label" for="flg_page">Flag*</label>
		<input type="text" id="flg_page" name="flg_page" class="form-control" required>
		<span class="help-block m-b-none">Digite a flag da Página.</span>
	</div>
	<div class="col-sm-3">
		<label class="control-label" for="sequence">Sequência*</label>
		<input type="number" id="sequence" name="sequence" class="form-control" required>
		<span class="help-block m-b-none">Digite o número da Sequência.</span>
	</div>
	<div class="col-sm-3">
		<label class="control-label" for="url">ULR*</label>
		<input type="text" id="url" name="url" class="form-control" required>
		<span class="help-block m-b-none">Digite a URL.</span>
	</div>
	<div class="col-sm-2">
		<label class="control-label" for="show">Mostrar no menu</label>
		<input type="checkbox" class="form-control" name="show" id="show" value="1">
	</div>
	<div class="col-sm-2">
		<label class="control-label" for="target">Abrir em outra Aba</label>
		<input type="checkbox" class="form-control" name="target" id="target" value="1">
	</div>
</div>
<div>
	<div class="text-left">
		<button
			type="button"
			class="btn btn-primary"
			title="Adicionar novo"
			onclick="newMetaTag()"
		>
			<i class="fa fa-plus"></i> Adicionar Meta Tag
		</button>
	</div>
	<div id="metaTag"></div>
</div>

<script id="tmplMetaTag" type="text/x-dot-template">
	<div class="form-group">
		<input type="hidden" name="metaTag[@{{= it.key }}][id]" value="@{{= it.id }}" />
		<div class="col-sm-2">
			<label class="control-label">Nome da Tag</label>
			<input type="text" name="metaTag[@{{= it.key }}][name]" class="form-control" maxlength="128" value="@{{= it.name }}">
			<span class="help-block m-b-none">Nome da Meta Tag.</span>
		</div>
		<div class="col-sm-9">
			<label class="control-label">Conteúdo</label>
			<input type="text" name="metaTag[@{{= it.key }}][content]" class="form-control" maxlength="1024" value="@{{= it.content }}">
			<span class="help-block m-b-none">Conteúdo da Meta Tag.</span>
		</div>
		<div class="col-sm-1 text-right" style="padding-top: 25px; cursor: pointer; color: #f00">
			<button type="button" class="btn btn-danger p-2" title="Excluir" onclick="removeFormGroup(event)">
				<i class="fa fa-times"></i>
			</button>
		</div>
	</div>
</script>


@section('scripts')
@parent
<script>
	function newMetaTag(data) {
		if (!data) {
			data = {
				id: '',
				name: '',
				content: '',
			}
		}

		data.key = generateUniqueKey()

		var metaTag = setTmplInsertAdjacentHTML({
			tmpl: 'tmplMetaTag',
			toTmpl: 'metaTag',
			data: data,
		})
	}

	function removeFormGroup(event) {
		event.target.closest('.form-group').remove();
	}

	document.addEventListener('DOMContentLoaded', function() {
		try {
			APP.scope.contentPage = <?=isset($data) ? json_encode($data) : 'null'?>;
			APP.metaTag = {!! isset($metaTag) ? json_encode($metaTag) : '[]' !!};

			if (APP.scope.contentPage) {
				populate(document.forms.formContentPage, APP.scope.contentPage);
			}

			APP.metaTag.forEach(newMetaTag)


		} catch (error) {
			console.warn(error);
		}
	});
</script>
@endsection
