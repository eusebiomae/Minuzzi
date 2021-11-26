@section('css')
@parent
{{-- Estilo Arquivo  --}}
<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
@endsection
<div class="form-group">
	<div class="col-sm-4">
		<label class=" control-label">Categoria*</label>
		<select name="course_category_id" class="select2_demo_1 form-control" required></select>
	</div>
	<div class="col-sm-8">
		<label class=" control-label">Título*</label>
		<input type="text" id="title_pt" name="title_pt" class="form-control" value="" required>
	</div>
	<div class="col-sm-4">
		<label class=" control-label">Arquivo*</label>
		<select name="" class="select2_demo_1 form-control" required>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select>
	</div>
	<div class="col-sm-8">
		<label class=" control-label">Subtítulo</label>
		<input type="text" id="subtitle_pt" name="subtitle_pt" class="form-control" value="">
	</div>
</div>

<div class="form-group">
	<label>Descrição</label>
	<div class="ibox-content no-padding">
		<textarea id="description_pt" name="description_pt" class="summernote"></textarea>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Imagem em destaque</label>
	<div class="col-sm-10">
		<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			<div class="form-control" data-trigger="fileinput">
				<i class="glyphicon glyphicon-file fileinput-exists"></i>
				<span class="fileinput-filename" id="fileImageModulo"></span>
			</div>
			<span class="input-group-addon btn btn-default btn-file">
				<span class="fileinput-new">Selecionar</span>
				<span class="fileinput-exists">Alterar</span>
				<input type="file" id="fileImage" name="fileImage" value="">
			</span>
			<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
		</div>
			<div class="img">
			<img id="imgModulo" width="200px">
		</div>
	</div>
</div>

@section('scripts')
@parent
<script>
document.addEventListener('DOMContentLoaded', function() {
	try {
		if (APP.listSelectBox) {
			if (APP.listSelectBox.courseCategory && document.forms.form.course_category_id) {
				populateSelectBox({
					list: APP.listSelectBox.courseCategory,
					target: document.forms.form.course_category_id,
					columnValue: "id",
					columnLabel: "description_pt",
					selectBy: (APP.payload && APP.payload.data && APP.payload.data.course_category_id) ? [APP.payload.data.course_category_id] : null,
					emptyOption: {
						label: "Selecione..."
					}
				})
			}
		}

		if (document.forms.form) {
			document.forms.form.fileImage.addEventListener('change', function(event) {
				console.log(event.target.files[0]);
				document.getElementById('imgModulo').src = URL.createObjectURL(event.target.files[0])
				document.getElementById('imgModulo').alt = 'img_' +  event.target.files[0]
				document.getElementById('fileImageModulo').innerText = event.target.files[0].name
			})
		}


		if(APP.payload){
			if (APP.payload.data.img){
					document.getElementById('imgModulo').src = APP.payload.data.img
					document.getElementById('imgModulo').alt = 'img_' + APP.payload.data.img
				}
			}
		} catch (error) {
			console.warn(error)
		}
	})
</script>
@endsection


