@extends('layouts.app')

@section('title', 'Equipe')

@section('css')
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/basic.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/dropzone.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/sweetalert/sweetalert.css') !!}"/>
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Inserir Certificação</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li>
        <a href="{{ url('/admin/certification') }}">Site</a>
      </li>
      <li class="active">
        <strong>Inserir Certificação</strong>
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
	      <h5> Certificação <small> Cadastro de Certificados </small></h5>
	    </div>
	    <div class="ibox-content">
				<form name="form" method="post" action="{{ $urlAction }}" enctype="multipart/form-data" class="form-horizontal">
					@include('admin.certification.form_group')

					<div class="form-group">
						<div class="col-sm-12 text-right">
							<button class="btn btn-white gp-alert" data-gp-alert="cancel" type="reset">Cancelar</button>
							<button class="btn btn-primary gp-alert" data-gp-alert="save" type="submit">Salvar alterações</button>
						</div>
					</div>
				</form>
	    </div>
	  </div>
	</div>
</div>
@endsection

@section('scripts')
@parent
<script src="{!! asset('js/plugins/dropzone/dropzone.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}" type="text/javascript"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
	try {
		Dropzone.options.dropzoneForm = {
			paramName: "file", // The name that will be used to transfer the file
			maxFilesize: 2, // MB
			dictDefaultMessage: "<strong>Drop files here or click to upload. </strong></br> (This is just a demo dropzone. Selected files are not actually uploaded.)"
		};

		$(document).ready(function() {
			$('.summernote').summernote();
		});

		APP.scope.certification = <?=isset($data) ? json_encode($data) : 'null'?>;

		if (APP.scope.certification) {
			populate(document.forms.formcertification, APP.scope.certification);
		}
	} catch (error) {
		console.warn(error);
	}
});
</script>
@endsection
