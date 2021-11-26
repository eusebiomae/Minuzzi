{{ csrf_field() }}
<input name="id" type="hidden" value="">
<div class="form-group">
	<div class="col-lg-12">
		<div class="form-group">
			<div class="col-sm-12">
				<label class=" control-label">Título</label>
				<input type="text" id="title_pt" name="title_pt" class="form-control" value=""  required>
			</div>
			{{-- <div class="col-sm-12">
				<label class=" control-label">Título EN</label>
				<input type="text" id="title_en" name="title_en" class="form-control" value="" >
			</div>
			<div class="col-sm-12">
				<label class=" control-label">Título ES</label>
				<input type="text" id="title_es" name="title_es" class="form-control" value="" >
			</div> --}}
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<label class=" control-label">Subtítulo</label>
				<input type="text" id="subtitle_pt" name="subtitle_pt" class="form-control" value="" >
			</div>
			{{-- <div class="col-sm-12">
				<label class=" control-label">Subtítulo EN</label>
				<input type="text" id="subtitle_en" name="subtitle_en" class="form-control" value="" >
			</div>
			<div class="col-sm-12">
				<label class=" control-label">Subtítulo ES</label>
				<input type="text" id="subtitle_es" name="subtitle_es" class="form-control" value="" >
			</div>	 --}}
		</div>

		<div class="form-group">
			<div class="col-sm-12">
				<label>Descrição</label>
				<div class="ibox-content no-padding">
					<textarea id="description_pt" name="description_pt" class="summernote"></textarea>
				</div>
			</div>
		</div>

		{{-- <div class="form-group">
			<label>Descrição EN</label>
			<div class="ibox-content no-padding">
				<textarea id="description_en" name="description_en" class="summernote"></textarea>
			</div>
		</div>

		<div class="form-group">
			<label>Descrição ES</label>
			<div class="ibox-content no-padding">
				<textarea id="description_es" name="description_es" class="summernote"></textarea>
			</div>
		</div> --}}

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
	</div>
</div>
