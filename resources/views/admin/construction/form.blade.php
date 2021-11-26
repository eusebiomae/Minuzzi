@extends('layouts.app')

@section('title', 'Estrutura')

@section('css')
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />

	<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/basic.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/dropzone.css') !!}" />
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Inserir Estrutura</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li>
        <a href="{{ url('/admin/construction') }}">Estrutura</a>
      </li>
      <li class="active">
        <strong>Inserir Ambientes</strong>
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
	      <h5>Estrutura <small>Cadstro de ambientes escolares.</small></h5>
	    </div>
	    <div class="ibox-content">
				<form name="formConstruction" method="post" action="{{ $urlAction }}" enctype="multipart/form-data"  class="form-horizontal">
					<input type="hidden" id="id" name="id">
	      	<div class="form-group">
						@if ($fieldPageConfig->show('school_information_id'))
							<label class="col-sm-2 control-label">Unidade*</label>
							<div class="col-sm-4">
								<select id="school_information_id" name="school_information_id" class="form-control m-b" {!! $fieldPageConfig->attr('school_information_id') !!}>
									@foreach($listSelectBox->schoolInformation as $item)
										<option value="{{ $item->id }}">{{ $item->name }}</option>
									@endforeach
								</select>
							</div>
						@endif

						@if ($fieldPageConfig->show('construction_category_id'))
							<label class="col-sm-2 control-label">Categoria*</label>
							<div class="col-sm-4">
								<select id="construction_category_id" name="construction_category_id" class="form-control m-b" {!! $fieldPageConfig->attr('construction_category_id') !!}>
									@foreach($listSelectBox->constructionCategory as $item)
										<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
									@endforeach
								</select>
							</div>
						@endif
        	</div>

					@if ($fieldPageConfig->show('name_pt'))
						<div class="form-group">
							<label class="col-sm-2 control-label">Nome PT-BR*</label>
							<div class="col-sm-10">
								<input type="text" id="name_pt" name="name_pt" class="form-control" {!! $fieldPageConfig->attr('name_pt') !!}>
								<span class="help-block m-b-none">Digite o Nome em Português.</span>
							</div>
						</div>
					@endif
	      	{{--
					@if ($fieldPageConfig->show('name_en'))
						<div class="form-group">
							<label class="col-sm-2 control-label">Nome EN*</label>
							<div class="col-sm-10">
								<input type="text" id="name_en" name="name_en" class="form-control" {!! $fieldPageConfig->attr('name_en') !!}>
								<span class="help-block m-b-none">Digite o Nome em Inglês.</span>
							</div>
						</div>
					@endif
					@if ($fieldPageConfig->show('name_es'))
						<div class="form-group">
							<label class="col-sm-2 control-label">Nome ES</label>
							<div class="col-sm-10">
								<input type="text" id="name_es" name="name_es" class="form-control" {!! $fieldPageConfig->attr('name_es') !!}>
								<span class="help-block m-b-none">Digite o Nome em Espanhol.</span>
							</div>
						</div>
					@endif
					--}}

	      	<div class="wrapper wrapper-content">

						@if ($fieldPageConfig->show('description_pt'))
							<div class="row">
								<div class="col-lg-12">
									<div class="ibox float-e-margins">
										<div class="ibox-title">
											<h5>Digite o conteúdo em Português*</h5>
										</div>
										<div class="ibox-content no-padding">
											<textarea id="description_pt" name="description_pt" class="summernote" {!! $fieldPageConfig->attr('description_pt') !!}>
											</textarea>
										</div>
									</div>
								</div>
							</div>
						@endif

            {{--
						@if ($fieldPageConfig->show('description_en'))
							<div class="row">
								<div class="col-lg-12">
									<div class="ibox float-e-margins">
										<div class="ibox-title">
											<h5>Digite o conteúdo em Inglês*</h5>
										</div>
										<div class="ibox-content no-padding">
											<textarea id="description_en" name="description_en" class="summernote" {!! $fieldPageConfig->attr('description_en') !!}>
											</textarea>
										</div>
									</div>
								</div>
							</div>
						@endif
						@if ($fieldPageConfig->show('description_es'))
							<div class="row">
								<div class="col-lg-12">
									<div class="ibox float-e-margins">
										<div class="ibox-title">
											<h5>Digite o conteúdo em Espanhol</h5>
										</div>
										<div class="ibox-content no-padding">
											<textarea id="description_es" name="description_es" class="summernote" {!! $fieldPageConfig->attr('description_es') !!}>
											</textarea>
										</div>
									</div>
								</div>
							</div>
						@endif
						--}}
						@if ($fieldPageConfig->show('description'))
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
												<input type="file" id="fileImage" name="fileImage">
											</span>
										<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
								</div>
							</div>
						</div>
						@endif

						<div class="form-group">
	            <div class="col-sm-12 text-right">
	              <button class="btn btn-white" type="submit">Cancelar</button>
	              <button class="btn btn-primary" type="submit">Salvar alterações</button>
	            </div>
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
<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}"></script>
<script src="{!! asset('js/plugins/jasny/jasny-bootstrap.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/dropzone/dropzone.js') !!}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
	try {
		APP.scope.construction = <?=isset($data) ? json_encode($data) : 'null'?>;

		if (APP.scope.construction) {
			populate(document.forms.formConstruction, APP.scope.construction);
		}
	} catch (error) {
		console.warn(error);
	}
});
</script>
@endsection
