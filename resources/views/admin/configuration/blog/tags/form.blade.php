@extends('layouts.app')

@section('title', 'Alimentação')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Inserir Tag Blog / Notícias</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li>
        <a href="#">Configurações</a>
      </li>
      <li>
        <a href="{{ url('/admin/configuration/blog/tags') }}">Tag</a>
      </li>
      <li class="active">
        <strong>Inserir Tag</strong>
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
	      <h5>Tags <small>Cadastro e edição de tag.</small></h5>
	    </div>
	    <div class="ibox-content">
				<form name="formBlogTags" method="post" action="{{ url($urlAction) }}" class="form-horizontal">
					<input type="hidden" id="id" name="id">
					@if ($fieldPageConfig->show('description'))
						<div class="form-group">
							<label class="col-sm-2 control-label">Tag</label>
							<div class="col-sm-10">
								<input type="text" id="description" name="description" class="form-control" {!! $fieldPageConfig->attr('description') !!}>
							</div>
						</div>
					@endif

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
		APP.scope.blogTags = <?=isset($data) ? json_encode($data) : 'null'?>;

		if (APP.scope.blogTags) {
			populate(document.forms.formBlogTags, APP.scope.blogTags);
		}
	} catch (error) {
		console.warn(error);
	}
});
</script>
@endsection
