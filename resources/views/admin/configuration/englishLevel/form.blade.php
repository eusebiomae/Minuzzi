@extends('layouts.app')

@section('title', 'Alimentação')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Inserir Nível de Inglês</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li>
        <a href="#">Configurações</a>
      </li>
      <li>
        <a href="{{ url('/admin/configuration/englishlevel') }}">Nível de Inglês</a>
      </li>
      <li class="active">
        <strong>Inserir Nível de Inglês</strong>
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
	      <h5>Nível de Inglês <small>Cadastro e edição das Nível de Inglês.</small></h5>
	    </div>
	    <div class="ibox-content">
	      <form name="formEnglishLevel" method="post" action="{{ url($urlAction) }}" class="form-horizontal">
	      	<input type="hidden" id="id" name="id">
					@if ($fieldPageConfig->show('description_pt'))
						<div class="form-group">
							<label class="col-sm-2 control-label">Nível de Inglês PT-BR</label>
							<div class="col-sm-10">
								<input type="text" id="description_pt" name="description_pt" class="form-control" {!! $fieldPageConfig->attr('description_pt') !!}>
								<span class="help-block m-b-none">Digite a Nível de Inglês em Português.</span>
							</div>
						</div>
					@endif

	      	{{--
					@if ($fieldPageConfig->show('description_en'))
						<div class="form-group">
							<label class="col-sm-2 control-label">Nível de Inglês EN</label>
							<div class="col-sm-10">
								<input type="text" id="description_en" name="description_en" class="form-control" {!! $fieldPageConfig->attr('description_en') !!}>
								<span class="help-block m-b-none">Digite a Nível de Inglês em Inglês.</span>
							</div>
						</div>
					@endif
					@if ($fieldPageConfig->show('description_es'))
						<div class="form-group">
							<label class="col-sm-2 control-label">Nível de Inglês ES</label>
							<div class="col-sm-10">
								<input type="text" id="description_es" name="description_es" class="form-control" {!! $fieldPageConfig->attr('description_es') !!}>
								<span class="help-block m-b-none">Digite a Nível de Inglês em Espanhol.</span>
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
		APP.scope.englishLevel = <?=isset($data) ? json_encode($data) : 'null'?>;

		if (APP.scope.englishLevel) {
			populate(document.forms.formEnglishLevel, APP.scope.englishLevel);
		}
	} catch (error) {
		console.warn(error);
	}
});
</script>
@endsection
