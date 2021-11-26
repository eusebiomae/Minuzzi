@section('css')
@parent
{{-- Estilo Arquivo  --}}
<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/chosen/bootstrap-chosen.css') !!}" />

@endsection

	<div class="form-group">
		<label class="col-sm-1 control-label">Página</label>
		<div class="col-sm-8">
			<select name="contentPage[]" data-placeholder="Selecione a página" class="chosen-select" multiple style="width:350px;" tabindex="4"></select>
		</div>
		<label class="col-sm-1 control-label">Tipo de Arquivo</label>
		<div class="col-sm-2">
			<select class="form-control m-b" name="type_file_id" id="type_file_id" required></select>
		</div>

		{{-- <div class="col-sm-4">
			<label class="control-label">Tipo de Arquivo</label>
			<select name="type_file" class="select2_demo_1 form-control" required>
				<option value="">Selecione...</option>
				<option value="far fa-file-image">Imagem</option>
				<option value="far fa-file-video">Vídeo</option>
				<option value="far fa-file-audio">Audio</option>
				<option value="far fa-file-pdf">PDF</option>
				<option value="far fa-file-word">Word</option>
				<option value="far fa-file-powerpoint">PowerPoint</option>
				<option value="far fa-file-excel">Execel</option>
				<option value="far fa-file-archive">Zip</option>
				<option value="far fa-file-alt">Texto</option>
				<option value="far fa-file-code">Código</option>
				<option value="far fa-file">Outros</option>
			</select>
		</div> --}}

	</div>

	<div class="form-group">
		<label class="col-sm-1 control-label">Título*</label>
		<div class="col-sm-5">
			<input type="text" name="title" class="form-control" value="" required>
		</div>
		<label class="col-sm-2 control-label">Nome desejado p/ o arquivo*</label>
		<div class="col-sm-4">
			<input type="text" name="name" class="form-control" value="" required>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-1 control-label">Descrição</label>
		<div class="col-sm-11">
			<div class="ibox-content no-padding">

				<textarea name="description" class="summernote"></textarea>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-1 control-label">Aquivo*</label>
		<div class="col-sm-5">
			<div class="fileinput fileinput-new input-group" data-provides="fileinput">
				<div class="form-control" data-trigger="fileinput">
					<i class="glyphicon glyphicon-file fileinput-exists"></i>
					<span class="fileinput-filename" id="fileinput-filename_doc"></span>
				</div>
				<span class="input-group-addon btn btn-default btn-file">
					<span class="fileinput-new">Selecionar</span>
					<span class="fileinput-exists">Alterar</span>
					<input type="file" id="fileDoc" name="fileDoc" value="" placeholder="">
				</span>
				<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
			</div>
		</div>
		<label class="col-sm-1 control-label">Subtítulo</label>
		<div class="col-sm-5">
			<input type="text" name="subtitle" class="form-control" value="">
		</div>
	</div>
	<div  class="row m-b-md">
		<div class="col-sm-10 col-sm-offset-1" id="file"></div>
	</div>

	<div class="form-group">
		<label class="col-sm-1 control-label">Imagem*</label>
		<div class="col-sm-11">
			<div class="fileinput fileinput-new input-group" data-provides="fileinput">
				<div class="form-control" data-trigger="fileinput">
					<i class="glyphicon glyphicon-file fileinput-exists"></i>
					<span class="fileinput-filename" id="fileinput-filename_img"></span>
				</div>
				<span class="input-group-addon btn btn-default btn-file">
					<span class="fileinput-new">Selecionar</span>
					<span class="fileinput-exists">Alterar</span>
					<input type="file" id="fileImage" name="fileImage" value="" placeholder="">
				</span>
				<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
			</div>
			<div class="img">
				<img id="img" width="200px">
			</div>
		</div>
	</div>


@section('scripts')
@parent

<!-- Page-Level Scripts -->
<script src="{!! asset('js/plugins/chosen/chosen.jquery.js') !!}" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		try {
			if (APP.listSelectBox) {
				if (APP.listSelectBox.contentPage) {
					populateSelectBox({
						list: APP.listSelectBox.contentPage,
						target: document.forms.form['contentPage[]'],
						columnValue: "id",
						columnLabel: "description_pt",
						selectBy: (APP.payload && APP.payload.data && APP.payload.data.content_page) ? APP.payload.data.content_page.map(function(item) { return item.id }) : null,
					});
				}

				if (APP.listSelectBox.typeFile) {
					populateSelectBox({
						list: APP.listSelectBox.typeFile,
						target: document.forms.form['type_file_id'],
						columnValue: "id",
						columnLabel: "name",
						selectBy: (APP.payload && APP.payload.data && APP.payload.data.type_file_id) ? [APP.payload.data.type_file_id] : null,
						emptyOption: {
							label: "Selecione..."
						}
					});
				}

			}
			if (document.forms.form) {
				document.forms.form.fileImage.addEventListener('change', function(event) {
					// console.log(event.target.files[0]);
					document.getElementById('img').src = URL.createObjectURL(event.target.files[0])
					document.getElementById('img').alt = 'img_' +  event.target.files[0]
					document.getElementById('fileinput-filename_img').innerText = event.target.files[0].name
				})
				document.forms.form.fileDoc.addEventListener('change', function(event) {
					console.log(event.target.files[0]);
					document.getElementById('img').alt = 'doc_' +  event.target.files[0]
					document.getElementById('fileinput-filename_doc').innerText = event.target.files[0].name

					document.getElementById('file').innerHTML = '<a href="' + URL.createObjectURL(event.target.files[0]) + '" title="' + event.target.files[0].name + '" target="_blank"><i class="fas fa-download"></i> ' + event.target.files[0].name + '</a>';

				})
			}

			if (APP.payload) {
				if (APP.payload.data.type_file_id) {
					if (APP.payload.data.link) {
						document.getElementById('file').innerHTML = '<a href="' + APP.payload.data.link + '" title="' + APP.payload.data.link + '" target="_blank"><i class="fas fa-download"></i> ' + APP.payload.data.name + '</a>';
					}
				}
				if (APP.payload.data.img){
					document.getElementById('img').src = APP.payload.data.img
					document.getElementById('img').alt = 'img_' + APP.payload.data.img
				}
			}

			$('.chosen-select').chosen({width: "100%"});

		} catch(error) {
			console.warn(error);
		}
	});

</script>
@endsection
