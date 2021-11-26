@extends('layouts.app')

{{-- @section('title', $module_page . ' ('. $title_page .')') --}}

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/clockpicker/clockpicker.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/switchery/switchery.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/dropzone.css') !!}" />
@endsection

@section('content')
@include($header)

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-lg-12">
							<form name="formCourse" method="post" action="{{ url($urlAction) }}" enctype="multipart/form-data" class="form-horizontal">
								{{ csrf_field() }}

								@if ($fieldPageConfig->show('title'))
									<div class="col-lg-12">
										<div class="form-group">
											<label class="col-sm-2 control-label">Tipo</label>
											<div class="col-sm-10">
												<input type="text" id="title" name="title" class="form-control" {!! $fieldPageConfig->attr('title') !!}>
												<span class="help-block m-b-none">Digite o tipo.</span>
											</div>
										</div>
									</div>
								@endif

								@if ($fieldPageConfig->show('description'))
									<div class="col-lg-12">
										<div class="form-group">
											<label class="col-sm-2 control-label">Descrição</label>
											<div class="col-sm-10">
												<input type="text" id="description" name="description" class="form-control" {!! $fieldPageConfig->attr('description') !!}>
												<span class="help-block m-b-none">Digite a Descrição.</span>
											</div>
										</div>
									</div>
								@endif
								<div class="col-lg-12">
									<div class="form-group">
										<label class="col-sm-2 control-label">Ocultar Tipo de Categoria</label>
										<div class="col-sm-2">
											<div class="switch">
												<div class="onoffswitch m-sm">
													<input type="checkbox" name="invisible" class="onoffswitch-checkbox" id="invisible" value="1" onchange = "makeInvisible()" />
													<label class="onoffswitch-label" for="invisible">
														<span class="onoffswitch-inner"></span>
														<span class="onoffswitch-switch"></span>
													</label>
												</div>
											</div>
										</div>

										<label class="col-sm-6 control-label divCourseConnected">Ocultar os cursos e bolsas deste tipo de categoria</label>
										<div class="col-sm-2 divCourseConnected">
											<div class="switch">
												<div class="onoffswitch m-sm">
													<input type="checkbox" name="invisible_connected" class="onoffswitch-checkbox" id="invisible_connected" value="1"/>
													<label class="onoffswitch-label" for="invisible_connected">
														<span class="onoffswitch-inner"></span>
														<span class="onoffswitch-switch"></span>
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-lg-12">
									<div class="form-group">
										@if ($fieldPageConfig->show('flg'))
											<label class="col-sm-2 control-label">Flag</label>
											<div class="col-sm-4">
												<input type="text" id="flg" name="flg" class="form-control" {!! $fieldPageConfig->attr('flg') !!}>
												<span class="help-block m-b-none">Digite a Flag de identificação</span>
											</div>
										@endif

										@if ($fieldPageConfig->show('type'))
											<label class="col-sm-2 control-label hide">Tipo</label>
											<div class="col-sm-4 hide">
												<input type="text" id="type" name="type" class="form-control" {!! $fieldPageConfig->attr('type') !!}>
												<span class="help-block m-b-none">Digite o Tipo</span>
											</div>
										@endif
									</div>
								</div>

								@if ($fieldPageConfig->show('image'))
								<div class="col-lg-12">
									<div class="form-group">
										<label class="col-sm-2 control-label">Imagem em destaque*</label>
										<div class="col-sm-10">
											<div class="fileinput fileinput-new input-group" data-provides="fileinput">
												<div class="form-control" data-trigger="fileinput">
													<i class="glyphicon glyphicon-file fileinput-exists"></i>
													<span class="fileinput-filename"></span>
												</div>
												<span class="input-group-addon btn btn-default btn-file">
													<span class="fileinput-new">Selecionar</span>
													<span class="fileinput-exists">Alterar</span>
													<input type="file" id="fileImage" name="fileImage" />
												</span>
												<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
											</div>
										</div>
									</div>
								</div>
								@endif

								<div class="col-sm-12 center">
									@if(isset($data) && isset($data['image']))
									<img height="200" src="{{ Storage::url("courseCategoryType/{$data['image']}") }}" />
									@endif
								</div>

								<div class="col-lg-12">
									<div class="col-lg-10">
									</div>
									<div class="col-lg-2">
										<div class="form-group">
											<button type="submit" class="btn btn-w-m btn-primary">Salvar</button>
										</div>
									</div>
								</div>
								<input id="id" name="id" type="hidden" value="">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<!-- Mainly scripts -->
<script src="{!! asset('js/plugins/metisMenu/jquery.metisMenu.js') !!}"></script>
<script src="{!! asset('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}"></script>
<script src="{!! asset('js/makeInvisibleField.js') !!}"></script>

<!-- Custom and plugin javascript -->
<script src="{!! asset('js/inspinia.js') !!}"></script>
<script src="{!! asset('js/plugins/pace/pace.min.js') !!}"></script>
<!-- SUMMERNOTE -->
<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}"></script>

<!-- Page-Level Scripts -->
<script src="{!! asset('js/plugins/dataTables/datatables.min.js') !!}"></script>
<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>
<script src="{!! asset('js/plugins/clockpicker/clockpicker.js') !!}"></script>
<script src="{!! asset('js/plugins/switchery/switchery.js') !!}"></script>
<script src="{!! asset('js/plugins/jasny/jasny-bootstrap.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/dropzone/dropzone.js') !!}" type="text/javascript"></script>
<script>
	$(document).ready(function() {
		try {
			APP = {
				scope: {
					course: <?=isset($data) ? json_encode($data) : 'null' ?>,
				}
			};

			if (APP.scope.course) {
				populate(document.forms.formCourse, APP.scope.course);
			}
		} catch(error) {
			console.warn(error);
		}

		$('.summernote').summernote({
			height: 100,
			toolbar: false,
			placeholder: 'Digite seu conteúdo',
			required: true
		});

		makeInvisible();
	});

</script>
@endsection
