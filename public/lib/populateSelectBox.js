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
