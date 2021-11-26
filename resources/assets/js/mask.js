$(document).ready(function () {
	function updateInputMask() {
		$('.mask-year').inputmask({
			mask: '2099'
		});

		$('.mask-phone').inputmask({
			mask: '(99) 9999-9999'
		});

		$('.mask-cell').inputmask({
			mask: '(99) 9 9999-9999'
		});

		$('.mask-cellphone').inputmask({
			mask: ["(99) 9999-9999", "(99) 99999-9999"],
			keepStatic: true
		});

		$('.mask-cep').inputmask({
			mask: '99999-999'
		});

		$('.mask-cpf').inputmask({
			mask: '999.999.999-99'
		});

		$('.mask-rg').inputmask({
			mask: '99.999.999-W'
		});

		// $('.mask-ra').inputmask({
		// 	mask: '009.999.999.999-9'
		// });

		$('.mask-cnpj').inputmask({
			mask: '99.999.999/0009-99'
		});

		$('.mask-ie-sp').inputmask({
			mask: '999.999.999.999'
		});

		$('.mask-birth-certificate').inputmask({
			mask: '999999 99 99 9999 9 99999 999 9999999-99'
		});

		$('.mask-wedding-certificate').inputmask({
			mask: '999999 99 99 9999 9 99999 999 9999999-99'
		});

		$('.mask-cnh').inputmask({
			mask: '99999999999'
		});

		$('.mask-pis').inputmask({
			mask: '999.99999.99-9'
		});

		$('.mask-work-permit-num').inputmask({
			mask: '9999999'
		});

		$('.mask-work-permit-serie').inputmask({
			mask: '999-9'
		});

		$('.mask-electoral-title').inputmask({
			mask: '9999 9999 9999'
		});

		$('.mask-electoral-title-zone').inputmask({
			mask: '999'
		});

		$('.mask-electoral-title-section').inputmask({
			mask: '9999'
		});

		$('.mask-reservist-num').inputmask({
			mask: '999999'
		});

		$('.mask-reservist-serie').inputmask({
			mask: 'W'
		});

		$('.mask-reservist-ra').inputmask({
			mask: '999999999999'
		});

		$('.mask-reservist-csm').inputmask({
			mask: '99ª'
		});

		$('.mask-rne').inputmask({
			mask: 'W999999-W'
		});

		$('.mask-passaport').inputmask({
			mask: 'aa9999999'
		});

		$('.mask-range_hours').inputmask({
			mask: '99:99 - 99:99'
		});

		$(".mask-money").inputmask({
			'alias': 'numeric',
			'groupSeparator': '.',
			'radixPoint': ",",
			'digits': 2,
			'digitsOptional': true,
			'prefix': 'R$ ',
			'placeholder': '0',
			'autoGroup': true,
			'allowMinus': false
		});

		$(".mask-numeric").inputmask({
			'alias': 'numeric',
			'digits': 0,
			'placeholder': '0'
		});
	}

	window.updateInputMask = updateInputMask;
	updateInputMask();
});
