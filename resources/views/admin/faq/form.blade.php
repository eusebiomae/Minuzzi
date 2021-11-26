@extends('layouts.app')

@section('title', 'FAQ')

@section('css')

@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Inserir</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li>
        <a href="{{ url('/admin/faq') }}">FAQ</a>
      </li>
      <li class="active">
        <strong>Inserir</strong>
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
	      <h5>Cadastro</h5>
	    </div>
	    <div class="ibox-content">
				<form name="formFaq" method="post" action="{{ $urlAction }}" class="form-horizontal">
					<input type="hidden" id="id" name="id" />
	      	<div class="form-group">
						@if ($fieldPageConfig->show('question'))
						<div class="col-sm-12">
							<label class="control-label">Questão*</label>
	          	<input type="text" name="question" class="form-control"  required maxlength="1024" {!! $fieldPageConfig->attr('question') !!}/>
	          </div>
						@endif
						@if ($fieldPageConfig->show('answer'))
						<div class="col-sm-12">
							<label class="control-label">Resposta*</label>
							<textarea name="answer" class="form-control" size="15" {!! $fieldPageConfig->attr('answer') !!}></textarea>
						</div>
						@endif
					</div>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
	try {
		APP.scope.faq = <?=isset($data) ? json_encode($data) : 'null'?>;

		if (APP.scope.faq) {
			populate(document.forms.formFaq, APP.scope.faq);
		}
	} catch (error) {
		console.warn(error);
	}
});
</script>
@endsection
