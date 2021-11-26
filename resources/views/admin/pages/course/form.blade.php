@extends('layouts.app')

@section('title', $config->title)

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
{{-- <link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" /> --}}
<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/clockpicker/clockpicker.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/switchery/switchery.css') !!}" />

<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/basic.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/dropzone.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/select2/select2.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/iCheck/custom.css')!!}" >
{{--MODEL--}}
<link rel="stylesheet" href="{!! asset('css/plugins/sweetalert/sweetalert.css') !!}">
{{-- <link rel="stylesheet" href="{!! asset('cetcc/css/icon_fonts/css/all_icons.min.css') !!}" > --}}
@endsection

@section('content')
@include($config->header)

<div class="wrapper wrapper-content animated fadeInTop">
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

							<div class="tabs-container">
								<ul class="nav nav-tabs">
									<li class="active"><a data-toggle="tab" href="#tab-1">Dados do Produto</a></li>
									{{-- <li><a class="" data-toggle="tab" href="#tab-2">Vantagens</a></li> --}}
									<li><a class="" data-toggle="tab" href="#tab-3">Valores</a></li>
									{{-- <li><a class="" data-toggle="tab" href="#tab-4">Professores</a></li> --}}
									{{-- <li><a class="" data-toggle="tab" href="#tab-5">Módulos</a></li> --}}
									<li><a class="" data-toggle="tab" href="#tab-additional">Adicionais</a></li>
									<li><a class="" data-toggle="tab" href="#tab-discount">Cupom de desconto</a></li>
									<li><a class="" data-toggle="tab" href="#tab-class">Turmas</a></li>
								</ul>
								<form name="formCourse" method="post" action="{{ url($config->urlAction) }}" class="form-horizontal" enctype="multipart/form-data">
									{{ csrf_field() }}
									<input id="id" name="id" type="hidden" value="">
									<div class="tab-content">

										<div id="tab-1" class="tab-pane active">
											<div class="panel-body">
												<div class="col-lg-12 animated fadeInLeft">
													<div class="form-group">
														<div class="col-sm-4">
															<label class="control-label">Tipo Categoria</label>
															<select class="form-control" name="course_category_type_id"></select>
														</div>
														<div class="col-sm-4">
															<label class="control-label">Categoria</label>
															<div class="gp-block-ruby">
																<select name="course_category_id" class="select2_demo_1 form-control" required></select>
																<button type="button" class="m-l-xs btn gp-btn-green " data-target="#courseCategoryModel" title="Nova opção" onclick="openModalNewItemSelect(event, 'course_category_id')">
																	<i class="fa fa-plus"></i>
																</button>
															</div>
														</div>
														<div class="col-sm-4">
															<label class="control-label">Subcategoria</label>
															<select name="course_subcategory_id" class="select2_demo_1 form-control"></select>
														</div>
														<div class="col-sm-6">
															<label class=" control-label">Título</label>
															<input type="text" id="title_pt" name="title_pt" class="form-control" value=""  required>
														</div>
														<div class="col-sm-12">
															<label class=" control-label">Título EN</label>
															<input type="text" id="title_en" name="title_en" class="form-control" value="" >
														</div>
														<div class="col-sm-12">
															<label class=" control-label">Título ES</label>
															<input type="text" id="title_es" name="title_es" class="form-control" value="" >
														</div>
														<div class="col-sm-6">
															<label class=" control-label">Subtítulo</label>
															<input type="text" id="subtitle_pt" name="subtitle_pt" class="form-control" value="">
														</div>
														<div class="col-sm-12">
															<label class=" control-label">Subtítulo EN</label>
															<input type="text" id="subtitle_en" name="subtitle_en" class="form-control" value="" >
														</div>
														<div class="col-sm-12">
															<label class=" control-label">Subtítulo ES</label>
															<input type="text" id="subtitle_es" name="subtitle_es" class="form-control" value="" >
														</div>
														{{-- <div class="col-sm-3 date">
															<label class="control-label">Data de Início</label>
															<div class="input-group date">
																<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																<input type="text" id="start_date" name="start_date" class="form-control" readonly>
															</div>
														</div> --}}
														{{-- <div class="col-sm-3 date">
															<label class="control-label">Data de Termino</label>
															<div class="input-group date">
																<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																<input type="text" id="end_date" name="end_date" class="form-control" readonly>
															</div>
														</div> --}}

														{{-- <div class="col-sm-4">
															<label class=" control-label">Carga Horário</label>
															<input type="text" id="hours_load" name="hours_load" class="form-control">
														</div> --}}

														{{-- <div class="col-sm-4">
															<label class=" control-label">Duração</label>
															<input type="text" name="duration" class="form-control">
														</div> --}}

														{{-- <div class="col-sm-4">
															<label class=" control-label">Porcentagem mínima da carga horária</label>
															<input type="text" name="min_percentage_workload" class="form-control">
														</div> --}}

														{{-- <div class="col-sm-4">
															<label class=" control-label">Quantidade de Módulos</label>
															<input type="text" name="number_modules" class="form-control">
														</div> --}}

														{{-- <div class="col-sm-4">
															<label class="control-label">Local</label>
															<select name="place_id" class="select2_demo_1 form-control"></select>
														</div> --}}

														{{-- <div class="col-sm-4">
															<label class="control-label">Certificado</label>
															<input type="text" id="certified" name="certified" class="form-control" maxlength="512" placeholder="MEC e CFP">
														</div> --}}

														{{-- <div class="col-sm-4">
															<label class="control-label">Coordenador(a)</label>
															<select name="team_id" class="select2_demo_1 form-control"></select>
														</div> --}}

														{{-- <div class="col-sm-4">
															<label class="control-label">Link de Vídeo</label>
															<input type="text" id="video_link" name="video_link" class="form-control" maxlength="255">
														</div> --}}

														{{-- <div class="col-sm-4">
															<label class="control-label">Horas de Atendimento em consultório</label>
															<input type="text" name="service_hours" class="form-control" maxlength="11">
														</div> --}}

														{{-- <div class="col-sm-4">
															<label class="control-label">Horas de Supervisão monitorada</label>
															<input type="text" name="hours_monitored_supervision" class="form-control" maxlength="11">
														</div> --}}

														<div class="col-sm-4" style="padding-top: 25px">
															<label class="control-label">Destaque</label>
															<input type="checkbox" id="show_home" name="show_home" class="js-switch" value="featured">
														</div>

														<div class="col-sm-4" style="padding-top: 25px">
															<label class="control-label">Mais Vendidos</label>
															<input type="checkbox" id="best_seller" name="best_seller" class="js-switch" value="best_seller">
														</div>

														<div class="col-sm-4" style="padding-top: 25px">
															<label class="control-label">Novos Sabores</label>
															<input type="checkbox" id="new_flavor" name="new_flavor" class="js-switch" value="new_flavor">
														</div>

														{{-- <div class="col-sm-5" style="padding-top: 25px">
															<label class="control-label">Inativo</label>
															<div class="switch">
																<div class="onoffswitch">
																	<input type="checkbox" class="onoffswitch-checkbox" id="inactive" name="inactive" value="1">
																	<label class="onoffswitch-label" for="inactive">
																		<span class="onoffswitch-inner"></span>
																		<span class="onoffswitch-switch"></span>
																	</label>
																</div>
															</div>
														</div> --}}
													</div>

													<div class="form-group">
														<label>Descrição</label>
														<div class="ibox-content no-padding">
															<textarea id="description_pt" name="description_pt" class="summernote"></textarea>
														</div>
													</div>

													<div class="form-group">
														<label>Descrição EN</label>
														<div class="ibox-content no-padding">
															<textarea id="description_en" name="description_en" class="summernote"></textarea>
														</div>
													</div>

													<div class="form-group">
														<label>Descrição ES</label>
														<div class="ibox-content no-padding">
															<textarea id="description_es" name="description_es" class="summernote"></textarea>
														</div>
													</div>

													<div class="col-lg-12">
														<div class="form-group">
															<label class="col-sm-2 control-label">Imagem em destaque*</label>
															<div class="col-sm-10">
																<div class="fileinput fileinput-new input-group" data-provides="fileinput">
																	<div class="form-control" data-trigger="fileinput">
																		<i class="glyphicon glyphicon-file fileinput-exists"></i>
																		<span class="fileinput-filename-img" id="fileinput-filename-img"></span>
																	</div>
																	<span class="input-group-addon btn btn-default btn-file">
																		<span class="fileinput-new">Selecionar</span>
																		<span class="fileinput-exists">Alterar</span>
																		<input type="file" id="fileImageCourse" name="fileImage" value="">
																	</span>
																	<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
																</div>
																<div class="img">
																	<img id="imgCourse" width="200px">
																</div>
															</div>
														</div>
													</div>
												</div>

											</div>
										</div>

										{{-- <div id="tab-2" class="tab-pane">
											<div class="panel-body">
												<div class="wrapper wrapper-content animated fadeInRight">
													<button type="button" class="m-l-xs btn gp-btn-green " data-toggle="modal" data-target="#bonusCourseModel" title="Nova opção"><i class="fa fa-plus"></i></button>
													<div id="bonusCourse"></div>
												</div>
											</div>
										</div> --}}

										<div id="tab-3" class="tab-pane">
											<div class="panel-body">
												<div class="wrapper wrapper-content animated fadeInRight">
													<div class="text-right">
														<button type="button" class="btn btn-primary" title="Adicionar novo" onclick="newFormsPayment()">
															<i class="fa fa-plus"></i>
														</button>
													</div>

													<div id="formPayment"></div>
													{{-- <div class="form-group">
														<label class="control-label">
															Valor padrão do curso
															<input type="checkbox" name="course_default_value" class="form-control" value="1" {{ isset($courseDefaultValue) ? 'checked' : '' }} />
														</label>
													</div> --}}
												</div>
											</div>
										</div>

										{{-- <div id="tab-4" class="tab-pane">
											<div class="panel-body">
												<div class="wrapper wrapper-content animated fadeInRight">
													<div class="text-right m-b-md">
														<button type="button" class="btn btn-primary" title="Adicionar novo" onclick="newTeacher()">
															<i class="fa fa-plus"></i>
														</button>
													</div>

													<div id="teacher"></div>

												</div>
											</div>
										</div> --}}

										{{-- <div id="tab-5" class="tab-pane">
											<div class="panel-body">
												<div class="wrapper wrapper-content animated fadeInRight">
													<div class="col-sm-10">
														<h3>Relacionamento de módulos</h3>
													</div>
													<div class="col-sm-2">
														<div class="text-right m-b-md">
															<button type="button" class="btn btn-primary" title="Adicionar novo" onclick="newModule()" >
																<i class="fa fa-plus"></i>
															</button>
														</div>
													</div>
													<div class="col-sm-12">
														<div id="module"></div>
													</div>
												</div>
											</div>
										</div> --}}

										<div id="tab-additional" class="tab-pane">
											<div class="panel-body">
												@include('admin.tmpl.tmplListAdditional')
											</div>
										</div>

										<div id="tab-discount" class="tab-pane">
											<div class="panel-body">
												@include('admin.tmpl.tmplListDiscount')
											</div>
										</div>

										<div id="tab-class" class="tab-pane">
											@if (isset($payload->class))
												@include('admin._components.dataTablesJs', ['dataTable' => $payload->class])
											@endif
										</div>

										<div class="row" style="padding-top: 15px">
											<div class="col-lg-10"></div>
											<div class="col-lg-2">
												<div class="form-group">
													<button type="submit" class="btn btn-w-m btn-primary">Salvar</button>
												</div>
											</div>
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

{{-- MODALS --}}

{{-- CourseCategoryModal --}}
<div class="modal inmodal" id="courseCategoryModel" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<i class="modal-icon fa fa-book"></i>
				<h4 class="modal-title">Cadastrar nova Categoria</h4>
			</div>
			<div class="modal-body gp-m-1">
				<form name="formCourseCategoryModal" class="form-horizontal" onsubmit="submitFormCourseCategoryModal(event)">
					@include('admin.pages.courseCategory.form')
					<div class="form-group">
						<div class="col-sm-12 text-right">
							<button class="btn btn-white gp-alert" data-gp-alert="cancel" type="reset">Cancelar</button>
							<button class="btn btn-primary" type="submit">Salvar alterações</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	function submitFormCourseCategoryModal(event) {
		event.preventDefault();

		var data = new FormData(event.target)

		$.ajax({
			url: '/api/save',
			type: "POST",
			enctype: 'multipart/form-data',
			processData: false,
			contentType: false,
			headers: {
				method: 'courseCategory',
			},
			data: data,
		}).then(function(resp) {
			$('#courseCategoryModel').modal('hide')
			$('#courseCategoryModel form')[0].reset()

			if (resp) {
				APP.listSelectBox.courseCategory.push(resp)

				var option = document.createElement("option");

				option.text = resp.description_pt
				option.value = resp.id

				document.forms.formCourse.course_category_id.add(option)

				APP.targetSelectModal.value = resp.id
				$(APP.targetSelectModal).select2()
			}

		})
	}
</script>
{{--/ CourseCategoryModal /--}}

{{-- bonusCourseModel --}}

{{-- <div class="modal inmodal" id="bonusCourseModel" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<i class="modal-icon fa fa-star"></i>
				<h4 class="modal-title">Cadastrar nova Vantagem</h4>
			</div>
			<div class="modal-body gp-m-1">
				<form name="formBonusCourseModel" class="form-horizontal" onsubmit="submitFormBonusCourseModel(event)">
					@include('admin.pages.bonusCourse.form')
					<div class="form-group">
						<div class="col-sm-12 text-right">
							<button class="btn btn-white gp-alert" data-gp-alert="cancel" type="reset">Cancelar</button>
							<button class="btn btn-primary" type="submit">Salvar alterações</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div> --}}

<script>
	function submitFormBonusCourseModel(event) {
		event.preventDefault();

		var data = new FormData(event.target)

		$.ajax({
			url: '/api/save',
			type: "POST",
			enctype: 'multipart/form-data',
			processData: false,
			contentType: false,
			headers: {
				method: 'bonusCourse',
			},
			data: data,
		}).then(function(resp) {
			$('#bonusCourseModel').modal('hide')
			$('#bonusCourseModel form')[0].reset()

			if (resp) {
				APP.listSelectBox.bonusCourse.push(resp)

				newBonusCourse(resp, true)
			}

		})
	}
</script>
{{--/ bonusCourseModel /--}}

{{-- paymentModal --}}
<div class="modal inmodal" id="formPaymentModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<i class="modal-icon fa fa-dollar"></i>
				<h4 class="modal-title">Cadastrar nova forma de Pagamento</h4>
			</div>
			<form name="formFormPaymentModal" class="form-horizontal" onsubmit="submitFormFormPaymentModal(event)">
				<div class="modal-body gp-m-1">
					@include('admin.pages.form_payment.form')
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white gp-alert" data-gp-alert="cancel" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary gp-alert" data-gp-alert="save">Salvar Mudanças</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	function submitFormFormPaymentModal(event) {
		event.preventDefault();

		var data = new FormData(event.target)

		$.ajax({
			url: '/api/save',
			type: "POST",
			enctype: 'multipart/form-data',
			processData: false,
			contentType: false,
			headers: {
				method: 'formPayment',
			},
			data: data,
		}).then(function(resp) {
			$('#formPaymentModal').modal('hide')
			$('#formPaymentModal form')[0].reset()

			if (resp) {
				APP.listSelectBox.formPayment.push(resp)

				document.getElementById('formPayment').querySelectorAll('[name$="[form_payment_id]"]').forEach(function(elem) {
					var option = document.createElement("option");

					option.text = resp.description
					option.value = resp.id

					elem.add(option)
				})

				APP.targetSelectModal.value = resp.id
				$(APP.targetSelectModal).select2()
			}
		})
	}
</script>
{{--/ paymentModal /--}}

{{-- teacherModal --}}
<div class="modal inmodal" id="teacherModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<i class="modal-icon fa fa-address-card"></i>
				<h4 class="modal-title">Cadastrar novo Professor(a)</h4>
			</div>
			<div class="modal-body gp-m-1">
				<form name="formTeacherModal" class="form-horizontal" onsubmit="submitFormTeacherModal(event)">
					@include('admin.pages.team.form')
					<div class="form-group">
						<div class="col-sm-12 text-right">
							<button class="btn btn-white gp-alert" data-gp-alert="cancel" type="reset">Cancelar</button>
							<button class="btn btn-primary" type="submit">Salvar alterações</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	function submitFormTeacherModal(event) {
		event.preventDefault();

		var data = new FormData(event.target)

		$.ajax({
			url: '/api/save',
			type: "POST",
			enctype: 'multipart/form-data',
			processData: false,
			contentType: false,
			headers: {
				method: 'team',
			},
			data: data,
		}).then(function(resp) {
			$('#teacherModal').modal('hide')
			$('#teacherModal form')[0].reset()

			if (resp) {
				APP.listSelectBox.team.push(resp)

				document.getElementById('teacher').querySelectorAll('[name$="[team_id]"]').forEach(function(elem) {
					var option = document.createElement("option");

					option.text = resp.name
					option.value = resp.id

					elem.add(option)
				})

				APP.targetSelectModal.value = resp.id
				$(APP.targetSelectModal).select2()
			}

		})

	}
</script>
{{--/ teacherModal /--}}

{{--/ MODALS /--}}

<script id="tmplBonusCourse" type="text/x-dot-template">
</script>

<script id="tmplFormsPayment" type="text/x-dot-template">
	<div class="form-group" style="border-radius: 5px; border: 1px solid #ddd; padding-bottom: 5px" data-key="@{{= it.key }}">
		<input type="hidden" name="formPayment[@{{= it.key }}][id]" value="@{{= it.id }}" />
		<div class="col-sm-2">
			<label class="control-label">Descrição</label>
			<input type="text" name="formPayment[@{{= it.key }}][description]" class="form-control" value="@{{= it.description || '' }}" maxlength="255"/>
		</div>
		<div class="col-sm-3">
			<label class="control-label">Forma de Pagamento</label>
			<div class="gp-w-80">
				<select name="formPayment[@{{= it.key }}][form_payment_id]" class="select2_demo_1 form-control" value="@{{= it.form_payment_id }}"></select>
			</div>
			<button type="button" class="m-l-xs btn gp-btn-green" data-target="#formPaymentModal" title="Nova opção" onclick="openModalNewItemSelect(event, 'formPayment[@{{= it.key }}][form_payment_id]')">
				<i class="fa fa-plus"></i>
			</button>
		</div>
		<div class="col-sm-2">
			<label class=" control-label">Total</label>
			<input type="text" name="formPayment[@{{= it.key }}][full_value]" class="form-control mask-currency" value="@{{= it.full_value || '0' }}" readonly onkeyup="recalcValues('@{{= it.key }}', 'full_value')">
		</div>
		<div class="col-sm-1">
			<label class=" control-label">Parcelas</label>
			<input type="number" name="formPayment[@{{= it.key }}][parcel]" class="form-control" value="@{{= it.parcel || '0' }}" maxlength="5" onkeyup="recalcValues('@{{= it.key }}', 'parcel')" onchange="recalcValues('@{{= it.key}}', 'parcel')">
		</div>
		<div class="col-sm-2">
			<label class=" control-label">Valor da Parcela</label>
			<input type="tel" name="formPayment[@{{= it.key }}][value]" class="form-control mask-currency" value="@{{= it.value || '0' }}" onkeyup="recalcValues('@{{= it.key }}', 'value')">
		</div>
		<div class="col-sm-1  m-t-md">
			<label class="control-label i-checks">
				<input type="checkbox" name="formPayment[@{{= it.key }}][flg_main]" class="form-control" value="S" onclick="onFlgMainFormsPayment(event)" />
				<b class="m-l-xs">Valor principal</b>
			</label>
		</div>
		<div class="col-sm-1 text-right" style="padding-top: 25px; cursor: pointer; color: #f00">
			<button type="button" class="btn btn-danger p-2" title="Excluir" onclick="removeFormGroup(event)">
				<i class="fa fa-times"></i>
			</button>
		</div>
		{{-- <div class="col-sm-12">
			<label class="control-label">Link</label>
			<input type="text" name="formPayment[@{{= it.key }}][link]" class="form-control" value="@{{= it.link || '' }}" maxlength="255"/>
		</div> --}}
	</div>
</script>

<script id="tmplTeacher" type="text/x-dot-template">
	<div class="form-group" style="border-radius: 5px; border: 1px solid #ddd; padding-bottom: 5px">
		<input type="hidden" name="teacher[@{{= it.key }}][id]" value="@{{= it.id }}" />
		<div class="col-sm-4">
			<label class="control-label">Professor(a)</label>
			<div class="gp-w-90">
				<select name="teacher[@{{= it.key }}][team_id]" class="select2_demo_1 form-control" value="@{{= it.team_id }}"></select>
			</div>
			<button type="button" class="m-l-xs btn gp-btn-green" data-target="#teacherModal" title="Nova opção" onclick="openModalNewItemSelect(event, 'teacher[@{{= it.key }}][team_id]')">
				<i class="fa fa-plus"></i>
			</button>
		</div>
		<div class="col-sm-6">
			<label class=" control-label">Descrição</label>
			<input type="text" name="teacher[@{{= it.key }}][description]" class="form-control" value="@{{= it.description }}" maxlength="1024">
		</div>
		<div class="col-sm-2 text-right" style="padding-top: 25px; cursor: pointer; color: #f00">
			<button type="button" class="btn btn-danger p-2" title="Excluir" onclick="removeFormGroup(event)">
				<i class="fa fa-times"></i>
			</button>
		</div>
	</div>
</script>

<script id="tmplModule" type="text/x-dot-template">
	<div class="form-group" style="border-radius: 5px; border: 1px solid #ddd; padding-bottom: 5px" data-module>
		<input type="hidden" name="module[@{{= it.key }}][id]" value="@{{= it.id }}" />

		<div class="row p-w-sm">
			<div class="col-sm-1">
				<label class="control-label">Sequência</label>
				<input type="number" name="module[@{{= it.key }}][sequence]" class="form-control" value="@{{= it.sequence || '' }}">
			</div>
			<div class="col-sm-2">
				<label class=" control-label">Data da Aula</label>
				<div class="input-group date">
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					<input type="text" name="module[@{{= it.key }}][start_date]" class="form-control" readonly value="@{{= it.start_date || '' }}">
				</div>
			</div>
			<div class="col-sm-6">
				<label class="control-label">Módulo</label>
				<div class="gp-block-ruby">
					<select name="module[@{{= it.key }}][content_course_id]" class="select2_demo_1 form-control" value="@{{= it.content_course_id || '' }}"></select>
					<button type="button" class="m-l-xs btn gp-btn-green" onclick="openModalNewItemSelect(event, 'module[@{{= it.key }}][content_course_id]')" data-target="#module-modal" title="Nova opção">
						<i class="fa fa-plus"></i>
					</button>
				</div>
			</div>
			<div class="col-sm-2 text-end" style="padding-top: 25px; cursor: pointer;">
				<div class="radio-group">
					<input type="radio" id="presential_@{{= it.key }}" name="module[@{{= it.key }}][type]" value="presential">
					<label class="text-uppercase" for="presential_@{{= it.key }}">Presencial</label>
					<input type="radio" id="online_@{{= it.key }}" name="module[@{{= it.key }}][type]" value="online">
					<label class="text-uppercase" for="online_@{{= it.key }}">Online</label>
				</div>
			</div>
			<div class="col-sm-1 text-right" style="padding-top: 25px; cursor: pointer; color: #f00">
				<button type="button" class="btn btn-danger p-2" title="Excluir" onclick="removeFormGroup(event)">
					<i class="fa fa-times"></i>
				</button>
			</div>
		</div>
	</div>
</script>

@endsection

@section('scripts')
@parent
<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}"></script>

<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>
<script src="{!! asset('js/plugins/clockpicker/clockpicker.js') !!}"></script>
<script src="{!! asset('js/plugins/switchery/switchery.js') !!}"></script>
<script src="{!! asset('js/plugins/dropzone/dropzone.js') !!}"></script>
<script src="{!! asset('js/plugins/select2/select2.full.min.js') !!}" type="text/javascript"></script>

<script>
	function removeFormGroup(event) {
		event.target.closest('.form-group').remove();
	}

	function onFlgMainFormsPayment(event) {
		document.getElementById('tab-2').querySelectorAll('[name$="[flg_main]"]').forEach(function(item) { item.checked = false })

		event.target.checked = true
	}

	// NOVA FORMA DE PAGAMENTO
	function newFormsPayment(data) {
		if (data) {
			data.key = generateUniqueKey()
		} else {
			data = {
				id: '',
				form_payment_id: '',
				full_value: '0',
				value: '0',
				parcel: 1,
				key: generateUniqueKey(),
			};
		}

		var formPayment = setTmplInsertAdjacentHTML({
			tmpl: 'tmplFormsPayment',
			toTmpl: 'formPayment',
			data: data,
		});

		if (data && data.flg_main) {
			formPayment.querySelector('[name$="[flg_main]"]').checked = true
		}

		var selectElem = formPayment.querySelector('[name$="[form_payment_id]"]')

		populateSelectBox({
			list: APP.listSelectBox.formPayment,
			target: formPayment.querySelector('[name$="[form_payment_id]"]'),
			columnValue: "id",
			columnLabel: "description",
			selectBy: data ? [data.form_payment_id] : null,
			emptyOption: {
				label: "Selecione..."
			}
		});

		$(selectElem).select2();
		updateInputMask()
	}

	// NOVA PROFESSOR
	function newTeacher(data) {
		if (!data) {
			data = {
				id: '',
				team_id: '',
				description: '',
			};
		}

		data.key = generateUniqueKey()

		var tmplTeacher = setTmplInsertAdjacentHTML({
			tmpl: 'tmplTeacher',
			toTmpl: 'teacher',
			data: data,
		});

		if (tmplTeacher) {
			var selectElem = tmplTeacher.querySelector('[name$="[team_id]"]')

			populateSelectBox({
				list: APP.listSelectBox.team,
				target: selectElem,
				columnValue: "id",
				columnLabel: "name",
				selectBy: [ data.team_id ],
				emptyOption: {
					label: "Selecione..."
				}
			});

			$(selectElem).select2();
		}
	}

	function newBonusCourse(data, checked) {
		document.getElementById('bonusCourse').innerHTML += '<label class="i-checks" style="border:1px solid #ddd; border-radius: 5px;margin: 10px 5px;padding: 10px 6px;cursor:pointer">\
			<input type="checkbox" name="bonusCourse[]" value="'+ data.id +'" '+ (checked ? 'checked' : '') +'> '+ data.title_pt +'\
		</label>'
	}

	function newModule(data) {
		if (!data) {
			data = {
				id: '',
				content_course_id: '',
				type: 'presential',
				sequence: document.getElementById('module').childElementCount + 1,
			};
		}

		data.key = generateUniqueKey()

		var tmplModule = setTmplInsertAdjacentHTML({
			tmpl: 'tmplModule',
			toTmpl: 'module',
			data: data,
		});

		try {
			if (tmplModule) {
				var selectElem = tmplModule.querySelector('[name$="[content_course_id]"]')

				populateSelectBox({
					list: APP.listSelectBox.contentCourse,
					target: selectElem,
					columnValue: "id",
					columnLabel: "title_pt",
					selectBy: [ data.content_course_id ],
					emptyOption: {
						label: "Selecione..."
					}
				});

				$(selectElem).select2()

				if (data.type) {
					tmplModule.querySelector('[name$="[type]"][value="' + data.type + '"]').checked = true
				}

				// if (data.number_of_classes) {
				// 	tmplModule.querySelector('[name$="[number_of_classes]"][value="' + data.number_of_classes + '"]').checked = true
				// }

				setDatePicker(tmplModule.querySelector('[name$="[start_date]"]'))
			}
		} catch (error) {
			console.warn(error)
		}

	}

	function recalcValues(key, name) {
		var elems = {
			parent: document.querySelector('div[data-key=' + key + ']'),
		}

		elems.fullValue = elems.parent.querySelector('[name$="[full_value]"]')
		elems.parcel = elems.parent.querySelector('[name$="[parcel]"]')
		elems.value = elems.parent.querySelector('[name$="[value]"]')

		switch (name) {
			// case 'full_value':
				// elems.value.value = (strToNumber(elems.fullValue.value) / elems.parcel.value).toFixed(2)
				// break;
			case 'parcel':
				// elems.value.value = (strToNumber(elems.fullValue.value) / elems.parcel.value).toFixed(2)
				elems.fullValue.value = (strToNumber(elems.value.value) * elems.parcel.value).toFixed(2)
				break;
			case 'value':
				// elems.parcel.value = (strToNumber(elems.fullValue.value) / strToNumber(elems.value.value))
				elems.fullValue.value = (strToNumber(elems.value.value) * elems.parcel.value).toFixed(2)
				break;
		}
	}

	// APP
	$(document).ready(function() {
		try {
			APP = {
				payload: {!! isset($payload) ? json_encode($payload) : '{}' !!},
				listSelectBox: {!! isset($listSelectBox) ? json_encode($listSelectBox) : 'null' !!},
				course: {!! isset($data) ? json_encode($data) : 'null' !!},
				pathFile: {!! isset($pathFile) ? json_encode($pathFile) : 'null' !!},

			};

			var payloadData = APP.payload.data;
			var formCourse = document.forms.formCourse;
			var listSelectBoxData = APP.listSelectBox;

				if (payloadData) {
				payloadData.value = parseFloat(payloadData.value);

				populate(document.forms.formCourse, payloadData);

			}


			// LISTAR SELECTBOXS
			if (listSelectBoxData) {

				// CURSO CATEGORIA
				if (listSelectBoxData.courseCategory) {
					populateSelectBox({
						list: listSelectBoxData.courseCategory,
						target: formCourse.course_category_id,
						columnValue: "id",
						columnLabel: "description_pt",
						selectBy: (payloadData && payloadData.course_category_id) ? [payloadData.course_category_id] : null,
						emptyOption: {
							label: "Selecione..."
						}
					});
				}

				// CURSO CATEGORIA TIPO
				if (listSelectBoxData.courseCategoryType) {
					populateSelectBox({
						list: listSelectBoxData.courseCategoryType,
						target: formCourse.course_category_type_id,
						columnValue: "id",
						columnLabel: "title",
						selectBy: (payloadData && payloadData.course_category_type_id) ? [payloadData.course_category_type_id] : null,
						emptyOption: {
							label: "Selecione..."
						}
					});
				}

				// CURSO SUBCATEGORIA
				if (listSelectBoxData.courseSubcategory) {
					populateSelectBox({
						list: listSelectBoxData.courseSubcategory,
						target: formCourse.course_subcategory_id,
						columnValue: "id",
						columnLabel: "description_pt",
						selectBy: (payloadData && payloadData.course_subcategory_id) ? [payloadData.course_subcategory_id] : null,
						emptyOption: {
							label: "Selecione..."
						}
					});
				}

				// TIME
				if (listSelectBoxData.team) {
					populateSelectBox({
						list: listSelectBoxData.team,
						target: formCourse.team_id,
						columnValue: "id",
						columnLabel: "name",
						selectBy: (payloadData && payloadData.team_id) ? [payloadData.team_id] : null,
						emptyOption: {
							label: "Selecione..."
						}
					});
				}

				// VANTAGENS CURSO
				if (listSelectBoxData.bonusCourse && document.getElementById('bonusCourse')) {
					document.getElementById('bonusCourse').innerHTML = ''

					listSelectBoxData.bonusCourse.forEach(function(item) {
						var checked = false

						if (payloadData && payloadData.bonusCourse) {
							for (i = payloadData.bonusCourse.length - 1; i > -1; i--) {
								if (payloadData.bonusCourse[i].bonus_course_id == item.id) {
									checked = true
									break
								}
							}
						}

						newBonusCourse(item, checked)
					})
				}

				// PLACE
				/* if (listSelectBoxData.place) {
					populateSelectBox({
						list: listSelectBoxData.place,
						target: document.forms.formCourse.place_id,
						columnValue: "id",
						columnLabel: "description",
						selectBy: (APP.course && APP.course.place_id) ? [APP.course.place_id] : null,
						emptyOption: {
							label: "Selecione..."
						}
					});
				} */
			}



			if (APP.course) {
				APP.course.value = parseFloat(APP.course.value);

				populate(document.forms.formCourse, APP.course);

				if (APP.course.img) {
					var img = document.createElement('img');
					img.setAttribute('src', APP.course.img);
					img.style.maxHeight = '100px';

					document.getElementById('imgCourse').appendChild(img);
				}
			}

			if (payloadData) {

				if (payloadData.course_form_payment && payloadData.course_form_payment.length) {
					payloadData.course_form_payment.forEach(newFormsPayment);
				} else {
					newFormsPayment()
				}

				if (payloadData.teacher && payloadData.teacher.length) {
					payloadData.teacher.forEach(newTeacher);
				} else {
					newTeacher()
				}

				if (payloadData.course_module && payloadData.course_module.length) {
					payloadData.course_module.forEach(newModule);
				} else {
					newModule()
				}

				if (payloadData.course_additional && payloadData.course_additional.length) {
					payloadData.course_additional.forEach(newAdditional);
				} else {
					newAdditional()
				}

				if (payloadData.course_discount && payloadData.course_discount.length) {
					payloadData.course_discount.forEach(newDiscount);
				} else {
					newDiscount()
				}
			}

			formCourse.fileImage.addEventListener('change', function(event) {
				// console.log(event.target.files[0]);
				document.getElementById('imgCourse').src = URL.createObjectURL(event.target.files[0])
				document.getElementById('imgCourse').alt = 'img_' +  event.target.files[0]
				document.getElementById('fileinput-filename-img').innerText = event.target.files[0].name
			})

			if (APP.payload.data && APP.payload.data.img){
					document.getElementById('imgCourse').src = APP.payload.data.img
					document.getElementById('imgCourse').alt = 'img_' + APP.payload.data.img
				}

			var elem = document.querySelector('.js-switch');
			if (elem) {
				var switchery = new Switchery(elem, { color: '#1AB394' });
			}

			$('.summernote').summernote({
				height: 250,
				placeholder: 'Digite seu conteúdo'
			});

			//  Sweet alert
			$('.gp-alert').click(function ($event) {
				try {
					var gpAlertKey = $event.target.dataset.gpAlert;
					var mapAlert = {
						markPay: {
							params: {
								title: "Deseja excluir a transação?",
								text: "Essa ação exclui todas as transações desta fatura e é IRREVERSÍVEL.",
								type: "warning",
							},
							callback: function () {
								swal("Feito!", "Excluir a transação.", "success");
							}
						},
						delete: {
							params: {
								title: "Deseja excluir esta fatura?",
								text: "Essa ação é IRREVERSÍVEL",
								type: "warning",
							},
							callback: function () {
								swal("Feito!", "Excluido esta fatura.", "success");
							}
						},
						cancel: {
							params: {
								title: "Cancelado",
								text: "As modificações não foram salvas",
								type: "error",
								showCancelButton: false,
								confirmButtonText: "Ok",
								confirmButtonColor: "#1a7bb9"
							}
						},
						save: {
							params: {
								title: "Salvo com Sucesso",
								text: "As modificações foram salvas",
								type: "success",
								showCancelButton: false,
								confirmButtonText: "Ok",
								confirmButtonColor: "#1a7bb9"
							}
						},
					}

					swal(Object.assign({
						title: "Tem certeza disso?",
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Sim",
						showCancelButton: true,
						closeOnConfirm: false
					}, mapAlert[gpAlertKey].params), mapAlert[gpAlertKey].callback);
				} catch (error) {
					console.warn(error)
				}
			});
		} catch(error) {
			console.warn(error);
		}
	});


	$(document).ready(function () {
		$('.i-checks').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green',
		});
	});
</script>
@endsection
