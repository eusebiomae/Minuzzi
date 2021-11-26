<div data-classes-form>
	{{ csrf_field() }}
	<input type="hidden" name="classes[id]" value="" />
	<input name="classes[class_id]" type="hidden">

	<div class="row form-group">
		<div class="col-sm-12" style="padding-top: 25px; cursor: pointer;">
			<div class="radio-group radio-group-center">
				<input type="radio" id="classesModule" name="module_avaliation" value="module" onchange="onChangeClassesModuleAvaliation(this)">
				<label class="text-uppercase" for="classesModule">Módulo</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" id="classesAvaliation" name="module_avaliation" value="avaliation" onchange="onChangeClassesModuleAvaliation(this)">
				<label class="text-uppercase" for="classesAvaliation">Avaliação</label>
			</div>
		</div>

		<div class="col-sm-12">
			<select name="classes[content_course_id]" class="chosen-select select2 form-control" value=""></select>
			<select name="classes[avaliation_id]" class="select2 form-control" value=""></select>
		</div>

		<div class="col-sm-5" style="padding-top: 25px;">
			<div class="radio-group" style="float:initial;">
				<input type="radio" id="classesTypePresential" name="classes[type]" value="presential" onchange="onChangeClassesType(this)">
				<label class="text-uppercase" for="classesTypePresential">Presencial</label>
				<input type="radio" id="classesTypeOnline" name="classes[type]" value="online" onchange="onChangeClassesType(this)">
				<label class="text-uppercase" for="classesTypeOnline">Online</label>
			</div>
		</div>

		<div class="col-sm-4">
			<label class="control-label">Aula(s)</label>
			<div class="radio-group" style="float:initial;">
				<input type="radio" id="numberOfClasses_1" name="classes[number_of_classes]" onchange="onChangeNumberOfClasses(this)" value="1">
				<label class="text-uppercase" for="numberOfClasses_1">1</label>
				<input type="radio" id="numberOfClasses_2" name="classes[number_of_classes]" onchange="onChangeNumberOfClasses(this)" value="2">
				<label class="text-uppercase" for="numberOfClasses_2">2</label>
				<input type="radio" id="numberOfClasses_4" name="classes[number_of_classes]" onchange="onChangeNumberOfClasses(this)" value="4">
				<label class="text-uppercase" for="numberOfClasses_4">4</label>
			</div>
		</div>

		<div class="col-sm-3">
			<label class="control-label">Orientativo</label>
			<div class="radio-group" style="float:initial;">
				<input type="radio" id="orientative_yes" name="classes[orientative]" value="yes">
				<label class="text-uppercase" for="orientative_yes">Sim</label>
				<input type="radio" id="orientative_no" name="classes[orientative]" value="no" checked>
				<label class="text-uppercase" for="orientative_no">Não</label>
			</div>
		</div>

		<div class="col-sm-4">
			<label class="control-label">Sequência</label>
			<input type="number" name="classes[sequence]" class="form-control" value="">
		</div>

		<div class="col-sm-4">
			<label class=" control-label">Data da Aula</label>
			<div class="input-group date">
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				<input type="text" name="classes[start_date]" class="form-control" readonly value="">
			</div>
		</div>

		<div class="col-sm-4" data-endDate>
			<label class=" control-label">Data 2º Aula</label>
			<div class="input-group date">
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				<input type="text" name="classes[end_date]" class="form-control" readonly value="">
			</div>
		</div>

		<div class="col-sm-12">
			<label class="control-label">Professor(a)</label>
			<div class="">
				<select name="classes[team_id]" class="select2 form-control" value=""></select>
			</div>
		</div>

		{{-- <div class="col-sm-6 m-t-md">
			<label class="m-r-sm">
				Exibir para Presencial
			</label>
			<input type="checkbox" name="classes[view_presencial]" class="js-switch_2" value="1" />
		</div> --}}

		<div class="col-sm-12 m-b-xs">
			<label class="control-label">Vídeo Aula*</label>
			<select name="classes[videoLessons][]" data-placeholder="Selecione o Vídeo" class="chosen-select" multiple style="width:350px;" tabindex="4"></select>
		</div>

		<div class="col-sm-12">
			<label class="control-label">Link para aula ao Vivo</label>
			<input type="text" name="classes[link_live]" class="form-control" maxlength="1024">
		</div>

	</div>
</div>

@section('scripts')
@parent
<script>
	function onChangeClassesModuleAvaliation(elem) {
		var $module = $('[name="classes[content_course_id]"]')
		var $avaliation = $('[name="classes[avaliation_id]"]')
		var $moduleSelect2 = $module.next(".select2-container")
		var $avaliationSelect2 = $avaliation.next(".select2-container")

		console.log(elem.value);
		switch(elem.value) {
			case 'module': {
				$avaliation.val('').trigger('change')
				$moduleSelect2.show()
				$avaliationSelect2.hide()
			} break
			case 'avaliation': {
				$module.val('').trigger('change')
				$moduleSelect2.hide()
				$avaliationSelect2.show()
			} break
		}
	}

	function onChangeClassesType(elemType) {
		var row = elemType.closest('[data-classes-form]')
		var elemSequence = row.querySelector('input[name$="[sequence]"]')
		var elemStartDate = row.querySelector('input[name$="[start_date]"]')
		var elemEndDate = row.querySelector('input[name$="[end_date]"]')

		if (elemType.value == 'presential') {
			elemSequence.disabled = true
			elemStartDate.disabled = false

			var elemNumberOfClasses = row.querySelector('input[name="classes[number_of_classes]"]:checked')
			if (elemNumberOfClasses && elemNumberOfClasses.value == 4) {
				elemEndDate.disabled = false
			} else {
				elemEndDate.disabled = true
			}
		} else
		if (elemType.value == 'online') {
			elemSequence.disabled = false
			elemStartDate.disabled = true
			elemEndDate.disabled = true
		}
	}

	function onChangeNumberOfClasses(elemNumberOfClasses) {
		var row = elemNumberOfClasses.closest('[data-classes-form]')

		var elemType = row.querySelector('input[name="classes[type]"]:checked')
		var elemEndDate = row.querySelector('input[name$="[end_date]"]')

		if (elemType.value == 'presential') {
			if (elemNumberOfClasses && elemNumberOfClasses.value == 4) {
				elemEndDate.disabled = false
			} else {
				elemEndDate.disabled = true
			}
		} else {
			elemEndDate.disabled = true
		}
	}
	//  console.log(321);
	//  $(document).ready(function() {
		// 	console.log(123);
		//  	$('[data-classes-form] .select2.form-control').select2()
		//  }
	</script>
	@endsection
