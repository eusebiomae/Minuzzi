
@extends('layouts.app')
@section('title', $module_page . ' ('. $title_page .')')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/clockpicker/clockpicker.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/switchery/switchery.css') !!}" />

<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/basic.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/dropzone.css') !!}" />
@endsection

@section('content')
@include($header)

<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-3">
			<div class="ibox float-e-margins">
				<div class="ibox-content">
					<div class="file-manager">
						<h5>Mostrar:</h5>
						<a onclick="setFilterHash('fa', null)" class="file-control active">Todos</a>
						<a onclick="setFilterHash('fa', 'file-image')" class="file-control">Imagem</a>
						<a onclick="setFilterHash('fa', 'file-video')" class="file-control">Vídeo</a>
						<a onclick="setFilterHash('fa', 'file-audio')" class="file-control">Audio</a>
						<a onclick="setFilterHash('fa', 'file-pdf')" class="file-control">PDF</a>
						<a onclick="setFilterHash('fa', 'file-word')" class="file-control">Word</a>
						<a onclick="setFilterHash('fa', 'file-powerpoint')" class="file-control">PowerPoint</a>
						<a onclick="setFilterHash('fa', 'file-excel')" class="file-control">Execel</a>
						<a onclick="setFilterHash('fa', 'file-archive')" class="file-control">Zip</a>
						<a onclick="setFilterHash('fa', 'file-alt')" class="file-control">Texto</a>
						<a onclick="setFilterHash('fa', 'file-code')" class="file-control">Código</a>
						<a onclick="setFilterHash('fa', 'file')" class="file-control">Outros</a>
						<div class="hr-line-dashed"></div>
						<button class="btn btn-primary btn-block" data-toggle="modal" data-target="#uloadFile">Upload Arquivo</button>
						@include('admin.prospection.file.uploadModal')
						<div class="hr-line-dashed"></div>
						<h5>Cursos</h5>
						<ul id="toTmplFilterListCourse" class="folder-list" style="padding: 0">
						</ul>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-9 animated fadeInRight">
			<div class="row">
				<div id="toTmplFilesDown" class="col-lg-12">

				</div>
			</div>
		</div>
	</div>
</div>

<script id="tmplFilterList" type="text/x-dot-template">
	<li><a onclick="setFilterHash('@{{= it.prefix }}', @{{= it.id ? "'" + it.id + "'" : null }})"><i class="fa fa-book"></i>@{{= it.label }}</a></li>
</script>

<script id="tmplFilesDown" type="text/x-dot-template">
	<div class="file-box">
		<div class="file">
			<a href="@{{= it.pathFile }}">
				<span class="corner"></span>

				<div class="icon">
					<i class="@{{= it.type_file }}"></i>
				</div>

				<div class="file-name">
					@{{= it.title_pt }}
					<br/>
					<small>Added: @{{= it.created_at }}</small>
				</div>
			</a>
		</div>
	</div>
</script>
@endsection

@section('scripts')
@parent
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
<script src="{!! asset('js/plugins/jasny/jasny-bootstrap.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/dropzone/dropzone.js') !!}"></script>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		APP.scope.files = <?=isset($data) ? json_encode($data) : '[]' ?>;
		APP.scope.pathFile = <?=isset($pathFile) ? json_encode($pathFile) : 'null' ?>;

		var filterHash = {};

		var listFiles = function(filters) {
			document.getElementById('toTmplFilesDown').innerHTML = '';

			var keyCount = filters ? Object.keys(filters).length : 0;

			APP.scope.files.forEach(function(data) {
				if (
					!keyCount || (
						(
							!filters.fa || ~(''+data.type_file).indexOf('fa-'+filters.fa)
						) && (
							!filters.course || filters.course == data.course_id
						)
					)
				) {
					var tmplElem = doT.template(document.getElementById('tmplFilesDown').innerText, null, null);

					data.pathFile = APP.scope.pathFile + data.link_file;

					document.getElementById('toTmplFilesDown').insertAdjacentHTML('afterbegin', tmplElem(data));
				}
			});
		};

		listFiles();

		function setFilterHash(name, id) {
			filterHash[name] = id;

			listFiles(filterHash);
		}

		window.setFilterHash = setFilterHash;

		setTimeout(function() {
			if (APP.scope.listSelectBox.course) {
				setTmplInsertAdjacentHTML({
					tmpl: 'tmplFilterList',
					toTmpl: 'toTmplFilterListCourse',
					data: {
						prefix: 'course',
						id: null,
						label: 'Todos'
					}
				});

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
		}, 500);
	});

</script>
@endsection
