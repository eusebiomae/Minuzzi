@section('css')
@parent
{{-- Estilo Arquivo  --}}
<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />

@endsection
<div class="form-group">
	<div class="col-lg-12">
		<div class="form-group">
			<div class="col-sm-12">
				<label class=" control-label">Título</label>
				<input type="text" name="title_pt" class="form-control" value=""  required>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<label class=" control-label">Subtítulo</label>
				<input type="text" name="subtitle_pt" class="form-control" value="" >
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-12">
				<label>Descrição</label>
				<div class="ibox-content no-padding">
					<textarea  name="description_pt" class="summernote"></textarea>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label">Imagem em destaque*</label>
			<div class="col-sm-10">
				<div class="fileinput fileinput-new input-group" data-provides="fileinput">
					<div class="form-control" data-trigger="fileinput">
						<i class="glyphicon glyphicon-file fileinput-exists"></i>
						<span class="fileinput-filename" id="fileinput-filename-bonus"></span>
					</div>
					<span class="input-group-addon btn btn-default btn-file">
						<span class="fileinput-new">Selecionar</span>
						<span class="fileinput-exists">Alterar</span>
						<input type="file" id="fileImageBonus" name="fileImage" value="">
					</span>
					<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
				</div>
				<div class="img">
					<img id="imgBonus" width="200px">
				</div>
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
					document.getElementById('imgBonus').src = URL.createObjectURL(event.target.files[0])
					document.getElementById('imgBonus').alt = 'img_' +  event.target.files[0]
					document.getElementById('fileinput-filename-bonus').innerText = event.target.files[0].name
				})
			}

			if (APP.payload) {
				if (APP.payload.data.img){
					document.getElementById('imgBonus').src = APP.payload.data.img
					document.getElementById('imgBonus').alt = 'img_' + APP.payload.data.img
				}
			}

		} catch(error) {
			console.warn(error);
		}
	});

</script>
@endsection

