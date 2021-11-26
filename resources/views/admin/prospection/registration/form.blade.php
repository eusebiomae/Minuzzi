@extends('layouts.app')

@section('title', 'Dados do aluno')

@section('css')
	<link rel="stylesheet" href="{!! asset('css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/select2/select2.min.css') !!}" />

	<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/basic.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/dropzone.css') !!}" />

	<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" >
	{{-- <link rel="stylesheet" href="{!! asset('css/plugins/switchery/switchery.css') !!}" > --}}

@endsection

@section('content')

	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Dados da Conta <small>Cadastro e edição do usuário</small></h5>
				</div>
				<div class="ibox-content">
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

		<div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Matriculas  <small>Lista de todas as Inscrição já feita.</small></h5>
        </div>
        <div class="ibox-content">
          <div class="table-responsive">
            @include('admin.prospection.registration.dataTables', [ 'dataTable' => $payload->orders ])
          </div>
        </div>
      </div>
		</div>

	</div>
@endsection

@section('scripts')
@parent
	<script>
		document.addEventListener('DOMContentLoaded', function() {

		});
	</script>
@endsection
