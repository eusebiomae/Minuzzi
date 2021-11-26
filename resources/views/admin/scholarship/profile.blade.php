@extends('layouts.app')

@section('title', $title.' Bolsa de Estudos')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
@endsection

@section('content')

@include($header)

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{$title}} Perfil do Bolsista</h5>
			</div>

			<div class="ibox-content">
				<div class="tabs-container">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#tab-active">Dados Pessoais</a></li>
						<li><a data-toggle="tab" href="#tab-inative">Dados Socioeconômicos</a></li>
					</ul>
					<div class="tab-content">
						<div id="tab-active" class="tab-pane active">
							<div class="panel-body">
								<div class="col-lg-12 animated fadeInLeft">
									<form name="formAccount" method="post" action="/student_area/account_data/save" enctype="multipart/form-data" class="form-horizontal">
										@include('student_area.account_data.formStudent')
										<div class="form-group">
											<div class="col-sm-4 col-sm-offset-9">
												<button class="btn btn-primary" type="submit">Salvar</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>

						<div id="tab-inative" class="tab-pane ">
							<div class="panel-body">
								<div class="col-lg-12 animated fadeInLeft">
									<form name="formSocioEconomic" method="post" action="/student_area/api/saveStudentSocioeconomic" enctype="multipart/form-data" class="form-horizontal form-row p-3">
										@include('student_area.account_data.formStudentSocioEconomic')
										<div class="form-group">
											<div class="col-sm-4 col-sm-offset-9">
												<button class="btn btn-primary" type="submit">Salvar</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
@parent

<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>

<script>
	$(document).ready(function(){
		try {
			APP.form = {!! json_encode($data ?? []) !!};
			populate(document.forms.formAccount, APP.form.student);
			populate(document.forms.formSocioEconomic, APP.form.student_socioeconomic);

			document.forms.formAccount.scholarship_id.value = APP.form.scholarship_id;
			document.forms.formSocioEconomic.scholarship_id.value = APP.form.scholarship_id;
		}catch(e){
			console.warn(e);
		}

		setDatePicker('.input-group.date');
	});
</script>
@endsection
