@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/sweetalert/sweetalert.css') !!}"/>
@endsection

<input type="hidden" id="id" name="id" value="">
@if ($fieldPageConfig->show('name'))
	<div class="form-group">
		<label class="col-sm-2 control-label">Cidade</label>
		<div class="col-sm-10">
			<input type="text" id="name" name="name" class="form-control" value="" {!! $fieldPageConfig->attr('name') !!}>
			<span class="help-block m-b-none">Digite o nome da cidade.</span>
		</div>
	</div>
@endif


@section('scripts')
@parent
<script src="{!! asset('js/plugins/sweetalert/sweetalert.min.js') !!}"></script>

<script>
	try {
			//  Sweet alert
			$('.gp-alert').click(function ($event) {
				try {
					var gpAlertKey = $event.target.dataset.gpAlert;
					var mapAlert = {
						markPay: {
							params: {
								title: "Deseja excluir a transação?",
								text: "Essa ação exclui todas as transações desta fatura e é IRREVERSÍVEL.",
								type: "warning",
							},
							callback: function () {
								swal("Feito!", "Excluir a transação.", "success");
							}
						},
						delete: {
							params: {
								title: "Deseja excluir esta fatura?",
								text: "Essa ação é IRREVERSÍVEL",
								type: "warning",
							},
							callback: function () {
								swal("Feito!", "Excluido esta fatura.", "success");
							}
						},
						cancel: {
							params: {
								title: "Cancelado",
								text: "As modificações não foram salvas",
								type: "error",
								showCancelButton: false,
								confirmButtonText: "Ok",
								confirmButtonColor: "#1a7bb9"
							}
						},
						save: {
							params: {
								title: "Salvo com Sucesso",
								text: "As modificações foram salvas",
								type: "success",
								showCancelButton: false,
								confirmButtonText: "Ok",
								confirmButtonColor: "#1a7bb9"
							}
						},
					}

					swal(Object.assign({
						title: "Tem certeza disso?",
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Sim",
						showCancelButton: true,
						closeOnConfirm: false
					}, mapAlert[gpAlertKey].params), mapAlert[gpAlertKey].callback);
				} catch (error) {
					console.warn(error)
				}
		});
	} catch(error) {
		console.warn(error);
	}
</script>
@endsection
