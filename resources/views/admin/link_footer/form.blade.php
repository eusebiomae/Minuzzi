@extends('layouts.app')

@section('title', 'Dados Institucional ')

@section('css')
	<link rel="stylesheet" href="{!! asset('css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/select2/select2.min.css') !!}" />

	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/basic.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/dropzone.css') !!}" />
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Inserir Novo Link Footer</h2>
    <ol class="breadcrumb">
			<li>
				<a href="{{ url('/admin') }}">Home</a>
			</li>
			<li>
        <a href="{{ url('/admin/link_footer') }}">Listar</a>
      </li>
			<li class="active">
				<strong>Inserir Novo Link Footer</strong>
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
	      <h5>Link Footer <small>Cadastro e edição de Link Footer.</small></h5>
	    </div>
	    <div class="ibox-content">
			<form name="formWork" method="post" action="{{ $urlAction }}" enctype="multipart/form-data"  class="form-horizontal">
				<input type="hidden" id="id" name="id" />
				@if ($fieldPageConfig->show('label'))
				<div class="form-group">
					<label class="col-sm-2 control-label">Label*</label>
					<div class="col-sm-10">
						<input type="text" name="label" class="form-control" {!! $fieldPageConfig->attr('label') !!}/>
					</div>
				</div>
				@endif
				@if ($fieldPageConfig->show('url'))
				<div class="form-group">
					<label class="col-sm-2 control-label">Link*</label>
					<div class="col-sm-10">
						<input type="text" name="url" class="form-control" {!! $fieldPageConfig->attr('url') !!}/>
					</div>
				</div>
				@endif
				<div class="form-group">
					<div class="col-sm-12 text-right">
						<button class="btn btn-white" type="reset">Cancelar</button>
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
@parent
	<!-- Custom and plugin javascript -->
	<script src="{!! asset('js/plugins/pace/pace.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/metisMenu/jquery.metisMenu.js') !!}" type="text/javascript"></script>

	<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/jasny/jasny-bootstrap.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/select2/select2.full.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') !!}" type="text/javascript"></script>

	<script src="{!! asset('js/plugins/dropzone/dropzone.js') !!}" type="text/javascript"></script>

	<script>
		Dropzone.options.dropzoneForm = {
			paramName: "file", // The name that will be used to transfer the file
			maxFilesize: 2, // MB
			dictDefaultMessage: "<strong>Drop files here or click to upload. </strong></br> (This is just a demo dropzone. Selected files are not actually uploaded.)"
		};

		$(document).ready(function(){

			$('.summernote').summernote();

			$('.tagsinput').tagsinput({
				tagClass: 'label label-primary'
			});

			$(".select2_demo_1").select2();
			$(".select2_demo_2").select2();
			$(".select2_demo_3").select2({
				placeholder: "Select a state",
				allowClear: true
			});

		});
  </script>

<script>
document.addEventListener('DOMContentLoaded', function() {
	try {
		APP.scope.work = <?=isset($data) ? json_encode($data) : 'null'?>;

		if (APP.scope.work) {
			populate(document.forms.formWork, APP.scope.work);
		}
	} catch (error) {
		console.warn(error);
	}
});
</script>
@endsection
