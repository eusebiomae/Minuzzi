<div class="wrapper wrapper-content animated fadeInRight">
	<div class="text-right">
		<button type="button" class="btn btn-primary" title="Adicionar novo" onclick="newAdditional()">
			<i class="fa fa-plus"></i>
		</button>
	</div>

	<div id="additional"></div>
</div>
<script id="tmplAdditional" type="text/x-dot-template">
	<div class="form-group" style="border-radius: 5px; border: 1px solid #ddd; padding-bottom: 5px" data-key="@{{= it.key }}">
		<input type="hidden" name="additional[@{{= it.key }}][id]" value="@{{= it.id }}" />
		<div class="col-sm-3">
			<label class="control-label">Adicional</label>
			<select name="additional[@{{= it.key }}][additional_id]" class="select2 form-control" value="@{{= it.additional_id }}"></select>
		</div>
		<div class="col-sm-3">
			<label class="control-label">Forma de Pagamento</label>
			<select name="additional[@{{= it.key }}][form_payment_id]" class="select2 form-control" value="@{{= it.form_payment_id }}"></select>
		</div>
		<div class="col-sm-1">
			<label class="control-label">Parcelas</label>
			<input type="number" name="additional[@{{= it.key }}][parcel]" class="form-control" value="@{{= it.parcel || '0' }}" maxlength="5" onkeyup="recalcValues('@{{= it.key }}', 'parcel')" onchange="recalcValues('@{{= it.key }}', 'parcel')">
		</div>
		<div class="col-sm-2">
			<label class="control-label">Valor da Parcela</label>
			<input type="tel" name="additional[@{{= it.key }}][value]" class="form-control mask-currency" value="@{{= it.value || '0' }}" onkeyup="recalcValues('@{{= it.key }}', 'value')">
		</div>
		<div class="col-sm-2">
			<label class="control-label">Total</label>
			<input type="text" name="additional[@{{= it.key }}][full_value]" class="form-control mask-currency" value="@{{= it.full_value || '0' }}" readonly onkeyup="recalcValues('@{{= it.key }}', 'full_value')">
		</div>
		<div class="col-sm-1 text-right" style="padding-top: 25px; cursor: pointer; color: #f00">
			<button type="button" class="btn btn-danger p-2" title="Excluir" onclick="removeFormGroup(event)">
				<i class="fa fa-times"></i>
			</button>
		</div>
	</div>
</script>

<script>
	function newAdditional(data) {
		if (data) {
			data.key = generateUniqueKey()
		} else {
			data = {
				id: '',
				full_value: '0',
				value: '0',
				parcel: 1,
				key: generateUniqueKey(),
			}
		}

		var elemTarget = setTmplInsertAdjacentHTML({
			tmpl: 'tmplAdditional',
			toTmpl: 'additional',
			data: data,
		})

		var selectElemAdditional = elemTarget.querySelector('[name$="[additional_id]"]')

		var selectElemFormPayment = elemTarget.querySelector('[name$="[form_payment_id]"]')

		populateSelectBox({
			list: APP.listSelectBox.additional,
			target: selectElemAdditional,
			columnValue: "id",
			columnLabel: "title",
			selectBy: data ? [ data.additional_id ] : null,
			emptyOption: {
				label: "Selecione..."
			}
		})

		populateSelectBox({
			list: APP.listSelectBox.formPayment,
			target: selectElemFormPayment,
			columnValue: "id",
			columnLabel: "description",
			selectBy: data ? [data.form_payment_id] : null,
			emptyOption: {
				label: "Selecione..."
			}
		})

		$([selectElemAdditional, selectElemFormPayment]).select2();
		updateInputMask()
	}
</script>
