@extends('layouts.app')

@section('title', 'Cidade')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Inserir Funções</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li>
        <a href="#">Configurações</a>
      </li>
      <li>
        <a href="{{ url('/admin/configuration/city') }}">Cidade</a>
      </li>
      <li class="active">
        <strong>Inserir Cidade</strong>
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
	      <h5>Cidades <small>Cadastro de cidade que os cursos estarão disponíveis.</small></h5>
	    </div>
	    <div class="ibox-content">
        <form name="formCity" method="post" action="{{ url($urlAction) }}" class="form-horizontal">
          @include('admin.configuration.city.form_group')
          {{ csrf_field() }}
          <div class="form-group">
            <div class="col-sm-12 text-right">
              <button class="btn btn-white gp-alert" data-gp-alert="cancel" type="submit">Cancelar</button>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
	try {
		APP.scope.city = <?=isset($data) ? json_encode($data) : 'null'?>;

		if (APP.scope.city) {
			populate(document.forms.formCity, APP.scope.city);
		}
	} catch (error) {
		console.warn(error);
	}
});
</script>
@endsection
