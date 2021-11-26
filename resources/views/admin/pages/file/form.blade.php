@section('css')
@parent
{{-- Estilo Arquivo  --}}
<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/chosen/bootstrap-chosen.css') !!}" />

@endsection

	<div class="form-group">
		<label class="col-sm-1 control-label">Módulos</label>
		<div class="col-sm-5">
			<select name="contentCourse[]" data-placeholder="Selecione o módulo" class="chosen-select" multiple style="width:350px;" tabindex="4"></select>
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

		<label class="col-sm-2 control-label">Nome desejado p/ o arquivo*</label>
		<div class="col-sm-4">
			<input type="text" name="name" class="form-control" value="" required>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-1 control-label">Título*</label>
		<div class="col-sm-11">
			<input type="text" name="title" class="form-control" value="" required>
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
		<div class="col-sm-11">
			<div class="fileinput fileinput-new input-group" data-provides="fileinput">
				<div class="form-control" data-trigger="fileinput">
					<i class="glyphicon glyphicon-file fileinput-exists"></i>
					<span class="fileinput-filename"></span>
				</div>
				<span class="input-group-addon btn btn-default btn-file">
					<span class="fileinput-new">Selecionar</span>
					<span class="fileinput-exists">Alterar</span>
					<input type="file" id="fileImage" name="fileImage" value="">
				</span>
				<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
			</div>
			<div id="img" class="img"></div>
		</div>
	</div>

	<div id="file" class="row"></div>
@section('scripts')
@parent

<!-- Page-Level Scripts -->
<script src="{!! asset('js/plugins/chosen/chosen.jquery.js') !!}" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		try {
			if (APP.listSelectBox) {
				if (APP.listSelectBox.contentCourse) {
					populateSelectBox({
						list: APP.listSelectBox.contentCourse,
						target: document.forms.form['contentCourse[]'],
						columnValue: "id",
						columnLabel: "title_pt",
						selectBy: (APP.payload && APP.payload.data && APP.payload.data.file_content_course) ? APP.payload.data.file_content_course.map(function(item) { return item.content_course_id }) : null,
					});
				}

			}

			$('.chosen-select').chosen({width: "100%"});
			// if (APP.scope.file) {
			// 	populate(document.forms.formFile, APP.scope.file);

			// 	if (APP.scope.file.link) {
			// 		document.getElementById('file').innerHTML = '<a href="' + APP.scope.file.link + '" title="' + APP.scope.file.link + '" target="_blank"><i class="fas fa-download"></i> ' + APP.scope.file.name + '</a>'
			// 	}
			// }

		} catch(error) {
			console.warn(error);
		}
	});

</script>
@endsection
