{{ csrf_field() }}
<input name="id" type="hidden" value="">
<div class="form-group">
	<div class="col-lg-12">
		{{--
		@if ($fieldPageConfig->show('course_id'))
			<div class="form-group">
				<div class="col-sm-4">
					<label class=" control-label">Curso</label>
					<select id="course_id" name="course_id"  class="select2_demo_1 form-control" value="" required {!! $fieldPageConfig->attr('course_id') !!}></select>
				</div>
			</div>
		@endif
		--}}
		{{--
		<div class="form-group">
			@if ($fieldPageConfig->show('name_pt'))
				<div class="col-sm-4">
					<label class=" control-label">Nome</label>
					<input type="text" id="name_pt" name="name_pt" class="form-control" value="" required {!! $fieldPageConfig->attr('name_pt') !!}>
				</div>
			@endif
			@if ($fieldPageConfig->show('name_en'))
				<div class="col-sm-4">
					<label class=" control-label">Nome EN</label>
					<input type="text" id="name_en" name="name_en" class="form-control" value="" {!! $fieldPageConfig->attr('name_en') !!}>
				</div>
			@endif
			@if ($fieldPageConfig->show('name_es'))
				<div class="col-sm-4">
					<label class=" control-label">Nome ES</label>
					<input type="text" id="name_es" name="name_es" class="form-control" value="" {!! $fieldPageConfig->attr('name_es') !!}>
				</div>
			@endif
		</div>
		--}}
		<div class="form-group">
			@if ($fieldPageConfig->show('title_pt'))
			<div class="col-sm-12">
				<label class=" control-label">Título</label>
				<input type="text" id="title_pt" name="title_pt" class="form-control" value=""  required {!! $fieldPageConfig->attr('title_pt') !!}>
			</div>
			@endif
			{{--
			@if ($fieldPageConfig->show('title_en'))
				<div class="col-sm-12">
					<label class=" control-label">Título EN</label>
					<input type="text" id="title_en" name="title_en" class="form-control" value="" {!! $fieldPageConfig->attr('title_en') !!}>
				</div>
			@endif
			@if ($fieldPageConfig->show('title_es'))
				<div class="col-sm-12">
					<label class=" control-label">Título ES</label>
					<input type="text" id="title_es" name="title_es" class="form-control" value="" {!! $fieldPageConfig->attr('title_es') !!}>
				</div>
			@endif
			--}}
		</div>
		<div class="form-group">
			@if ($fieldPageConfig->show('subtitle_pt'))
			<div class="col-sm-12">
				<label class=" control-label">Subtítulo</label>
				<input type="text" id="subtitle_pt" name="subtitle_pt" class="form-control" value="" {!! $fieldPageConfig->attr('subtitle_pt') !!}>
			</div>
			@endif
			{{--
			@if ($fieldPageConfig->show('subtitle_en'))
				<div class="col-sm-12">
					<label class=" control-label">Subtítulo EN</label>
					<input type="text" id="subtitle_en" name="subtitle_en" class="form-control" value="" {!! $fieldPageConfig->attr('subtitle_en') !!}>
				</div>
			@endif
			@if ($fieldPageConfig->show('subtitle_es'))
				<div class="col-sm-12">
					<label class=" control-label">Subtítulo ES</label>
					<input type="text" id="subtitle_es" name="subtitle_es" class="form-control" value="" {!! $fieldPageConfig->attr('subtitle_es') !!}>
				</div>
			@endif
			--}}
		</div>

		@if ($fieldPageConfig->show('description_pt'))
		<div class="form-group">
			<label>Descrição</label>
			<div class="ibox-content no-padding">
				<textarea id="description_pt" name="description_pt" class="summernote" {!! $fieldPageConfig->attr('description_pt') !!}></textarea>
			</div>
		</div>
		@endif

		{{--
		@if ($fieldPageConfig->show('title'))
			<div class="form-group">
				<label>Descrição EN</label>
				<div class="ibox-content no-padding">
					<textarea id="description_en" name="description_en" class="summernote" {!! $fieldPageConfig->attr('title') !!}></textarea>
				</div>
			</div>
		@endif

		@if ($fieldPageConfig->show('title'))
			<div class="form-group">
				<label>Descrição ES</label>
				<div class="ibox-content no-padding">
					<textarea id="description_es" name="description_es" class="summernote" {!! $fieldPageConfig->attr('title') !!}></textarea>
				</div>
			</div>
		@endif
		--}}

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
	</div>
</div>
