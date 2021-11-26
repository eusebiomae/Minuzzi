@extends('layouts.app')

@section('title', 'Depoimento')

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
    <h2>Inserir Depoimento</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li>
        <a href="{{ url('/admin/testemonial') }}">Depoimentos</a>
      </li>
      <li class="active">
        <strong>Formulário Depoimento</strong>
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
	      <h5>Depoimento <small>Cadastro e edição do depoimento</small></h5>
	    </div>
	    <div class="ibox-content">
	      <form name="formTestemonial" method="post" action="{{ $urlAction }}" enctype="multipart/form-data" class="form-horizontal">
				<input type="hidden" id="id" name="id" />
				<div class="form-group">

					<label class="col-sm-2 control-label">Página*</label>
					@if ($fieldPageConfig->show('content_page_id'))
					<div class="col-sm-4">
						<select id="content_page_id" name="content_page_id" class="form-control m-b" required {!! $fieldPageConfig->attr('content_page_id') !!} >
							<option value="">Selecione a página</option>
							@foreach($listSelectBox->contentPage as $item)
							<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
							@endforeach
						</select>
					</div>
					@endif

					<label class="col-sm-2 control-label">Status*</label>
					@if ($fieldPageConfig->show('status'))
					<div class="col-sm-4">
						<input type="checkbox" id="status" name="status" class="js-switch"  checked {!! $fieldPageConfig->attr('status') !!} />
					</div>
					@endif

				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Nome*</label>
					@if ($fieldPageConfig->show('name'))
					<div class="col-sm-10">
						<input type="text" id="name" name="name" class="form-control" required {!! $fieldPageConfig->attr('name') !!} />
						<span class="help-block m-b-none">Digite o Nome.</span>
					</div>
					@endif
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Profissão</label>
					@if ($fieldPageConfig->show('office'))
					<div class="col-sm-10">
						<input type="text" id="office" name="office" class="form-control" {!! $fieldPageConfig->attr('office') !!} />
						<span class="help-block m-b-none">Digite a Profissão.</span>
					</div>
					@endif
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Resumo em Português*</label>
					@if ($fieldPageConfig->show('abstract_pt'))
					<div class="col-sm-10">
						<input type="text" id="abstract_pt" name="abstract_pt" class="form-control" required {!! $fieldPageConfig->attr('abstract_pt') !!} />
						<span class="help-block m-b-none">Digite o Resumo.</span>
					</div>
					@endif
				</div>
				{{-- <div class="form-group">
					<label class="col-sm-2 control-label">Resumo em Inglês*</label>
					@if ($fieldPageConfig->show('abstract_en'))
					<div class="col-sm-10">
						<input type="text" id="abstract_en" name="abstract_en" class="form-control" {!! $fieldPageConfig->attr('abstract_en') !!} />
						<span class="help-block m-b-none">Digite o Resumo.</span>
					</div>
					@endif
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Resumo em Espanhol</label>
					@if ($fieldPageConfig->show('abstract_es'))
					<div class="col-sm-10">
						<input type="text" id="abstract_es" name="abstract_es" class="form-control" {!! $fieldPageConfig->attr('abstract_es') !!} />
						<span class="help-block m-b-none">Digite o Resumo.</span>
					</div>
					@endif
				</div> --}}

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
						{{-- <div class="row">
							<div class="col-lg-12">
								<div class="ibox float-e-margins">
									<div class="ibox-title">
										<h5>Digite o Depoimento em Inglês*</h5>
									</div>
									<div class="ibox-content no-padding">
										<textarea rows="10" id="text_en" name="text_en" class="summernote">
										</textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="ibox float-e-margins">
									<div class="ibox-title">
										<h5>Digite o Depoimento em Espanhol</h5>
									</div>
									<div class="ibox-content no-padding">
										<textarea rows="10" id="text_es" name="text_es" class="summernote">
										</textarea>
									</div>
								</div>
							</div>
						</div> --}}
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
	Dropzone.options.dropzoneForm = {
		paramName: "file", // The name that will be used to transfer the file
		maxFilesize: 2, // MB
		dictDefaultMessage: "<strong>Drop files here or click to upload. </strong></br> (This is just a demo dropzone. Selected files are not actually uploaded.)"
	};

	$(document).ready(function() {
		$('.summernote').summernote();
	});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
	try {
		APP.scope.testemonial = <?=isset($data) ? json_encode($data) : 'null'?>;

		if (APP.scope.testemonial) {
			populate(document.forms.formTestemonial, APP.scope.testemonial);
		}

		var elem = document.querySelector('.js-switch');
		var switchery = new Switchery(elem, { color: '#1AB394' });
	} catch (error) {
		console.warn(error);
	}
});
</script>
@endsection
