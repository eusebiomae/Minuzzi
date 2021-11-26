<div data-filterDefaultClass class="row">
	<div class="col-sm-4">
		<label class="control-label">Tipo</label>
		<select name="type" class="form-control select2" onchange="onChangefilterDefaultClass(event, 'type')"></select>
	</div>
	<div class="col-sm-4">
		<label class="control-label">Categoria</label>
		<select name="category" class="form-control select2" onchange="onChangefilterDefaultClass(event, 'category')"></select>
	</div>
	<div class="col-sm-4">
		<label class="control-label">Subcategoria</label>
		<select name="subcategory" class="form-control select2" onchange="onChangefilterDefaultClass(event, 'subcategory')"></select>
	</div>

	<div class="col-sm-8">
		<label class="control-label">Curso</label>
		<select name="course" class="form-control select2" onchange="onChangefilterDefaultClass(event, 'course')"></select>
	</div>
	<div class="col-sm-4">
		<label class="control-label">Turma</label>
		<select name="class" class="form-control select2" onchange="onChangefilterDefaultClass(event, 'class')"></select>
	</div>
</div>

@section('css')
	@parent
	<link rel="stylesheet" href="{!! asset('css/plugins/select2/select2.min.css') !!}" />
@endsection

@section('scripts')
	@parent
	<script src="{!! asset('js/plugins/select2/select2.full.min.js') !!}" type="text/javascript"></script>

	<script>
		var filterDefaultClass = {!! json_encode(GigaGetData::filterDefaultClass()) !!}
		var elemFilterDefaultClass = document.querySelector('[data-filterDefaultClass]')

		filterDefaultClass.elems = {
			type: elemFilterDefaultClass.querySelector('[name="type"]'),
			category: elemFilterDefaultClass.querySelector('[name="category"]'),
			subCategory: elemFilterDefaultClass.querySelector('[name="subcategory"]'),
			course: elemFilterDefaultClass.querySelector('[name="course"]'),
			class: elemFilterDefaultClass.querySelector('[name="class"]')
		}

		if (filterDefaultClass.categoryType) {
			populateSelectBox({
				list: filterDefaultClass.categoryType,
				target: filterDefaultClass.elems.type,
				columnValue: "id",
				columnLabel: "title",
				emptyOption: {
					label: "Selecione..."
				}
			})
		}

		if (filterDefaultClass.category) {
			populateSelectBox({
				list: filterDefaultClass.category,
				target: filterDefaultClass.elems.category,
				columnValue: "id",
				columnLabel: "description_pt",
				emptyOption: {
					label: "Selecione..."
				}
			})
		}

		if (filterDefaultClass.subCategory) {
			populateSelectBox({
				list: filterDefaultClass.subCategory,
				target: filterDefaultClass.elems.subCategory,
				columnValue: "id",
				columnLabel: "description_pt",
				emptyOption: {
					label: "Selecione..."
				}
			})
		}

		if (filterDefaultClass.course) {
			populateSelectBox({
				list: filterDefaultClass.course,
				target: filterDefaultClass.elems.course,
				columnValue: "id",
				columnLabel: "title_pt",
				emptyOption: {
					label: "Selecione..."
				}
			})
		}

		if (filterDefaultClass.class) {
			populateSelectBox({
				list: filterDefaultClass.class,
				target: filterDefaultClass.elems.class,
				columnValue: "id",
				columnLabel: "name",
				emptyOption: {
					label: "Selecione..."
				}
			})
		}

		function onChangefilterDefaultClass(event, key) {
			elemFilterDefaultClass.dispatchEvent(new CustomEvent('filterDefaultClass', {
				detail: {
					key: key,
					type: event.type,
					payload: filterDefaultClass,
					parent: elemFilterDefaultClass,
					target: event.target,
				}
			}))
		}

		function filterDefaultCourses(detail) {
			var courses = [ '<option value="">Selecione...</option>' ]

			for (var i = 0; i < detail.payload.course.length; i++) {
				var course =  detail.payload.course[i]
				if (detail.payload.elems.type.value && course.course_category_type_id != detail.payload.elems.type.value) {
					continue
				}
				if (detail.payload.elems.category.value && course.course_category_id != detail.payload.elems.category.value) {
					continue
				}
				if (detail.payload.elems.subCategory.value && course.course_subcategory_id != detail.payload.elems.subCategory.value) {
					continue
				}

				courses.push('<option value="'+ course.id +'">'+ course.title_pt +'</option>')
			}

			detail.payload.elems.course.innerHTML = courses
			$(detail.payload.elems.course).select2()
		}

		function onClickFilterDefaultClassReset(event) {
			$('[data-filterdefaultclass] .select2').val('').trigger('change')
		}

		elemFilterDefaultClass.addEventListener('filterDefaultClass', function(event) {
			var detail = event.detail

			switch (detail.key) {
				case 'type':
				case 'category':
				case 'subcategory':
					filterDefaultCourses(detail)
				break;
				case 'course':
					var class_ = [ '<option value="">Selecione...</option>' ]

					for (var i = 0; i < detail.payload.class.length; i++) {
						var _class = detail.payload.class[i];

						if (detail.payload.elems.course.value && _class.course_id != detail.payload.elems.course.value) {
							continue
						}

						class_.push('<option value="'+ _class.id +'">'+ _class.name +'</option>')
					}

					detail.payload.elems.class.innerHTML = class_
					$(detail.payload.elems.class).select2()
				break;
				case 'class':
					onChangeFilterDefaultClass && onChangeFilterDefaultClass(detail.target.value)
				break;
			}
		})

		$(document).ready(function() {
			$('.select2').select2()
		})
	</script>
@endsection
