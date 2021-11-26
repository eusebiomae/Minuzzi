{{-- <script id="tmplClasses" type="text/x-dot-template">

</script> --}}

<div id="dataTablesClasses" class="table-responsived"></div>

@section('modals')
<div class="modal inmodal" id="modalClasses" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Cadastrar nova Aula</h4>
			</div>
			<form name="formModalClasses" class="form-horizontal" onsubmit="submitFormModalClasses(event)">
				<div class="modal-body gp-m-1">
					@include('admin.classes.classesForm')
				</div>

				<div class="modal-footer">
					<button class="btn btn-white" type="reset" data-dismiss="modal">Cancelar</button>
					<button class="btn btn-primary" type="submit">Salvar alterações</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('scripts')
@parent
<script>
	function submitFormModalClassesDelete(id) {
		$.ajax({
			url: '/admin/classes/delete/' + id,
			method: 'get',
		}).then(function(resp) {
			for (let i = 0; i < APP.payload.classes.length; i++) {
				if (APP.payload.classes[i].id == id) {
					APP.payload.classes.splice(i, 1)
					break
				}
			}

			dataTablesClasses()
		})
	}

	function submitFormModalClasses(event) {
		event.preventDefault()
		var serializedData = $(event.target).serialize()

		if (!submitFormModalClasses.ajax) {
			submitFormModalClasses.ajax = true
			$('#sk-preloader').delay(350).fadeIn('slow')

			$.ajax({
				url: '/admin/classes/save',
				method: 'post',
				data: serializedData,
			}).then(function(resp) {
				submitFormModalClasses.ajax = false
				$('#sk-preloader').delay(350).fadeOut('slow')

				if (resp && resp.id) {
					var isNew = true
					for (let i = 0; i < APP.payload.classes.length; i++) {
						if (APP.payload.classes[i].id == resp.id) {
							APP.payload.classes[i] = resp
							isNew = false
							break
						}
					}

					if (isNew) {
						APP.payload.classes.push(resp)
					}

					dataTablesClasses()
					$('#modalClasses').modal('hide')
				}
			})

		}
	}
	submitFormModalClasses.ajax = false

	function modalClasses(id) {
		var formModalClasses = $('#modalClasses form[name="formModalClasses"]')[0]

		$('#modalClasses').modal('show')

		formModalClasses.reset()

		var data = null

		if (id) {
			data = APP.payload.classes.find(function(item) { return item.id == id })
			console.log(data);
		}

		if (!data) {
			data = {
				id: '',
				team_id: '',
				evaluation_link: '',
				description: '',
				type: 'presential',
				number_of_classes: 1,
				class_id: APP.scope.course.id,
			}

			var lastData = APP.payload.classes[APP.payload.classes.length - 1]

			if (lastData) {
				data.sequence = lastData.sequence + 1
			}
		}

		populate(formModalClasses, data, 'classes')

		populateSelectBox({
			list: APP.contentCourse,
			target: formModalClasses.querySelector('[name$="[content_course_id]"]'),
			columnValue: "id",
			columnLabel: "title_pt",
			selectBy: data.content_course_id ? [ data.content_course_id ] : null,
			emptyOption: {
				label: "Selecione..."
			}
		})

		populateSelectBox({
			list: APP.scope.listSelectBox.avaliation,
			target: formModalClasses.querySelector('[name$="[avaliation_id]"]'),
			columnValue: "id",
			columnLabel: "title",
			selectBy: data.avaliation_id ? [ data.avaliation_id ] : null,
			emptyOption: {
				label: "Selecione..."
			}
		})

		if (data.type) {
			var elemType = formModalClasses.querySelector('[name$="[type]"][value="' + data.type + '"]')

			if (elemType) {
				elemType.checked = true

				onChangeClassesType(elemType)
			}
		}

		if (data.orientative) {
			var elemOrientative = formModalClasses.querySelector('[name$="[orientative]"][value="' + data.orientative + '"]')

			elemOrientative && (elemOrientative.checked = true)
		}

		if (data.number_of_classes) {
			formModalClasses.querySelector('[name$="[number_of_classes]"][value="' + data.number_of_classes + '"]').checked = true
		}

		var elemVideoLessons = formModalClasses.querySelector('[name$="[videoLessons][]"]')

		populateSelectBox({
			list: APP.scope.listSelectBox.video.map(function (item) {  return { id: item.id, label: item.id + ' - ' + item.title } }),
			target: elemVideoLessons,
			columnValue: "id",
			columnLabel: "label",
			selectBy: data.video_lesson ? data.video_lesson.map(function(item) { return item.id }) : [],
		})

		var selectElemAvaliation = formModalClasses.querySelector('[name$="[avaliation_id]"]')
		populateSelectBox({
			list: APP.scope.listSelectBox.avaliation,
			target: selectElemAvaliation,
			columnValue: "id",
			columnLabel: "title",
			selectBy: [ data.avaliation_id ],
			emptyOption: {
				label: "Selecione..."
			}
		})

		var elemTeacher = formModalClasses.querySelector('[name$="[team_id]"]')
		populateSelectBox({
			list: APP.payload.teacher.map(function(item) { return  item.team}),
			target: elemTeacher,
			columnValue: "id",
			columnLabel: "name",
			selectBy: [ data.team_id ],
			emptyOption: {
				label: "Selecione..."
			}
		})

		$('#modalClasses form[name="formModalClasses"] select.select2').select2()
		$(elemVideoLessons).trigger("chosen:updated").chosen({ width: "100%" });
		setDatePicker('#modalClasses form[name="formModalClasses"] [name$="[start_date]"], #modalClasses form[name="formModalClasses"] [name$="[end_date]"]')

		var classesModuleAvaliation = document.getElementById(data.avaliation_id ? 'classesAvaliation' : 'classesModule')

		classesModuleAvaliation.checked = true
		onChangeClassesModuleAvaliation(classesModuleAvaliation)
	}

	function dataTablesClasses() {
		var course = APP.scope.listSelectBox.course.find(function(item) { return item.id == APP.scope.course.course_id })
		var courseCategoryType = APP.scope.listSelectBox.courseCategoryType.find(function(item) { return item.id == course.course_category_type_id })

		$('#dataTablesClasses').html('<table id="dataTables-classes" class="table table-striped table-bordered table-hover" style="width: 100%"></table>')

		$('#dataTables-classes').DataTable({
			pageLength: 25,
			ordering: false,
			responsive: true,
			dom: '<"html5buttons"B>lTfgitp',
			data: APP.payload.classes,
			columns: [
			{
				title: function() { return courseCategoryType.flg == 'ead' ? 'Sequência' : 'Data da Aula' },
				data: function(data) {
					if (courseCategoryType.flg == 'ead') {
						return data.sequence
					} else {
						var date = data.start_date

						if (data.end_date) {
							date += '<br>' + data.end_date
						}

						return date
					}
				},
				className: 'text-center',
			},
			{
				title: 'Tipo',
				data: function(data) {
					return data.content_course ? 'Módulo' : (data.avaliation ? 'Avaliação' : '')
				}
			},
			{
				title: 'Título',
				data: function(data) {
					return data.content_course ? data.content_course.title_pt : (data.avaliation ? data.avaliation.title : '')
				}
			},
			{ title: '', data: 'typeLabel', className: 'text-center', },
			{ title: 'Qtd. Aula(s)', data: 'number_of_classes', className: 'text-center', },
			{ title: "Orientativo", data: function(data) { return data.orientative == 'yes' ? 'Sim' : 'Não' } },
			{
				title: '',
				width: '45px',
				className: 'text-center',
				render: function( data, type, row, meta ) {
					return '<button type="button" class="btn btn-primary btn-outline" onclick="modalClasses('+ row.id +')"><i class="fas fa-pencil-alt" title="Editar"></i></button>'
				}
			},
			{
				title: '',
				width: '45px',
				className: 'text-center',
				render: function( data, type, row, meta ) {
					return '<button type="button" class="btn btn-danger btn-outline" onclick="submitFormModalClassesDelete('+ row.id +')"><i class="fas fa-trash-alt" title="Desabilitar"></i></button>'
				}
			},
			],
			buttons: [ {
				text: '<i class="fa fa-plus"></i>',
				titleAttr: 'Adicionar novo',
				className: 'btn btn-primary',
				action: function(dt) {
					modalClasses()
				},
			} ]
		})
	}

	$(document).ready(function() {
		dataTablesClasses()
	});

	/*
	$('#classes').on('change', '[data-numberOfClasses]', function(event) {
		var elemEndDate = $(event.target).parents('[data-classes]').find('[data-endDate]')

		if (event.target.value != 4) {
			elemEndDate.addClass('hide')
			elemEndDate.find('input').val('')
		} else {
			elemEndDate.removeClass('hide')
		}
	})

	function newClasses(data) {


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
				var elemType = tmplClasses.querySelector('[name$="[type]"][value="' + data.type + '"]')

				elemType && (elemType.checked = true)
			}

			if (data.orientative) {
				var elemOrientative = tmplClasses.querySelector('[name$="[orientative]"][value="' + data.orientative + '"]')

				elemOrientative && (elemOrientative.checked = true)
			}

			var elemTeacher = tmplClasses.querySelector('[name$="[team_id]"]')
			populateSelectBox({
				list: APP.payload.teacher.map(function(item) { return  item.team}),
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
				list: APP.scope.listSelectBox.video.map(function (item) {  return { id: item.id, label: item.id + ' - ' + item.title } }),
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
			console.warn(error)
		}

		try {
			setDatePicker(tmplClasses.querySelector('[name$="[start_date]"]'))
			setDatePicker(tmplClasses.querySelector('[name$="[end_date]"]'))
		} catch (error) {
			console.warn(error)
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
			console.warn(error)
		}
	}

	if (APP.payload.classes.length) {
		APP.payload.classes.forEach(item => {
			newClasses(item)
		});
	} else {
		newClasses()
	}
	*/
</script>
@endsection
