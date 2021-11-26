@extends('layouts.app')

@section('title', 'Alimentação')

@section('css')
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Inserir Alimentação</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li>
        <a href="{{ url('/admin/alimentation') }}">Alimentação</a>
      </li>
      <li class="active">
        <strong>Inserir Alimentação</strong>
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
	      <h5>Alimentação <small>Cadastro de tabela alimentar.</small></h5>
	    </div>
	    <div class="ibox-content">
			<form name="formAlimentation" method="post" action="{{ $urlAction }}" class="form-horizontal">
				<input type="hidden" id="id" name="id">
	      	<div class="form-group">
	      		@if ($fieldPageConfig->show('alimentation_type_id'))
							<label class="col-sm-2 control-label">Tipo*</label>
							<div class="col-sm-2">
								<select id="alimentation_type_id" name="alimentation_type_id" class="form-control m-b" {!! $fieldPageConfig->attr('alimentation_type_id') !!}>
									@foreach($listSelectBox->alimentationType as $item)
										<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
									@endforeach
								</select>
							</div>
						@endif

	      		@if ($fieldPageConfig->show('alimentation_category_id'))
							<label  class="col-sm-2 control-label">Categoria*</label>
							<div class="col-sm-2">
								<select id="alimentation_category_id" name="alimentation_category_id" class="form-control m-b" {!! $fieldPageConfig->attr('alimentation_category_id') !!}>
									@foreach($listSelectBox->alimentationCategory as $item)
										<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
									@endforeach
								</select>
							</div>
						@endif

						@if ($fieldPageConfig->show('weekday_id'))
							<label  class="col-sm-2 control-label">Dia*</label>
							<div class="col-sm-2">
								<select id="weekday_id" name="weekday_id" class="form-control m-b" {!! $fieldPageConfig->attr('weekday_id') !!}>
									@foreach($listSelectBox->weekday as $item)
										<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
									@endforeach
								</select>
							</div>
						@endif

        	</div>
        	<div class="hr-line-dashed"></div>
        	<div class="form-group">
        		<div class="col-sm-12">
        			<h4><small>Descrição do alimento.</small></h4>
        		</div>
        	</div>
					@if ($fieldPageConfig->show('description_pt'))
						<div class="form-group">
							<label class="col-sm-2 control-label">Descrição PT-BR*</label>
							<div class="col-sm-10">
								<input type="text"  id="description_pt" name="description_pt" class="form-control" {!! $fieldPageConfig->attr('description_pt') !!}>
								<span class="help-block m-b-none">Digite o Descrição em Português.</span>
							</div>
						</div>
					@endif

					@if ($fieldPageConfig->show('description_en'))
						<div class="form-group">
							<label class="col-sm-2 control-label">Descrição EN*</label>
							<div class="col-sm-10">
								<input type="text" id="description_en" name="description_en" class="form-control" {!! $fieldPageConfig->attr('description_en') !!}>
								<span class="help-block m-b-none">Digite o Descrição em Inglês.</span>
							</div>
						</div>
					@endif

					@if ($fieldPageConfig->show('title'))
						<div class="form-group">
							<label class="col-sm-2 control-label">Descrição ES</label>
							<div class="col-sm-10">
								<input type="text" id="description_es" name="description_es" class="form-control" {!! $fieldPageConfig->attr('description_es') !!}>
								<span class="help-block m-b-none">Digite o Descrição em Espanhol.</span>
							</div>
						</div>
					@endif


					<div class="form-group">
						<div class="wrapper wrapper-content">
							@if ($fieldPageConfig->show('text_pt'))
								<div class="row">
									<div class="col-lg-12">
										<div class="ibox float-e-margins">
											<div class="ibox-title">
												<h5>Digite o conteúdo em Português*</h5>
											</div>
											<div class="ibox-content no-padding">
												<textarea id="text_pt" name="text_pt" class="summernote" {!! $fieldPageConfig->attr('text_pt') !!}></textarea>
											</div>
										</div>
									</div>
								</div>
							@endif

							@if ($fieldPageConfig->show('text_en'))
								<div class="row">
									<div class="col-lg-12">
										<div class="ibox float-e-margins">
											<div class="ibox-title">
												<h5>Digite o conteúdo em Inglês*</h5>
											</div>
											<div class="ibox-content no-padding">
												<textarea id="text_en" name="text_en" class="summernote" {!! $fieldPageConfig->attr('text_en') !!}></textarea>
											</div>
										</div>
									</div>
								</div>
							@endif

							@if ($fieldPageConfig->show('text_es'))
								<div class="row">
									<div class="col-lg-12">
										<div class="ibox float-e-margins">
											<div class="ibox-title">
												<h5>Digite o conteúdo em Espanhol</h5>
											</div>
											<div class="ibox-content no-padding">
												<textarea id="text_es" name="text_es" class="summernote" {!! $fieldPageConfig->attr('text_es') !!}></textarea>
											</div>
										</div>
									</div>
								</div>
							@endif

						</div>
					</div>

	      	<div class="hr-line-dashed"></div>
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
		APP.scope.alimentation = <?=isset($data) ? json_encode($data) : 'null'?>;

		if (APP.scope.alimentation) {
			populate(document.forms.formAlimentation, APP.scope.alimentation);
		}
	} catch (error) {
		console.warn(error);
	}
});
</script>
@endsection

