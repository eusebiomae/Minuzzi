@extends('layouts.app')

{{-- @section('title', $module_page . ' ('. $title_page .')') --}}

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
<link rel="stylesheet" href="{!! asset('css/plugins/sweetalert/sweetalert.css') !!}"/>
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
							<form name="formCourse" method="post" action="{{ url($urlAction) }}" class="form-horizontal" enctype="multipart/form-data">
								@include('admin.prospection.includedItems.form_group')
								<div class="form-group">
									<div class="col-sm-12 text-right">
										<button class="btn btn-white gp-alert" data-gp-alert="cancel" type="submit">Cancelar</button>
										<button class="btn btn-primary gp-alert" data-gp-alert="save" type="submit">Salvar alterações</button>
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

@endsection

@section('scripts')
<!-- Mainly scripts -->
<script src="{!! asset('js/plugins/metisMenu/jquery.metisMenu.js') !!}"></script>
<script src="{!! asset('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}"></script>


<!-- Custom and plugin javascript -->
<script src="{!! asset('js/inspinia.js') !!}"></script>
<!-- SUMMERNOTE -->
<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}"></script>

<!-- Page-Level Scripts -->
<script src="{!! asset('js/plugins/dataTables/datatables.min.js') !!}"></script>
<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>
<script src="{!! asset('js/plugins/clockpicker/clockpicker.js') !!}"></script>
<script src="{!! asset('js/plugins/switchery/switchery.js') !!}"></script>
<script src="{!! asset('js/plugins/jasny/jasny-bootstrap.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/dropzone/dropzone.js') !!}"></script>
<script src="{!! asset('js/plugins/sweetalert/sweetalert.min.js') !!}"></script>


<script>
	$(document).ready(function() {
		try {
			APP = {
				scope: {
					course: <?=isset($data) ? json_encode($data) : 'null' ?>,
					listSelectBox: <?=isset($listSelectBox) ? json_encode($listSelectBox) : 'null' ?>,
					pathFile: <?=isset($pathFile) ? json_encode($pathFile) : 'null' ?>,
				}
			};

			if (APP.scope.course) {
				populate(document.forms.formCourse, APP.scope.course);
				if (APP.scope.course.img) {
					var img = document.createElement('img');
					img.setAttribute('src', '/' + APP.scope.pathFile + '/' + APP.scope.course.img);
					img.style.maxHeight = '100px';

					document.getElementById('img').appendChild(img);
				}
			}

			if (APP.scope.listSelectBox) {
				if (APP.scope.listSelectBox.course) {

					populateSelectBox({
						list: APP.scope.listSelectBox.course,
						target: document.forms.formCourse.course_id,
						columnValue: "id",
						columnLabel: "title_pt",
						selectBy: (APP.scope.course && APP.scope.course.course_id) ? [APP.scope.course.course_id] : null,
						emptyOption: {
							label: "Selecione o curso"
						}
					});
				}
			}

			$('.summernote').summernote({
				height: 100,
				placeholder: 'Digite seu conteúdo',
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

</script>
<script>

try {

} catch(error) {
	console.warn(error);
}
</script>
@endsection
