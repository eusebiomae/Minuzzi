@extends('layouts.app')

@section('title', 'Rank')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/select2/select2.min.css') !!}" />

@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-12">
    <h2>Lista de Rank</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li>
        <a href="{{ url('/admin/all') }}">Rank</a>
      </li>
      <li class="active">
        <strong>Lista de Rank</strong>
      </li>
    </ol>
  </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">

      {{-- FILTRO AVANÇADO --}}
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Filtro Avançado<small>Example of login in modal box</small></h5>
          <div class="ibox-tools">
            <a class="collapse-link">
              <i class="fa fa-chevron-up"></i>
            </a>
          </div>
        </div>
        <div class="ibox-content">
          <div class="text-center">
            <form name="form" method="post" action="" class="form-horizontal">
              <div class="row text-left">
                <div class="col-sm-4">
                  <label class="control-label">Tipo</label>
                  <select name="type" class="form-control " onchange="onChangefilterCourse(event, 'type')">
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label">Categoria</label>
                  <select name="category" class="form-control" onchange="onChangefilterCourse(event, 'category')">
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label">Região</label>
                  <select name="subcategory" class="form-control" onchange="onChangefilterCourse(event, 'subcategory')">
                  </select>
                </div>

                <div class="col-sm-4">
                  <label class=" control-label" for="course_id">Curso</label>
                  <select name="course_id" class="form-control" onchange="selectedCourse(this.value)">
                  </select>
                </div>

                <div class="col-sm-4">
                  <label class="control-label" for="class_id">Turma</label>
                  <select name="class_id" class="form-control" onchange="onChangeClass(event)">
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="control-label" for="city_id">Cidade</label>
                  <select id="city_id" name="city_id" class="form-control" disabled>
                    <option value="">Selecione...</option>
                  </select>
                </div>
              </div>
              <div class="row m-t-md">
                <div class="col-lg-12">
                  <div class="form-group text-right " style="padding-right: 15px">
                    <button type="submit" class="btn btn-w-m btn-primary">Pesquisar</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Lista de Rank</h5>
        </div>
        <div class="ibox-content">
          <div class="tabs-container">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#tab-enar"> Enar</a></li>
              <li><a data-toggle="tab" href="#tab-kids"> Enar Kids</a></li>
            </ul>
            <div class="tab-content">

              {{-- TAB ENAR  --}}
							<div id="tab-enar" class="tab-pane active">
                <div class="panel-body p-t-md rank ">
									<div class="col-sm-4">
										<div class="card">
											<div class="number">
													1
											</div>
											<span>Fred Frederico Silva</span><br>
											<h1>1000</h1>
											<small>Pontos</small>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="card">
											<div class="number">
													2
											</div>
											<span>Sarah Belascra</span><br>
											<h1>1000</h1>
											<small>Pontos</small>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="card">
											<div class="number">
													3
											</div>
											<span>Pedro Denosfera</span><br>
											<h1>1000</h1>
											<small>Pontos</small>
										</div>
									</div>
                  <div class="col-lg-12 m-t-md animated fadeInLeft">
                    @include('admin.components.dataTablesJs', ['id' => 'enar', 'dataTable' => $dataTable['enar']])
                  </div>
                </div>
              </div>

              {{-- TAB KIDS  --}}
              <div id="tab-kids" class="tab-pane">
                <div class="panel-body p-t-md rank">
                  <div class="col-sm-4">
										<div class="card">
											<div class="number">
													1
											</div>
											<span>Fred Frederico Silva</span><br>
											<h1>1000</h1>
											<small>Pontos</small>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="card">
											<div class="number">
													2
											</div>
											<span>Sarah Belascra</span><br>
											<h1>1000</h1>
											<small>Pontos</small>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="card">
											<div class="number">
													3
											</div>
											<span>Pedro Denosfera</span><br>
											<h1>1000</h1>
											<small>Pontos</small>
										</div>
									</div>
                  <div class="col-lg-12 m-t-md animated fadeInLeft">
                    @include('admin.components.dataTablesJs', ['id' => 'kids', 'dataTable' => $dataTable['kids']])
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@parent
<script src="{!! asset('js/plugins/select2/select2.full.min.js') !!}" type="text/javascript"></script>

<script>
  $(document).ready(function() {
    // APP.course = {!! isset($data) ? json_encode($data) : 'null' !!}
    APP.listSelectBox = {!! isset($listSelectBox) ? json_encode($listSelectBox) : '{}' !!}
    APP.search = searchToObj()
    $('.select2').select2()

    setCourses()
  });

  // FILTER COURSE
	function onChangefilterCourse(event, key) {
		var newCourses = []
		var type = document.form.type.value
		var category = document.form.category.value
		var subCategory = document.form.subcategory.value
		var courses = APP.listSelectBox.course


		for (var i = 0; i < courses.length; i++) {
			var course =  courses[i]

			if (type && course.course_category_type_id 		!= type) {
				continue
			}
			if (category && course.course_category_id != category) {
				continue
			}
			if (subCategory && course.course_subcategory_id != subCategory) {
				continue
			}
			newCourses.push(course)
		}

		populateSelectBox({
			list: newCourses,
			target: document.form.course_id,
			columnValue: "id",
			columnLabel: "title_pt",
      emptyOption: {
				label: "Selecione..."
			},
		})

		populateSelectBox({
			list: [],
			target: document.form.class_id,
			columnValue: "id",
			columnLabel: "name",
      emptyOption: {
				label: "Selecione..."
			},

		})

		document.form.course_id.dispatchEvent(new Event('change'))
		document.form.class_id.dispatchEvent(new Event('change'))
	}

  function setCourses() {
		populateSelectBox({
			list: APP.listSelectBox.courseCategoryType,
			target: document.form.type,
			columnValue: "id",
			columnLabel: "title",
			emptyOption: {
				label: "Selecione..."
			},
		})
		populateSelectBox({
			list: APP.listSelectBox.courseCategory,
			target: document.form.category,
			columnValue: "id",
			columnLabel: "description_pt",
			emptyOption: {
				label: "Selecione..."
			},
		})

		populateSelectBox({
			list: APP.listSelectBox.courseSubcategory,
			target: document.form.subcategory,
			columnValue: "id",
			columnLabel: "description_pt",
			emptyOption: {
				label: "Selecione..."
			},
		})

		populateSelectBox({
			list: APP.listSelectBox.course,
			target: document.form.course_id,
			columnValue: "id",
			columnLabel: "title_pt",
			selectBy: APP.search.course ? [ APP.search.course ] : [],
      emptyOption: {
				label: "Selecione..."
			},
		})

		selectedCourse(APP.search.course)

		$('form[name="formCourse"] .select2').select2()
	}



  function selectedCourse(idCourse) {
		var course = idCourse ? APP.listSelectBox.course.find(function (item) { return item.id == idCourse }) : APP.listSelectBox.course[0]

		// document.getElementById('courseInfo').innerHTML = ''

		APP.course = course;
		if (course) {
			if (APP.search.course && APP.search.course == course.id) {
				document.form.type.value = course.course_category_type_id
				document.form.category.value = course.course_category_id
				document.form.subcategory.value = course.course_subcategory_id
			}

			// var classId = (APP.search.course == idCourse && APP.search.class) || (course.class[0] && course.class[0].id)
			var classId = (APP.search.course == idCourse && APP.search.class);

			populateSelectBox({
				list: course.class,
				target: document.form.class_id,
				columnValue: "id",
				columnLabel: "name",
				selectBy: [ classId ] ? [ classId ] : [] ,
        emptyOption: {
				label: "Selecione..."
			  },
			})

			selectedClass(classId)

			document.form.class_id.dispatchEvent(new Event('change'))

			// listAdditional(course.course_additional)
		}

		return null
	}

  function onChangeClass(event) {
		var itemClass = event.target.value;
		selectedClass(itemClass);
	}

  function selectedClass(idClass) {
		var innerHTML = ''
		if (idClass) {
			var data = APP.course.class.find(function(item) { return item.id == idClass })

			innerHTML = data.start_date || ''
		}

		// document.getElementById('classStartDate').innerHTML = innerHTML
	}


</script>
@endsection
