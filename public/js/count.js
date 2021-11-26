// var tempo = new Number();
// Tempo em segundos
// tempo = 500;
function startCountdown(tempo, element) {
	var setTimeoutIndx = null

	function exec() {
		// Se o tempo não for zerado
		if((tempo - 1) >= 0) {

			// Pega a parte inteira dos minutos
			var hor = parseInt(tempo / 3600);
			var min = tempo % 3600;
			var seg = min % 60;
			min = parseInt(min / 60);

			// Formata o número menor que dez, ex: 08, 07, ...
			hor = (hor < 10) ? ("0" + hor).slice(0, 2) : hor
			min = (min < 10) ? ("0" + min).slice(0, 2) : min
			seg = (seg < 10) ? ("0" + seg).slice(0, 2) : seg

			// Cria a variável para formatar no estilo hora/cronômetro
			horaImprimivel = hor + ':' + min + ':' + seg;

			//JQuery pra setar o valor
			element.html(horaImprimivel);

			// Define que a função será executada novamente em 1000ms = 1 segundo
			setTimeoutIndx = setTimeout(exec, 1000, --tempo, element);

		// Quando o contador chegar a zero faz esta ação
		} else {
			$("#sessao").html('Finalizado');
			$("#finishTime").modal('show');
		}
	}

	exec()

	return {
		stopCountdown: function() {
			console.log('stopCountdown:', setTimeoutIndx, tempo, element);
			clearTimeout(setTimeoutIndx)
		}
	}
}

// Chama a função ao carregar a tela
// startCountdown();

