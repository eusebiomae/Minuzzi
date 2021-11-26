@extends('layouts.app')

@section('title', 'Páginas')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Inserir Nova Páginas</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li>
        <a href="#">Configurações</a>
      </li>
      <li>
        <a href="{{ url('/admin/configuration/contentpage') }}">Página</a>
      </li>
      <li class="active">
        <strong>Inserir Página</strong>
      </li>
    </ol>
  </div>
  <div class="col-lg-2"></div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="col-lg-12">
	  <div class="ibox float-e-margins">
	    <div class="ibox-title">
	      <h5>Páginas <small>Cadastro e edição das páginas do site.</small></h5>
	    </div>
	    <div class="ibox-content">
				<form name="formContentPage" method="post" action="{{ url($urlAction) }}" class="form-horizontal">
					<input type="hidden" id="id" name="id">
	      	<div class="form-group">
						@if ($fieldPageConfig->show('description_pt'))
							<div class="col-sm-6">
								<label class="control-label">Página PT-BR</label>
								<input type="text" id="description_pt" name="description_pt" class="form-control" {!! $fieldPageConfig->attr('description_pt') !!}>
								<span class="help-block m-b-none">Digite o nome da Página.</span>
							</div>
						@endif
						@if ($fieldPageConfig->show('flg_page'))
							<div class="col-sm-6">
								<label class="control-label">Flag</label>
								<input type="text" id="flg_page" name="flg_page" class="form-control" {!! $fieldPageConfig->attr('flg_page') !!}>
								<span class="help-block m-b-none">Digite a flag da Página.</span>
							</div>
						@endif

					</div>
	      	<div>
						<div class="text-left">
							<button
								type="button"
								class="btn btn-primary"
								title="Adicionar novo"
								onclick="newMetaTag()"
							>
								<i class="fa fa-plus"></i> Adicionar Meta Tag
							</button>
						</div>
						<div id="metaTag"></div>
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

<script id="tmplMetaTag" type="text/x-dot-template">
	<div class="form-group">
		<input type="hidden" name="metaTag[@{{= it.key }}][id]" value="@{{= it.id }}" />
		<div class="col-sm-2">
			<label class="control-label">Nome da Tag</label>
			<input type="text" name="metaTag[@{{= it.key }}][name]" class="form-control" maxlength="128" value="@{{= it.name }}">
			<span class="help-block m-b-none">Nome da Meta Tag.</span>
		</div>
		<div class="col-sm-9">
			<label class="control-label">Conteúdo</label>
			<input type="text" name="metaTag[@{{= it.key }}][content]" class="form-control" maxlength="1024" value="@{{= it.content }}">
			<span class="help-block m-b-none">Conteúdo da Meta Tag.</span>
		</div>
		<div class="col-sm-1 text-right" style="padding-top: 25px; cursor: pointer; color: #f00">
			<button type="button" class="btn btn-danger p-2" title="Excluir" onclick="removeFormGroup(event)">
				<i class="fa fa-times"></i>
			</button>
		</div>
	</div>
</script>
@endsection

@section('scripts')
@parent
<script>
	function newMetaTag(data) {
		if (!data) {
			data = {
				id: '',
				name: '',
				content: '',
			}
		}

		data.key = generateUniqueKey()

		var metaTag = setTmplInsertAdjacentHTML({
			tmpl: 'tmplMetaTag',
			toTmpl: 'metaTag',
			data: data,
		})
	}

	function removeFormGroup(event) {
		event.target.closest('.form-group').remove();
	}

	document.addEventListener('DOMContentLoaded', function() {
		try {
			APP.scope.contentPage = <?=isset($data) ? json_encode($data) : 'null'?>;
			APP.metaTag = {!! isset($metaTag) ? json_encode($metaTag) : '[]' !!};

			if (APP.scope.contentPage) {
				populate(document.forms.formContentPage, APP.scope.contentPage);
			}

			APP.metaTag.forEach(newMetaTag)


		} catch (error) {
			console.warn(error);
		}
	});
</script>
@endsection
