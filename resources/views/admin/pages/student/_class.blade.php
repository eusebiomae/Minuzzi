@extends('layouts.app')

@section('title', $module_page . ' ('. $title_page .')')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/clockpicker/clockpicker.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/switchery/switchery.css') !!}" />
@endsection

@section('content')
@include($header)

<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-content">
					<div class="file-manager">
						<h5>Categoria</h5>
						<ul id="toTmplFilterListCategory" class="folder-list" style="padding: 0"></ul>
						<h5>Cursos</h5>
						<ul id="toTmplFilterListCourse" class="folder-list" style="padding: 0"></ul>
						<h5>Turmas</h5>
						<ul id="toTmplFilterListClass" class="folder-list" style="padding: 0"></ul>
						<div class="hr-line-dashed"></div>
						<a href="{{ url('/admin/prospection/registry/insert') }}">
							<button class="btn btn-primary btn-block">
								Novo Aluno
							</button>
						</a>
						<div class="hr-line-dashed"></div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-9 animated fadeInRight">
			<div class="row">
				<div id="toTmplRegistries" class="col-lg-12"></div>
			</div>
		</div>
	</div>
</div>

<script id="tmplFilterList" type="text/x-dot-template">
	<li><a href="#@{{= it.prefix }}-@{{= it.id }}"><i class="fa fa-book"></i>@{{= it.label }}</a></li>
</script>

<script id="tmplRegistries" type="text/x-dot-template">
	<div class="col-lg-6">
		<div class="contact-box">
			<a href="#">
				<div class="col-sm-4">
					<div class="text-center">
						<img alt="image" class="img-circle m-t-xs img-responsive" src="img/a2.jpg">
						<div class="m-t-xs font-bold">@{{= it.leads ? it.leads.badge_name : '' }}</div>
					</div>
				</div>
				<div class="col-sm-8">
					<h3 class="m-b-xs"><strong>@{{= it.leads ? it.leads.full_name : '' }}</strong></h3>
					<div class="font-bold">@{{= it.leads ? it.leads.birth_date : '' }}</div>
					<strong>@{{= it.leads ? it.leads.gender : '' }}</strong><br>

					<address class="m-t-md">
						<abbr title="Telefone Residencial"><strong>Tel: </strong></abbr> @{{= it.leads ? it.leads.phone : '' }}<br>
						<abbr title="Celular (Whatsapp)"><strong>Cel: </strong></abbr> @{{= it.leads ? it.leads.cel_phone : '' }}<br>
						<abbr title="E-mail Pessoal"><strong>Email: </strong></abbr> @{{= it.leads ? it.leads.email : '' }}<br>
					</address>

					<company class="m-t-md">
						<abbr title="Nome da Empresa"><strong>Empresa: </strong></abbr> @{{= it.leads ? it.leads.company_name : '' }}<br>
						<abbr title="Qual a função na Empresa"><strong>Cargo: </strong></abbr>@{{= it.leads ? it.leads.office : '' }}<br>
						<abbr title="Setor ou Ramo de trabalho"><strong>Departamento: </strong></abbr> @{{= it.leads ? it.leads.department : '' }}<br>
					</company>
				</div>
				<div class="clearfix"></div>
			</a>
		</div>
	</div>
</script>

@endsection

@section('scripts')
<!-- Mainly scripts -->
<script src="{!! asset('js/plugins/metisMenu/jquery.metisMenu.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}" type="text/javascript"></script>


<!-- Custom and plugin javascript -->
<script src="{!! asset('js/inspinia.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/pace/pace.min.js') !!}" type="text/javascript"></script>

<!-- SUMMERNOTE -->
<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}" type="text/javascript"></script>

<!-- Page-Level Scripts -->
<script src="{!! asset('js/plugins/dataTables/datatables.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/switchery/switchery.js') !!}" type="text/javascript"></script>

<script>
	try {
		APP.scope.listSelectBox = <?=isset($listSelectBox) ? json_encode($listSelectBox) : 'null' ?>;
		APP.scope.registries = <?=isset($data) ? json_encode($data) : '[]' ?>;

		if (APP.scope.listSelectBox) {

			if (APP.scope.listSelectBox.courseCategory) {
				APP.scope.listSelectBox.courseCategory.forEach(function(item) {
					setTmplInsertAdjacentHTML({
						tmpl: 'tmplFilterList',
						toTmpl: 'toTmplFilterListCategory',
						data: {
							prefix: 'courseCategory',
							id: item.id,
							label: item.description_pt
						}
					});
				});
			}

			if (APP.scope.listSelectBox.course) {
				APP.scope.listSelectBox.course.forEach(function(item) {
					setTmplInsertAdjacentHTML({
						tmpl: 'tmplFilterList',
						toTmpl: 'toTmplFilterListCourse',
						data: {
							prefix: 'course',
							id: item.id,
							label: item.title_pt
						}
					});
				});
			}

			if (APP.scope.listSelectBox.class) {
				APP.scope.listSelectBox.class.forEach(function(item) {
					setTmplInsertAdjacentHTML({
						tmpl: 'tmplFilterList',
						toTmpl: 'toTmplFilterListClass',
						data: {
							prefix: 'class',
							id: item.id,
							label: item.name
						}
					});
				});
			}
		}

		var listRegistries = function() {
			var typeFilter = window.location.hash;

			typeFilter = typeFilter && typeFilter.split('-');
			document.getElementById('toTmplRegistries').innerHTML = '';

			var callBackFilter = function(item) {
				return true;
			};

			switch (typeFilter[0]) {
				case '#courseCategory': {
					callBackFilter = (function(courses) {
						var coursesId = courses.reduce(function(coursesId, course) {
							if (course.course_category_id == typeFilter[1]) {
								coursesId.push(course.id);
							}

							return coursesId;
						}, []);

						return function(item) {
							return ~coursesId.indexOf(item.course_id);
						};
					})((APP && APP.scope && APP.scope.listSelectBox && APP.scope.listSelectBox.course) || []);
				} break;
				case '#course': {
					callBackFilter = function(item) {
						return item.course_id == typeFilter[1];
					}
				} break;
				case '#class': {
					callBackFilter = function(item) {
						return item.class_id == typeFilter[1];
					}
				} break;
			}

			APP.scope.registries.forEach(function(item) {
				if (!typeFilter || callBackFilter(item)) {
					setTmplInsertAdjacentHTML({
						tmpl: 'tmplRegistries',
						toTmpl: 'toTmplRegistries',
						data: item,
					});
				}
			});
		}

		listRegistries();

		window.addEventListener("hashchange", listRegistries);

	} catch(error) {
		console.error(error);
	}
</script>
@endsection
