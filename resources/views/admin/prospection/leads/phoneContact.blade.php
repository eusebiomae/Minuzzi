<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-fs">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<i class="fa fa-phone modal-icon"></i>
				<h4 class="modal-title">Contatos Telefônicos</h4>
				<small class="font-bold">Registre aqui os contatos telefônicos.</small>
			</div>
			<form method="post" name="formPhoneContact" action="{{ url( $url_page ) }}" class="form-horizontal">
				{{ csrf_field() }}
				<div class="modal-body">
					<div style="padding: 15px;">
						<input type="hidden" id="id" name="id" class="form-control required" value="">
						<input type="hidden" id="leads_id" name="leads_id">
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
							<select class="form-control m-b" name="leads_status_id"></select>
						</div>
						@include('admin._components.form_question', [
							'questions' => isset($questions) ? $questions : null,
						])
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
		editRow.after('#{{ $data_target_modal }} form', function(options) {
			populateQuestionAnswers({
				answers: options.data.answers,
				form: options.form
			});
		});

	</script>
@endsection
