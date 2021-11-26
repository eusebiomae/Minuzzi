@extends('layouts.app')

@section('title', 'Eventos')

@section('css')
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />

	<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/clockpicker/clockpicker.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/switchery/switchery.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/select2/select2.min.css') !!}" />
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Inserir Evento</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li>
        <a href="{{ url('/admin/event' ) }}">Eventos</a>
      </li>
      <li class="active">
        <strong>Inserir Evento</strong>
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
	      <h5>Evento <small>cadastro</small></h5>
	    </div>
	    <div class="ibox-content">
				<form name="formEvent" method="post" action="{{ $urlAction }}" class="form-horizontal">
					<input type="hidden" id="id" name="id">
					<div class="form-group" >
						@if ($fieldPageConfig->show('event_date'))
							<label class="col-sm-2 control-label">Data do Evento</label>
							<div class="col-sm-4" id="data_1">
								<div class="input-group date">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input type="text" id="event_date" name="event_date"  class="form-control" readonly {!! $fieldPageConfig->attr('event_date') !!}>
								</div>
							</div>
						@endif
						@if ($fieldPageConfig->show('event_date'))
							<label class="col-sm-2 control-label">Hora do Evento</label>
							<div class="col-sm-4">
								<div class="input-group clockpicker" data-autoclose="true">
									<input type="text" id="event_time" name="event_date"  class="form-control" readonly {!! $fieldPageConfig->attr('event_date') !!}>
									<span class="input-group-addon">
											<span class="fa fa-clock-o"></span>
									</span>
								</div>
							</div>
						@endif
					</div>
					<div class="form-group" >
						@if ($fieldPageConfig->show('calendar_id'))
							<label class="col-sm-2 control-label">Calendário</label>
							<div class="col-sm-4">
								<select id="calendar_id" name="calendar_id" class="select2_demo_1 form-control" {!! $fieldPageConfig->attr('calendar_id') !!}>
									@foreach($listSelectBox->calendar as $item)
										<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
									@endforeach
								</select>
							</div>
						@endif
						@if ($fieldPageConfig->show('calendar_privacy_id'))
							<label class="col-sm-2 control-label">Privacidade</label>
							<div class="col-sm-4">
								<select id="calendar_privacy_id" name="calendar_privacy_id" class="select2_demo_1 form-control" {!! $fieldPageConfig->attr('calendar_privacy_id') !!}>
									@foreach($listSelectBox->calendarPrivacy as $item)
										<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
									@endforeach
								</select>
							</div>
						@endif
					</div>
					<div class="form-group" >
						@if ($fieldPageConfig->show('class_status'))
							<label class="col-sm-2 control-label">Aula Status</label>
							<div class="col-sm-4">
								<select id="class_status" name="class_status" class="select2_demo_1 form-control" {!! $fieldPageConfig->attr('class_status') !!}>
									<option value="1">Suspensão de Aula</option>
									<option value="2">Suspensão Parcial de aula (Manhã)</option>
									<option value="3">Suspensão Parcial de aula (Tarde)</option>
									<option value="4">Aula Normal</option>
									<option value="5">Aula com evento</option>
								</select>
							</div>
						@endif
						@if ($fieldPageConfig->show('annual_repeat'))
							<label class="col-sm-2 control-label">Repetir Anualmente</label>
							<div class="col-sm-1">
								<input type="checkbox" id="annual_repeat" name="annual_repeat" class="js-switch" {!! $fieldPageConfig->attr('annual_repeat') !!}/>
							</div>
						@endif
						@if ($fieldPageConfig->show('status'))
							<label class="col-sm-1 control-label">Status</label>
							<div class="col-sm-2">
								<input type="checkbox" id="status" name="status" class="js-switch" checked {!! $fieldPageConfig->attr('status') !!}/>
							</div>
						@endif
						</div>
					<div class="form-group">
						@if ($fieldPageConfig->show('localization'))
							<label class="col-sm-2 control-label">Localização</label>
							<div class="col-sm-10">
								<input type="text" id="localization" name="localization" class="form-control" {!! $fieldPageConfig->attr('localization') !!}/>
								<span class="help-block m-b-none">Digite o local do evento.</span>
							</div>
						@endif
	      	</div>
	      	<div class="form-group">
						@if ($fieldPageConfig->show('title_pt'))
							<label class="col-sm-2 control-label">Título PT-BR</label>
							<div class="col-sm-10">
								<input type="text" id="title_pt" name="title_pt" class="form-control" {!! $fieldPageConfig->attr('title_pt') !!} />
								<span class="help-block m-b-none">Digite o título em Português.</span>
							</div>
							@endif
	      	</div>
	      	<div class="form-group">
						@if ($fieldPageConfig->show('title_en'))
							<label class="col-sm-2 control-label">Título EN</label>
							<div class="col-sm-10">
								<input type="text" id="title_en" name="title_en" class="form-control" {!! $fieldPageConfig->attr('title_en') !!}>
								<span class="help-block m-b-none">Digite o título em Inglês.</span>
							</div>
						@endif
	      	</div>
	      	<div class="form-group">
						@if ($fieldPageConfig->show('title_es'))
							<label class="col-sm-2 control-label">Título ES</label>
							<div class="col-sm-10">
								<input type="text" id="title_es" name="title_es" class="form-control" {!! $fieldPageConfig->attr('title_es') !!}/>
								<span class="help-block m-b-none">Digite o título em Espanhol.</span>
							</div>
						@endif
	      	</div>
					<div class="form-group" >
						<div class="wrapper wrapper-content">
							@if ($fieldPageConfig->show('description_pt'))
								<div class="row">
									<div class="col-lg-12">
										<div class="ibox float-e-margins">
											<div class="ibox-title">
												<h5>Digite o conteúdo em Português*</h5>
											</div>
											<div class="ibox-content no-padding">
												<textarea id="description_pt" name="description_pt" class="summernote" {!! $fieldPageConfig->attr('description_pt') !!}></textarea>
											</div>
										</div>
									</div>
								</div>
							@endif
							@if ($fieldPageConfig->show('description_en'))
								<div class="row">
									<div class="col-lg-12">
										<div class="ibox float-e-margins">
											<div class="ibox-title">
												<h5>Digite o conteúdo em Inglês*</h5>
											</div>
											<div class="ibox-content no-padding">
												<textarea id="description_en" name="description_en" class="summernote" {!! $fieldPageConfig->attr('description_en') !!}></textarea>
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
												<textarea id="description_es" name="description_es" class="summernote" {!! $fieldPageConfig->attr('description_es') !!}></textarea>
											</div>
										</div>
									</div>
								</div>
							@endif
						</div>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
	try {
		APP.scope.event = <?=isset($data) ? json_encode($data) : 'null'?>;

		if (APP.scope.event) {
			populate(document.forms.formEvent, APP.scope.event);
		}
	} catch (error) {
		console.warn(error);
	}
});
</script>
@endsection
