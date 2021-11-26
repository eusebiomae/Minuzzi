@extends('layouts.app')

@section('title', $config->title)

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
{{-- <link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" /> --}}
<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/clockpicker/clockpicker.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/switchery/switchery.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/select2/select2.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/radio-button-group/radio-button-group.css') !!}"/>
{{-- <link rel="stylesheet" href="{!! asset('css/plugins/sweetalert/sweetalert.css') !!}"/> --}}
{{-- <link rel="stylesheet" href="{!! asset('cetcc/css/icon_fonts/css/all_icons.min.css') !!}" /> --}}
<link rel="stylesheet" href="{!! asset('css/plugins/chosen/bootstrap-chosen.css') !!}" >
<link rel="stylesheet" href="{!! asset('css/plugins/touchspin/jquery.bootstrap-touchspin.min.css') !!}" >

@endsection

@section('content')
@include($config->header)

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
									{{-- <li><a class="" data-toggle="tab" href="#tab-3">Professores</a></li> --}}
									<li><a class="" data-toggle="tab" href="#tab-4">Módulos</a></li>
									<li><a class="" data-toggle="tab" href="#tab-5">Aulas</a></li>
								</ul>
								<form name="form" method="post" action="{{ url($config->urlAction) }}" class="form-horizontal">
									{{ csrf_field() }}
									<input name="id" type="hidden">
									<div class="tab-content">

										<div id="tab-1" class="tab-pane active">
											<div class="panel-body">
												<div class="col-lg-12 animated fadeInLeft">
													<div class="form-group">

														<div class="col-sm-12">
															<label class=" control-label">Nome</label>
															<input type="text" name="name" class="form-control" required>
														</div>

														<div class="col-sm-2">
															<label class="control-label">Tipo</label>
															<select name="courseCategoryType" class="form-control select2" onchange="onChangeCourseTCS(event)"></select>
														</div>
														<div class="col-sm-5">
															<label class="control-label">Categoria</label>
															<select name="courseCategory" class="form-control select2" onchange="onChangeCourseTCS(event)"></select>
														</div>
														<div class="col-sm-5">
															<label class="control-label">Subcategoria</label>
															<select name="courseSubcategory" class="form-control select2" onchange="onChangeCourseTCS(event)"></select>
														</div>

														<div class="col-sm-5">
															<label class=" control-label">Curso</label>
															<select name="course_id" class="select2 form-control" required onchange="onChangeCourse(this.value)"></select>
														</div>

														{{-- <div class="col-sm-2 ">
															<label class="control-label">Cidade</label>
															<select id="city_id" name="city_id" class="select2 form-control" required>
																<option value="">Selecione a Cidade</option>
																@foreach($listSelectBox->city as $item)
																<option value="{{ $item->id }}">{{ $item->name }}</option>
																@endforeach
															</select>
															<button type="button" class="m-l-xs btn gp-btn-green" data-target="#city-modal" title="Nova opção" onclick="openModalNewItemSelect(event, 'city_id')">
																<i class="fa fa-plus"></i>
															</button>
														</div> --}}

														{{-- <div class="col-sm-3">
															<label class=" control-label">Local*</label>
															<div class="gp-block-ruby">
																<select name="place_id" class="select2 form-control" required></select>
																<button type="button" class="m-l-xs btn gp-btn-green" data-target="#place-modal" title="Nova opção" onclick="openModalNewItemSelect(event, 'place_id')">
																	<i class="fa fa-plus"></i>
																</button>
															</div>
														</div> --}}

														<div class="col-sm-2">
															<label class="control-label">Status</label>
															<select name="status" class="form-control" onchange="onChangeStatus(event)">
																<option value="1">Breve</option>
																<option value="2">Aberto</option>
																<option value="3">Em andamento</option>
																<option value="4">Finalizado</option>
															</select>
														</div>

														<div class="col-sm-2">
															<label class="control-label" style="padding-bottom: 10px">Mostra no Site</label>
															<div class="switch">
																<div class="onoffswitch">
																	<input type="hidden" name="show_site">
																	<input type="checkbox" class="onoffswitch-checkbox" id="formClassShowSite" onchange="document.forms.form.show_site.value = this.checked ? 1 : ''">
																	<label class="onoffswitch-label" for="formClassShowSite">
																		<span class="onoffswitch-inner"></span>
																		<span class="onoffswitch-switch"></span>
																	</label>
																</div>
															</div>
														</div>

														<div class="col-sm-2">
															<label class="control-label" style="padding-bottom: 10px">Faz Inscrição</label>
															<div class="switch">
																<div class="onoffswitch">
																	<input type="hidden" name="does_registre">
																	<input type="checkbox" class="onoffswitch-checkbox" id="formClassDoesRegistre" onchange="document.forms.form.does_registre.value = this.checked ? 1 : ''">
																	<label class="onoffswitch-label" for="formClassDoesRegistre">
																		<span class="onoffswitch-inner"></span>
																		<span class="onoffswitch-switch"></span>
																	</label>
																</div>
															</div>
														</div>

														{{-- <div id="repetitionPermanence" class="col-sm-6 hide">
															<div class="row">
																<div class="col-sm-3">
																	<label class="control-label">Repetição*</label>
																	{{-- Deve trazer já a repetição cadastrado na turma
																	<input type="text" name="repetition" class="form-control" required>
																	<span class="help-block m-b-none">Liberar aula a cada quantos dias?</span>
																</div>

																<div class="col-sm-3">
																	<label class="control-label">Permanência*</label>
																	{{-- Deve trazer já a repetição cadastrado na turma
																	<input type="text" name="permanence" class="form-control" required value="0">
																	<span class="help-block m-b-none">Quantos dias essa aula deve permanecer ativa.</span>
																</div>

																<div class="col-sm-6">
																	<label class="control-label" style="padding-bottom: 10px">Permanência Aprovação matrícula</label>
																	<div class="switch">
																		<div class="onoffswitch">
																			<input type="hidden" name="permanence_all" value="0">
																			<input type="checkbox" class="onoffswitch-checkbox" id="formClassPermanenceAll" onchange="document.forms.form.permanence_all.value = this.checked ? '1' : '0'">
																			<label class="onoffswitch-label" for="formClassPermanenceAll">
																				<span class="onoffswitch-inner"></span>
																				<span class="onoffswitch-switch"></span>
																			</label>
																		</div>
																	</div>
																	<span class="help-block m-b-none">Permanência a partir da data da aprovação da matrícula</span>
																</div>
															</div>
														</div> --}}
													</div>

													{{-- <div id="presentialDates" class="row">
														<div class="col-sm-5">
															<label class=" control-label">Data Início e Fim da Turma</label>
															<div class="input-daterange input-group">
																<input type="text" id="start_date" name="start_date" class="form-control date" readonly>
																<span class="input-group-addon">até</span>
																<input type="text" id="end_date" name="end_date" class="form-control date" readonly>
															</div>
														</div>

														<div class="col-sm-3">
															<label class=" control-label">Horas do encontro</label>
															<div class="input-daterange input-group clockpicker">
																<input type="text" class="input-sm form-control" name="start_hours" readonly />
																<span class="input-group-addon">até</span>
																<input type="text" class="input-sm form-control" name="end_hours" readonly />
															</div>
														</div>

														<div class="col-sm-2">
															<label class=" control-label">Dias da Semana</label>
															<input type="text" name="days_week" class="form-control">
														</div>

														<div class="col-sm-2">
															<label class="control-label">Periodicidade</label>
															<select name="periodicity_id" class="form-control"></select>
														</div>
													</div> --}}

													{{-- <div class="row">
														<div class="col-sm-4">
															<label class="control-label">Contrato</label>
															<select name="contract_id" class="form-control"></select>
														</div>

														<div class="col-sm-8">
															<label class="control-label">Link</label>
															<input type="text" name="link" class="form-control" maxlength="255"/>
														</div>
													</div> --}}

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
													<button
													type="button"
													class="btn btn-primary"
													title="Adicionar novo"
													onclick="newTeacher()"
													>
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
								</div>

								<div id="tab-5" class="tab-pane">
									<div class="panel-body">
										<div class="wrapper wrapper-content animated fadeInRight">
											<div class="col-sm-10">
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
											</div>
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

{{-- CIDADE --}}
{{-- <div class="modal inmodal" id="city-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<i class="modal-icon fa fa-map"></i>
				<h4 class="modal-title">Cadastrar nova Cidade</h4>
			</div>
			<div class="modal-body gp-m-1">
				<form name="formCityModal" class="form-horizontal" onsubmit="submitFormCityModal(event)">
					@include('admin.pages.city.form')
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

{{-- LUGAR  --}}
{{-- <div class="modal inmodal" id="place-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<i class="modal-icon fa fa-home"></i>
				<h4 class="modal-title">Cadastrar novo Lugar</h4>
			</div>
			<div class="modal-body gp-m-1">
				<form name="formPlaceModal" class="form-horizontal" onsubmit="submitFormPlaceModal(event)">
					@include('admin.pages.place.form')
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

{{-- PROFESSORES  --}}
{{-- <div class="modal inmodal" id="teacher-modal" tabindex="-1" role="dialog" aria-hidden="true">
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
</div> --}}

{{-- CURSOS  --}}
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
					@include('admin.pages.contentCourse.form')
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

{{-- CATEGORIA CURSO --}}
{{-- <div class="modal inmodal" id="courseCategoryModel" tabindex="-1" role="dialog" aria-hidden="true">
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
</div> --}}

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

				document.forms.form.course_category_id.add(option)

				APP.targetSelectModal.value = resp.id
				$(APP.targetSelectModal).select2()
			}

		})
	}
</script>

{{-- TEMPLATE PROFESSORES  --}}
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
{{-- TEMPLATE MODULOS  --}}
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
					<select name="module[@{{= it.key }}][content_course_id]" class="select2 form-control" value="@{{= it.content_course_id || '' }}"></select>
					{{-- <button type="button" class="m-l-xs btn gp-btn-green" onclick="openModalNewItemSelect(event, 'module[@{{= it.key }}][content_course_id]')" data-target="#module-modal" title="Nova opção">
						<i class="fa fa-plus"></i>
					</button> --}}
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
{{-- TEMPLATE TURMAS --}}
<script id="tmplClasses" type="text/x-dot-template">
	<div class="form-group" onload="chosenSelect()" style="border-radius: 5px; border: 1px solid #ddd; padding-bottom: 5px" data-classes>
		<input type="hidden" name="classes[@{{= it.key }}][id]" value="@{{= it.id }}" />

		<div class="row p-w-sm">
			<div class="col-sm-1">
				<label class="control-label">Sequência</label>
				<input type="number" name="classes[@{{= it.key }}][sequence]" class="form-control" value="@{{= it.sequence || '' }}">
			</div>
			<div class="col-sm-5">
				<label class="control-label">Módulo</label>
				<select name="classes[@{{= it.key }}][content_course_id]" class="select2 form-control" value="@{{= it.content_course_id || '' }}"></select>
				{{-- <button type="button" class="m-l-xs btn gp-btn-green" onclick="openModalNewItemSelect(event, 'classes[@{{= it.key }}][content_course_id]')" data-target="#classes-modal" title="Nova opção">
					<i class="fa fa-plus"></i>
				</button> --}}
			</div>
			<div class="col-sm-2" style="cursor: pointer;">
				<label class="control-label">Aula(s)</label>
				<div class="radio-group" style="float:initial;">
					<input type="radio" id="1_@{{= it.key }}" name="classes[@{{= it.key }}][number_of_classes]" data-numberOfClasses value="1">
					<label class="text-uppercase" for="1_@{{= it.key }}">1</label>
					<input type="radio" id="2_@{{= it.key }}" name="classes[@{{= it.key }}][number_of_classes]" data-numberOfClasses value="2">
					<label class="text-uppercase" for="2_@{{= it.key }}">2</label>
					<input type="radio" id="4_@{{= it.key }}" name="classes[@{{= it.key }}][number_of_classes]" data-numberOfClasses value="4">
					<label class="text-uppercase" for="4_@{{= it.key }}">4</label>
				</div>
			</div>
			<div class="col-sm-3" style="padding-top: 25px; cursor: pointer;">
				<div class="radio-group" style="float:initial;">
					<input type="radio" id="presential_@{{= it.key }}" name="classes[@{{= it.key }}][type]" value="presential">
					<label class="text-uppercase" for="presential_@{{= it.key }}">Presencial</label>
					<input type="radio" id="online_@{{= it.key }}" name="classes[@{{= it.key }}][type]" value="online">
					<label class="text-uppercase" for="online_@{{= it.key }}">Online</label>
				</div>
			</div>
			{{--	<div class="col-sm-2">
					<label class="control-label">Orientativo</label>
					<div class="radio-group" style="float:initial;">
						<input type="radio" id="orientative_yes_@{{= it.key }}" name="classes[@{{= it.key }}][orientative]" value="yes">
						<label class="text-uppercase" for="orientative_yes_@{{= it.key }}">Sim</label>
						<input type="radio" id="orientative_no_@{{= it.key }}" name="classes[@{{= it.key }}][orientative]" value="no" checked>
						<label class="text-uppercase" for="orientative_no_@{{= it.key }}">Não</label>
					</div>
				</div>
			--}}
			<div class="col-sm-1 text-right" style="padding-top: 25px; cursor: pointer; color: #f00">
				<button type="button" class="btn btn-danger p-2" title="Excluir" onclick="removeFormGroup(event)">
					<i class="fa fa-times"></i>
				</button>
			</div>
		</div>
		<div class="row p-w-sm">
			<div class="col-sm-2">
				<label class=" control-label">Data da Aula</label>
				<div class="input-group date">
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					<input type="text" name="classes[@{{= it.key }}][start_date]" class="form-control" readonly value="@{{= it.start_date || '' }}">
				</div>
			</div>
			<div class="col-sm-2 @{{= it.end_date ? '' : 'hide' }}" data-endDate>
				<label class=" control-label">Data 2º Aula</label>
				<div class="input-group date">
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					<input type="text" name="classes[@{{= it.key }}][end_date]" class="form-control" readonly value="@{{= it.end_date || '' }}">
				</div>
			</div>
			<div class="col-sm-@{{= it.end_date ? '8' : '10' }}">
				<label class="control-label">Vídeo Aula*</label>
				<select name="classes[@{{= it.key }}][videoLessons][]" data-placeholder="Selecione o Vídeo" class="chosen-select" multiple style="width:350px;" tabindex="4"></select>
			</div>
			{{-- <div class="col-sm-@{{= it.end_date ? '8' : '10' }}">
				<label class="control-label">Professor(a)</label>
				<div class="">
					<select name="classes[@{{= it.key }}][team_id]" class="select2 form-control" value="@{{= it.team_id }}"></select>
				</div>
			</div> --}}
			{{-- <div class="col-sm-1 text-right">
				<button type="button" class="m-l-xs btn gp-btn-green " data-toggle="modal" data-target="#teacher-modal" title="Nova opção"><i class="fa fa-plus"></i></button>
			</div> --}}
		</div>
		{{-- <div class="row p-w-sm">
			<div class="col-sm-2 m-t-md">
				<label class="m-r-sm">
					Exibir para Presencial
				</label>
				<input type="checkbox" name="classes[@{{= it.key }}][view_presencial]" class="js-switch_2" value="1" />
			</div>

		</div>--}}
		<div class="row p-w-sm m-b-sm">
			<div class="col-sm-12">
				<label class="control-label">Link para aula ao Vivo</label>
				<input type="text" name="classes[@{{= it.key }}][link_live]" class="form-control" maxlength="1024">
			</div>
		</div>
	</div>

</script>

@endsection

@section('scripts')
@parent

<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}"></script>
<!-- Page-Level Scripts -->
<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>
<script src="{!! asset('js/plugins/clockpicker/clockpicker.js') !!}"></script>
<script src="{!! asset('js/plugins/switchery/switchery.js') !!}"></script>
<script src="{!! asset('js/plugins/select2/select2.full.min.js') !!}" type="text/javascript"></script>
{{-- <script src="{!! asset('js/plugins/sweetalert/sweetalert.min.js') !!}"></script> --}}
<script src="{!! asset('js/plugins/chosen/chosen.jquery.js') !!}"></script>
<script src="{!! asset('js/plugins/touchspin/jquery.bootstrap-touchspin.min.js') !!}"></script>

<script>
	try {
		function changeAtrrValue(input, atrrs) {
			for (var key in atrrs) {
				input[key] = atrrs[key]
			}
		}

		function onChangeStatus(event) {
			var formCourse = document.forms.form
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

			// var formPayment = setTmplInsertAdjacentHTML({
			// 	tmpl: 'tmplFormsPayment',
			// 	toTmpl: 'formPayment',
			// 	data: data,
			// });

			// if (data && data.flg_main) {
			// 	formPayment.querySelector('[name$="[flg_main]"]').checked = true
			// }

			// var selectElem = formPayment.querySelector('[name$="[form_payment_id]"]')

			// populateSelectBox({
			// 	list: APP.listSelectBox.formPayment,
			// 	target: formPayment.querySelector('[name$="[form_payment_id]"]'),
			// 	columnValue: "id",
			// 	columnLabel: "description",
			// 	selectBy: data ? [data.form_payment_id] : null,
			// 	emptyOption: {
			// 		label: "Selecione..."
			// 	}
			// });

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

		function newClasses(data) {
			if (!data) {
				data = {
					id: '',
					team_id: '',
					description: '',
					type: 'presential',
					sequence: document.getElementById('classes').childElementCount + 1,
				};
			}

			data.key = generateUniqueKey()

			var tmplClasses = setTmplInsertAdjacentHTML({
				tmpl: 'tmplClasses',
				toTmpl: 'classes',
				data: data,
			});

			try {
				populate(tmplClasses, data, 'classes[' + data.key + ']')
			} catch (error) {
				console.warn(error)
			}

			try {
				var selectElem = tmplClasses.querySelector('[name$="[content_course_id]"]')

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
					var elemType = tmplClasses.querySelector('[name$="[type]"][value="' + data.type + '"]')

					elemType && (elemType.checked = true)
				}

				if (data.orientative) {
					var elemOrientative = tmplClasses.querySelector('[name$="[orientative]"][value="' + data.orientative + '"]')

					elemOrientative && (elemOrientative.checked = true)
				}

				var elemTeacher = tmplClasses.querySelector('[name$="[team_id]"]')
				populateSelectBox({
					list: APP.listSelectBox.team,
					target: elemTeacher,
					columnValue: "id",
					columnLabel: "name",
					selectBy: [ data.team_id ],
					emptyOption: {
						label: "Selecione..."
					}
				})

				var elemVideoLessons = tmplClasses.querySelector('[name$="[videoLessons][]"]')
				populateSelectBox({
					list: APP.listSelectBox.video.map(function (item) {  return { id: item.id, label: item.id + ' - ' + item.title } }),
					target: elemVideoLessons,
					columnValue: "id",
					columnLabel: "label",
					selectBy: data.video_lesson ? data.video_lesson.map(function(item) { return item.id }) : [],
				})

				$(elemVideoLessons).chosen({ width: "100%" });

				if (data.number_of_classes) {
					tmplClasses.querySelector('[name$="[number_of_classes]"][value="' + data.number_of_classes + '"]').checked = true
				}

			} catch (error) {
				console.warn(error);
			}

			try {
				setDatePicker(tmplClasses.querySelector('[name$="[start_date]"]'))
				setDatePicker(tmplClasses.querySelector('[name$="[end_date]"]'))
			} catch (error) {
				console.warn(error);
			}

			try {
				tmplClasses.querySelectorAll('.js-switch_2').forEach(function(elem) {
					if (!elem.Switchery) {
						elem.Switchery = new Switchery(elem, {
							color: '#007FB8'
						});
					}
				})
			} catch (error) {
				console.warn(error);
			}
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
					tmplModule.querySelector('[name$="[type]"][value="' + data.type + '"]').checked = true
				}

				/*
				if (data.number_of_classes) {
					tmplModule.querySelector('[name$="[number_of_classes]"][value="' + data.number_of_classes + '"]').checked = true
				}
				*/

			} catch (error) {
				console.warn(error)
			}

			setDatePicker(tmplModule.querySelector('[name$="[start_date]"]'))
		}

		function onChangeCourseTCS() {
			var courseCategoryType = document.forms.form.courseCategoryType.value
			var courseCategory = document.forms.form.courseCategory.value
			var courseSubcategory = document.forms.form.courseSubcategory.value
			var course = APP.listSelectBox.course
			var courseNew = []

			var type = APP.listSelectBox.courseCategoryType.find(function(item) { return item.id == courseCategoryType })
			var elemRepetitionPermanence = document.getElementById('repetitionPermanence')
			var elemPresentialDates = document.getElementById('presentialDates')
			if (type) {
				if (type.flg == 'ead') {
					elemRepetitionPermanence && elemRepetitionPermanence.classList.remove('hide')
					elemPresentialDates && elemPresentialDates.classList.add('hide')
				} else {
					elemRepetitionPermanence && elemRepetitionPermanence.classList.add('hide')
					elemPresentialDates && elemPresentialDates.classList.remove('hide')
				}
			} else {
				elemRepetitionPermanence && elemRepetitionPermanence.classList.add('hide')
				elemPresentialDates && elemPresentialDates.classList.add('hide')
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
				target: document.forms.form.courseCategoryType,
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
				target: document.forms.form.courseCategory,
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
				target: document.forms.form.courseSubcategory,
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
				target: document.forms.form.course_id,
				columnValue: "id",
				columnLabel: "title_pt",
				emptyOption: {
					label: "Selecione..."
				},
			})

			document.forms.form.course_id.dispatchEvent(new Event('change'))

			if (id) {
				var course = APP.listSelectBox.course.find(function(item) { return item.id == id })

				document.forms.form.courseCategoryType.value = course.course_category_type_id
				document.forms.form.courseCategory.value = course.course_category_id
				document.forms.form.courseSubcategory.value = course.course_subcategory_id
				onChangeCourseTCS()
				document.forms.form.course_id.value = id
				onChangeCourse(id)
			}
		}

		function onChangeCourse(courseId) {
			var course = APP.listSelectBox.course.find(function(item) { return item.id == courseId })

			APP.contentCourse = course ? course.content_course : []

			// var module = document.getElementById('module').querySelectorAll('[name$="[content_course_id]"]')
			// .forEach(function(item) {
			// 	console.log(item)
			// 	populateSelectBox({
			// 		list: APP.contentCourse,
			// 		target: item,
			// 		columnValue: "id",
			// 		columnLabel: "title_pt",
			// 		emptyOption: {
			// 			label: "Selecione..."
			// 		}
			// 	})
			// 	item.dispatchEvent(new Event('change'))
			// 	$(item).select2();
			// })
		}

		function submitFormContentCourse(event) {
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
					APP.contentCourse.push(resp)

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
		}

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
					APP.listSelectBox.city.push(resp)

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
					APP.listSelectBox.place.push(resp)

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

		$(document).ready(function() {
			// APP.course = {!! isset($data) ? json_encode($data) : 'null' !!}
			APP.listSelectBox = {!! isset($listSelectBox) ? json_encode($listSelectBox) : '{}' !!}
			APP.payload = {!! json_encode($payload) !!}
			if (APP.payload) {
				APP.payload.contentCourse = []

				if (APP.payload.data.teacher.length) {
					APP.payload.data.teacher.forEach(item => {
						newTeacher(item)
					});
				} else {
					newTeacher()
				}
			}

			/* if (APP.courseFormPayment.length) {
				APP.courseFormPayment.forEach(item => {
					newFormsPayment(item)
				});
			} else {
				newFormsPayment()
			} */



			setClockpicker('.input-daterange.clockpicker input')
			setDatePicker('.input-daterange .date')

			if (APP.course) {
				// changeCourse(APP.course.id)
				populate(document.forms.form)
				onChangeStatus()

				if (APP.course.permanence_all == '1') {
					document.getElementById('formClassPermanenceAll').checked = true
				}
			}

			if (APP.listSelectBox.courseCategoryType) {
				setCourseType(APP.listSelectBox.courseCategoryType)
			}

			if (APP.listSelectBox.courseCategory) {
				setCourseCourseCategory(APP.listSelectBox.courseCategory, (APP.payload && APP.payload.data ? APP.payload.data.course_id : null))
			}

			if (APP.listSelectBox.courseSubcategory) {
				setCourseCourseSubcategory(APP.listSelectBox.courseSubcategory)
			}

			if (APP.listSelectBox.course) {
				setCourse(APP.listSelectBox.course, (APP.payload && APP.payload.data ? APP.payload.data.course_id : null))
			}

			if (APP.payload) {
				if (APP.payload.data.classes.length) {
					APP.payload.data.classes.forEach(item => {
						newClasses(item)
					});
				} else {
					newClasses()
				}

				if (APP.payload.data.course_module.length) {
					APP.payload.data.course_module.forEach(item => {
						newModule(item)
					});
				} else {
					newModule()
				}
			}

			if (APP.listSelectBox.place) {
				populateSelectBox({
					list: APP.listSelectBox.place,
					target: document.forms.form.place_id,
					columnValue: "id",
					columnLabel: "description",
					selectBy: (APP.payload && APP.payload.data && APP.payload.data.place_id) ? [APP.payload.data.place_id] : null,
					emptyOption: {
						label: "Selecione..."
					}
				});
			}

			if (APP.listSelectBox.contract) {
				populateSelectBox({
					list: APP.listSelectBox.contract,
					target: document.forms.form.contract_id,
					columnValue: "id",
					columnLabel: "title",
					selectBy: (APP.course && APP.course.contract_id) ? [APP.course.contract_id] : null,
					emptyOption: {
						label: "Selecione..."
					}
				});
			}

			if (APP.listSelectBox.periodicity) {
				populateSelectBox({
					list: APP.listSelectBox.periodicity,
					target: document.forms.form.periodicity_id,
					columnValue: "id",
					columnLabel: "title",
					emptyOption: {
						label: "Selecione..."
					},
					selectBy: (APP.course && APP.course.periodicity_id) ? [APP.course.periodicity_id] : null,
				});
			}

			// if (APP.listSelectBox.courseCategory) {
			// 	populateSelectBox({
			// 		list: APP.listSelectBox.courseCategory,
			// 		target: document.forms.formContentCourse.course_category_id,
			// 		columnValue: "id",
			// 		columnLabel: "description_pt",
			// 		emptyOption: {
			// 			label: "Selecione..."
			// 		}
			// 	});
			// }

			$('.summernote').summernote({
				height: 100,
				toolbar: false,
				placeholder: 'Digite seu conteúdo',
				required: true
			});


			$(".touchspin1").TouchSpin({
				buttondown_class: 'btn btn-white',
				buttonup_class: 'btn btn-white'
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

			$('#classes').on('change', '[data-numberOfClasses]', function(event) {
				var elemEndDate = $(event.target).parents('[data-classes]').find('[data-endDate]')

				if (event.target.value != 4) {
					elemEndDate.addClass('hide')
					elemEndDate.find('input').val('')
				} else {
					elemEndDate.removeClass('hide')
				}
			})

			$('.select2').select2()

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
