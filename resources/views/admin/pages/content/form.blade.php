
@section('css')
@parent
<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
@endsection

<div class="form-group">
	<label class="col-sm-2 control-label">Secione a página *</label>
	<div class="col-sm-4">
		<select id="content_page_id" name="content_page_id" class="form-control m-b" value="" required>
			<option value="Selecione a página"></option>
			@foreach($listSelectBox->contentPage as $item)
			<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
			@endforeach
		</select>
		<script>
			document.getElementById('content_page_id').value = '';
		</script>
	</div>
	<label class="col-sm-2 control-label">Selecione a seção *</label>
	<div class="col-sm-4">
		<select id="content_section_id" name="content_section_id" class="form-control m-b"  value="" required>
			<option value="">Selecione a seção</option>
			@foreach($listSelectBox->contentSection as $item)
			<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
			@endforeach
		</select>
		<script>
			document.getElementById('content_section_id').value = '';
		</script>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Título PT-BR *</label>
	<div class="col-sm-10">
		<input type="text" id="title_pt" name="title_pt" class="form-control" value="" required>
		<span class="help-block m-b-none">Digite o título em Português.</span>
	</div>
</div>

@if(!empty (Session::get('company')->multilanguage) )
<div class="form-group">
	<label class="col-sm-2 control-label">Título EN *</label>
	<div class="col-sm-10">
		<input type="text" id="title_en" name="title_en" class="form-control" value="" required>
		<span class="help-block m-b-none">Digite o título em Inglês.</span>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">Título ES</label>
	<div class="col-sm-10">
		<input type="text" id="title_es" name="title_es" class="form-control" value="">
		<span class="help-block m-b-none">Digite o título em Espanhol.</span>
	</div>
</div>
@endif

<div class="form-group">
	<label class="col-sm-2 control-label">Sub título PT-BR *</label>
	<div class="col-sm-10">
		<input type="text" id="subtitle_pt" name="subtitle_pt" class="form-control" value="">
		<span class="help-block m-b-none">Digite o Sub título em Português.</span>
	</div>
</div>

@if(!empty (Session::get('company')->multilanguage) )
<div class="form-group">
	<label class="col-sm-2 control-label">Sub título EN *</label>
	<div class="col-sm-10">
		<input type="text" id="subtitle_en" name="subtitle_en" class="form-control" value="">
		<span class="help-block m-b-none">Digite o Sub título em Inglês.</span>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">Sub título ES</label>
	<div class="col-sm-10">
		<input type="text" id="subtitle_es" name="subtitle_es" class="form-control" value="">
		<span class="help-block m-b-none">Digite o Sub título em Espanhol.</span>
	</div>
</div>
@endif

<div class="form-group">
	<div class="wrapper wrapper-content">

		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Digite o conteúdo em Português*</h5>
					</div>
					<div class="ibox-content no-padding">
						<textarea id="text_pt" name="text_pt" class="summernote"></textarea>
					</div>
				</div>
			</div>
		</div>
		@if(!empty (Session::get('company')->multilanguage) )
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Digite o conteúdo em Inglês*</h5>
					</div>
					<div class="ibox-content no-padding">
						<textarea id="text_en" name="text_en" class="summernote"></textarea>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Digite o conteúdo em Espanhol</h5>
					</div>
					<div class="ibox-content no-padding">
						<textarea id="text_es" name="text_es" class="summernote"></textarea>
					</div>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Icon</label>
	<div class="col-sm-10">
		<input type="text" id="icon" name="icon" class="form-control" value="">
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Link</label>
	<div class="col-sm-10">
		<input type="text" id="link" name="link" class="form-control" value="">
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Label do Link</label>
	<div class="col-sm-10">
		<input type="text" id="link_label" name="link_label" class="form-control" value="">
	</div>
</div>

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
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Imagem de fundo</label>
	<div class="col-sm-10">
		<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			<div class="form-control" data-trigger="fileinput">
				<i class="glyphicon glyphicon-file fileinput-exists"></i>
				<span class="fileinput-filename"></span>
			</div>
			<span class="input-group-addon btn btn-default btn-file">
				<span class="fileinput-new">Selecionar</span>
				<span class="fileinput-exists">Alterar</span>
				<input type="file" id="fileImageBG" name="fileImageBG" value="">
			</span>
			<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
		</div>
	</div>
</div>

<div class="col-sm-6 center">
	@if(isset($data) && isset($data['image']))
	<img height="200" src="{{ $data['image'] }}" />
	@endif
</div>
<div class="col-sm-6 center">
	@if(isset($data) && isset($data['image_bg']))
	<img height="200" src="{{ $data['image_bg'] }}" />
	@endif
</div>

@section('scripts')
@parent
<!-- SUMMERNOTE -->
{{-- <script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}" type="text/javascript"></script> --}}
<script>
	$(document).ready(function() {
		// $('.summernote').summernote();

		var contentSectionElem = $('#content_section_id');
		$('#content_page_id').on('change', function(event) {
			contentSectionElem.html('');

			if (event.target.value) {
				$.ajax({
					url: "/api/contentsection/contentpage/" + event.target.value,
					dataType: 'json',
					method: 'get',
				}).then(function(data) {
					contentSectionElem.append($('<option>', {
						value: '',
						text: ''
					}));

					for (i = 0, ii = data.length; i < ii; i++) {
						var item = data[i];
						contentSectionElem.append($('<option>', {
							value: item.id,
							text: item.description_pt
						}));
					}
				});

			}

		});
	});
</script>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		try {
			APP.scope.content = <?=isset($data) ? json_encode($data) : 'null'?>;

			if (APP.scope.content) {
				populate(document.forms.formContent, APP.scope.content);
			}
		} catch (error) {
			console.warn(error);
		}
	});
</script>
@endsection
