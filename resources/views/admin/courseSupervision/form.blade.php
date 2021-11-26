@extends('layouts.app')

@section('title', 'Supervisãos')

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
    <h2>Inserir Supervisão</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li>
        <a href="{{ url('/admin/course_supervision' ) }}">Supervisão</a>
      </li>
      <li class="active">
        <strong>Inserir Supervisão</strong>
      </li>
    </ol>
  </div>
  <div class="col-lg-2" style="padding-top: 30px; text-align: right">
		<a href="{{ url('admin/course_supervision') }}">
			<button type="button" class="btn btn-primary">
				<i class="fa fa-list"></i> Lista
			</button>
		</a>
  </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="col-lg-12">
	  <div class="ibox float-e-margins">
	    <div class="ibox-title">
	      <h5>Supervisão <small>cadastro</small></h5>
	    </div>
	    <div class="ibox-content">
				<form name="formData" method="post" action="{{ $urlAction }}" class="form-horizontal">
					{{ csrf_field() }}
					<input type="hidden" id="id" name="id">

					<div class="form-group row">
						@if ($fieldPageConfig->show('status'))
						<div class="col-sm-4">
							<div class="input-group" data-form-data="status">
								<label class="control-label"> Finalizado &nbsp;</label>
								<input type="checkbox" name="status" class="js-switch" value="A" {!! $fieldPageConfig->attr('status') !!}>
								<label class="control-label">&nbsp; Ativado </label>
							</div>
						</div>
						@endif
					</div>

					<div class="form-group row">
						@if ($fieldPageConfig->show('date'))
							<div class="col-sm-4">
								<label class="control-label">Data</label>
								<div class="input-group date">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="text" name="date" class="form-control" readonly {!! $fieldPageConfig->attr('date') !!} />
								</div>
							</div>
						@endif
						@if ($fieldPageConfig->show('course_category_id'))
							<div class="col-sm-4">
								<label class=" control-label">Categoria</label>
								<select name="course_category_id" class="select2 form-control" {!! $fieldPageConfig->attr('course_category_id') !!}></select>
							</div>
						@endif

						{{--
						@if ($fieldPageConfig->show('course_id'))
							<div class="col-sm-4">
								<label class=" control-label">Curso</label>
								<select name="course_id[]" class="select2 form-control" {!! $fieldPageConfig->attr('course_id') !!}></select>
							</div>
						@endif
						--}}

						@if ($fieldPageConfig->show('team_id'))
							<div class="col-sm-4">
								<label class=" control-label">Responsável</label>
								<select name="team_id"  class="select2 form-control" {!! $fieldPageConfig->attr('team_id') !!}></select>
							</div>
						@endif

					</div>

					<div class="form-group row">
						@if ($fieldPageConfig->show('value_3'))
							<div class="col-sm-4">
								<label class="control-label">R$: Aluno</label>
								<input type="tel" name="value_3" class="form-control mask-currency" {!! $fieldPageConfig->attr('value_3') !!}/>
							</div>
						@endif

						@if ($fieldPageConfig->show('value_1'))
							<div class="col-sm-4">
								<label class="control-label">R$: Ex-alunos do CETCC</label>
								<input type="tel" name="value_1" class="form-control mask-currency" {!! $fieldPageConfig->attr('value_1') !!}/>
							</div>
						@endif

						@if ($fieldPageConfig->show('value_2'))
							<div class="col-sm-4">
								<label class="control-label">R$: Avulso</label>
								<input type="tel" name="value_2" class="form-control mask-currency" {!! $fieldPageConfig->attr('value_2') !!}/>
							</div>
						@endif

						@if ($fieldPageConfig->show('link'))
							<div class="col-sm-12">
								<label class="control-label">Link</label>
								<input type="text" name="link" class="form-control" {!! $fieldPageConfig->attr('link') !!}/>
							</div>
						@endif

					</div>

					<div class="form-group">
						<div class="col-sm-12 text-right">
							<button class="btn btn-white" type="submit">Cancelar</button>
							<button class="btn btn-primary" type="submit">Salvar alterações</button>
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
<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>
<script src="{!! asset('js/plugins/switchery/switchery.js') !!}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
	try {
		APP.scope.data = <?=isset($data) ? json_encode($data) : 'null'?>;
		APP.scope.listSelectBox = {!! isset($listSelectBox) ? json_encode($listSelectBox) : 'null' !!};

		if (APP.scope.listSelectBox) {
			if (APP.scope.listSelectBox.teacher) {
				populateSelectBox({
					list: APP.scope.listSelectBox.teacher,
					target: document.forms.formData.querySelector('[name="team_id"]'),
					columnValue: "id",
					columnLabel: "name",
				});
			}

			if (APP.scope.listSelectBox.courseCategory) {
				populateSelectBox({
					list: APP.scope.listSelectBox.courseCategory,
					target: document.forms.formData.querySelector('[name="course_category_id"]'),
					selectBy: APP.scope.data ? APP.scope.data.course_category_id : null,
					columnValue: "id",
					columnLabel: "description_pt",
					// emptyOption: {
					// 	label: "Selecione..."
					// }
				});
			}
		}

		if (APP.scope.data) {
			populate(document.forms.formData, APP.scope.data);
		} else {
			document.querySelector('[data-form-data="status"]').classList.add('hide')
			document.querySelector('[name="formData"] [name="status"]').checked = true
		}

		document.querySelectorAll('.js-switch').forEach(function(elem) {
			elem.switchery = new Switchery(elem, { color: '#1AB394' })

			console.log(elem.switchery);
		})

		setDatePicker('.date')
		$('.select2').select2()
	} catch (error) {
		console.warn(error);
	}
});
</script>
@endsection
