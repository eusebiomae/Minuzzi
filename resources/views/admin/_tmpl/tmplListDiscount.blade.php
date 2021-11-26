<div class="wrapper wrapper-content animated fadeInRight">
	<div class="text-right">
		<button type="button" class="btn btn-primary" title="Adicionar novo" onclick="newDiscount()">
			<i class="fa fa-plus"></i>
		</button>
	</div>

	<div id="discount"></div>
</div>
<script id="tmplDiscount" type="text/x-dot-template">
	<div class="form-group" style="border-radius: 5px; border: 1px solid #ddd; padding-bottom: 5px" data-key="@{{= it.key }}">
		<input type="hidden" name="discount[@{{= it.key }}][id]" value="@{{= it.id }}" />
		<div class="col-sm-4">
			<label class="control-label">Cupom de desconto</label>
			<select name="discount[@{{= it.key }}][discount_id]" class="select2 form-control" value="@{{= it.discount_id }}" onchange="changedDiscount(event)"></select>
		</div>
		<div class="col-sm-7">
			<label class="control-label">Código</label>
			<div style="padding-top: 8px;"><b data-discount>@{{= it.discount ? it.discount.code : '' }}</b></div>
		</div>
		<div class="col-sm-1 text-right" style="padding-top: 25px; cursor: pointer; color: #f00">
			<button type="button" class="btn btn-danger p-2" title="Excluir" onclick="removeFormGroup(event)">
				<i class="fa fa-times"></i>
			</button>
		</div>
	</div>
</script>

<script>
	function newDiscount(data) {
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
			tmpl: 'tmplDiscount',
			toTmpl: 'discount',
			data: data,
		})

		var selectElemDiscount = elemTarget.querySelector('[name$="[discount_id]"]')

		populateSelectBox({
			list: APP.scope.listSelectBox.discount,
			target: selectElemDiscount,
			columnValue: "id",
			columnLabel: "title",
			selectBy: data ? [ data.discount_id ] : null,
			emptyOption: {
				label: "Selecione..."
			}
		})

		$([selectElemDiscount]).select2();
		updateInputMask()
	}

	function changedDiscount(event) {
		selectedDiscount(event.target.value, event.target.closest('[data-key]'))
	}

	function selectedDiscount(discountId, elemParent) {
		try {
			var discount = APP.scope.listSelectBox.discount.find(function(item) { return item.id == discountId })

			elemParent.querySelector('[data-discount]').innerText = discount.code
		} catch (error) {
			console.warn(error)
		}
	}
</script>
