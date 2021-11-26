function validateCpfCnpj(val) {
	try {
		const cpfCNPJ = val.toString().replace(/\D/g, '');

		const calcDigitPosition = (dig, pos = 10, sum = 0) => {
			for (let i = 0, ii = dig.length; i < ii; i++) {
				sum += dig[i] * pos;
				--pos < 2 && (pos = 9);
			}

			return dig + ((sum %= 11) < 2 ? 0 : 11 - sum);
		}

		const cpf_cnpj = {
			11: () => calcDigitPosition(calcDigitPosition(cpfCNPJ.substr(0, 9)), 11),
			14: () => calcDigitPosition(calcDigitPosition(cpfCNPJ.substr(0, 12), 5), 6),
		}

		return cpfCNPJ === cpf_cnpj[cpfCNPJ.length]();
	} catch (error) {
		return false
	}
}

function validateEmail(val) {
	return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(val)
}
