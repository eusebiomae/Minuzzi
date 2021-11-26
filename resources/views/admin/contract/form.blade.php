@extends('layouts.app')

@section('title', 'Contratos')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
<link rel="stylesheet" href="{!! asset('cetcc/css/icon_fonts/css/all_icons.min.css') !!}" >
<link rel="stylesheet" href="{!! asset('css/plugins/sweetalert/sweetalert.css') !!}">


@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Inserir Contratos</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/admin') }}">Home</a>
			</li>
			<li>
				<a href="{{ url('/admin/contract') }}">Lista de Contratos</a>
			</li>
			<li class="active">
				<strong>Inserir Contrato</strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2">

	</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>Contrato <small>Cadastro de Contrato.</small></h5>
		</div>

		<div class="ibox-content">
			<form name="form" method="post" action="{{ url($urlAction) }}" enctype="multipart/form-data" class="form-horizontal">
				<div class="row">
					<input type="hidden" id="id" name="id">
					@if ($fieldPageConfig->show('title'))
					<div class="col-sm-8">
						<label class="control-label">Titulo*</label>
						<input type="text" name="title" class="form-control" {!! $fieldPageConfig->attr('title') !!}>
					</div>
					@endif
					@if ($fieldPageConfig->show('status'))
					<div class="col-sm-4">
						<label class="control-label">Status</label>
						<select name="status" class="form-control" {!! $fieldPageConfig->attr('status') !!}></select>
					</div>
					@endif
				</div>
				<div class="form-group">
					<div class="wrapper wrapper-content" style="padding-bottom:0px;">
						<div class="row">
							@if ($fieldPageConfig->show('content'))
							<div class="col-sm-12">
								<div class="ibox float-e-margins">
									<div class="ibox-title">
										<h5>Conteúdo Contrato*</h5>
									</div>
									<div class="ibox-content no-padding">
										<textarea name="content" class="summernote" {!! $fieldPageConfig->attr('content') !!}></textarea>
									</div>
								</div>
							</div>
							@endif
						</div>
						<div class="row">
							<div class="col-sm-12 text-right">
								<button class="btn btn-white gp-alert" data-gp-alert="cancel" type="submit">Cancelar</button>
								<button class="btn btn-primary gp-alert" data-gp-alert="save" type="submit">Salvar alterações</button>
							</div>
						</div>
					</div>
				</div>

				{{ csrf_field() }}
			</form>
		</div>
	</div>
</div>
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

<script src="{!! asset('js/plugins/sweetalert/sweetalert.min.js') !!}"></script>

<!-- switch -->


<script>
	document.addEventListener('DOMContentLoaded', function() {
		try {
			APP.scope.form = <?=isset($data) ? json_encode($data) : 'null'?>;
			APP.scope.listSelectBox = {!! isset($listSelectBox) ? json_encode($listSelectBox) : '{}' !!};

			if (APP.scope.listSelectBox.status) {
				populateSelectBox({
					list: APP.scope.listSelectBox.status,
					target: document.forms.form.status,
					columnValue: "flg",
					columnLabel: "label",
				});
			}

			if (APP.scope.form) {
				populate(document.forms.form, APP.scope.form);
			}

			//  Sweet alert
			$('.gp-alert').click(function ($event) {
				try {
					var gpAlertKey = $event.target.dataset.gpAlert;

					var mapAlert = {
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

			var customButtonFn = function(opt) {
				return function (context) {
					var ui = $.summernote.ui;

					var button = ui.button({
						contents: opt.contents,
						tooltip: opt.tooltip,
						click: function () {
							context.invoke('editor.insertText', opt.insertText);
						}
					});

					return button.render();
				}
			}

			var myButtons = {
				contractCompanyName: customButtonFn({
					contents: 'Nome da Empresa',
					tooltip: 'Tag do Nome no Contrato',
					insertText: '#contractCompanyName#',
				}),
				contractCompanyCNPJ: customButtonFn({
					contents: 'CNPJ da Empresa',
					tooltip: 'Tag do CNPJ no Contrato',
					insertText: '#contractCompanyCNPJ#',
				}),
				contractCompanyAddress: customButtonFn({
					contents: 'Endereço da Empresa',
					tooltip: 'Tag do Endereço no Contrato',
					insertText: '#contractCompanyAddress#',
				}),
				contractCourseName: customButtonFn({
					contents: 'Nome do Curso',
					tooltip: 'Tag do Nome do Curso no Contrato',
					insertText: '#contractCourseName#',
				}),
				contractCourseAcademicDegree: customButtonFn({
					contents: 'Grau Académico do Curso',
					tooltip: 'Tag do Grau académico do Curso no Contrato',
					insertText: '#contractCourseAcademicDegree#',
				}),
				// contractCourseStartDate: customButtonFn({
				// 	contents: 'Data de Início do Curso',
				// 	tooltip: 'Tag da Data de Início do Curso no Contrato',
				// 	insertText: '#contractCourseStartDate#',
				// }),
				contractOrderValue: customButtonFn({
					contents: 'Valor do Curso',
					tooltip: 'Tag do Valor do Curso no Contrato',
					insertText: '#contractOrderValue#',
				}),
				contractOrderNumberParcel: customButtonFn({
					contents: 'Número de parcelas do Curso',
					tooltip: 'Tag do Número de parcelas do Curso por extenso no Contrato',
					insertText: '#contractOrderNumberParcel#',
				}),
				contractOrderValueParcel: customButtonFn({
					contents: 'Valor da parcela do Curso',
					tooltip: 'Tag do Valor da parcela do Curso por extenso no Contrato',
					insertText: '#contractOrderValueParcel#',
				}),
				contractCourseMulta: customButtonFn({
					contents: 'Valor da Multa do Curso',
					tooltip: 'Tag do Valor da Multa do Curso por extenso no Contrato',
					insertText: '#contractCourseMulta#',
				}),
				// contractCourseSubcategory: customButtonFn({
				// 	contents: 'Subcategoria do Curso',
				// 	tooltip: 'Tag da Subcategoria do Curso no Contrato',
				// 	insertText: '#contractCourseSubcategory#',
				// }),
				// contractCourseStartWeek: customButtonFn({
				// 	contents: 'Dia da Semana de Início do Curso',
				// 	tooltip: 'Tag do Dia da Semana por extenso de Início do Curso no Contrato',
				// 	insertText: '#contractCourseStartWeek#',
				// }),
				// contractCourseHourPeriod: customButtonFn({
				// 	contents: 'Período da Aulas do Curso',
				// 	tooltip: 'Tag do Horário das aulas do Curso no Contrato',
				// 	insertText: '#contractCourseHourPeriod#',
				// }),
				contractCourseDuration: customButtonFn({
					contents: 'Duração Total do Curso',
					tooltip: 'Tag da Duração Total do Curso no Contrato',
					insertText: '#contractCourseDuration#',
				}),
				contractQuantModules: customButtonFn({
					contents: 'Total De Módulos',
					tooltip: 'Tag do Total De Módulos do Curso no Contrato',
					insertText: '#contractQuantModules#',
				}),
				// contractCourseMinPercentWorkload: customButtonFn({
				// 	contents: 'Porcentagem mínima da carga horária do Curso',
				// 	tooltip: 'Tag da Porcentagem mínima da carga horária do Curso no Contrato',
				// 	insertText: '#contractCourseMinPercentWorkload#',
				// }),
				// contractCourseMinValueWorkload: customButtonFn({
				// 	contents: 'Horas mínima da carga horária do Curso',
				// 	tooltip: 'Tag da Horas mínima da carga horária do Curso no Contrato',
				// 	insertText: '#contractCourseMinValueWorkload#',
				// }),
				// contractCourseServiceHours: customButtonFn({
				// 	contents: 'Horas de Atendimento em consultório do Curso',
				// 	tooltip: 'Tag da Horas de Atendimento em consultório do Curso no Contrato',
				// 	insertText: '#contractCourseServiceHours#',
				// }),
				// contractCourseHoursMonitoredSupervision: customButtonFn({
				// 	contents: 'Horas de Supervisão monitorada do Curso',
				// 	tooltip: 'Tag da Horas de Supervisão monitorada do Curso no Contrato',
				// 	insertText: '#contractCourseHoursMonitoredSupervision#',
				// }),
				contractStudentFullName: customButtonFn({
					contents: 'Nome Completo do Aluno',
					tooltip: 'Tag do Nome Completo no Contrato',
					insertText: '#contractStudentFullName#',
				}),
				contractStudentCPF: customButtonFn({
					contents: 'CPF do Aluno',
					tooltip: 'Tag do CPF no Contrato',
					insertText: '#contractStudentCPF#',
				}),
				contractStudentZipCode: customButtonFn({
					contents: 'CEP do Aluno',
					tooltip: 'Tag do CEP no Contrato',
					insertText: '#contractStudentZipCode#',
				}),
				contractStudentAddress: customButtonFn({
					contents: 'Endereço(Rua) do Aluno',
					tooltip: 'Tag do Nome da Rua no Contrato',
					insertText: '#contractStudentAddress#',
				}),
				contractStudentAddressNumber: customButtonFn({
					contents: 'Endereço(Número) do Aluno',
					tooltip: 'Tag do Número da Rua no Contrato',
					insertText: '#contractStudentAddressNumber#',
				}),
				contractStudentCity: customButtonFn({
					contents: 'Cidade do Aluno',
					tooltip: 'Tag da Cidade no Contrato',
					insertText: '#contractStudentCity#',
				}),
				contractStudentState: customButtonFn({
					contents: 'Estado do Aluno',
					tooltip: 'Tag do Estado no Contrato',
					insertText: '#contractStudentState#',
				}),
				contractStudentPhone: customButtonFn({
					contents: 'Telefone do Aluno',
					tooltip: 'Tag do Telefone no Contrato',
					insertText: '#contractStudentPhone#',
				}),
				contractStudentEmail: customButtonFn({
					contents: 'E-mail do Aluno',
					tooltip: 'Tag do E-mail no Contrato',
					insertText: '#contractStudentEmail#',
				}),
				'contractClause4.1B': customButtonFn({
					contents: 'Cláusula: 4.1 B',
					tooltip: 'Tag do E-mail no Contrato',
					insertText: '#contractClause4.1B#',
				}),
				'contractClause4.2.1': customButtonFn({
					contents: 'Cláusula: 4.2.1',
					tooltip: 'Tag do E-mail no Contrato',
					insertText: '#contractClause4.2.1#',
				}),
				'contractDateGenerateContract': customButtonFn({
					contents: 'Data que foi gerado o Contrato',
					tooltip: 'Tag da Data que foi gerado o Contrato',
					insertText: '#contractDateGenerateContract#',
				}),
			}

			console.log(JSON.stringify(Object.keys(myButtons)));


			$('.summernote').summernote({
				minHeight: 300,
				toolbar: [
					['style', ['style']],
					['font', ['bold', 'underline', 'clear']],
					['fontname', ['fontname']],
					['color', ['color']],
					['para', ['ul', 'ol', 'paragraph']],
					['table', ['table']],
					['insert', ['link', 'picture']],
					['view', ['fullscreen', 'codeview', 'help']],
					['mybutton', Object.keys(myButtons) ]
				],
				buttons: myButtons,
			});

		} catch (error) {
			console.warn(error);
		}
	});
</script>
@endsection
