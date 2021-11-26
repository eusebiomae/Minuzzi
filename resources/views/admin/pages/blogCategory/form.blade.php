@section('css')
@parent
{{-- Estilo Arquivo  --}}
<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/chosen/bootstrap-chosen.css') !!}" />

@endsection

<div class="form-group">
	<div class="col-sm-3">
		<label class="control-label">Tipo*</label>
		<select name="flg_type" class="form-control m-b" required>
			<option value="blog">Blog</option>
			<option value="article">Artigo</option>
		</select>
	</div>

	<div class="col-sm-3">
		<label class="control-label">Categoria de Curso (Correspondente)</label>
		<select name="correspondingCourseCategory[]" data-placeholder="Selecione o Curso" class="chosen-select m-b" multiple style="width:350px;" tabindex="4"></select>
	</div>

	<div class="col-sm-6">
		<label class="control-label">Categoria</label>
		<input type="text" id="description_pt" name="description_pt" class="form-control">
		<span class="help-block m-b-none">Digite a Categoria.</span>
	</div>
</div>

@section('scripts')
@parent
<script src="{!! asset('js/plugins/chosen/chosen.jquery.js') !!}" type="text/javascript"></script>

<script>

$(document).ready(function() {
		try {
			if (APP.listSelectBox) {
				if (APP.listSelectBox.courseCategory) {
					populateSelectBox({
						list: APP.listSelectBox.courseCategory,
						target: document.forms.form['correspondingCourseCategory[]'],
						columnValue: "id",
						columnLabel: "description_pt",
						selectBy: (APP.payload && APP.payload.data && APP.payload.data.corresponding_course_category) ? APP.payload.data.corresponding_course_category.map(function(item) { return item.course_category_id }) : null,
					});
				}

			}
			$('.chosen-select').chosen({width: "100%"});

		} catch(error) {
			console.warn(error);
		}
})
</script>
@endsection
