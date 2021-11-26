@section('css')
@parent
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/switchery/switchery.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
	<link href="{!! asset('css/plugins/iCheck/custom.css') !!}" rel="stylesheet">


@endsection
<div class="form-group">
	<label class="col-sm-2 control-label">Página*</label>
	<div class="col-sm-10">
		<select id="content_page_id" name="content_page_id" class="form-control m-b" required>
			<option value="">Selecione a página</option>
			@foreach($listSelectBox->contentPage as $item)
			<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
			@endforeach
		</select>
	</div>
	{{-- <label class="col-sm-2 control-label">Status*</label>
	<div class="col-sm-4">
		<input type="checkbox" id="status" name="status" class="js-switch" value="1">
	</div> --}}
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">Título em Português*</label>
	<div class="col-sm-10">
		<input type="text" id="title_pt" name="title_pt" class="form-control" required>
		<span class="help-block m-b-none">Digite o Título.</span>
	</div>
</div>

{{-- @if(!empty (Session::get('company')->multilanguage) ) --}}
	<div class="form-group">
		<label class="col-sm-2 control-label">Título em Inglês*</label>
		<div class="col-sm-10">
			<input type="text" id="title_en" name="title_en" class="form-control" required>
			<span class="help-block m-b-none">Digite o Título.</span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Título em Espanhol</label>
		<div class="col-sm-10">
			<input type="text" id="title_es" name="title_es" class="form-control" />
			<span class="help-block m-b-none">Digite o Título.</span>
		</div>
	</div>
{{-- @endif --}}

<div class="form-group">
	<label class="col-sm-2 control-label">Pré-título em Português</label>
	<div class="col-sm-10">
		<input type="text" id="pretitle_pt" name="pretitle_pt" class="form-control" />
		<span class="help-block m-b-none">Digite o Pré-título.</span>
	</div>
</div>
{{-- @if(!empty (Session::get('company')->multilanguage) ) --}}
	<div class="form-group">
		<label class="col-sm-2 control-label">Pré-título em Inglês</label>
		<div class="col-sm-10">
			<input type="text" id="pretitle_en" name="pretitle_en" class="form-control" />
			<span class="help-block m-b-none">Digite o Pré-título.</span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Pré-título em Espanhol</label>
		<div class="col-sm-10">
			<input type="text" id="pretitle_es" name="pretitle_es" class="form-control" />
			<span class="help-block m-b-none">Digite o Pré-título.</span>
		</div>
	</div>
{{-- @endif --}}

<div class="form-group">
	<label class="col-sm-2 control-label">Subtítulo em Português</label>
	<div class="col-sm-10">
		<input type="text" id="subtitle_pt" name="subtitle_pt" class="form-control" />
		<span class="help-block m-b-none">Digite o Subtítulo.</span>
	</div>
</div>
{{-- @if(!empty (Session::get('company')->multilanguage) ) --}}
	<div class="form-group">
		<label class="col-sm-2 control-label">Subtítulo em Inglês</label>
		<div class="col-sm-10">
			<input type="text" id="subtitle_en" name="subtitle_en" class="form-control" />
			<span class="help-block m-b-none">Digite o Subtítulo.</span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Subtítulo em Espanhol</label>
		<div class="col-sm-10">
			<input type="text" id="subtitle_es" name="subtitle_es" class="form-control" />
			<span class="help-block m-b-none">Digite o Subtítulo.</span>
		</div>
	</div>
{{-- @endif --}}

<div class="form-group">
	<label class="col-sm-2 control-label">Link</label>
	<div class="col-sm-10">
		<input type="text" id="link" name="link" class="form-control" />
		<span class="help-block m-b-none">Digite o link.</span>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Label Link</label>
	<div class="col-sm-6">
		<input type="text" id="label_link" name="label_link" class="form-control" />
		<span class="help-block m-b-none">Digite a label do link.</span>
	</div>
</div>
<div class="form-group">
{{-- <div class="col-sm-10 col-sm-offset-2 i-checks"><label> <input type="radio" value="0" name="flg_type"> <i></i>Banner</label></div>
<div class="col-sm-10 col-sm-offset-2 i-checks"><label> <input type="radio" value="1" name="flg_type"> <i></i>Slide/Carrosel</label></div> --}}

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
						<input type="file" id="fileImage" name="fileImage" />
					</span>
				<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
		</div>
	</div>
	<img class="col-sm-offset-2" id="image" height="100px" >
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



@section('scripts')
@parent
	<script src="{!! asset ('js/plugins/iCheck/icheck.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}" type="text/javascript"></script>
	<!-- switch -->
	<script src="{!! asset('js/plugins/switchery/switchery.js') !!}" type="text/javascript"></script>
	<script>
	document.addEventListener('APP.payload', function() {
		$('.i-checks').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green',
		});

	})

	document.addEventListener('DOMContentLoaded', function() {
		try {
			APP.scope.slide = {!! isset($data) ? json_encode($data) : 'null' !!};

			if (APP.scope.slide) {
				populate(document.forms.formSlide, APP.scope.slide);
			}

			$('.summernote').summernote();

			var elem = document.querySelector('.js-switch');
			var switchery = new Switchery(elem, { color: '#1AB394' });
		} catch (error) {
			console.warn(error);
		}

		try {
			APP.payload && (document.getElementById('image').src = APP.payload.data.image)

			if (document.forms.form) {
				document.forms.form.fileImage.addEventListener('change', function(event) {
					document.getElementById('image').src = URL.createObjectURL(event.target.files[0])
				})
			}
		} catch (error) {
			console.warn(error);
		}
	});
</script>
@endsection
