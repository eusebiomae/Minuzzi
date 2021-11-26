@extends('layouts.app')

@section('title', 'Fazer a inscrição do aluno')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-9">
		<h2>Avaliação dos Alunos</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/admin') }}">Home</a>
			</li>
			<li class="active">
				Gestão Alunos
			</li>
			<li>
				Avaliação dos Alunos
			</li>
			<li class="active">
				<strong>Avaliação dos Alunos</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-3" style="padding-top: 30px; text-align: right"></div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					Lista de Avaliação por aluno
				</div>
				<div class="ibox-content">
					<form name="form" method="post" action="/admin/avaliation_student/save" class="form-horizontal">
						<div class="row">
							{{ csrf_field() }}
							<input type="hidden" name="id">

							@if ($fieldPageConfig->show('typeName'))
							<div class="col-sm-2">
								<label class="control-label">Tipo</label>
								<input type="text" name="typeName" class="form-control" disabled {!! $fieldPageConfig->attr('typeName') !!}>
							</div>
							@endif

							@if ($fieldPageConfig->show('categoryName'))
							<div class="col-sm-3">
								<label class="control-label">Categoria</label>
								<input type="text" name="categoryName" class="form-control" disabled {!! $fieldPageConfig->attr('categoryName') !!}>
							</div>
							@endif

							@if ($fieldPageConfig->show('subcategoryName'))
							<div class="col-sm-2">
								<label class="control-label">Subcategoria</label>
								<input type="text" name="subcategoryName" class="form-control" disabled {!! $fieldPageConfig->attr('subcategoryName') !!}>
							</div>
							@endif

							@if ($fieldPageConfig->show('courseName'))
							<div class="col-sm-5">
								<label class="control-label">Curso</label>
								<input type="text" name="courseName" class="form-control" disabled {!! $fieldPageConfig->attr('courseName') !!}>
							</div>
							@endif

							@if ($fieldPageConfig->show('className'))
							<div class="col-sm-4">
								<label class="control-label">Turma</label>
								{{-- Deixar apenas para visualização --}}
								<input type="text" name="className" class="form-control" disabled {!! $fieldPageConfig->attr('className') !!}>
							</div>
							@endif

							@if ($fieldPageConfig->show('studentName'))
							<div class="col-sm-8">
								<label class="control-label">Nome*</label>
								{{-- Deixar apenas para visualização --}}
								<input type="text" name="studentName" class="form-control" disabled {!! $fieldPageConfig->attr('studentName') !!}>
							</div>
							@endif
						</div>
					</form>

					<hr>

					<div class="row text-right">
						<button class="btn btn-info" onclick="addRatingNote()">Adicionar nota de avaliação</button>
					</div>

					<hr>

					<div id="dataTablesStudentAvaliation_content" class="row m-t-sm m-b-md"></div>

				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal inmodal" id="avaliationModal" tabindex="-1" role="dialog" aria-hidden="true" >
	<div class="modal-dialog" style="width: 80%">
		<div class="modal-content animated bounceInRight" style="width: 95%">
			<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Fechar</span>
					</button>
					{{-- <i class="fa fa-mail-forward modal-icon"></i> --}}
					<h4 id="dataTablesAvaliation_caption" class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<div class="m-t-sm m-b-md">
					<div id="dataTablesAvaliation_content" class="table-responsive"></div>

					<h4 id="dataTablesAvaliationRecuperation_caption" class="modal-title text-center"></h4>
					<div id="dataTablesAvaliationRecuperation_content" class="table-responsive"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-white" type="button" data-dismiss="modal">Cancelar</button>
				<button class="btn btn-primary" type="submit" data-dismiss="modal">Salvar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal inmodal" id="addRatingNoteModal" tabindex="-1" role="dialog" aria-hidden="true" >
	<div class="modal-dialog" style="width: 80%">
		<div class="modal-content animated bounceInRight" style="width: 95%">
			<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Fechar</span>
					</button>
					<h4 class="modal-title">Adicionar nota de avaliação</h4>
			</div>
			<div class="modal-body">
				<div class="m-t-sm m-b-md">
					<div class="row">
						<div class="col-sm-8">
							<label class="control-label">Avaliação*</label>
							<select id="addRatingNoteModal_avaliation" class="form-control" required ></select>
						</div>
						<div class="col-sm-4">
							<label class="control-label">Nota*</label>
							<input type="number" id="addRatingNoteModal_score" class="form-control" min="0" step=".5" required />
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-white" type="button" data-dismiss="modal">Cancelar</button>
				<button class="btn btn-primary" type="submit" data-dismiss="modal" onclick="saveRatingNote()">Salvar</button>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
@parent
<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>
<script src="{!! asset('js/plugins/dataTables/datatables.min.js') !!}" type="text/javascript"></script>
<script>
	var appPayload = {!! isset($payload) ? json_encode($payload) : '{}' !!}
	var dataTablesStudentAvaliation = null

	if (appPayload.order) {
		var form = document.forms.form

		form.id.value = appPayload.order.id
		form.className.value = appPayload.order.class.name
		form.studentName.value = appPayload.order.student.name

		form.typeName.value = appPayload.order.course.course_category_type && appPayload.order.course.course_category_type.title
		form.categoryName.value = appPayload.order.course.course_category && appPayload.order.course.course_category.description_pt
		form.subcategoryName.value = appPayload.order.course.course_subcategory && appPayload.order.course.course_subcategory.description_pt
		form.courseName.value = appPayload.order.course.title_pt
	}

	function saveAvaliationStudent(data) {
		$.ajax({
			method: 'post',
			url: '/admin/avaliation_student/save',
			data: data,
		}).done(function(resp) {
			if (resp) {
				var classes = appPayload.order.class.classes.find(function(item) { return item.id == resp.classes_id })

				if (classes) {
					var avaliationStudent = classes.avaliation.avaliation_student.find(function(item) { return item.id == resp.id })

					if (avaliationStudent) {
						Object.assign(avaliationStudent, resp)
					}
				} else {
					window.location.reload()
				}

				renderDataTablesStudentAvaliation()
			}
		})
	}

	function saveChangeAvaliation(id, key, val) {
		var data = {
			id: id,
		}

		data[key] = val

		saveAvaliationStudent(data)
	}

	function saveRatingNote() {
		var dataJson = document.querySelector('#addRatingNoteModal_avaliation option:checked').dataJson

		if (dataJson) {
			var data = {
				student_id: appPayload.order.student_id,
				order_id: appPayload.order.id,
				avaliation_id: dataJson.avaliation_id,
				classes_id: dataJson.id,
				right_wrong: 1,
				score: document.querySelector('#addRatingNoteModal_score').value,
			}

			saveAvaliationStudent(data)
		}
	}

	function getJsonDataTablesAvaliation(data) {
		return {
			data: data,
			paging: false,
			ordering: false,
			searching: false,
			responsive: false,
			dom: 't',
			columns: [
				{
					title: 'Resposta',
					data: function(row) {
						if (row.alternative) {
							return row.alternative.title
						} else
						if (row.text_response) {
							return row.text_response
						} else
						if ('' + row.yes_no) {
							return row.yes_no == 1 ? 'Sim' : 'Não'
						}

						return '-'
					}
				},
				{
					title: 'Pontuação',
					width: '100px',
					className: 'text-center',
					data: function(row) {
						if (row.question) {
							if (row.question.flg_type == 1) {
								return '<input type="number" class="form-control" value="'+ row.score +'" min="0" max="'+ row.avaliation_question.score +'" step=".5" title="Toda alteração é salva automaticamente" onkeydown="return false" onchange="saveChangeAvaliation('+ row.id +', \'score\', this.value)" />'
							}

							return numberWithCommas(row.score, 1)
						} else {
							return '<input type="number" class="form-control" value="'+ row.score +'" min="0" step=".5" title="Toda alteração é salva automaticamente" onkeydown="return false" onchange="saveChangeAvaliation('+ row.id +', \'score\', this.value)" />'
						}
					},
				},
				{
					title: 'Certo/Errado',
					width: '100px',
					className: 'text-center',
					data: function(row) {
						if (row.question?.flg_type == 1 || row.avaliation_file) {
							return '<select class="form-control" onchange="saveChangeAvaliation('+ row.id +', \'right_wrong\', this.value)" value="' + row.right_wrong + '">\
								<option value="0">Errado</option>\
								<option value="-1">Parcialmente Correta</option>\
								<option value="1">Certo</option>\
							</select>'
						}

						return 1 == row.right_wrong ? 'Certo' : 'Errado'
					},
				},
				{
					title: 'Justificativa',
					data: function(row) {
						return '<textarea class="form-control" title="Toda alteração é salva automaticamente" onchange="saveChangeAvaliation('+ row.id +', \'justification\', this.value)" style="width: 100%">'+ (row.justification || '') +'</textarea>'
					},
				},
			],
		}
	}

	function setTablesStudent(idStr, data) {
		$('#' + idStr + '_caption').text(data.title)
		$('#' + idStr + '_content').html('<table id="' + idStr + '" class="table table-striped table-bordered table-hover" style="font-size: 12px;"></table>')

		const $tableContent = $('#' + idStr + '')

		if (data.avaliation_student?.length) {
			$tableContent.DataTable(getJsonDataTablesAvaliation(data.avaliation_student))
		} else {
			if (data.avaliation_question?.length) {
				data.avaliation_question.forEach(function(avaliationQuestion, indx) {
					let tdContent = '<div style="text-align: center;">Sem resposta</div>'

					const hasAvaliationStudent = avaliationQuestion.avaliation_student?.length

					if (hasAvaliationStudent) {
						tdContent = '<table id="avaliationQuestion_' + avaliationQuestion.id + '" class="table table-striped table-bordered table-hover" style="font-size: 12px;"></table>'
					}

					$tableContent.append(`<tr style="background: ${ indx % 2 ? '#ddd' : '#eee' }"><td><h4 style="text-align: center;">${avaliationQuestion.question.title}</h4>${tdContent}</td></tr>`)

					if (hasAvaliationStudent) {
						$('#avaliationQuestion_' + avaliationQuestion.id).DataTable(getJsonDataTablesAvaliation(avaliationQuestion.avaliation_student))
					}
				});
			}
		}

		$('#' + idStr + ' select').each(function(idx, elem) {
			$el = $(elem)

			$el.val($el.attr('value'))
		})
	}

	function showModalReview(idClasses) {
		var classes = appPayload.order.class.classes.find(function(item) { return item.id == idClasses })
		$('#avaliationModal').modal('show')
		setTablesStudent('dataTablesAvaliation', classes.avaliation)

		if (classes.avaliation.recuperation?.avaliation_question?.length) {
			setTablesStudent('dataTablesAvaliationRecuperation', classes.avaliation.recuperation)
		}
	}

	function renderDataTablesStudentAvaliation() {
		$('#dataTablesStudentAvaliation_content').html('<table id="dataTablesStudentAvaliation" class="table table-striped table-bordered table-hover" style="font-size: 12px;"></table>')

		const calcAverage = function(avaliationStudent) {
			return avaliationStudent.reduce(function(score, item) {
				let val = 0

				if (item.avaliation_file) {
					return item.score
				}

				if ([-1, 1].includes(parseInt(item.right_wrong))) {
					val = parseFloat(item.score)
				}

				return score + val
			}, 0)
		}

		if (appPayload.order?.class?.classes) {
			dataTablesStudentAvaliation = $('#dataTablesStudentAvaliation').DataTable({
				data: appPayload.order.class.classes,
				paging: false,
				ordering: false,
				searching: false,
				responsive: true,
				columns: [
					{
						title: 'Avaliação',
						data: 'avaliation.title',
					},
					{
						title: 'Média',
						className: 'text-center',
						data: function(data) {
							if (data.avaliation?.avaliation_student?.length) {
								return calcAverage(data.avaliation.avaliation_student)
							}

							let average = 0

							if (data.avaliation?.avaliation_question?.length) {
								for (let i = 0; i < data.avaliation.avaliation_question.length; i++) {
									const avaliationQuestion = data.avaliation.avaliation_question[i]

									average += calcAverage(avaliationQuestion.avaliation_student)
								}
							}

							return numberWithCommas(average, 1)
						}
					},
					{
						title: 'Revisado',
						className: 'text-center',
						data: function(data) {
							if (data.avaliation?.avaliation_student?.length) {
								return 'Avaliação feita fora do sistema'
							}

							if (data.avaliation?.avaliation_question?.length) {
								let reviewed = false

								for (let i = 0; i < data.avaliation.avaliation_question.length; i++) {
									const avaliationQuestion = data.avaliation.avaliation_question[i]

									reviewed = avaliationQuestion.avaliation_student.some(function(item) {
										return item.score != null
									})

									if (reviewed) {
										break
									}
								}

								return reviewed ? 'Sim' : 'Não'
							}

							return 'Avaliação não realizada'
						},
					},
					{
						title: "Revisar",
						width: '50px',
						data: function(data, type, row, meta) {
							return '<input type="button" class="btn btn-info" value="Revisar" onclick="showModalReview(' + data.id + ')">'
						}
					}
				],
				language: {
					sEmptyTable: 'Nenhuma avaliação realizada',
				}
			})
		}
	}

	function addRatingNote() {
		$.ajax({
			method: 'get',
			url: '/admin/avaliation_student/getEvaluationNotDone',
			data: {
				idOrder: appPayload.order.id,
				idClass: appPayload.order.class_id,
			}
		}).done(function(resp) {
			$('#addRatingNoteModal').modal('show')

			populateSelectBox({
				list: resp,
				target: document.getElementById('addRatingNoteModal_avaliation'),
				columnValue: "id",
				columnLabel: "avaliation.title",
				emptyOption: {
					label: "Selecione..."
				}
			})
		})
	}

	$(function() {
		renderDataTablesStudentAvaliation()
	})
</script>
@endsection
