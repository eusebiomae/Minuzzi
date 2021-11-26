@extends('layouts.app')

{{-- @section('title', $module_page . ' ('. $title_page .')') --}}

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/clockpicker/clockpicker.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/switchery/switchery.css') !!}" />
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
							<div class="tabs-container">
								<ul class="nav nav-tabs">
									<li class="active" data-tab-target="tab-subcategory"><a data-toggle="tab" href="#tab-subcategory"> Subcategoria</a></li>
									<li class="disabled" data-tab-target="tab-values"><a data-toggle="tab" href="#tab-values"> Valores</a></li>
								</ul>

								<div class="tab-content">

									<div id="tab-subcategory" class="tab-pane active">
										<div class="panel-body">
											<form name="formCourse" method="post" action="{{ url($urlAction) }}" class="form-horizontal">
												{{ csrf_field() }}

												@if ($fieldPageConfig->show('description_pt'))
													<div class="col-xs-12">
														<label class="control-label">Nome da Subcategoria</label>
														<input type="text" id="description_pt" name="description_pt" class="form-control" value="" required {!! $fieldPageConfig->attr('description_pt') !!} />
														<span class="help-block m-b-none">Digite o nome da subcategoria.</span>
													</div>

													<label class="col-sm-2 control-label">Ocultar Subcategoria</label>
													<div class="col-sm-2">
														<div class="switch">
															<div class="onoffswitch m-sm">
																<input type="checkbox" name="invisible" class="onoffswitch-checkbox" id="invisible" value="1" onchange = "makeInvisible()" />
																<label class="onoffswitch-label" for="invisible">
																	<span class="onoffswitch-inner"></span>
																	<span class="onoffswitch-switch"></span>
																</label>
															</div>
														</div>
													</div>

													<label class="col-sm-4 control-label divCourseConnected">Ocultar os cursos e bolsas desta subcategoria</label>
													<div class="col-sm-2 divCourseConnected">
														<div class="switch">
															<div class="onoffswitch m-sm">
																<input type="checkbox" name="invisible_connected" class="onoffswitch-checkbox" id="invisible_connected" value="1"/>
																<label class="onoffswitch-label" for="invisible_connected">
																	<span class="onoffswitch-inner"></span>
																	<span class="onoffswitch-switch"></span>
																</label>
															</div>
														</div>
													</div>
												@endif

												{{-- @if ($fieldPageConfig->show('description_en'))
												<div class="col-xs-12">
													<label class="control-label">Nome da Subcategoria</label>
													<input type="text" id="description_en" name="description_en" class="form-control" value="" required {!! $fieldPageConfig->attr('description_en') !!} />
													<span class="help-block m-b-none">Digite o nome da subcategoria.</span>
												</div>
												@endif

												@if ($fieldPageConfig->show('description_es'))
												<div class="col-xs-12">
													<label class="control-label">Nome da Subcategoria</label>
													<input type="text" id="description_es" name="description_es" class="form-control" value="" required {!! $fieldPageConfig->attr('description_es') !!} />
													<span class="help-block m-b-none">Digite o nome da subcategoria.</span>
												</div>
												@endif --}}

												<div class="col-lg-12">
													<div class="col-lg-10">
													</div>
													<div class="col-lg-2">
														<div class="form-group">
															<button type="submit" class="btn btn-w-m btn-primary">Salvar</button>
														</div>
													</div>
												</div>
												<input id="id" name="id" type="hidden" value="">
											</form>
										</div>
									</div>

									<div id="tab-values" class="tab-pane">
										<div class="panel-body">
											<div class="wrapper wrapper-content animated fadeInRight">
												<form name="formValues" action="{{ url('/admin/prospection/course_subcategory/values') }}" method="post">
													{{ csrf_field() }}
													<input type="hidden" name="course_subcategory_id" >

													<div class="row" style="margin: 10px auto;">

														@if ($fieldPageConfig->show('fine_value'))
														<div class="col-sm-3">
															<label class="control-label">Valor de multa (Contrato)</label>
															<input type="tel" name="fine_value" class="form-control mask-currency" maxlength="10" required {!! $fieldPageConfig->attr('fine_value') !!} />
														</div>
														@endif

														<div class="col-sm-9 text-right">
															<button type="submit" class="btn btn-w-m btn-primary" title="Salvar dados de Valores">Salvar</button>
														</div>
													</div>

													<div class="row">
														<div class="col-sm-12">
															<label class="control-label">Data limite</label>
															<div class="input-group">
																<div class="input-group">
																	<span class="input-group-addon" onclick="showDatePicker('form[name=\'formValues\'] .date[name=\'date\']')">
																		<i class="fa fa-calendar"></i>
																	</span>
																	<input type="text" name="date" class="form-control date" readonly />
																	<span class="input-group-addon btn btn-primary" title="Adicionar novo" onclick="newGroupFormsPayment()" style="background: #4E96D3;color: #fff;border-color: #4E96D3;" >
																		<i class="fa fa-plus"></i>
																	</span>
																</div>
															</div>
														</div>
													</div>

													<div id="groupFormPayment" style="margin-top: 10px"></div>
													<div class="form-group text-right" style="margin-top: 20px">
														<button type="submit" class="btn btn-w-m btn-primary" title="Salvar dados de Valores">Salvar</button>
													</div>
												</form>
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
	</div>
</div>

<script id="tmplGroupFormPayment" type="text/x-dot-template">
	<fieldset style="border: 1px solid #aaa;border-radius: 5px;padding: 0 20px;margin-top: 15px;" data-key="@{{= it.key }}">
		<legend>
			<div class="row">
				<div class="col-sm-10">@{{= it.date }}</div>

				<div class="col-sm-1 text-right">
					<button type="button" class="btn btn-primary" title="Adicionar novo" onclick="newFormsPayment('@{{= it.key }}', {date: '@{{= it.date }}'})" style="background: #4E96D3;color: #fff;border-color: #4E96D3;" >
						<i class="fa fa-plus"></i>
					</button>
				</div>

				<div class="col-sm-1 text-right">
					<button type="button" class="btn btn-danger p-2" title="Excluir" onclick="removeParentElem(event, 'fieldset');delete APP.groupFormsPayment['@{{= it.date }}']">
						<i class="fa fa-times"></i>
					</button>
				</div>

			</div>
		</legend>

		<div id="formPayment-@{{= it.key }}"></div>
	</fieldset>
</script>

<script id="tmplFormsPayment" type="text/x-dot-template">
	<div class="row form-group" style="border-radius: 5px; border: 1px solid #ddd; padding: 5px 0" data-row data-key="@{{= it.key }}">
		<input type="hidden" name="formPayment[@{{= it.key }}][id]" value="@{{= it.id }}" />
		<input type="hidden" name="formPayment[@{{= it.key }}][date]" value="@{{= it.date }}" />
		<div class="col-sm-2 hide">
			<label class="control-label">Descrição</label>
			<input type="text" name="formPayment[@{{= it.key }}][desc]" class="form-control" value="@{{= it.desc || '' }}" maxlength="255"/>
		</div>
		<div class="col-sm-5">
			<label class="control-label">Forma de Pagamento</label>
			<select name="formPayment[@{{= it.key }}][form_payment_id]" class="select2_demo_1 form-control" value="@{{= it.form_payment_id }}"></select>
		</div>
		<div class="col-sm-2">
			<label class="control-label">Total</label>
			<input type="text" name="formPayment[@{{= it.key }}][full_value]" class="form-control mask-currency" value="@{{= it.full_value || '0' }}" readonly onkeyup="recalcValues('@{{= it.key }}', 'full_value')">
		</div>
		<div class="col-sm-1">
			<label class=" control-label">Parcelas</label>
			<input type="number" name="formPayment[@{{= it.key }}][parcel]" class="form-control" value="@{{= it.parcel || '0' }}" maxlength="5" onkeyup="recalcValues('@{{= it.key }}', 'parcel')" onchange="recalcValues('@{{= it.key }}', 'parcel')">
		</div>
		<div class="col-sm-2">
			<label class=" control-label">Valor da Parcela</label>
			<input type="tel" name="formPayment[@{{= it.key }}][value]" class="form-control mask-currency" value="@{{= it.value || '0' }}" onkeyup="recalcValues('@{{= it.key }}', 'value')">
		</div>
		<div class="col-sm-1  m-t-md">
			<label class="control-label i-checks">
				<input type="checkbox" name="formPayment[@{{= it.key }}][flg_main]" class="form-control" value="S" onclick="onFlgMainFormsPayment(event)" />
				<b class="m-l-xs">Valor principal</b>
			</label>
		</div>
		<div class="col-sm-1 text-right" style="padding-top: 25px; cursor: pointer; color: #f00">
			<button type="button" class="btn btn-danger p-2" title="Excluir" onclick="removeParentElem(event, '[data-row]')">
				<i class="fa fa-times"></i>
			</button>
		</div>
	</div>
</script>
@endsection

@section('scripts')
<!-- Mainly scripts -->
<script src="{!! asset('js/plugins/metisMenu/jquery.metisMenu.js') !!}"></script>
<script src="{!! asset('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}"></script>
<script src="{!! asset('js/makeInvisibleField.js') !!}"></script>

<!-- Custom and plugin javascript -->
<script src="{!! asset('js/inspinia.js') !!}"></script>
<script src="{!! asset('js/plugins/pace/pace.min.js') !!}"></script>
<!-- SUMMERNOTE -->
<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}"></script>

<!-- Page-Level Scripts -->
<script src="{!! asset('js/plugins/dataTables/datatables.min.js') !!}"></script>
<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>
<script src="{!! asset('js/plugins/clockpicker/clockpicker.js') !!}"></script>
<script src="{!! asset('js/plugins/switchery/switchery.js') !!}"></script>
<script>
	function newGroupFormsPayment(date) {
		if (!date) {
			var elemDate = document.querySelector('form[name="formValues"] .date[name="date"]')
			date = elemDate.value
			elemDate.value = ''
		}

		var key = generateUniqueKey()

		if (date) {
			if (APP.groupFormsPayment[date]) {
				return false
			}

			var tmplGroupFormPayment = setTmplInsertAdjacentHTML({
				tmpl: 'tmplGroupFormPayment',
				toTmpl: 'groupFormPayment',
				data: {
					key: key,
					date: date,
				},
			})

			APP.groupFormsPayment[date] = tmplGroupFormPayment

			console.info('newGroupFormsPayment: ', date)
			return key
		}

		console.info('newGroupFormsPayment')
		return false
	}

	function newFormsPayment(groupKey, data) {
		if (event) {
			console.log(event);
			event.preventDefault()
		}

		data = Object.assign({
			id: '',
			form_payment_id: '',
			full_value: '0',
			value: '0',
			date: '',
			parcel: 1,
			key: generateUniqueKey(),
		}, data)

		var formPayment = setTmplInsertAdjacentHTML({
			tmpl: 'tmplFormsPayment',
			toTmpl: 'formPayment-' + groupKey,
			data: data,
		})

		if (data && data.flg_main) {
			formPayment.querySelector('[name$="[flg_main]"]').checked = true
		}

		var selectElem = formPayment.querySelector('[name$="[form_payment_id]"]')

		populateSelectBox({
			list: APP.scope.listSelectBox.formPayment,
			target: formPayment.querySelector('[name$="[form_payment_id]"]'),
			columnValue: "id",
			columnLabel: "description",
			selectBy: data ? [data.form_payment_id] : null,
			emptyOption: {
				label: "Selecione..."
			}
		})

		$(selectElem).select2();
		updateInputMask()
	}

	function removeParentElem(event, parentSelector) {
		event.target.closest(parentSelector).remove();
	}

	function recalcValues(key, name) {
		var elems = {
			parent: document.querySelector('div[data-key=' + key + ']'),
		}

		elems.fullValue = elems.parent.querySelector('[name$="[full_value]"]')
		elems.parcel = elems.parent.querySelector('[name$="[parcel]"]')
		elems.value = elems.parent.querySelector('[name$="[value]"]')

		switch (name) {
			case 'parcel':
				elems.fullValue.value = (strToNumber(elems.value.value) * elems.parcel.value).toFixed(2)
				break;
			case 'value':
				elems.fullValue.value = (strToNumber(elems.value.value) * elems.parcel.value).toFixed(2)
				break;
		}
	}

	function onFlgMainFormsPayment(event) {
		document.getElementById('groupFormPayment')
		.querySelectorAll('[name$="[flg_main]"]').forEach(function(item) {
			item.checked = false
		})

		event.target.checked = true
	}

	$(document).ready(function() {
		try {
			APP = {
				scope: {
					course: <?=isset($data) ? json_encode($data) : 'null' ?>,
					listSelectBox: <?=isset($listSelectBox) ? json_encode($listSelectBox) : 'null' ?>,
				},
				groupFormsPayment: {},
			};

			/* if (APP.scope.listSelectBox.courseCategoryType) {
				populateSelectBox({
					list: APP.scope.listSelectBox.courseCategoryType,
					target: document.forms.formCourse.course_category_type_id,
					columnValue: "id",
					columnLabel: "title",
					emptyOption: {
						label: "Selecione..."
					}
				});
			} */

			if (APP.scope.course) {
				populate(document.forms.formCourse, APP.scope.course);

				document.forms.formValues.course_subcategory_id.value = APP.scope.course.id
				document.forms.formValues.fine_value.value = APP.scope.course.fine_value

				$('[data-tab-target="tab-values"]').removeClass('disabled')
			}

			APP.scope && APP.scope.listSelectBox && APP.scope.listSelectBox.values.forEach(function(item) {
				newGroupFormsPayment(item.date)
				newFormsPayment(APP.groupFormsPayment[item.date].dataset.key, item)
			})

			setDatePicker('.date')
		} catch(error) {
			console.warn(error);
		}

		makeInvisible();
	});

</script>
@endsection
