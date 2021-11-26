<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-sm-3">
		 	<label class="control-label">Adicional</label>
			<select id="additional" class="form-control"></select>
		</div>
		<div class="col-sm-1 m-t-md">
			<button type="button" class="btn btn-primary" title="Adicionar novo" onclick="newAdditionalTab(document.getElementById('additional').value)">
				<i class="fa fa-plus"></i>
			</button>
		</div>
	</div>

	<div id="additionalTabs" class="m-t-sm">
		<ul class="nav nav-tabs" role="tablist"></ul>
		<div class="tab-content"></div>
	</div>
</div>

<script id="tmplAdditionalTabPane" type="text/x-dot-template">
	<div class="tab-pane" id="additionalTabsPane_@{{= it.id }}">
		<div class="row m-t-sm">
			<div class="col-sm-6">
				<button type="button" class="btn btn-danger p-2" title="Excluir" onclick="removeAdditionalTab(@{{= it.id }})">
					<i class="fa fa-times"></i> Remover Adicional
				</button>
			</div>
			<div class="col-sm-6 text-right">
				<button type="button" class="btn btn-primary hide" title="Adicionar novo" onclick="newAdditional(null, @{{= it.id }})" data-show-first-additional>
					<i class="fa fa-plus"></i>
				</button>
			</div>
		</div>
		<div id="targetAdditional_@{{= it.id }}" data-target-additional></div>
	</div>
</script>

<script id="tmplAdditional" type="text/x-dot-template">
	<div class="form-group" style="border-radius: 5px; border: 1px solid #ddd; padding-bottom: 5px" data-key="@{{= it.key }}" data-additional="@{{= it.additional_id }}">
		<input type="hidden" name="additional[@{{= it.key }}][id]" value="@{{= it.id }}" />
		<input type="hidden" name="additional[@{{= it.key }}][additional_id]" value="@{{= it.additional_id }}" />
		<div class="col-sm-6">
			<label class="control-label">Forma de Pagamento*</label>
			<select name="additional[@{{= it.key }}][form_payment_id]" class="select2 form-control" value="@{{= it.form_payment_id }}" data-enable-first-additional readonly required onchange="onChangeMirrorAdditional(event, 'form_payment_id')"></select>
		</div>
		<div class="col-sm-1">
			<label class="control-label">Parcelas*</label>
			<input type="number" name="additional[@{{= it.key }}][parcel]" class="form-control" value="@{{= it.parcel || '0' }}" maxlength="5" readonly data-enable-first-additional onkeyup="recalcValues('@{{= it.key }}', 'parcel');onChangeMirrorAdditional(event, 'parcel')" onchange="recalcValues('@{{= it.key }}', 'parcel');onChangeMirrorAdditional(event, 'parcel')" required>
		</div>
		<div class="col-sm-2">
			<label class="control-label">Valor da Parcela*</label>
			<input type="tel" name="additional[@{{= it.key }}][value]" class="form-control mask-currency" value="@{{= it.value || '0' }}" onkeyup="recalcValues('@{{= it.key }}', 'value')" required>
		</div>
		<div class="col-sm-2">
			<label class="control-label">Total</label>
			<input type="text" name="additional[@{{= it.key }}][full_value]" class="form-control mask-currency" value="@{{= it.full_value || '0' }}" readonly onkeyup="recalcValues('@{{= it.key }}', 'full_value')">
		</div>
		<div class="col-sm-1 text-right hide" style="padding-top: 25px; cursor: pointer; color: #f00" data-show-first-additional>
			<button type="button" class="btn btn-danger p-2" title="Excluir" onclick="removeAdditionalFormPayment(event)" >
				<i class="fa fa-times"></i>
			</button>
		</div>
	</div>
</script>

<script>
	function newAdditionalTab(additionalId, byNewAdditional) {
		if (!additionalId) {
			return
		}

		var additionalTabsList_id = 'additionalTabsList_' + additionalId
		var additionalTabsPane_id = 'additionalTabsPane_' + additionalId

		if (!document.getElementById(additionalTabsList_id)) {
			var additional = APP.scope.listSelectBox.additional.find(function(item) { return item.id == additionalId })

			$('#additionalTabs ul').append('<li id="' + additionalTabsList_id + '" ><a href="#' + additionalTabsPane_id + '">' + additional.title + '</a></li>')

			var tmplElem = doT.template(document.getElementById('tmplAdditionalTabPane').innerText, null, null);

			$('#additionalTabs .tab-content').append(tmplElem(additional))
			doT.template(document.getElementById('tmplAdditionalTabPane').innerText, null, null)

			var firstAdditionalTabsList = document.querySelector('#additionalTabs ul').firstElementChild
			if (!firstAdditionalTabsList || firstAdditionalTabsList.id == additionalTabsList_id) {
				$('#' + additionalTabsPane_id + ' [data-show-first-additional]').removeClass('hide')
			} else
			if (firstAdditionalTabsList && !byNewAdditional) {
				var cloneData = $(document.querySelector('#additionalTabs .tab-content').firstElementChild.querySelectorAll('[name^="additional"]')).serializeObject()

				for (var key in cloneData.additional) {
					var additionalForm = cloneData.additional[key]
					newAdditional({
						id: '',
						full_value: '0',
						value: '0',
						additional_id: additionalId,
						parcel: additionalForm.parcel,
						form_payment_id: additionalForm.form_payment_id,
					}, additionalId)
				}
			}
		}

		$('#additionalTabs ul li#additionalTabsList_'+ additionalId +' a').click()
	}

	function newAdditional(data, additionalId) {
		var mirror = false
		if (data) {
			if (!additionalId) {
				additionalId = data.additional_id
			}
		} else {
			data = {
				id: '',
				full_value: '0',
				value: '0',
				parcel: 1,
				additional_id: additionalId,
			}

			mirror = true
		}

		var targetAdditionalId = 'targetAdditional_' + additionalId

		if (!document.getElementById(targetAdditionalId)) {
			newAdditionalTab(additionalId, true)
		}

		data.key = generateUniqueKey()

		var elemTarget = setTmplInsertAdjacentHTML({
			tmpl: 'tmplAdditional',
			toTmpl: targetAdditionalId,
			data: data,
		})

		var selectElemFormPayment = elemTarget.querySelector('[name$="[form_payment_id]"]')

		populateSelectBox({
			list: APP.scope.listSelectBox.formPayment,
			target: selectElemFormPayment,
			columnValue: "id",
			columnLabel: "description",
			selectBy: data ? [data.form_payment_id] : null,
			emptyOption: {
				label: "Selecione..."
			}
		})

		updateInputMask()

		var firstAdditionalTabsList = document.querySelector('#additionalTabs ul').firstElementChild
		if (!firstAdditionalTabsList || firstAdditionalTabsList.id == ('additionalTabsList_' + additionalId)) {
			var additionalTabsPane_id = 'additionalTabsPane_' + additionalId

			$('#' + additionalTabsPane_id + ' [data-show-first-additional]').removeClass('hide')
			$('#' + additionalTabsPane_id + ' [data-enable-first-additional]').removeAttr('readonly')
		}

		if (mirror) {
			$('#additionalTabs div.tab-content>.tab-pane:not(#'+ additionalTabsPane_id +')').each(function(indx, elem) {
				var additionalId = elem.id.replace(/\D/g, '')
				newAdditional({
					id: '',
					full_value: '0',
					value: '0',
					additional_id: additionalId,
					parcel: 1,
					form_payment_id: null,
				}, additionalId)
			})

			if (document.querySelector('#additionalTabs ul').children.length > 1) {
				swal({
					type: 'warning',
					title: "Essa forma de pagamento foi replicada nos outros adicionais, lembre de insirir o valor de parcela",
				})
			}
		}
	}

	function removeAdditionalTab(additionalId) {
		swal({
			type: 'warning',
			title: "Certeza que deseja remover esse adicional?",
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Sim",
			cancelButtonText: "Cancelar",
			showCancelButton: true,
		}, function (value) {
			if (value) {
				document.getElementById('additionalTabsList_' + additionalId).remove()
				document.getElementById('additionalTabsPane_' + additionalId).remove()

				var additionalTabsList_first = document.querySelector('#additionalTabs ul li a')

				additionalTabsList_first && additionalTabsList_first.click()
			}
		})
	}

	function findIndxRowAdditionalFormPayment(target) {
		var rowAdditionalFormPayment = target.closest('.form-group[data-key]')
		var additionalId = rowAdditionalFormPayment.dataset.additional
		return Array.prototype.slice.call(document.getElementById('targetAdditional_' + additionalId).children).indexOf(rowAdditionalFormPayment)
	}

	function removeAdditionalFormPayment(event) {
		var idxAdditionalFormPayment = findIndxRowAdditionalFormPayment(event.target)

		document.getElementById('additionalTabs').querySelectorAll('.tab-content .tab-pane div[data-target-additional]').forEach(function(elem) {
			elem.children[idxAdditionalFormPayment].remove()
		})
	}

	function onChangeMirrorAdditional(event, nameInput) {
		if (!event) {
			return
		}

		var target = event.target
		var idxAdditionalFormPayment = findIndxRowAdditionalFormPayment(target)

		document.getElementById('additionalTabs').querySelectorAll('.tab-content .tab-pane div[data-target-additional]').forEach(function(elem) {
			var inputElem = elem.children[idxAdditionalFormPayment].querySelector('[name$="['+ nameInput +']"]')
			inputElem.value = target.value
			inputElem.onkeyup && inputElem.onkeyup()
		})
	}

	document.addEventListener("DOMContentLoaded", function () {
		$("#additionalTabs .nav-tabs").on("click", "a", function (e) {
        e.preventDefault();
				$(this).tab('show');
    })
    .on("click", "span", function () {
        var anchor = $(this).siblings('a');
        $(anchor.attr('href')).remove();
        $(this).parent().remove();
        $("#additionalTabs .nav-tabs li").children('a').first().click();
    })

		$(populateSelectBox({
			list: APP.scope.listSelectBox.additional,
			target: document.getElementById('additional'),
			columnValue: "id",
			columnLabel: "title",
			selectBy: null,
			emptyOption: {
				label: "Selecione..."
			}
		})).select2()
	})
</script>
