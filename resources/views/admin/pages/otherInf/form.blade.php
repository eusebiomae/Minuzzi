@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
@endsection

<div class="row m-b-md">
	@if ($fieldPageConfig->show('other_inf_type_id'))
	<label class="col-sm-1 control-label">Tipo*</label>
	<div class="col-sm-4 ">
		<select name="other_inf_type_id" class="form-control m-b" {!! $fieldPageConfig->attr('other_inf_type_id') !!}>
		</select>
		<span class="help-block m-b-none">Digite o Forma de Pagamento.</span>
	</div>
	@endif
	@if ($fieldPageConfig->show('title'))
	<label class="col-sm-1 control-label">Nome*</label>
	<div class="col-sm-6 ">
		<input type="text" name="title" class="form-control" {!! $fieldPageConfig->attr('title') !!} maxlength="45">
		<span class="help-block m-b-none">Digite o Nome.</span>
	</div>
	@endif
</div>
<div class="row">
	@if ($fieldPageConfig->show('description'))
	<label class="col-sm-1 control-label">Descrição</label>
	<div class="col-sm-11">
		<textarea name="description" class="summernote" {!! $fieldPageConfig->attr('description') !!}></textarea>
		<span class="help-block m-b-none">Digite o Descrição.</span>
	</div>
	@endif
	@if ($fieldPageConfig->show('image'))
	<label class="col-sm-1 control-label">Imagem de Perfil</label>
	<div class="col-sm-11">
		<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			<div class="form-control" data-trigger="fileinput">
				<i class="glyphicon glyphicon-file fileinput-exists"></i>
				<span class="fileinput-filename" id="fileinput-filename_img"></span>
			</div>
			<span class="input-group-addon btn btn-default btn-file">
				<span class="fileinput-new">Selecionar</span>
				<span class="fileinput-exists">Alterar</span>
				<input type="file" id="fileImage" name="fileImage">
			</span>
			<a href="#" class="input-group-addon btn btn-default fileinput-exists"
				data-dismiss="fileinput">Remover</a>
		</div>
	</div>
	@endif
</div>
<div class="row center">
	<div class="img">
		<img id="img" width="200px">
	</div>
</div>

@section('scripts')
@parent
<script src="{!! asset('js/plugins/dropzone/dropzone.js') !!}" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		try {
			if (APP.listSelectBox) {
				if (APP.listSelectBox.other_inf_type_id) {
					populateSelectBox({
						list: APP.listSelectBox.other_inf_type_id,
						target: document.forms.form['other_inf_type_id'],
						columnValue: "id",
						columnLabel: "description_pt",
						emptyOption: {
						label: "Selecione..."
						},
						selectBy: (APP.payload && APP.payload.data && APP.payload.data.other_inf_type_id) ? [APP.payload.data.other_inf_type_id] : null,
					});
				}

			}

			document.forms.form.fileImage.addEventListener('change', function(event) {
				document.getElementById('img').src = URL.createObjectURL(event.target.files[0])
				document.getElementById('img').alt = 'img_' +  event.target.files[0]
				document.getElementById('fileinput-filename_img').innerText = event.target.files[0].name
			})

			if (APP.payload) {
				if (APP.payload.data.img){
					document.getElementById('img').src = APP.payload.data.img
					document.getElementById('img').alt = 'img_' + APP.payload.data.img
				}
			}

		} catch(error) {
			console.warn(error);
		}
	});
</script>
@endsection
