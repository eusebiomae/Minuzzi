@section('css')
@parent
{{-- Estilo Arquivo  --}}
<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />

@endsection
<div class="col-lg-12">
	<div class="form-group">
		<label class="col-sm-2 control-label">Nome da Categoria</label>
		<div class="col-sm-10">
			<input type="text" name="description_pt" class="form-control" value="">
			<span class="help-block m-b-none">Digite o nome da categoria.</span>
		</div>
	</div>
</div>
<div class="col-lg-12">
	<div class="form-group">
		<label class="col-sm-2 control-label" for="fileImage">Imagem em destaque</label>
		<div class="col-sm-10">
			<div class="fileinput fileinput-new input-group" data-provides="fileinput">
				<div class="form-control" data-trigger="fileinput">
					<i class="glyphicon glyphicon-file fileinput-exists"></i>
					<span class="fileinput-filename" id="fileinput-filename-imgCourse"></span>
				</div>
				<span class="input-group-addon btn btn-default btn-file">
					<span class="fileinput-new">Selecionar</span>
					<span class="fileinput-exists">Alterar</span>
					<input type="file" id="fileImageCourseCategory" name="fileImage" value="">
				</span>
				<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
			</div>
			<div class="img">
				<img id="imgCourse" width="200px">
			</div>
		</div>
	</div>
</div>

@section('scripts')
@parent

<script>
	$(document).ready(function() {
		try {
			if (document.forms.form) {
				document.forms.form.fileImage.addEventListener('change', function(event) {
					document.getElementById('imgCourse').src = URL.createObjectURL(event.target.files[0])
					document.getElementById('imgCourse').alt = 'img_' +  event.target.files[0]
					document.getElementById('fileinput-filename-imgCourse').innerText = event.target.files[0].name
				})
			}

			if (APP.payload && APP.payload.data) {
				if (APP.payload.data.image){
					document.getElementById('imgCourse').src = APP.payload.data.image
					document.getElementById('imgCourse').alt = 'img_' + APP.payload.data.image
				}
			}

		} catch(error) {
			console.warn(error);
		}
	});

</script>
@endsection
