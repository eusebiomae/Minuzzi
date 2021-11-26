@section('css')
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/basic.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/dropzone.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/switchery/switchery.css') !!}" />
@endsection

<div class="form-group">
	<label class="col-sm-2 control-label">Página*</label>
	<div class="col-sm-4">
		<select id="content_page_id" name="content_page_id" class="form-control m-b" required>
			<option value="">Selecione a página</option>
			@foreach($listSelectBox->contentPage as $item)
			<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
			@endforeach
		</select>
	</div>
	<label class="col-sm-2 control-label">Status*</label>
	<div class="col-sm-4">
		<input type="checkbox" id="status" name="status" class="js-switch" checked value="1"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">Nome*</label>
	<div class="col-sm-10">
		<input type="text" id="name" name="name" class="form-control" required />
		<span class="help-block m-b-none">Digite o Nome.</span>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">Profissão</label>
	<div class="col-sm-10">
		<input type="text" id="office" name="office" class="form-control" />
		<span class="help-block m-b-none">Digite a Profissão.</span>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Resumo em Português*</label>
	<div class="col-sm-10">
		<input type="text" id="abstract_pt" name="abstract_pt" class="form-control" required />
		<span class="help-block m-b-none">Digite o Resumo.</span>
	</div>
</div>

<div class="form-group">
	<div class="wrapper wrapper-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Digite o Depoimento em Português*</h5>
					</div>
					<div class="ibox-content no-padding">
						<textarea id="text_pt" name="text_pt" class="summernote">
						</textarea>
					</div>
				</div>
			</div>
		</div>

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
				<input type="file" id="fileImage" name="fileImage" />
			</span>
			<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
		</div>
	</div>
</div>
<div class="row center">
	@if(isset($data) && isset($data['image']))
	<img height="200" src="{{ Storage::url("testemonial/{$data['image']}") }}" />
	@endif
</div>

@section('scripts')
@parent
<!-- Mainly scripts -->
<script src="{!! asset('js/plugins/metisMenu/jquery.metisMenu.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}" type="text/javascript"></script>

<!-- Custom and plugin javascript -->
<script src="{!! asset('js/inspinia.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/pace/pace.min.js') !!}" type="text/javascript"></script>

<!-- SUMMERNOTE -->
<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/jasny/jasny-bootstrap.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/dropzone/dropzone.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/switchery/switchery.js') !!}"></script>


<script>
	$(document).ready(function() {
		$('.summernote').summernote();

		var elem = document.querySelector('.js-switch');
		var switchery = new Switchery(elem, { color: '#1AB394' });
	});
</script>

@endsection
