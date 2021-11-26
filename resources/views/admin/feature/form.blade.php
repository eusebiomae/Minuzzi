@extends('layouts.app')

@section('title', 'Feature')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/basic.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/dropzone.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/switchery/switchery.css') !!}" />
<link rel="stylesheet" href="{!! asset('cetcc/css/icon_fonts/css/all_icons.min.css') !!}" >

@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Inserir Feature</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/admin') }}">Home</a>
			</li>
			<li>
				<a href="{{ url('/admin/feature') }}">Feature</a>
			</li>
			<li class="active">
				<strong>Inserir Feature</strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2">

	</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>Feature <small>Cadastro de Feature.</small></h5>
		</div>

		<div class="ibox-content">
			<div class="row">
				<form name="formFeature" method="post" action="{{ $urlAction }}" enctype="multipart/form-data" class="form-horizontal">
					<input type="hidden" id="id" name="id">
					@if ($fieldPageConfig->show('content_page_id'))
					<div class="col-sm-3">
						<label class="control-label">Página*</label>
						<select id="content_page_id" name="content_page_id" class="form-control m-b" {!! $fieldPageConfig->attr('content_page_id') !!}>
							<option value="">Selecione a página</option>
							@foreach($listSelectBox->contentPage as $item)
							<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
							@endforeach
						</select>
					</div>
					@endif
					@if ($fieldPageConfig->show('title'))
					<div class="col-sm-9">
						<label class="control-label">Título*</label>
						<input type="text" id="title" name="title" class="form-control" {!! $fieldPageConfig->attr('title') !!}>
						<span class="help-block m-b-none">Digite o Título.</span>
					</div>
					@endif

					@if ($fieldPageConfig->show('icon'))
					<div class="col-sm-3">
						<label class="control-label">Icon*</label>
							<input type="text" id="icon" name="icon" class="form-control" {!! $fieldPageConfig->attr('icon') !!}>
					</div>
					@endif

					@if ($fieldPageConfig->show('description'))
					<div class="col-sm-9">
						<label class=" control-label">Descrição</label>
						<input type="text" id="description" name="description" class="form-control" style="margin-bottom:10px;" {!! $fieldPageConfig->attr('description') !!}>
					</div>
					@endif

					<div class="col-sm-12 text-right">
						<button class="btn btn-white" type="submit">Cancelar</button>
						<button class="btn btn-primary" type="submit">Salvar alterações</button>
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
			APP.scope.feature = <?=isset($data) ? json_encode($data) : 'null'?>;

			if (APP.scope.feature) {
				populate(document.forms.formFeature, APP.scope.feature);
			}

			$('.summernote').summernote();

			var elem = document.querySelector('.js-switch');
			var switchery = new Switchery(elem, { color: '#1AB394' });
		} catch (error) {
			console.warn(error);
		}
	});
</script>
@endsection
