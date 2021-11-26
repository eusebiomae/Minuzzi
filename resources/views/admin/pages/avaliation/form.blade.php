@section('css')
	<link rel="stylesheet" href="{!! asset('css/plugins/clockpicker/clockpicker.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/select2/select2.min.css') !!}" />
@endsection

<div class="row m-b-md">
	<div class="col-sm-6">
		<label class="control-label">Tipo de Avaliação:</label>
		<select class="form-control select2" name="avaliation_type_id" onchange="changeAvaliationType(this.value)"></select>
	</div>

	<div class="col-sm-6 avaliationTypeSix">
		<label class="control-label">Recuperação da Avaliação:</label>
		<select class="form-control select2" name="avaliation_id" title="Tipo de Avaliação deve ser Recuperação" disabled></select>
	</div>

	<div class="col-sm-12">
		<label class="control-label">Título:</label>
		<input type="text" name="title" class="form-control" maxlength="255">
	</div>
</div>

<div class="row m-b-md avaliationTypeSix">
	<div class="col-sm-4">
		<label class="control-label">Tipo</label>
		<select id="course_category_type_id" name="course_category_type_id"  class="form-control select2"></select>
	</div>
	<div class="col-sm-4">
		<label class="control-label">Categoria</label>
		<select id="category_id" name="category_id" class="form-control select2"></select>
	</div>
	<div class="col-sm-4">
		<label class="control-label">Subcategoria</label>
		<select id="course_subcategory_id" name="course_subcategory_id" class="form-control select2"></select>
	</div>
</div>

<div class="row m-b-md avaliationTypeSix">
	<div class="col-sm-6">
		<label class="control-label">Curso</label>
		<select name="course_id" class="form-control select2"></select>
	</div>
	<div class="col-sm-6">
		<label class="col-sm-1 control-label">Turma</label>
		<select name="class_id" class="form-control select2"></select>
	</div>
</div>

<div class="row m-b-md">

	<div class="col-sm-4 input_hidden avaliationTypeSix">
		<label class="m-b control-label">Data:</label>
		<div class="input-group date">
			<span class="input-group-addon">
				<i class="fa fa-calendar"></i>
			</span>
			<input type="text" class="form-control" name="date" value="" readonly>
		</div>
	</div>

	<div class="col-sm-4 input_hidden avaliationTypeSix">
		<label class="control-label">Hora Início:</label>
		<div class="input-group clockpicker" data-autoclose="true">
			<input type="text" class="form-control" name="start_time" value="" readonly>
			<span class="input-group-addon">
				<span class="fa fa-clock-o"></span>
			</span>
		</div>
	</div>

	<div class="col-sm-4 input_hidden avaliationTypeSix">
		<label class="control-label">Hora Final:</label>
		<div class="input-group clockpicker" data-autoclose="true">
			<input type="text" class="form-control" name="final_time" value="" readonly>
			<span class="input-group-addon">
				<span class="fa fa-clock-o"></span>
			</span>
		</div>
	</div>

	<div class="col-sm-6">
		<label class="control-label">Duration:</label>
		<div class="input-group clockpicker" data-autoclose="true">
			<input type="text" name="duration" class="form-control" value="" readonly>
			<span class="input-group-addon">
				<span class="fa fa-clock-o"></span>
			</span>
		</div>
	</div>

	<div class="col-sm-6 avaliationTypeSix">
		<label class="control-label">Banner:</label>
		<select class="form-control select2" name="slide_id"></select>
	</div>

</div>

<div class="row m-t-md">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Digite o Enunciado e os Aviso da Avaliação em Português*</h5>
			</div>
			<div class="ibox-content no-padding">
				<textarea id="description" name="description" class="summernote"></textarea>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-8">
		<label class="control-label">Perguntas</label>
		<select id="question" class="form-control select2" onchange="changeQuestion(this.value)"></select>
		<small class="form-text text-muted">Selecione a pergunta que deseja adicionar na prova.</small>
	</div>

	<div class="col-sm-2">
		<label class="control-label">Pontuação</label>
		<input id="score" type="number" class="form-control" maxlength="5" min=".5" max="10" step=".5">
	</div>

	<div class="col-sm-2" style="top:25px;">
		<button class="btn btn-primary btn-circle btn-md align-bottom" onclick="addQuestion()" type="button"><i class="fa fa-1x fa-plus"></i></button>
	</div>
</div>
<div class="row m-t-md" id="toTmplQuestion"></div>

<script id="tmplQuestion" type="text/x-dot-template">
	<div class="col-sm-12" data-question="@{{= it.id }}" >
		<div class="ibox float-e-margins shadow-sm">

			<div class="ibox-tools">
				<a class="collapse-link">
					<i class="fa fa-chevron-up"></i>
				</a>
				<a class="close-link" onclick="javascript: $(this).parent('[data-question]').remove()">
					<i class="fa fa-times"></i>
				</a>
			</div>

			<div class="ibox-title no-borders">
				<h5>
					@{{= it.title }}
					<small>@{{= it.type }}</small>
					<small class="badge bg-light text-dark">
						Pontuação: <input type="number" name="question[@{{= it.id }}][score]" value="@{{= it.score }}" maxlength="5" min=".5" max="10" step=".5" style="width: 50px" />
					</small>
				</h5>
			</div>

			<div class="ibox-content">
				<p>
					@{{= it.name }}
				</p>
				<ol type="a" id="question_@{{= it.id }}_alternative"></ol>
			</div>
		</div>
	</div>
</script>

<script id="tmplAlternative" type="text/x-dot-template">
	<li style="@{{= it.flg_correct }}">@{{= it.alter }}</li>@{{= it.x_alter }}
</script>

@section('scripts')
	@parent
	<script src="{!! asset('js/plugins/clockpicker/clockpicker.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}" type="text/javascript"></script>
	{{-- input mask --}}
	<script src="{!! asset('js/plugins/jasny/jasny-bootstrap.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/select2/select2.full.min.js') !!}" type="text/javascript"></script>

	<script type="text/javascript">
		setClockpicker('.clockpicker input');
		setDatePicker('.input-group.date', {
			startView: 2,
		});

		$(document).ready(function() {
			$('#course_category_type_id').on('change', function() {
				switch($(this).val()) {
					case '1':
					case '2':
					showFields(this.value);
						break;
					case '3':
					hideFields(this.value);
						break;
				}
			})

			populateSelectBox({
				list: APP.listSelectBox.courseCategoryType,
				target: document.form.course_category_type_id,
				columnValue: "id",
				columnLabel: "title",
				selectBy: (APP.payload && APP.payload.data && APP.payload.data.course_category_type_id) ? [APP.payload.data.course_category_type_id] : null,
				emptyOption: {
					label: "Selecione..."
				}
			})

			populateSelectBox({
				list: APP.listSelectBox.courseCategory,
				target: document.form.category_id,
				columnValue: "id",
				columnLabel: "description_pt",
				selectBy: (APP.payload && APP.payload.data && APP.payload.data.category_id) ? [APP.payload.data.category_id] : null,
				emptyOption: {
					label: "Selecione..."
				}
			})

			populateSelectBox({
				list: APP.listSelectBox.courseSubcategory,
				target: document.form.course_subcategory_id,
				columnValue: "id",
				columnLabel: "description_pt",
				selectBy: (APP.payload && APP.payload.data && APP.payload.data.course_subcategory_id) ? [APP.payload.data.course_subcategory_id] : null,
				emptyOption: {
					label: "Selecione..."
				}
			})

			populateSelectBox({
				list: APP.listSelectBox.course,
				target: document.form.course_id,
				columnValue: "id",
				columnLabel: "title_pt",
				selectBy: (APP.payload && APP.payload.data && APP.payload.data.course_id) ? [APP.payload.data.course_id] : null,
				emptyOption: {
					label: "Selecione..."
				}
			})

			populateSelectBox({
				list: APP.listSelectBox.class,
				target: document.form.class_id,
				columnValue: "id",
				columnLabel: "name",
				selectBy: (APP.payload && APP.payload.data && APP.payload.data.class_id) ? [ APP.payload.data.class_id ] : null,
				emptyOption: {
					label: "Selecione..."
				}
			})

			populateSelectBox({
				list: APP.listSelectBox.slide,
				target: document.form.slide_id,
				columnValue: "id",
				columnLabel: "title_pt",
				selectBy: (APP.payload && APP.payload.data && APP.payload.data.slide_id) ? [ APP.payload.data.slide_id ] : null,
				emptyOption: {
					label: "Selecione..."
				}
			})

			populateSelectBox({
				list: APP.listSelectBox.avaliationType,
				target: document.form.avaliation_type_id,
				columnValue: "id",
				columnLabel: "name",
				selectBy: (APP.payload && APP.payload.data && APP.payload.data.avaliation_type_id) ? [ APP.payload.data.avaliation_type_id ] : null,
			})

			populateSelectBox({
				list: APP.listSelectBox.avaliation ?? [],
				target: document.form.avaliation_id,
				columnValue: "id",
				columnLabel: "title",
				selectBy: APP.payload?.data?.avaliation_id ? [ APP.payload.data.avaliation_id ] : null,
				emptyOption: {
					label: "Selecione..."
				}
			})

			$('#category_id').change(function() {
				var category_val = $('#category_id').val();
				var filter = [];

				APP.listSelectBox.questions.forEach(item => {
					item['category_id'] == category_val && filter.push(item);
				});

				populateSelectBox({
					list: filter,
					target: document.getElementById('question'),
					columnValue: "id",
					columnLabel: "title",
					emptyOption: {
						label: "Selecione..."
					}
				})
			});

			populateSelectBox({
				list: APP.listSelectBox.questions,
				target: document.getElementById('question'),
				columnValue: "id",
				columnLabel: "title",
				emptyOption: {
					label: "Selecione..."
				}
			})

			$('.select2').select2();

			try {
				if (APP.payload?.data) {
					APP.payload.data.question.forEach(addQuestion)

					changeAvaliationType(APP.payload.data.avaliation_type_id)
				}
			} catch (error) {
				console.warn(error)
			}

			var selectCourseCategoryType = document.getElementById('course_category_type_id');

			if (selectCourseCategoryType.value == 3) {
				hideFields()
			}
		});

		function addQuestion(question = null) {
			var idQuestion = null
			var score = 0

			if (!question) {
				idQuestion = $('#question').val()
				score = $('#score').val()

				if (!idQuestion || !(score > 0)) {
					return
				}

				$('#question').val('').change()
				$('#score').val('')
				question = APP.listSelectBox.questions.find(function(item) { return item.id == idQuestion })
			}

			if(question) {
				if ($('#toTmplQuestion [data-question="' + question.id + '"]').length) {
					return
				}

				if (question.pivot) {
					score = question.pivot.score
				}

				var tmplQuestion = setTmplInsertAdjacentHTML({
					data: {
						name: question.description,
						id: question.id,
						type: question.type,
						typeChoose: question.flg_type == 2 ? 'radio' : 'check',
						title: question.title,
						score: score,
						key: "alt"
					},
					tmpl: 'tmplQuestion',
					toTmpl: 'toTmplQuestion',
				});

				if (question.alternative) {
					if (question.flg_type == 4) {
						var element = question.alternative[0];
						setTmplInsertAdjacentHTML({
							data: {
								alter: 'Sim',
								flg_correct: element['flg_correct'] == 1 ? 'font-weight:700' : '',
								y_flg_correct: element['flg_correct'] == 2 ? 'font-weight:700' : '',
								x_alter: '<li style="@{{= it.y_flg_correct }}">Não</li>'
							},
							tmpl: 'tmplAlternative',
							toTmpl: 'question_' + question.id + '_alternative',
						});
					} else {
						question.alternative.forEach( element => {
							setTmplInsertAdjacentHTML({
								data: {
									alter: element['title'],
									flg_correct: element['flg_correct'] == 1 ? 'font-weight:700' : '',
									y_flg_correct: '',
									x_alter: '',
								},
								tmpl: 'tmplAlternative',
								toTmpl: 'question_' + question.id + '_alternative',
							});
						});
					}
				}

				tmplQuestionDependence(tmplQuestion)
			}
		}

		function changeQuestion(idQuestion) {
			if (idQuestion) {
				var question = APP.listSelectBox.questions.find(function(item) { return item.id == idQuestion })
				if (question) {
					$('#score').val(question.score)
				}
			}
		}

		function changeAvaliationType(idAvaliationType) {
			var elemAvaliationId = $('[name="avaliation_id"]');
			var disabled = idAvaliationType != 2;

			(disabled) ? elemAvaliationId.prop('disabled', true) : elemAvaliationId.val('').prop('disabled', false).change();

			if(idAvaliationType == 6){
				$('.avaliationTypeSix').css('display', 'none');
				$('select[name="avaliation_type_id"]').parent().removeClass('col-sm-6').addClass('col-sm-4');
				$('input[name="title"]').parent().removeClass('col-sm-12').addClass('col-sm-8');
			}else{
				$('.avaliationTypeSix').css('display', '');
				$('select[name="avaliation_type_id"]').parent().removeClass('col-sm-4').addClass('col-sm-6');
				$('input[name="title"]').parent().removeClass('col-sm-8').addClass('col-sm-12');
			}
		}

		function showFields(data) {
			$('.input_hidden').removeClass('hidden');
		}

		function hideFields() {
			$('.input_hidden').addClass('hidden');
		}

		function tmplQuestionDependence(tmplQuestion) {
			// Collapse ibox function
			$(tmplQuestion).find('.collapse-link').on('click', function () {
				var ibox = $(tmplQuestion).find('div.ibox');
				var button = $(tmplQuestion).find('i');
				var content = ibox.children('.ibox-content');
				content.slideToggle(200);
				button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
				ibox.toggleClass('').toggleClass('border-bottom');
				setTimeout(function () {
					ibox.resize();
					ibox.find('[id^=map-]').resize();
				}, 50);
			});

			// Close ibox function
			$(tmplQuestion).find('.close-link').on('click', function () {
				$(tmplQuestion).remove();
			});

			$(tmplQuestion).find('.i-checks').iCheck({
				checkboxClass: 'icheckbox_square-green',
				radioClass: 'iradio_square-green',
			});
		}
	</script>
@endsection
