<div class="modal inmodal" id="myModalLeadVisit" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
						class="sr-only">Close</span></button>
				<i class="fa fa-calendar modal-icon"></i>
				<h4 class="modal-title">Agendar Visita</h4>
				<small class="font-bold">Agende aqui a visita.</small>
			</div>
			<form method="post" name="formSchedule" action="{{ url( '/admin/prospection/visitSchedule/schedule') }}"
				class="form-horizontal">
				{{ csrf_field() }}
				<input type="hidden" name="id">
				<input type="hidden" name="leads_id">
				<div class="modal-body">
					<div class="row">
						@if(isset($showSearchLeads) && $showSearchLeads)
						<div class=" col-lg-12">
							<label>Nome do lead</label>
							<input type="text" name="typeahead_lead" placeholder="Lead..." class="typeahead_2 form-control" /><br>
						</div>
						@section('scripts')
						@parent
						<script src="{!! asset('js/plugins/typehead/bootstrap3-typeahead.min.js') !!}" type="text/javascript">
						</script>
						<script>
							$.get('/admin/prospection/prospect/json', function(data) {
								APP.scope.leads = data;

								APP.scope.typeahead = {};

								$(".typeahead_2").typeahead({
									source: data,
									autoSelect: true,
									displayText: function(item) {
										return item.full_name;
									},
									afterSelect: function(item) {
										APP.scope.typeahead.lead = item;

										document.forms.formSchedule.leads_id.value = item.id;
									}
								});
							}, 'json');
						</script>
						@endsection
						@endif
						<div class="col-lg-12">
							<div class="form-group col-lg-12">
								<label>Profissional Responsável *</label>
								<select class="form-control m-b" required name="consultant"></select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group col-lg-12">
								<label>Cidade *</label>
								<select class="form-control m-b" required name="city_id"></select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group col-lg-12">
								<label>Curso *</label>
								<select class="form-control m-b" required name="course_id"></select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group col-lg-12 date">
								<label>Data da Visita *</label>
								<div class="input-group date">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="text" name="visit_date" class="form-control" required readonly>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group col-lg-12 clock">
								<label>Hora da Visita *</label>
								<div class="input-group clockpicker">
									<input type="text" name="visit_time" class="form-control" required readonly>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-time"></span>
									</span>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group col-lg-12">
								<label>Assunto Principal *</label>
								<input type="text" name="subject" placeholder="Assunto Principal" class="form-control" required>
							</div>
							<div class="form-group col-lg-12">
								<label>Anotações Importantes:</label>
								<div class="ibox-content no-padding">
									<textarea name="observation" class="summernote"></textarea>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group col-sm-12">
								<label class=" control-label">Descrição do Local</label>
								<input type="text" name="location_description" class="form-control" required>
							</div>
						</div>
						<div class="col-lg-9">
							<div class="form-group col-sm-12">
								<label class=" control-label">Endereço</label>
								<input type="text" name="address" class="form-control" required>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group col-sm-12">
								<label class=" control-label">Nº</label>
								<input type="text" name="number" class="form-control" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group col-sm-12">
								<label class=" control-label">Complemento</label>
								<input type="text" name="complement" class="form-control" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group col-sm-12">
								<label class=" control-label">Referência</label>
								<input type="text" name="reference" class="form-control" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group col-sm-12">
								<label class=" control-label">Bairro</label>
								<input type="text" name="district" class="form-control" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group col-sm-12">
								<label class=" control-label">Cidade</label>
								<input type="text" name="city" class="form-control" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class=" form-group col-lg-12">
								<label class=" control-label">UF </label>
								<select class="form-control m-b" required name="state"></select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group col-sm-12">
								<label class=" control-label">CEP</label>
								<input type="text" name="zip_code" class="form-control" required>
							</div>
						</div>

						<div class="clear-both"></div>
					</div>
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

</script>
@endsection
