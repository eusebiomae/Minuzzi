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
	<label class="col-sm-2 control-label">Título</label>
	<div class="col-sm-10">
		<input type="text" id="title" name="title" class="form-control" required>
		<span class="help-block m-b-none">Digite o Título.</span>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Descrição</label>
	<div class="col-sm-10">
		<input type="text" id="description" name="description" class="form-control" />
		<span class="help-block m-b-none">Digite a descrição.</span>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Imagem em destaque*</label>
	<div class="col-sm-10">
		<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			<div class="form-control" data-trigger="fileinput">
				<i class="glyphicon glyphicon-file fileinput-exists"></i>
				<span class="fileinput-filename-img" id="fileinput-filename-img"></span>
			</div>
			<span class="input-group-addon btn btn-default btn-file">
				<span class="fileinput-new">Selecionar</span>
				<span class="fileinput-exists">Alterar</span>
				<input type="file" id="imageMain" name="imageMain" value="">
			</span>
			<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
		</div>
		<div class="img">
			<img id="imgCourse" width="200px">
		</div>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Carousel Imagem 2*</label>
	<div class="col-sm-10">
		<div class="fileinput fileinput-new input-group" data-provides="fileinput">
				<div class="form-control" data-trigger="fileinput">
					<i class="glyphicon glyphicon-file fileinput-exists"></i>
					<span class="fileinput-filename"></span>
				</div>
				<span class="input-group-addon btn btn-default btn-file">
					<span class="fileinput-new">Selecionar</span>
					<span class="fileinput-exists">Alterar</span>
						<input type="file" id="imageAdditional1" name="imageAdditional1" />
					</span>
				<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
		</div>
	</div>
	<img class="col-sm-offset-2" id="image" height="100px" >
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Carousel Imagem 3</label>
	<div class="col-sm-10">
		<div class="fileinput fileinput-new input-group" data-provides="fileinput">
				<div class="form-control" data-trigger="fileinput">
					<i class="glyphicon glyphicon-file fileinput-exists"></i>
					<span class="fileinput-filename"></span>
				</div>
				<span class="input-group-addon btn btn-default btn-file">
					<span class="fileinput-new">Selecionar</span>
					<span class="fileinput-exists">Alterar</span>
						<input type="file" id="imageAdditional2" name="imageAdditional2" />
					</span>
				<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
		</div>
	</div>
	<img class="col-sm-offset-2" id="image" height="100px" >
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Carousel Imagem 4</label>
	<div class="col-sm-10">
		<div class="fileinput fileinput-new input-group" data-provides="fileinput">
				<div class="form-control" data-trigger="fileinput">
					<i class="glyphicon glyphicon-file fileinput-exists"></i>
					<span class="fileinput-filename"></span>
				</div>
				<span class="input-group-addon btn btn-default btn-file">
					<span class="fileinput-new">Selecionar</span>
					<span class="fileinput-exists">Alterar</span>
						<input type="file" id="imageAdditional3" name="imageAdditional3" />
					</span>
				<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
		</div>
	</div>
	<img class="col-sm-offset-2" id="image" height="100px" >
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Carousel Imagem 5</label>
	<div class="col-sm-10">
		<div class="fileinput fileinput-new input-group" data-provides="fileinput">
				<div class="form-control" data-trigger="fileinput">
					<i class="glyphicon glyphicon-file fileinput-exists"></i>
					<span class="fileinput-filename"></span>
				</div>
				<span class="input-group-addon btn btn-default btn-file">
					<span class="fileinput-new">Selecionar</span>
					<span class="fileinput-exists">Alterar</span>
						<input type="file" id="imageAdditional" name="imageAdditional4" />
					</span>
				<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
		</div>
	</div>
	<img class="col-sm-offset-2" id="image" height="100px" >
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Carousel Imagem 6</label>
	<div class="col-sm-10">
		<div class="fileinput fileinput-new input-group" data-provides="fileinput">
				<div class="form-control" data-trigger="fileinput">
					<i class="glyphicon glyphicon-file fileinput-exists"></i>
					<span class="fileinput-filename"></span>
				</div>
				<span class="input-group-addon btn btn-default btn-file">
					<span class="fileinput-new">Selecionar</span>
					<span class="fileinput-exists">Alterar</span>
						<input type="file" id="imageAdditional5" name="imageAdditional5" />
					</span>
				<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
		</div>
	</div>
	<img class="col-sm-offset-2" id="image" height="100px" >
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
			APP.scope.carousel = {!! isset($data) ? json_encode($data) : 'null' !!};

			if (APP.scope.carousel) {
				populate(document.forms.formCarousel, APP.scope.carousel);
			}

			$('.summernote').summernote();

			var elem = document.querySelector('.js-switch');
			var switchery = new Switchery(elem, { color: '#1AB394' });
		} catch (error) {
			console.warn(error);
		}

		try {
			APP.payload && (document.getElementById('image_main').src = APP.payload.data.image_main)

			if (document.forms.form) {
				document.forms.form.imageMain.addEventListener('change', function(event) {
					document.getElementById('image_main').src = URL.createObjectURL(event.target.files[0])
				document.getElementById('image_main').alt = 'img_' +  event.target.files[0]
				document.getElementById('fileinput-filename-img').innerText = event.target.files[0].name
				})
			}
		} catch (error) {
			console.warn(error);
		}
	});
</script>
@endsection
