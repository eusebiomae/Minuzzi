@extends('layouts.app')

@section('title', 'Slide')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/basic.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/dropzone.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/switchery/switchery.css') !!}" />
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Inserir Slide</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/admin') }}">Home</a>
			</li>
			<li>
				<a href="{{ url('/admin/slide') }}">Slide</a>
			</li>
			<li class="active">
				<strong>Inserir Slide</strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2">

	</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Slide <small>Cadastro de Slide.</small></h5>
			</div>

			<div class="ibox-content">
				<form name="formSlide" method="post" action="{{ $urlAction }}" enctype="multipart/form-data" class="form-horizontal">
					<input type="hidden" id="id" name="id">
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
						@if ($fieldPageConfig->show('pretitle_pt'))
						<div class="col-sm-10">
							<input type="text" id="pretitle_pt" name="pretitle_pt" class="form-control" {!! $fieldPageConfig->attr('pretitle_pt') !!} />
							<span class="help-block m-b-none">Digite o Pré-título.</span>
						</div>
						@endif

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
						@if ($fieldPageConfig->show('subtitle_pt'))
						<div class="col-sm-10">
							<input type="text" id="subtitle_pt" name="subtitle_pt" class="form-control" {!! $fieldPageConfig->attr('subtitle_pt') !!} />
							<span class="help-block m-b-none">Digite o Subtítulo.</span>
						</div>
						@endif
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
						@if ($fieldPageConfig->show('link'))
						<div class="col-sm-10">
							<input type="text" id="link" name="link" class="form-control" {!! $fieldPageConfig->attr('link') !!} />
							<span class="help-block m-b-none">Digite o link.</span>
						</div>
						@endif
					</div>

					<div class="form-group">

						<label class="col-sm-2 control-label">Label Link</label>
						@if ($fieldPageConfig->show('label_link'))
						<div class="col-sm-10">
							<input type="text" id="label_link" name="label_link" class="form-control" {!! $fieldPageConfig->attr('label_link') !!} />
							<span class="help-block m-b-none">Digite a label do link.</span>
						</div>
						@endif

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
						<img height="200" src="{{ Storage::url("slides/{$data['image']}") }}" />
						@endif
					</div>

					<div class="form-group">
						<div class="col-sm-12 text-right">
							<button class="btn btn-white" type="submit">Cancelar</button>
							<button class="btn btn-primary" type="submit">Salvar alterações</button>
						</div>
					</div>
					{{ csrf_field() }}
				</form>
			</div>
		</div>
	</div>
</div>
@endsection


@section('scripts')
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

<!-- switch -->
<script src="{!! asset('js/plugins/switchery/switchery.js') !!}" type="text/javascript"></script>


<script>
	document.addEventListener('DOMContentLoaded', function() {
		try {
			APP.scope.slide = <?=isset($data) ? json_encode($data) : 'null'?>;

			if (APP.scope.slide) {
				populate(document.forms.formSlide, APP.scope.slide);
			}

			$('.summernote').summernote();

			// var elem = document.querySelector('.js-switch');
			// var switchery = new Switchery(elem, { color: '#1AB394' });
		} catch (error) {
			console.warn(error);
		}
	});
</script>
@endsection
