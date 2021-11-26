@section('css')
@parent
{{-- Estilo Arquivo  --}}
<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />

@endsection
	<div class="col-lg-12">
		<div class="form-group">
			<label class="col-sm-2 control-label" for="title">Titulo*</label>
			<div class="col-sm-10">
				<input type="text" id="title" name="title" class="form-control" value="" required>
				<span class="help-block m-b-none">Digite o tipo.</span>
			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<div class="form-group">
			<label class="col-sm-2 control-label" for="description">Descrição</label>
			<div class="col-sm-10">
				<input type="text" id="description" name="description" class="form-control" value="">
				<span class="help-block m-b-none">Digite a Descrição.</span>
			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<div class="form-group">
			<label class="col-sm-2 control-label" for="flg">Flag*</label>
			<div class="col-sm-4">
				<input type="text" id="flg" name="flg" class="form-control" value="" required>
				<span class="help-block m-b-none">Digite a Flag de identificação</span>
			</div>

			<label class="col-sm-1 control-label" for="type">Tipo*</label>
			<div class="col-sm-5">
				<input type="text" id="type" name="type" class="form-control" value="" required>
				<span class="help-block m-b-none">Digite o Tipo</span>
			</div>
		</div>
	</div>

	<label class="col-sm-2 control-label" for="fileImage">Imagem em destaque</label>
	<div class="col-sm-10 m-b-md">
		<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			<div class="form-control" data-trigger="fileinput">
				<i class="glyphicon glyphicon-file fileinput-exists"></i>
				<span class="fileinput-filename" id="fileinput-filename-imgCourseType"></span>
			</div>
			<span class="input-group-addon btn btn-default btn-file">
				<span class="fileinput-new">Selecionar</span>
				<span class="fileinput-exists">Alterar</span>
				<input type="file" id="fileImage" name="fileImage" />
			</span>
			<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
		</div>
		<div class="img">
			<img id="imgCourseType" width="200px">
		</div>
	</div>

@section('scripts')
@parent

<script>
	$(document).ready(function() {
		try {
			if (document.forms.form) {
				document.forms.form.fileImage.addEventListener('change', function(event) {
					// console.log(event.target.files[0]);
					document.getElementById('imgCourseType').src = URL.createObjectURL(event.target.files[0])
					document.getElementById('imgCourseType').alt = 'img_' +  event.target.files[0]
					document.getElementById('fileinput-filename-imgCourseType').innerText = event.target.files[0].name
				})
			}

			if (APP.payload && APP.payload.data) {
				if (APP.payload.data.image){
					document.getElementById('imgCourseType').src = APP.payload.data.image
					document.getElementById('imgCourseType').alt = 'img_' + APP.payload.data.image
				}
			}

		} catch(error) {
			console.warn(error);
		}
	});

</script>
@endsection
