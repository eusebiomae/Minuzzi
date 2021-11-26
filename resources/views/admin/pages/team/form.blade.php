@section('css')
@parent
{{-- Estilo Arquivo  --}}
<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
@endsection

<div class="form-group">
	<label class="col-sm-2 control-label">Nome*</label>
	<div class="col-sm-6">
		<input type="text" id="name" name="name" class="form-control"  required />
		<span class="help-block m-b-none">Digite o nome do Funcionário.</span>
	</div>
	<label class="col-sm-1 control-label">CRP</label>
	<div class="col-sm-3">
		<input type="text" id="crp" name="crp" class="form-control" maxlength="16"/>
		<span class="help-block m-b-none">Digite o Código de Conselho Regional de Psicologia</span>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">Função*</label>
	<div class="col-sm-4">
		<select id="function_id" name="function_id" class="form-control m-b" required >
		</select>
	</div>
	<label class="col-sm-2 control-label">Graduação*</label>
	<div class="col-sm-4">
		<select id="graduation_id" name="graduation_id" class="form-control m-b" required >
		</select>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">Cargo</label>
	<div class="col-sm-4">
		<select id="office_id" name="office_id" class="form-control m-b" required >
		</select>
	</div>
</div>

<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Digite a descrição em Português*</h5>
				</div>
				<div class="ibox-content no-padding">
					<textarea name="description_pt" class="summernote"></textarea>
				</div>
			</div>
		</div>
	</div>
	{{-- <div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Digite a descrição em Inglês*</h5>
				</div>
				<div class="ibox-content no-padding">
					<textarea id="description_en" name="description_en" class="summernote" required></textarea>
				</div>
			</div>
		</div>
	</div> --}}
	{{-- <div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Digite a descrição em Espanhol</h5>
				</div>
				<div class="ibox-content no-padding">
					<textarea id="description_es" name="description_es" class="summernote"></textarea>
				</div>
			</div>
		</div>
	</div> --}}
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">Imagem em destaque*</label>
	<div class="col-sm-10">
		<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			<div class="form-control" data-trigger="fileinput">
				<i class="glyphicon glyphicon-file fileinput-exists"></i>
				<span class="fileinput-filename" id="fileinput-filename-team"></span>
			</div>
			<span class="input-group-addon btn btn-default btn-file">
				<span class="fileinput-new">Selecionar</span>
				<span class="fileinput-exists">Alterar</span>
				<input type="file" id="fileImageTeam" name="fileImage" />
			</span>
			<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
		</div>
		<div class="img">
			<img id="imgTeam" width="200px">
		</div>
	</div>
</div>

@section('scripts')
@parent
<script src="{!! asset('js/plugins/sweetalert/sweetalert.min.js') !!}"></script>

<script>
	$(document).ready(function() {
		try {
			if (document.forms.form) {
				document.forms.form.fileImage.addEventListener('change', function(event) {
					document.getElementById('imgTeam').src = URL.createObjectURL(event.target.files[0])
					document.getElementById('imgTeam').alt = 'img_' +  event.target.files[0]
					document.getElementById('fileinput-filename-team').innerText = event.target.files[0].name
				});
			}

			if (APP.payload && APP.payload.data) {
				if (APP.payload.data.image){
					document.getElementById('imgTeam').src = APP.payload.data.image
					document.getElementById('imgTeam').alt = 'img_' + APP.payload.data.image
				}
			}

			if (APP.listSelectBox) {
				if (APP.listSelectBox.function && document.forms.form) {
					populateSelectBox({
						list: APP.listSelectBox.function,
						target: document.forms.form['function_id'],
						columnValue: "id",
						columnLabel: "description_pt",
						selectBy: (APP.payload && APP.payload.data && APP.payload.data.function) ? [APP.payload.data.function] : null,
					});
				}
				if (APP.listSelectBox.graduation && document.forms.form) {
					populateSelectBox({
						list: APP.listSelectBox.graduation,
						target: document.forms.form['graduation_id'],
						columnValue: "id",
						columnLabel: "description_pt",
						selectBy: (APP.payload && APP.payload.data && APP.payload.data.graduation) ? [APP.payload.data.graduation] : null,
					});
				}
				if (APP.listSelectBox.office && document.forms.form) {
					populateSelectBox({
						list: APP.listSelectBox.office,
						target: document.forms.form['office_id'],
						columnValue: "id",
						columnLabel: "description_pt",
						selectBy: (APP.payload && APP.payload.data && APP.payload.data.office) ? [APP.payload.data.office] : null,
					});
				}

			}

		} catch(error) {
			console.warn(error);
		}
	});
</script>
@endsection
