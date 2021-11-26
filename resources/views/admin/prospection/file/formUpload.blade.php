	<div class="form-group">
		<div class="col-sm-4">
			<label class="control-label">Módulos</label>
			<div>
				<select name="contentCourse[]" data-placeholder="Selecione o módulo" class="chosen-select" multiple style="width:350px;" tabindex="4"></select>
			</div>
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

		<div class="col-sm-4">
			<label class=" control-label">Nome desejado p/ o arquivo</label>
			<input type="text" name="name" class="form-control" value="" required>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-12">
			<label class=" control-label">Título</label>
			<input type="text" name="title" class="form-control" value="" required>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-12">
			<label>Descrição</label>
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
<!-- Mainly scripts -->
<script src="{!! asset('js/plugins/metisMenu/jquery.metisMenu.js') !!}"></script>
<script src="{!! asset('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}"></script>

<!-- Custom and plugin javascript -->
<script src="{!! asset('js/inspinia.js') !!}"></script>
<!-- SUMMERNOTE -->
<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}"></script>

<!-- Page-Level Scripts -->
<script src="{!! asset('js/plugins/dataTables/datatables.min.js') !!}"></script>
<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>
<script src="{!! asset('js/plugins/clockpicker/clockpicker.js') !!}"></script>
<script src="{!! asset('js/plugins/switchery/switchery.js') !!}"></script>
<script src="{!! asset('js/plugins/jasny/jasny-bootstrap.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/dropzone/dropzone.js') !!}"></script>
<script src="{!! asset('js/plugins/select2/select2.full.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/chosen/chosen.jquery.js') !!}" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		try {
			Dropzone.options.dropzoneForm = {
				paramName: "file", // The name that will be used to transfer the file
				maxFilesize: 8, // MB
				dictDefaultMessage: "<strong>Drop files here or click to upload. </strong></br> (This is just a demo dropzone. Selected files are not actually uploaded.)"
			};

			APP.scope.listSelectBox = <?=isset($listSelectBox) ? json_encode($listSelectBox) : 'null' ?>;

			if (APP.scope.listSelectBox) {
				if (APP.scope.listSelectBox.contentCourse) {
					populateSelectBox({
						list: APP.scope.listSelectBox.contentCourse,
						target: document.forms.formFile['contentCourse[]'],
						columnValue: "id",
						columnLabel: "title_pt",
						selectBy: (APP.scope.file && APP.scope.file.contentCourse) ? APP.scope.file.contentCourse : null,
					});

					$('.chosen-select').chosen({ width: "100%" });
				}
			}

			if (APP.scope.file) {
				populate(document.forms.formFile, APP.scope.file);

				if (APP.scope.file.link) {
					document.getElementById('file').innerHTML = '<a href="' + APP.scope.file.link + '" title="' + APP.scope.file.link + '" target="_blank"><i class="fas fa-download"></i> ' + APP.scope.file.name + '</a>'
				}
			}

			$('.summernote').summernote({
				height: 100,
				toolbar: false,
				placeholder: 'Digite seu conteúdo',
				required: true
			});

			$(".select2_demo_1").select2();
		} catch(error) {
			console.warn(error);
		}
	});

</script>
@endsection
