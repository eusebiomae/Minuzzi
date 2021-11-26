@section('css')
@parent
<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />

@endsection

<div class="row">
	<div class="col-sm-6">
		<label class="control-label">Título*</label>
		<input type="text" name="title" class="form-control" required>
		<span class="help-block m-b-none">Digite o Título.</span>
	</div>
	<div class="col-sm-6">
		<label class="control-label">Link*</label>
		<input type="text" name="link" class="form-control" required>
		<span class="help-block m-b-none">Digite o Link do Vídeo.</span>
		<div id="alert">

		</div>
	</div>
</div>
<div class="row m-t-sm">
	<div class="col-sm-12">
		<div class="i-checks"><label> <input type="radio" value="S" name="type"> <i></i>Vídeo Site </label></div>
		<div class="i-checks"><label> <input type="radio" value="A" name="type" checked=""> <i></i> Vídeo Aluno </label></div>
	</div>
</div>
<div class="form-group">
	<div class="wrapper wrapper-content" style="padding-bottom:0px;">
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Digite o conteúdo em Português*</h5>
					</div>
					<div class="ibox-content no-padding">
						<textarea name="description" class="summernote"></textarea>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-12">
			<div class="fileinput fileinput-new input-group" data-provides="fileinput">
				<div class="form-control" data-trigger="fileinput">
					<i class="glyphicon glyphicon-file fileinput-exists"></i>
					<span class="fileinput-filename"></span>
				</div>
				<span class="input-group-addon btn btn-default btn-file">
					<span class="fileinput-new">Selecionar Imagem</span>
					<span class="fileinput-exists">Trocar</span>
					<input type="file" name="fileImage" accept="image/*"/>
				</span>
				<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
			</div>
			<img id="image" height="100px">
		</div>

	</div>
</div>

@section('scripts')
@parent

<script>
	document.addEventListener('APP.payload', function() {
		try {
			APP.payload && (document.getElementById('image').src = APP.payload.data.image)
			if (document.forms.form) {
				document.forms.form.fileImage.addEventListener('change', function(event) {
					document.getElementById('image').src = URL.createObjectURL(event.target.files[0])
				})
			}

		$(document).ready(function() {
			var save = document.querySelector("button[type='submit']");
			var link = document.querySelector('[name="link"]');

			// evento Blur
			if(link) {
				link.addEventListener("blur", function( event ) {

					validateLink();
				}, true);
			}

			// evento Clink
			$('input').on('ifChecked', function(event){
				validateLink()
			});

			function validateLink(){
				var type = document.querySelector("[name='type']:checked");
					var alert = document.getElementById('alert')

					save.setAttribute("disabled", "disabled");
					// console.log(type.value);

					if (type.value == 'A') {
						// console.log('if 1');

						if(link.value.indexOf('www.') > -1 || link.value.indexOf('http') > -1 || link.value.indexOf('https') > -1){
							// console.log('if 2');
							alert.innerHTML = '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><b class="m-r-sm">Erro</b>O link para o tipo Vídeo Aulas tenque ser apenas o código.</div>';
							// alert.insertAdjacentHTML ('beforeend','O link para o tipo Vídeo Aulas tenque ser apenas o código');
						} else
						save.removeAttribute('disabled');

					} else
					save.removeAttribute('disabled');
			}
		});

		} catch (error) {
			console.warn(error);
		}
	});
</script>
@endsection
