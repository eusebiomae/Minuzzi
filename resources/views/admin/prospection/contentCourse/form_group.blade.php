<div class="form-group">
	@if ($fieldPageConfig->show('course_category_id'))
	<div class="col-sm-4">
		<label class=" control-label">Categoria</label>
		<select name="course_category_id[]" class="select2_demo_1 form-control" required {!! $fieldPageConfig->attr('course_category_id') !!}></select>
	</div>
	@endif
	@if ($fieldPageConfig->show('title_pt'))
	<div class="col-sm-8">
		<label class=" control-label">Título</label>
		<input type="text" id="title_pt" name="title_pt" class="form-control" value="" required {!! $fieldPageConfig->attr('title_pt') !!}>
	</div>
	@endif
	@if ($fieldPageConfig->show('file'))
	<div class="col-sm-4">
		<label class=" control-label">Arquivo</label>
		<select name="" class="select2_demo_1 form-control" required {!! $fieldPageConfig->attr('file') !!}>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select>
	</div>
	@endif
	@if ($fieldPageConfig->show('subtitle_pt'))
	<div class="col-sm-8">
		<label class=" control-label">Subtítulo</label>
		<input type="text" id="subtitle_pt" name="subtitle_pt" class="form-control" value="" {!! $fieldPageConfig->attr('subtitle_pt') !!}>
	</div>
	@endif
</div>

@if ($fieldPageConfig->show('description_pt'))
<div class="form-group">
	<label>Descrição</label>
	<div class="ibox-content no-padding">
		<textarea id="description_pt" name="description_pt" class="summernote" {!! $fieldPageConfig->attr('description_pt') !!}></textarea>
	</div>
</div>
@endif

@if ($fieldPageConfig->show('image'))
<div class="form-group">
	<label class="col-sm-2 control-label">Imagem em destaque*</label>
	<div class="col-sm-10">
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
@endif
