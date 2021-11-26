@extends('layouts.app')

@section('title', $module_page . ' ('. $title_page .')')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/clockpicker/clockpicker.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/switchery/switchery.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/select2/select2.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/radio-button-group/radio-button-group.css') !!}"/>
<link rel="stylesheet" href="{!! asset('css/plugins/sweetalert/sweetalert.css') !!}"/>
<link rel="stylesheet" href="{!! asset('cetcc/css/icon_fonts/css/all_icons.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/chosen/bootstrap-chosen.css') !!}" >
<link rel="stylesheet" href="{!! asset('css/plugins/touchspin/jquery.bootstrap-touchspin.min.css') !!}" >

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
							<div class="tabs-container">
								<ul class="nav nav-tabs">
									<li class="active"><a data-toggle="tab" href="#tab-1"> Dados da Turma</a></li>
									{{-- <li><a class="" data-toggle="tab" href="#tab-2">Valores</a></li> --}}
									<li {!! isset($data) ? '' : 'class="disabled" title="Salve os dados da turma para liberar"' !!}><a data-toggle="tab" href="#tab-3">Professores</a></li>
									<li {!! isset($data) ? '' : 'class="disabled" title="Salve os dados da turma para liberar"' !!}><a data-toggle="tab" href="#tab-4">Módulos</a></li>
									<li {!! isset($data) ? '' : 'class="disabled" title="Salve os dados da turma para liberar"' !!}><a data-toggle="tab" href="#tab-5">Aulas</a></li>
								</ul>
								<form name="formCourse" method="post" action="{{ url($urlAction) }}" class="form-horizontal">
									{{ csrf_field() }}
									<input name="id" type="hidden">
									<div class="tab-content">

										<div id="tab-1" class="tab-pane active">
											<div class="panel-body">
												<div class="col-lg-12 animated fadeInLeft">
													<div class="form-group">

														@if ($fieldPageConfig->show('name'))
														<div class="col-sm-12">
															<label class=" control-label">Nome</label>
															<input type="text" name="name" class="form-control" required {!! $fieldPageConfig->attr('name') !!}>
														</div>
														@endif

														@if ($fieldPageConfig->show('courseCategoryType'))
														<div class="col-sm-2">
															<label class="control-label">Tipo</label>
															<select name="courseCategoryType" class="form-control select2" onchange="onChangeCourseTCS(event)" {!! $fieldPageConfig->attr('courseCategoryType') !!}></select>
														</div>
														@endif

														@if ($fieldPageConfig->show('courseCategory'))
														<div class="col-sm-5">
															<label class="control-label">Categoria</label>
															<select name="courseCategory" class="form-control select2" onchange="onChangeCourseTCS(event)" {!! $fieldPageConfig->attr('courseCategory') !!}></select>
														</div>
														@endif

														@if ($fieldPageConfig->show('courseSubcategory'))
														<div class="col-sm-5">
															<label class="control-label">Subcategoria</label>
															<select name="courseSubcategory" class="form-control select2" onchange="onChangeCourseTCS(event)" {!! $fieldPageConfig->attr('courseSubcategory') !!}></select>
														</div>
														@endif

														@if ($fieldPageConfig->show('course_id'))
														<div class="col-sm-7">
															<label class=" control-label">Curso</label>
															<select name="course_id" class="select2 form-control" required onchange="onChangeCourse(this.value)" {!! $fieldPageConfig->attr('course_id') !!}></select>
														</div>
														@endif

														@if ($fieldPageConfig->show('team_id'))
														<div class="col-sm-5">
															<label class="control-label">Coordenador(a)</label>
															<select name="team_id" class="select2_demo_1 form-control" {!! $fieldPageConfig->attr('team_id') !!}></select>
														</div>
														@endif

														@if ($fieldPageConfig->show('city_id'))
														<div class="col-sm-2 ">
															<label class="control-label">Cidade</label>
															<select id="city_id" name="city_id" class="select2 form-control" required {!! $fieldPageConfig->attr('city_id') !!}>
																<option value="">Selecione a Cidade</option>
																@foreach($listSelectBox->city as $item)
																<option value="{{ $item->id }}">{{ $item->name }}</option>
																@endforeach
															</select>
															{{-- <button type="button" class="m-l-xs btn gp-btn-green" data-target="#city-modal" title="Nova opção" onclick="openModalNewItemSelect(event, 'city_id')">
																<i class="fa fa-plus"></i>
															</button> --}}
														</div>
														@endif

														@if ($fieldPageConfig->show('place_id'))
														<div class="col-sm-3">
															<label class=" control-label">Local</label>
															<div class="gp-block-ruby">
																<select name="place_id" class="select2 form-control" {!! $fieldPageConfig->attr('place_id') !!}></select>
																{{-- <button type="button" class="m-l-xs btn gp-btn-green" data-target="#place-modal" title="Nova opção" onclick="openModalNewItemSelect(event, 'place_id')">
																	<i class="fa fa-plus"></i>
																</button> --}}
															</div>
														</div>
														@endif

														@if ($fieldPageConfig->show('status'))
														<div class="col-sm-2">
															<label class="control-label">Status</label>
															<select name="status" class="form-control" onchange="onChangeStatus(event)" {!! $fieldPageConfig->attr('status') !!}>
																<option value="1">Breve</option>
																<option value="2">Aberto</option>
																<option value="3">Em andamento</option>
																<option value="4">Finalizado</option>
															</select>
														</div>
														@endif

														@if ($fieldPageConfig->show('show_site'))
														<div class="col-sm-2">
															<label class="control-label" style="padding-bottom: 10px">Mostra no Site</label>
															<div class="switch">
																<div class="onoffswitch">
																	<input type="hidden" name="show_site">
																	<input type="checkbox" class="onoffswitch-checkbox" id="formClassShowSite" onchange="document.forms.formCourse.show_site.value = this.checked ? 1 : ''" {!! $fieldPageConfig->attr('show_site') !!}>
																	<label class="onoffswitch-label" for="formClassShowSite">
																		<span class="onoffswitch-inner"></span>
																		<span class="onoffswitch-switch"></span>
																	</label>
																</div>
															</div>
														</div>
														@endif

														@if ($fieldPageConfig->show('does_registre'))
														<div class="col-sm-2">
															<label class="control-label" style="padding-bottom: 10px">Faz Inscrição</label>
															<div class="switch">
																<div class="onoffswitch">
																	<input type="hidden" name="does_registre">
																	<input type="checkbox" class="onoffswitch-checkbox" id="formClassDoesRegistre" onchange="document.forms.formCourse.does_registre.value = this.checked ? 1 : ''" {!! $fieldPageConfig->attr('does_registre') !!}>
																	<label class="onoffswitch-label" for="formClassDoesRegistre">
																		<span class="onoffswitch-inner"></span>
																		<span class="onoffswitch-switch"></span>
																	</label>
																</div>
															</div>
														</div>
														@endif

														<div id="repetitionPermanence" class="col-sm-6 hide">
															<div class="row">
																@if ($fieldPageConfig->show('repetition'))
																<div class="col-sm-3">
																	<label class="control-label">Repetição*</label>
																	{{-- Deve trazer já a repetição cadastrado na turma --}}
																	<input type="text" name="repetition" class="form-control" value="7" {!! $fieldPageConfig->attr('repetition') !!}>
																	<span class="help-block m-b-none">Liberar aula a cada quantos dias?</span>
																</div>
																@endif

																@if ($fieldPageConfig->show('permanence'))
																<div class="col-sm-3">
																	<label class="control-label">Permanência*</label>
																	{{-- Deve trazer já a repetição cadastrado na turma --}}
																	<input type="text" name="permanence" class="form-control" value="0" {!! $fieldPageConfig->attr('permanence') !!}>
																	<span class="help-block m-b-none">Quantos dias essa aula deve permanecer ativa.</span>
																</div>
																@endif

																@if ($fieldPageConfig->show('permanence_all'))
																<div class="col-sm-6">
																	<label class="control-label" style="padding-bottom: 10px">Permanência Aprovação matrícula</label>
																	<div class="switch">
																		<div class="onoffswitch">
																			<input type="hidden" name="permanence_all" value="0">
																			<input type="checkbox" class="onoffswitch-checkbox" id="formClassPermanenceAll" onchange="document.forms.formCourse.permanence_all.value = this.checked ? '1' : '0'" {!! $fieldPageConfig->attr('permanence_all') !!}>
																			<label class="onoffswitch-label" for="formClassPermanenceAll">
																				<span class="onoffswitch-inner"></span>
																				<span class="onoffswitch-switch"></span>
																			</label>
																		</div>
																	</div>
																	<span class="help-block m-b-none">Permanência a partir da data da aprovação da matrícula</span>
																</div>
																@endif

															</div>
														</div>
													</div>

													<div id="presentialDates" class="row">
														@if ($fieldPageConfig->show('start_date'))
														<div class="col-sm-5">
															<label class=" control-label">Data Início e Fim da Turma</label>
															<div class="input-daterange input-group">
																<input type="text" id="start_date" name="start_date" class="form-control date" readonly {!! $fieldPageConfig->attr('start_date') !!}>
																<span class="input-group-addon">até</span>
																<input type="text" id="end_date" name="end_date" class="form-control date" readonly {!! $fieldPageConfig->attr('end_date') !!}>
															</div>
														</div>
														@endif

														@if ($fieldPageConfig->show('start_hours'))
														<div class="col-sm-3">
															<label class=" control-label">Horas do encontro</label>
															<div class="input-daterange input-group clockpicker">
																<input type="text" class="input-sm form-control" name="start_hours" readonly {!! $fieldPageConfig->attr('start_hours') !!}/>
																<span class="input-group-addon">até</span>
																<input type="text" class="input-sm form-control" name="end_hours" readonly {!! $fieldPageConfig->attr('end_hours') !!}/>
															</div>
														</div>
														@endif

														@if ($fieldPageConfig->show('days_week'))
														<div class="col-sm-2">
															<label class=" control-label">Dias da Semana</label>
															<input type="text" name="days_week" class="form-control" {!! $fieldPageConfig->attr('days_week') !!}>
														</div>
														@endif

														@if ($fieldPageConfig->show('periodicity_id'))
														<div class="col-sm-2">
															<label class="control-label">Periodicidade</label>
															<select name="periodicity_id" class="form-control" {!! $fieldPageConfig->attr('periodicity_id') !!}></select>
														</div>
														@endif

													</div>

													<div class="row">
														@if ($fieldPageConfig->show('contract_id'))
														<div class="col-sm-4">
															<label class="control-label">Contrato</label>
															<select name="contract_id" class="form-control" {!! $fieldPageConfig->attr('contract_id') !!}></select>
														</div>
														@endif

														@if ($fieldPageConfig->show('link'))
														<div class="col-sm-8">
															<label class="control-label">Link</label>
															<input type="text" name="link" class="form-control" maxlength="255" {!! $fieldPageConfig->attr('link') !!}/>
														</div>
														@endif
													</div>
													<div class="row">
														@if ($fieldPageConfig->show('description_pt'))
														<div class="col-sm-12">
															<label class="control-label">Descrição</label>
															<div class="ibox-content no-padding">
																<textarea id="description_pt" name="description_pt" class="summernote" {!! $fieldPageConfig->attr('description_pt') !!}></textarea>
															</div>
														</div>
														@endif
													</div>

												</div>
											</div>
										</div>

										{{-- <div id="tab-2" class="tab-pane">
											<div class="panel-body">
												<div class="wrapper wrapper-content animated fadeInRight">
													<div class="text-right">
														<button
														type="button"
														class="btn btn-primary"
														title="Adicionar novo"
														onclick="newFormsPayment()"
														>
														<i class="fa fa-plus"></i>
													</button>
												</div>

												<div id="formPayment"></div>
												<div class="form-group">
													<label class="control-label">
														Valor padrão do curso
														<input type="checkbox" name="course_default_value" class="form-control" value="1" {{ isset($courseDefaultValue) ? 'checked' : '' }} />
													</label>
												</div>
											</div>
										</div>
									</div> --}}

									<div id="tab-3" class="tab-pane">
										<div class="panel-body">
											<div class="wrapper wrapper-content animated fadeInRight">
												<div class="text-right m-b-md">
													<button	type="button" class="btn btn-primary" title="Adicionar novo" onclick="newTeacher()">
														<i class="fa fa-plus"></i>
													</button>
												</div>
												<div id="teacher"></div>
											</div>
										</div>
									</div>

									<div id="tab-4" class="tab-pane">
										<div class="panel-body">
											<div class="wrapper wrapper-content animated fadeInRight">
												<div class="col-sm-10">
													<h3>Relacionamento de módulos</h3>
												</div>
												<div class="col-sm-2">
													<div class="text-right m-b-md">
														<button type="button" class="btn btn-primary" title="Adicionar novo" onclick="newModule(null, true)" >
															<i class="fa fa-plus"></i>
														</button>
													</div>
												</div>
												<div class="col-sm-12">
													<div id="module"></div>
												</div>
												<div class="col-sm-12 text-right m-b-md">
													<button type="button" class="btn btn-primary" title="Adicionar novo" onclick="newModule(null, true)" >
														<i class="fa fa-plus"></i>
													</button>
												</div>
											</div>
										</div>
									</div>

									<div id="tab-5" class="tab-pane">
										<div class="panel-body">
											<div class="animated fadeInRight">
												{{-- <div class="col-sm-10">
													<h3>Relacionamento de Aulas</h3>
												</div>
												<div class="col-sm-2">
													<div class="text-right m-b-md">
														<button type="button" class="btn btn-primary" title="Adicionar novo" onclick="newClasses()" >
															<i class="fa fa-plus"></i>
														</button>
													</div>
												</div>
												<div class="col-sm-12">
													<div id="classes"></div>
												</div> --}}
												@includeWhen(isset($data), 'admin.prospection.classGroup.tabClasses')
											</div>
										</div>
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
<div class="modal inmodal" id="city-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<i class="modal-icon fa fa-map"></i>
				<h4 class="modal-title">Cadastrar nova Cidade</h4>
			</div>
			<div class="modal-body gp-m-1">
				<form name="formCityModal" class="form-horizontal" onsubmit="submitFormCityModal(event)">
					@include('admin.configuration.city.form_group')
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

<div class="modal inmodal" id="place-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<i class="modal-icon fa fa-home"></i>
				<h4 class="modal-title">Cadastrar novo Lugar</h4>
			</div>
			<div class="modal-body gp-m-1">
				<form name="formPlaceModal" class="form-horizontal" onsubmit="submitFormPlaceModal(event)">
					@include('admin.place.form')
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

<div class="modal inmodal" id="teacher-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<i class="modal-icon fa fa-address-card"></i>
				<h4 class="modal-title">Cadastrar novo Professor(a)</h4>
			</div>
			<div class="modal-body gp-m-1">
				<form name="formTeacherModal" class="form-horizontal" onsubmit="submitFormTeacherModal(event)">
					@include('admin.team.form_group')
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

{{-- <div class="modal inmodal" id="contentCourse-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<i class="modal-icon fa fa-folder"></i>
				<h4 class="modal-title">Cadastrar novo Modulo</h4>
			</div>
			<div class="modal-body gp-m-1">
				<form name="formContentCourse" class="form-horizontal" onsubmit="submitFormContentCourse(event)">
					@include('admin.prospection.contentCourse.form_group')
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
					@include('admin.prospection.courseCategory.form_group')
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
				APP.scope.listSelectBox.courseCategory.push(resp)

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

<script id="tmplTeacher" type="text/x-dot-template">
	<div class="form-group" style="border-radius: 5px; border: 1px solid #ddd; padding-bottom: 5px">
		<input type="hidden" name="teacher[@{{= it.key }}][id]" value="@{{= it.id }}" />
		<div class="col-sm-4">
			<label class="control-label">Professor(a)</label>
			<div class="gp-w-90">
				<select name="teacher[@{{= it.key }}][team_id]" class="select2 form-control" value="@{{= it.team_id }}"></select>
			</div>
			<button type="button" class="m-l-xs btn gp-btn-green" data-target="#teacher-modal" title="Nova opção" onclick="openModalNewItemSelect(event, 'teacher[@{{= it.key }}][team_id]')">
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
			<div class="col-sm-6">
				<div class="col-sm-12" style="padding-top: 25px; cursor: pointer;">
					<div class="radio-group radio-group-center">
						<input type="radio" id="module_@{{= it.key }}" name="module[@{{= it.key }}][module_avaliation]" value="module" onchange="onChangeModuleAvaliation(this, '@{{= it.key }}')">
						<label class="text-uppercase" for="module_@{{= it.key }}">Módulo</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" id="avaliation_@{{= it.key }}" name="module[@{{= it.key }}][module_avaliation]" value="avaliation" onchange="onChangeModuleAvaliation(this, '@{{= it.key }}')">
						<label class="text-uppercase" for="avaliation_@{{= it.key }}">Avaliação</label>
					</div>
				</div>

				<div class="gp-block-ruby">
					<select name="module[@{{= it.key }}][content_course_id]" class="form-control" value="@{{= it.content_course_id || '' }}"></select>
					<select name="module[@{{= it.key }}][avaliation_id]" class="form-control" value="@{{= it.avaliation_id || '' }}"></select>
				</div>
			</div>

			<div class="col-sm-2" style="padding-top: 25px; cursor: pointer;">
				<div class="radio-group radio-group-center">
					<input type="radio" id="presential_@{{= it.key }}" name="module[@{{= it.key }}][type]" value="presential" onchange="onChangeModulePresentialOnline(this, '@{{= it.key }}')">
					<label class="text-uppercase" for="presential_@{{= it.key }}">Presencial</label><br>
					<input type="radio" id="online_@{{= it.key }}" name="module[@{{= it.key }}][type]" value="online" onchange="onChangeModulePresentialOnline(this, '@{{= it.key }}')">
					<label class="text-uppercase" for="online_@{{= it.key }}">Online</label>
				</div>
			</div>

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

			<div class="col-sm-1 text-right" style="padding-top: 25px; cursor: pointer; color: #f00">
				<button type="button" class="btn btn-danger p-2" title="Excluir" onclick="removeFormGroup(event);addDelModuleChildNodes()">
					<i class="fa fa-times"></i>
				</button>
			</div>
		</div>
	</div>
</script>

@endsection

@section('scripts')
@parent
<!-- Mainly scripts -->
<script src="{!! asset('js/plugins/metisMenu/jquery.metisMenu.js') !!}"></script>
<script src="{!! asset('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}"></script>

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
<script src="{!! asset('js/plugins/select2/select2.full.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/sweetalert/sweetalert.min.js') !!}"></script>
<script src="{!! asset('js/plugins/chosen/chosen.jquery.js') !!}"></script>
<script src="{!! asset('js/plugins/touchspin/jquery.bootstrap-touchspin.min.js') !!}"></script>

<script>
	function addDelModuleChildNodes() {
		var elemCourseCategory = document.forms.formCourse.courseCategory

		if (document.getElementById('module').childNodes.length) {
			elemCourseCategory.disabled = true
			elemCourseCategory.title = 'Não é possível alterar a categoria se já houver modulo cadastrado'
		} else {
			elemCourseCategory.disabled = false
			elemCourseCategory.title = ''
		}
	}

	function onChangeModulePresentialOnline(target, key) {
		var row = target.closest('[data-module]')
		var elemSequence = row.querySelector('[name$="[sequence]"]')
		var elemStartDate = row.querySelector('[name$="[start_date]"]')

		if (target.value == 'presential') {
			elemSequence.disabled = true
			elemStartDate.disabled = false
		} else
		if (target.value == 'online') {
			elemSequence.disabled = false
			elemStartDate.disabled = true
		}
	}

	try {
		function changeAtrrValue(input, atrrs) {
			for (var key in atrrs) {
				input[key] = atrrs[key]
			}
		}

		function onChangeStatus(event) {
			var formCourse = document.forms.formCourse
			var formClassShowSite = formCourse.formClassShowSite
			var formClassDoesRegistre = formCourse.formClassDoesRegistre
			var show_site = formCourse.show_site
			var does_registre = formCourse.does_registre

			switch (formCourse.status.value) {
				case '1':
				if (event) {
					show_site.value = 1
				}

				changeAtrrValue(formClassShowSite, { checked: show_site.value == 1, disabled: false, })
				changeAtrrValue(formClassDoesRegistre, { checked: false, disabled: true, })
				does_registre.value = ''
				break;
				case '2':
				if (event) {
					show_site.value = 1
					does_registre.value = 1
				}

				changeAtrrValue(formClassShowSite, { checked: show_site.value == 1, disabled: false, })
				changeAtrrValue(formClassDoesRegistre, { checked: does_registre.value == 1, disabled: false, })
				break;
				case '3':
				if (event) {
					show_site.value = ''
					does_registre.value = ''
				}
				changeAtrrValue(formClassShowSite, { checked: show_site.value == 1, disabled: false, })
				changeAtrrValue(formClassDoesRegistre, { checked: does_registre.value == 1, disabled: false, })
				break;
				case '4':
				changeAtrrValue(formClassShowSite, { checked: false, disabled: true, })
				changeAtrrValue(formClassDoesRegistre, { checked: false, disabled: true, })
				show_site.value = ''
				does_registre.value = ''
				break;
				default:
				changeAtrrValue(formClassShowSite, { checked: false, disabled: true, })
				changeAtrrValue(formClassDoesRegistre, { checked: false, disabled: true, })
				show_site.value = ''
				does_registre.value = ''
			}

		}
	} catch (error) {
		console.warn(error);
	}

	try {
		function newFormsPayment(data) {
			if (data) {
				data.key = generateUniqueKey()
			} else {
				data = {
					id: '',
					form_payment_id: '',
					value: '',
					parcel: 1,
					key: generateUniqueKey(),
				}
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
				list: APP.scope.listSelectBox.formPayment,
				target: formPayment.querySelector('[name$="[form_payment_id]"]'),
				columnValue: "id",
				columnLabel: "description",
				selectBy: data ? [data.form_payment_id] : null,
				emptyOption: {
					label: "Selecione..."
				}
			});

			$(selectElem).select2();
		}

		function removeFormGroup(event) {
			event.target.closest('.form-group').remove();
		}

		function onFlgMainFormsPayment(event) {
			document.getElementById('tab-2').querySelectorAll('[name$="[flg_main]"]').forEach(function(item) { item.checked = false })

			event.target.checked = true
		}

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

			var selectElem = tmplTeacher.querySelector('[name$="[team_id]"]')

			populateSelectBox({
				list: APP.scope.listSelectBox.team,
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

		function onChangeModuleAvaliation(elem, key) {
			var $module = $('[name="module['+ key +'][content_course_id]"]')
			var $avaliation = $('[name="module['+ key +'][avaliation_id]"]')
			var $moduleSelect2 = $module.next(".select2-container")
			var $avaliationSelect2 = $avaliation.next(".select2-container")

			switch(elem.value) {
				case 'module': {
					$avaliation.val('').trigger('change')
					$moduleSelect2.show()
					$avaliationSelect2.hide()
				} break
				case 'avaliation': {
					$module.val('').trigger('change')
					$moduleSelect2.hide()
					$avaliationSelect2.show()
				} break
			}
		}

		function newModule(data, toBottom) {
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
				var selectElem = tmplModule.querySelector('[name$="[content_course_id]"]')

				populateSelectBox({
					list: APP.contentCourse,
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
					var elemType = tmplModule.querySelector('[name$="[type]"][value="' + data.type + '"]')
					elemType.checked = true
					onChangeModulePresentialOnline(elemType, data.key)
				}

				/* if (data.number_of_classes) {
					tmplModule.querySelector('[name$="[number_of_classes]"][value="' + data.number_of_classes + '"]').checked = true
				} */

				var selectElemAvaliation = tmplModule.querySelector('[name$="[avaliation_id]"]')

				populateSelectBox({
					list: APP.scope.listSelectBox.avaliation,
					target: selectElemAvaliation,
					columnValue: "id",
					columnLabel: "title",
					selectBy: [ data.avaliation_id ],
					emptyOption: {
						label: "Selecione..."
					}
				});

				$(selectElemAvaliation).select2()

				var idModuleAvaliation = 'module_' + data.key

				if (data.avaliation_id) {
					idModuleAvaliation = 'avaliation_' + data.key
				}

				document.getElementById(idModuleAvaliation).checked = true

				onChangeModuleAvaliation(document.getElementById(idModuleAvaliation), data.key)

				setDatePicker(tmplModule.querySelector('[name$="[start_date]"]'))
				addDelModuleChildNodes()

				if (toBottom && $(document).height() > 1700) {
					$(document).scrollTop($(document).height())
				}
			} catch (error) {
				console.warn(error)
			}

		}

		function onChangeCourseTCS() {
			var courseCategoryType = document.forms.formCourse.courseCategoryType.value
			var courseCategory = document.forms.formCourse.courseCategory.value
			var courseSubcategory = document.forms.formCourse.courseSubcategory.value
			var course = APP.scope.listSelectBox.course
			var courseNew = []

			var type = APP.scope.listSelectBox.courseCategoryType.find(function(item) { return item.id == courseCategoryType })
			var elemRepetitionPermanence = document.getElementById('repetitionPermanence')
			var elemPresentialDates = document.getElementById('presentialDates')
			if (type) {
				if (type.flg == 'ead') {
					elemRepetitionPermanence.classList.remove('hide')
					elemPresentialDates.classList.add('hide')
				} else {
					elemRepetitionPermanence.classList.add('hide')
					elemPresentialDates.classList.remove('hide')
				}
			} else {
				elemRepetitionPermanence.classList.add('hide')
				elemPresentialDates.classList.add('hide')
			}

			for (var i = 0; i < course.length; i++) {
				var item = course[i]
				if (courseCategoryType && item.course_category_type_id != courseCategoryType) {
					continue
				}
				if (courseCategory && item.course_category_id != courseCategory) {
					continue
				}
				if (courseSubcategory && item.course_subcategory_id != courseSubcategory) {
					continue
				}

				courseNew.push(item)
			}

			setCourse(courseNew, null)
		}

		function setCourseType(payload) {
			populateSelectBox({
				list: payload,
				target: document.forms.formCourse.courseCategoryType,
				columnValue: "id",
				columnLabel: "title",
				emptyOption: {
					label: "Selecione..."
				}
			})
		}

		function setCourseCourseCategory(payload) {
			populateSelectBox({
				list: payload,
				target: document.forms.formCourse.courseCategory,
				columnValue: "id",
				columnLabel: "description_pt",
				emptyOption: {
					label: "Selecione..."
				}
			})
		}

		function setCourseCourseSubcategory(payload) {
			populateSelectBox({
				list: payload,
				target: document.forms.formCourse.courseSubcategory,
				columnValue: "id",
				columnLabel: "description_pt",
				emptyOption: {
					label: "Selecione..."
				}
			})
		}

		function setCourse(payload, id) {
			populateSelectBox({
				list: payload,
				target: document.forms.formCourse.course_id,
				columnValue: "id",
				columnLabel: "title_pt",
				emptyOption: {
					label: "Selecione..."
				},
			})

			document.forms.formCourse.course_id.dispatchEvent(new Event('change'))

			if (id) {
				var course = APP.scope.listSelectBox.course.find(function(item) { return item.id == id })
				document.forms.formCourse.courseCategoryType.value = course.course_category_type_id
				document.forms.formCourse.courseCategory.value = course.course_category_id
				document.forms.formCourse.courseSubcategory.value = course.course_subcategory_id
				onChangeCourseTCS()
				document.forms.formCourse.course_id.value = id
				onChangeCourse(id)
			}
		}

		function onChangeCourseCategory(val) {
			var idCourseCategory = parseInt(val)

			if (idCourseCategory) {
				APP.contentCourse = APP.scope.listSelectBox.contentCourse.filter(function(item) {
					return item.course_category.includes(idCourseCategory)
				})
			}
		}

		function onChangeCourse(courseId) {
			if (courseId) {
				var course = APP.scope.listSelectBox.course.find(function(item) { return item.id == courseId })
				onChangeCourseCategory(course.course_category_id)
			}

			/* var module = document.getElementById('module').querySelectorAll('[name$="[content_course_id]"]')
			.forEach(function(item) {
				console.log(item)
				populateSelectBox({
					list: APP.contentCourse,
					target: item,
					columnValue: "id",
					columnLabel: "title_pt",
					emptyOption: {
						label: "Selecione..."
					}
				})
				item.dispatchEvent(new Event('change'))
				$(item).select2();
			}) */
		}

		{{--/*function submitFormContentCourse(event) {
			event.preventDefault();

			var data = new FormData(event.target)

			$.ajax({
				url: '/api/save',
				type: "POST",
				enctype: 'multipart/form-data',
				processData: false,
				contentType: false,
				headers: {
					method: 'contentCourse',
				},
				data: data,
			}).then(function(resp) {
				$('#contentCourse-modal').modal('hide')
				if (resp) {
					// APP.contentCourse.push(resp)
					document.getElementById('contentCourse').querySelectorAll('[name$="[content_course_id]"]').forEach(function(elem) {
						var option = document.createElement("option");

						option.text = resp.title_pt
						option.value = resp.id

						elem.add(option)
					})

					APP.targetSelectModal.value = resp.id
					$(APP.targetSelectModal).select2()
				}

			})
		}*/--}}

		function submitFormCityModal(event) {
			event.preventDefault();

			var data = new FormData(event.target)

			$.ajax({
				url: '/api/save',
				type: "POST",
				enctype: 'multipart/form-data',
				processData: false,
				contentType: false,
				headers: {
					method: 'city',
				},
				data: data,
			}).then(function(resp) {
				$('#city-modal').modal('hide')
				$('#city-modal form')[0].reset()

				if (resp) {
					APP.scope.listSelectBox.city.push(resp)

					var option = document.createElement("option");

					option.text = resp.name
					option.value = resp.id

					APP.targetSelectModal.add(option)

					APP.targetSelectModal.value = resp.id
				}

			})
		}

		function submitFormPlaceModal(event) {
			event.preventDefault();

			var data = new FormData(event.target)

			$.ajax({
				url: '/api/save',
				type: "POST",
				enctype: 'multipart/form-data',
				processData: false,
				contentType: false,
				headers: {
					method: 'place',
				},
				data: data,
			}).then(function(resp) {
				$('#place-modal').modal('hide')
				$('#place-modal form')[0].reset()

				if (resp) {
					APP.scope.listSelectBox.place.push(resp)

					var option = document.createElement("option");

					option.text = resp.description
					option.value = resp.id

					APP.targetSelectModal.add(option)

					APP.targetSelectModal.value = resp.id
				}

			})
		}

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
				$('#teacher-modal').modal('hide')
				$('#teacher-modal form')[0].reset()

				if (resp) {
					APP.scope.listSelectBox.team.push(resp)

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

		$(document).ready(function() {
			APP.scope.course = {!! isset($data) ? json_encode($data) : 'null' !!}
			APP.scope.listSelectBox = {!! isset($listSelectBox) ? json_encode($listSelectBox) : '{}' !!}
			APP.payload = {!! json_encode($payload) !!}
			APP.payload.contentCourse = []

			/* if (APP.scope.courseFormPayment.length) {
				APP.scope.courseFormPayment.forEach(item => {
					newFormsPayment(item)
				});
			} else {
				newFormsPayment()
			} */

			// normalização dos modulos
			if (APP.scope.listSelectBox.contentCourse) {
				APP.scope.listSelectBox.contentCourse = APP.scope.listSelectBox.contentCourse.map(function(item) {
					item.course_category = item.course_category.map(function(item) {
						return item.id
					})

					return item
				})
			}

			if (APP.payload.teacher.length) {
				APP.payload.teacher.forEach(item => {
					newTeacher(item)
				});
			} else {
				newTeacher()
			}

			setClockpicker('.input-daterange.clockpicker input')
			setDatePicker('.input-daterange .date')

			if (APP.scope.course) {
				// changeCourse(APP.scope.course.id)
				populate(document.forms.formCourse, APP.scope.course)
				onChangeStatus()

				if (APP.scope.course.permanence_all == '1') {
					document.getElementById('formClassPermanenceAll').checked = true
				}

			}

			if (APP.scope.listSelectBox.team) {
				populateSelectBox({
					list: APP.scope.listSelectBox.team,
					target: document.forms.formCourse.team_id,
					columnValue: "id",
					columnLabel: "name",
					selectBy: (APP.scope.course && APP.scope.course.team_id) ? [APP.scope.course.team_id] : null,
					emptyOption: {
						label: "Selecione..."
					}
				});
			}

			if (APP.scope.listSelectBox.courseCategoryType) {
				setCourseType(APP.scope.listSelectBox.courseCategoryType)
			}

			if (APP.scope.listSelectBox.courseCategory) {
				setCourseCourseCategory(APP.scope.listSelectBox.courseCategory)
			}

			if (APP.scope.listSelectBox.courseSubcategory) {
				setCourseCourseSubcategory(APP.scope.listSelectBox.courseSubcategory)
			}

			if (APP.scope.listSelectBox.course) {
				setCourse(APP.scope.listSelectBox.course, (APP.scope.course ? APP.scope.course.course_id : null))
			}

			if (APP.scope.listSelectBox.place) {
				populateSelectBox({
					list: APP.scope.listSelectBox.place,
					target: document.forms.formCourse.place_id,
					columnValue: "id",
					columnLabel: "description",
					selectBy: (APP.scope.course && APP.scope.course.place_id) ? [APP.scope.course.place_id] : null,
					emptyOption: {
						label: "Selecione..."
					}
				});
			}

			if (APP.scope.listSelectBox.contract) {
				populateSelectBox({
					list: APP.scope.listSelectBox.contract,
					target: document.forms.formCourse.contract_id,
					columnValue: "id",
					columnLabel: "title",
					selectBy: (APP.scope.course && APP.scope.course.contract_id) ? [APP.scope.course.contract_id] : null,
					emptyOption: {
						label: "Selecione..."
					}
				});
			}

			if (APP.scope.listSelectBox.periodicity) {
				populateSelectBox({
					list: APP.scope.listSelectBox.periodicity,
					target: document.forms.formCourse.periodicity_id,
					columnValue: "id",
					columnLabel: "title",
					emptyOption: {
						label: "Selecione..."
					},
					selectBy: (APP.scope.course && APP.scope.course.periodicity_id) ? [APP.scope.course.periodicity_id] : null,
				});
			}

			/* if (APP.scope.listSelectBox.courseCategory) {
				populateSelectBox({
					list: APP.scope.listSelectBox.courseCategory,
					target: document.forms.formContentCourse.course_category_id,
					columnValue: "id",
					columnLabel: "description_pt",
					emptyOption: {
						label: "Selecione..."
					}
				});
			} */

			$('.summernote').summernote({
				height: 100,
				toolbar: false,
				placeholder: 'Digite seu conteúdo',
				required: true
			})

			// $('.chosen-select').chosen({width: "100%"})

			$(".touchspin1").TouchSpin({
				buttondown_class: 'btn btn-white',
				buttonup_class: 'btn btn-white'
			})

			$('form[name="formCourse"] .select2').select2()

			if (APP.payload.courseModule.length) {
				APP.payload.courseModule.forEach(item => {
					newModule(item)
				});
			}

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

			function hasChanged(event) {
				if (event.target.name == 'course_id') {
					swal({
						type: 'warning',
						title: 'Ao salvar essa alteração, será alterado em todos as inscrições onde essa turma está vinculado',
						text: 'Não esqueça de alterar os módulos com o novo curso dessa turma',
					}, function(params) {
						console.info(params)
					})
				}
			}

			$('form[name="formCourse"] [name="course_id"]').on('select2:select', hasChanged);
		});
	} catch(error) {
		console.warn(error);
	}
</script>
@endsection
