try {
	document.addEventListener("DOMContentLoaded", function (eventDOMContentLoaded) {
		console.info(eventDOMContentLoaded);

		if ($.fn.clockpicker) {
			$('.clock .clockpicker').clockpicker({
				autoclose: true,
			});
		}

		if ($.fn.datepicker) {

			$('.date .input-group.date').datepicker({
				todayBtn: "linked",
				keyboardNavigation: true,
				forceParse: false,
				calendarWeeks: true,
				autoclose: true,
				format: "dd/mm/yyyy",
				container: "body",
				locale: {
					daysOfWeek: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
					monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
					firstDay: 1
				}
			});

			$('.date-year .input-group.date').datepicker({
				todayBtn: "linked",
				startView: 2,
				keyboardNavigation: true,
				forceParse: false,
				calendarWeeks: true,
				autoclose: true,
				format: "dd/mm/yyyy",
				container: "body",
				locale: {
					daysOfWeek: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
					monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
					firstDay: 1
				}
			});
		}
	});

	function populateSelectBox(params) {
		params.target.innerHTML = '';
		var options = [];

		if (params.emptyOption) {
			var option = document.createElement('option');

			option.value = params.emptyOption.value || '';
			option.innerText = params.emptyOption.label || '';

			options.push(option);
		}

		params.list.forEach(function (item) {
			var option = document.createElement('option');

			option.value = item[params.columnValue];
			option.innerHTML = item[params.columnLabel];
			option.dataJson = item;

			if (params.selectBy && params.selectBy.length) {
				option.selected = params.selectBy.some(function (item) {
					return item == option.value;
				});
			}

			options.push(option);
		});

		if (params.target && params.target.length) {
			for (var i = params.target.length - 1; i > -1; i--) {
				for (var j = 0; j < options.length; j++) {
					var option = options[j].cloneNode();
					option.value = options[j].value;
					option.innerHTML = options[j].innerHTML;
					option.dataJson = options[j].dataJson;
					option.selected = options[j].selected;

					params.target[i].options.add(option);
				}
			}
		} else {
			for (var j = 0; j < options.length; j++) {
				params.target.options.add(options[j]);
			}
		}
	}

	function setTmplInsertAdjacentHTML(params) {
		var tmpl = params.tmpl;
		var toTmpl = params.toTmpl;
		var data = params.data;

		var tmplElem = doT.template(document.getElementById(tmpl).innerText, null, null);

		document.getElementById(toTmpl).insertAdjacentHTML('beforeend', tmplElem(data));

		return document.getElementById(toTmpl).firstChild;
	};

	function setTmpl(params) {
		var data = params.data;
		var tmpl = params.tmplId;
		var toTmpl = params.toTmplId;

		var tmplElem = doT.template(document.getElementById(tmpl).innerText, null, null);

		document.getElementById(toTmpl).innerHTML = tmplElem(data);
	};

	function numberWithCommas(x, d) {
		if (x) {
			var parts = parseFloat(x).toFixed(d).split(".");
			parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");

			return parts.join(",");
		}

		return x;
	};

	function strToNumber(v) {
		return parseFloat(v == parseFloat(v) ? v : v.toString().replace('.', '').replace(',', '.'));
	}

	function calculateBirthdate(value) {
		var date = value.toString().split('/');
		var today = new Date();
		var age = today.getFullYear() - date[2] - 1;

		if (today.getMonth() + 1 - date[1] < 0) {
			return age
		}

		if (today.getMonth() + 1 - date[1] > 0) {
			return age + 1
		}

		if (today.getUTCDate() - date[0] >= 0) {
			return age + 1
		}

		return age
	};

	function editRow(event, formSelect) {
		var form = $(formSelect);
		var target = $(event.target || event);

		form.find('.i-checks').iCheck('uncheck');
		resetSwitchery();

		var dataCallBack = {
			form: form[0],
			target: target[0],
		};

		var setValue = function setValue(key, val) {
			form.find('[name="' + key + '"]').each(function (idx, elem) {
				if (typeof elem.value === "undefined") {
					elem.innerText = val;
				} else {
					elem.value = val;
				}
			});
		};

		var dataHidden = target.parents('tr').find('[data-edit-row-key="dataHidden"]');

		if (dataHidden.length) {
			try {
				var data = JSON.parse(dataHidden.val());
				dataCallBack.data = data;

				populate(form[0], data).finished(function () {
					$('.i-checks').iCheck({
						checkboxClass: 'icheckbox_square-green',
						radioClass: 'iradio_square-green'
					});
				});
			} catch (error) {
				console.warn(error);
			}
		} else {
			target.parents('tr').find('[data-edit-row-key]').each(function (idx, elem) {
				if (elem.dataset.editRowKey) {
					var key = elem.dataset.editRowKey;

					var text = elem.value || elem.innerText;

					setValue(key, text);
				}
			});
		}

		editRow.afterCallBack[formSelect] && editRow.afterCallBack[formSelect](dataCallBack);
	}

	editRow.afterCallBack = {};

	editRow.after = function (formSelect, callback) {
		editRow.afterCallBack[formSelect] = callback;
	};

	var itemListEventRoot = function(event) {
		var closest = null;

		if (closest = event.target.closest('.item-list-close')) {
			if (!closest.disabled) {
				closest.closest('.item-list').remove();
				eval(closest.dataset.remove);
			}
		} else
		if (closest = event.target.closest('.item-list-check')) {
			if (!closest.disabled) {
				var elemIcon = closest.getElementsByTagName('i')[0];
				var elemInput = closest.closest('.item-list').querySelector('input[type="checkbox"]');

				var isChecked = !elemIcon.classList.contains('item-list-checked');
				if (isChecked) {
					elemIcon.classList.add('item-list-checked');
					elemIcon.classList.remove('item-list-noChecked');
					elemInput.checked = true;
				} else {
					elemIcon.classList.remove('item-list-checked');
					elemIcon.classList.add('item-list-noChecked');
					elemInput.checked = false;
				}

				new Function("return function(elem, isChecked) { return "+ closest.dataset.onclick +"}")()(closest.closest('.item-list'), isChecked);
			}
		}
	};

	document.querySelectorAll('[data-item-list-event-root]').forEach(function(itemListRootElem) {
		itemListRootElem.removeEventListener('click', itemListEventRoot);
		itemListRootElem.addEventListener('click', itemListEventRoot);
	});

	var generateUniqueKey = function() {
		return (new Date().getTime() + Math.floor(Math.random() * 999999999999)).toString(36);
	}

	function initSwitchery() {
		document.querySelectorAll('.js-switch').forEach(function(elem) {
			if (!elem.Switchery) {
				elem.Switchery = new Switchery(elem, {
					color: '#1AB394'
				});
			}
		});
	}

	function updateSwitchery() {
		document.querySelectorAll('.js-switch').forEach(function(elem) {
			if (elem.checked) {
				//elem.Switchery.setPosition(true)
				elem.Switchery.handleOnchange(true)
			}
		});
	}

	function resetSwitchery() {
		document.querySelectorAll('.js-switch').forEach(function(elem) {
			if (elem.checked) {
				elem.Switchery.setPosition(true);
				elem.Switchery.handleOnchange(true);
			}
		});
	}

	function populateQuestionAnswers(options) {
		if (options.answers.length) {
			var answers = options.answers;
			var dataFormQuestion = {};

			for (var i = answers.length - 1; i > -1; i--) {
				var data = answers[i];

				if (data.question.flg_type == "3") {
					var key = "question["+ data.question_id +"]["+ data.question.flg_type +"]";

					if (!dataFormQuestion[key]) {
						dataFormQuestion[key] = [];
					}

					dataFormQuestion[key].push(data.answer);
				} else {
					dataFormQuestion["question["+ data.question_id +"]["+ data.question.flg_type +"]"] = data.answer;
				}
			}

			populate(options.form, dataFormQuestion);
		}

		$('.i-checks').iCheck('update');
		updateSwitchery();
	}

} catch (error) {
	console.warn(error);
}
