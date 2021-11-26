@extends('layouts.app')

@section('title', $title.' Bolsa de Estudos')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
@endsection

@section('content')

@include($header)

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>{{$title}} Bolsa de Estudo</h5>
			</div>

			<div class="ibox-content">
				<form name="formBolsa" method="post" action="{{ $urlAction }}" class="form-horizontal ">
					{{ csrf_field() }}
					<div class="form-group">
						<input type="hidden" id="id" name="id" />

						<div class="col-sm-12">
							<label class="control-label" for = "title">Título*</label>
							<input type = "text" class = "form-control m-b" name = "title" id = "title" {!! $fieldPageConfig->attr('title') !!} />
						</div>

						<div class="col-sm-12">
							<label class="control-label" for = "description">Descrição*</label>
							<textarea class = "form-control m-b" name = "description" id = "description" {!! $fieldPageConfig->attr('description') !!}></textarea>
						</div>

						<div class = "col-sm-12">
							@include('admin._components.filterDefaultClass')
						</div>

						<div class="col-sm-2">
							<label class="control-label" for = "registration_fee">Taxa de Inscrição*</label>
							<input type = "number" min = "0" step = "0.01" class = "form-control" name = "registration_fee" id = "registration_fee" placeholder = "R$..." {!! $fieldPageConfig->attr('registration_fee') !!} />
						</div>

						<div class="col-sm-2">
							<label class="control-label" for = "registration_start_date">Início das Inscrições*</label>
							<div class="input-group date">
								<input type="text" name="registration_start_date" class="form-control" readonly {!! $fieldPageConfig->attr('registration_start_date') !!} />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>

						<div class="col-sm-2">
							<label class="control-label" for = "registration_end_date">Fim das Inscrições*</label>
							<div class="input-group date">
								<input type="text" name="registration_end_date" class="form-control" readonly {!! $fieldPageConfig->attr('registration_end_date') !!} />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>

						<div class="col-sm-2">
							<label class="control-label" for = "avaliation_id">Avaliação*</label>
							<select class = "form-control" name = "avaliation_id" id = "avaliation_id">
								<option value = "">Selecione...</option>
								@foreach ($evaluations as $avaliation)
									<option value = "{{$avaliation->id}}">{{$avaliation->title}}</option>
								@endforeach
							</select>
						</div>

						<div class="col-sm-4">
							<label class="control-label" for = "exam_deadline">Data Limite da Prova*</label>
							<div class="input-group date">
								<input type="text" name="exam_deadline" class="form-control" readonly {!! $fieldPageConfig->attr('exam_deadline') !!} />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>

						<div class="col-sm-4">
							<label class="control-label" for = "results_release_date">Divulgação dos Resultados <small>(1° Chamada)</small>*</label>
							<div class="input-group date">
								<input type="text" name="results_release_date" class="form-control" readonly {!! $fieldPageConfig->attr('results_release_date') !!} />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>

						<div class="col-sm-4">
							<label class="control-label" for = "course_registration_deadline">Completar inscrição até <small>(1° Chamada)</small>*</label>
							<div class="input-group date">
								<input type="text" name="course_registration_deadline" class="form-control" readonly {!! $fieldPageConfig->attr('course_registration_deadline') !!} />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>

						<div class="col-sm-4">
							<label class="control-label" for = "results_date_second_call">Divulgação dos Resultados <small>(2° Chamada)</small>*</label>
							<div class="input-group date">
								<input type="text" name="results_date_second_call" class="form-control" readonly {!! $fieldPageConfig->attr('results_date_second_call') !!} />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>

						<div class="col-sm-4">
							<label class="control-label" for = "registration_deadline_second_call">Completar inscrição até <small>(2° Chamada)</small>*</label>
							<div class="input-group date">
								<input type="text" name="registration_deadline_second_call" class="form-control" readonly {!! $fieldPageConfig->attr('registration_deadline_second_call') !!} />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
						</div>

						<div id = "divMoreDiscounts"></div>

						<div class="col-sm-2">
							<label class="control-label" style = "visibility: hidden">&nbsp;</label>
							<input type = "submit" class="btn btn-block btn-primary" value = "Salvar" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
@parent

<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>

<script>
	$(document).ready(function(){
		try {
			APP.form = {!! json_encode($data ?? []) !!};

			if(!(APP.form.length == 0)){
				$('select[name="type"]').val(APP.form.course_category_type_id);
				$('select[name="category"]').val(APP.form.course_category_id);
				$('select[name="subcategory"]').val(APP.form.course_subcategory_id);
				$('select[name="course"]').val(APP.form.course_id);
				$('select[name="class"]').val(APP.form.class_id);
			}else{
				addMoreDiscounts();
			}

			populate(document.forms.formBolsa, APP.form);

			if(APP.form.scholarship_discount && APP.form.scholarship_discount.length){
				last_position = APP.form.scholarship_discount.length;
				APP.form.scholarship_discount.forEach(function(item, index){ addMoreDiscounts(null, item, index, last_position) });
			}
		}catch(e){
			console.warn(e);
		}

		setDatePicker('.input-group.date');
	});

	function addMoreDiscounts(button, data = null, index = null, last_position = null){

		if(button && button.classList.contains('btn-danger')){
			$(button).parents('[data-bag]').remove();
		} else {
			if (button) {
				button.innerHTML = '<i class="fa fa-minus" aria-hidden="true"></i>';
				button.classList.add('btn-danger');
				button.classList.remove('btn-primary');
			}

			btnColor = 'btn-primary',
			btnContent = '<i class="fa fa-plus" aria-hidden="true"></i>';

			if(data && index != (last_position - 1)){
				btnColor = 'btn-danger',
				btnContent = '<i class="fa fa-minus" aria-hidden="true"></i>';
			}

			var key = generateUniqueKey();

			$('#divMoreDiscounts').append(`<div class="col-sm-4" data-bag>
																			<div class = "row">
																				<div class="col-sm-5">
																					<label class="control-label" for = "discount_percentage">% Desconto*</label>
																					<input type = "number" min = "1" id="discount_percentage" name="scholarshipDiscount[${key}][discount_percentage]" class="form-control" {!! $fieldPageConfig->attr('discount_percentage') !!} value = "${data?.discount_percentage ?? ''}" />
																				</div>

																				<div class="col-sm-5">
																					<label class="control-label" for = "amount_bag">Qtd. Bolsas*</label>
																					<input type = "number" min = "1" id="amount_bag" name="scholarshipDiscount[${key}][amount_bag]" class="form-control" {!! $fieldPageConfig->attr('amount_bag') !!} value = "${data?.amount_bag ?? ''}" />
																				</div>

																				<div class="col-sm-2">
																					<label class="control-label" style = "visibility: hidden">&nbsp;</label>
																					<button class = "btn ${btnColor} btn-block" type = "button" onclick = "addMoreDiscounts(this)">
																						${btnContent}
																					</button>
																				</div>
																			</div>
																		</div>`);
		}
	}


</script>
@endsection
