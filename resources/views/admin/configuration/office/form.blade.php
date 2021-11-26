@extends('layouts.app')

@section('title', 'Cargo')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Inserir Cargo/Profissão</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li>
        <a href="#">Configurações</a>
      </li>
      <li>
        <a href="{{ url('/admin/configuration/office') }}">Cargo/Profissão</a>
      </li>
      <li class="active">
        <strong>Inserir Funções</strong>
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
	      <h5>Cargo/Profissão <small>Cadastro e edição das cargo/profissão.</small></h5>
	    </div>
	    <div class="ibox-content">
				<form method="post" name="formOffice" action="{{ url($urlAction) }}" class="form-horizontal">
					<input type="hidden" id="id" name="id">
	      	<div class="form-group">
						@if ($fieldPageConfig->show('description_pt'))
							<div class="col-sm-10">
								<label class="control-label">Cargo/Profissão</label>
								<input type="text" id="description_pt" name="description_pt" class="form-control" maxlength="45" {!! $fieldPageConfig->attr('description_pt') !!}>
								<span class="help-block m-b-none">Digite a Cargo/Profissão.</span>
							</div>
						@endif

						@if ($fieldPageConfig->show('flg'))
							<div class="col-sm-2">
								<label class="control-label">Flag</label>
								<input type="text" id="flg" name="flg" class="form-control" maxlength="45" {!! $fieldPageConfig->attr('flg') !!}>
								<span class="help-block m-b-none">Digite a flag de identificação.</span>
							</div>
						@endif
	      	</div>
	      	{{--
					@if ($fieldPageConfig->show('description_en'))
						<div class="form-group">
							<label class="col-sm-2 control-label">Cargo/Profissão EN</label>
							<div class="col-sm-10">
								<input type="text" id="description_en" name="description_en" class="form-control" {!! $fieldPageConfig->attr('description_en') !!}>
								<span class="help-block m-b-none">Digite a Cargo/Profissão em Inglês.</span>
							</div>
						</div>
					@endif
					@if ($fieldPageConfig->show('description_es'))
						<div class="form-group">
							<label class="col-sm-2 control-label">Cargo/Profissão ES</label>
							<div class="col-sm-10">
								<input type="text" id="description_es" name="description_es" class="form-control" {!! $fieldPageConfig->attr('description_es') !!}>
								<span class="help-block m-b-none">Digite a Cargo/Profissão em Espanhol.</span>
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
		APP.scope.office = <?=isset($data) ? json_encode($data) : 'null'?>;

		if (APP.scope.office) {
			populate(document.forms.formOffice, APP.scope.office);
		}
	} catch (error) {
		console.warn(error);
	}
});
</script>
@endsection
