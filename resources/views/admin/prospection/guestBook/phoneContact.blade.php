<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<i class="fa fa-phone modal-icon"></i>
				<h4 class="modal-title">Contatos Telefônicos</h4>
				<small class="font-bold">Registre aqui os contatos telefônicos.</small>
			</div>
			<form method="post" name="phoneContact" action="{{ url( $url_page . '/phone_contact') }}" class="form-horizontal">
				<div class="modal-body">
					<div style="padding: 15px;">
						{{ csrf_field() }}
						<input type="hidden" name="guest_book_id">
						<div class="form-group">
							<label>Nome do Contato</label>
							<input type="text" id="contact_name" name="contact_name" placeholder="Nome Completo" class="form-control">
						</div>
						<div class="form-group">
							<label>Telefone de Contato</label>
							<input type="text" id="phone_contact" name="phone_contact" class="form-control mask-cellphone">
						</div>
						<div class="form-group">
							<label>Assunto Principal</label>
							<input type="text" id="subject" name="subject" placeholder="Assunto Principal" class="form-control">
						</div>
						<div class="form-group">
							<label>Anotações Importantes:</label>
							<div class="ibox-content no-padding">
								<textarea id="phoneContactObservation" name="observation" class="summernote"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label>Status</label>
							<select class="form-control m-b" name="guest_book_status_id"></select>
						</div>
					</div>
					<div class="clear-both"></div>
				</div>
				<div class="modal-footer" style="margin-top: 0">
					<button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>
@section('scripts')
@parent
<script>
	try {
		document.addEventListener("DOMContentLoaded", function(eventDOMContentLoaded) {
			setTimeout(function() {
				populateSelectBox({
					list: APP.scope.listSelectBox.status || [],
					target: document.forms.phoneContact.guest_book_status_id,
					columnValue: "id",
					columnLabel: "subject",
					emptyOption: {
						label: "Selecione..."
					}
				});
			}, 400);
		});
	} catch(error) {
		console.warn(error);
	}
</script>
@endsection
