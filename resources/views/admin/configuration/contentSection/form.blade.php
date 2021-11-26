@extends('layouts.app')

@section('title', 'Seção da Página')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Inserir Seções de Páginas</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li>
        <a href="#">Configurações</a>
      </li>
      <li>
        <a href="{{ url('/admin/configuration/contentsection') }}">Seções de Páginas</a>
      </li>
      <li class="active">
        <strong>Inserir Seções</strong>
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
	      <h5>Seções de Páginas <small>Cadastro e edição das páginas do site.</small></h5>
	    </div>
	    <div class="ibox-content">
				<form name="formContentSection" method="post" action="{{ url($urlAction) }}" class="form-horizontal">
					<input type="hidden" id="id" name="id">
	      	<div class="form-group">
						@if ($fieldPageConfig->show('content_page_id'))
							<div class="col-sm-4">
								<label class="control-label">Página</label>
								<select class="form-control m-b" name="content_page_id" id="content_page_id" {!! $fieldPageConfig->attr('content_page_id') !!}>
									<option value="">Selecione a página</option>
									@foreach($listSelectBox->contentPage as $item)
									<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
									@endforeach
								</select>
							</div>
						@endif

						@if ($fieldPageConfig->show('component'))
						<div class="col-sm-4">
							<label class="control-label">Flag do Componente</label>
							<input type="text" id="component" name="component" class="form-control" {!! $fieldPageConfig->attr('component') !!}>
						</div>
						@endif

						@if ($fieldPageConfig->show('component_order'))
						<div class="col-sm-4">
							<label class="control-label">Ordem do Componente</label>
							<input type="text" id="component_order" name="component_order" class="form-control" value="1" {!! $fieldPageConfig->attr('component_order') !!}>
						</div>
						@endif
        	</div>
					@if ($fieldPageConfig->show('description_pt'))
					<div class="form-group">
	      		<label class="col-sm-2 control-label">Título</label>
	          <div class="col-sm-10">
	          	<input type="text" id="description_pt" name="description_pt" class="form-control" {!! $fieldPageConfig->attr('description_pt') !!}>
	          	<span class="help-block m-b-none">Digite a título.</span>
	          </div>
	      	</div>
					@endif

	      	{{--
					@if ($fieldPageConfig->show('description_en'))
						<div class="form-group">
							<label class="col-sm-2 control-label">Título EN</label>
							<div class="col-sm-10">
								<input type="text" id="description_en" name="description_en" class="form-control" {!! $fieldPageConfig->attr('description_en') !!}>
								<span class="help-block m-b-none">Digite a Título em Inglês.</span>
							</div>
						</div>
					@endif

					@if ($fieldPageConfig->show('description_es'))
						<div class="form-group">
							<label class="col-sm-2 control-label">Título ES</label>
							<div class="col-sm-10">
								<input type="text" id="description_es" name="description_es" class="form-control" {!! $fieldPageConfig->attr('description_es') !!}>
								<span class="help-block m-b-none">Digite a Título em Espanhol.</span>
							</div>
						</div>
					@endif
					--}}
					@if ($fieldPageConfig->show('subtitle_pt'))
					<div class="form-group">
	      		<label class="col-sm-2 control-label">Subtítulo</label>
	          <div class="col-sm-10">
	          	<input type="text" id="subtitle_pt" name="subtitle_pt" class="form-control" {!! $fieldPageConfig->attr('subtitle_pt') !!}>
	          	<span class="help-block m-b-none">Digite a Subtítulo.</span>
	          </div>
	      	</div>
					@endif

	      	{{--
					@if ($fieldPageConfig->show('subtitle_en'))
						<div class="form-group">
							<label class="col-sm-2 control-label">Subtítulo EN</label>
							<div class="col-sm-10">
								<input type="text" id="subtitle_en" name="subtitle_en" class="form-control" {!! $fieldPageConfig->attr('subtitle_en') !!}>
								<span class="help-block m-b-none">Digite a Subtítulo em Inglês.</span>
							</div>
						</div>
					@endif
					@if ($fieldPageConfig->show('subtitle_es'))
						<div class="form-group">
							<label class="col-sm-2 control-label">Subtítulo ES</label>
							<div class="col-sm-10">
								<input type="text" id="subtitle_es" name="subtitle_es" class="form-control" {!! $fieldPageConfig->attr('subtitle_es') !!}>
								<span class="help-block m-b-none">Digite a Subtítulo em Espanhol.</span>
							</div>
						</div>
					@endif
					--}}
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
<script>
document.addEventListener('DOMContentLoaded', function() {
	try {
		APP.scope.contentSection = <?=isset($data) ? json_encode($data) : 'null'?>;

		if (APP.scope.contentSection) {
			populate(document.forms.formContentSection, APP.scope.contentSection);
		}
	} catch (error) {
		console.warn(error);
	}
});
</script>
@endsection
