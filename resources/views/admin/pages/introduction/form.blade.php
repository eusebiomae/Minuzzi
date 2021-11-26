<div class="row">
	<div class="col-sm-6">
		<label class="control-label">Título*</label>
		<input type="text" name="title" class="form-control" required>
		<span class="help-block m-b-none">Digite o Título.</span>
	</div>
	<div class="col-sm-6">
		<label class="control-label">Forma de Pagamento*</label>
		<select name="form_payment_id" class="form-control m-b" required>
		</select>
		<span class="help-block m-b-none">Digite o Forma de Pagamento.</span>
	</div>
</div>
<div class="form-group">
	<div class="wrapper wrapper-content" style="padding-bottom:0px;">
		<div class="row">
			<div class="col-sm-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Digite o conteúdo em Português*</h5>
					</div>
					<div class="ibox-content no-padding">
						<textarea name="description" class="summernote" required></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@section('scripts')
@parent
<script>
	$(document).ready(function() {
		try {
			if (APP.listSelectBox) {
				if (APP.listSelectBox.form_payment) {
					populateSelectBox({
						list: APP.listSelectBox.form_payment,
						target: document.forms.form.form_payment_id,
						columnValue: "id",
						columnLabel: "description",
						selectBy: (APP.payload && APP.payload.data && APP.payload.data.content_page) ? APP.payload.data.content_page.map(function(item) { return item.id }) : null,
					});
				}
			}

		} catch(error) {
			console.warn(error);
		}
	});
</script>

@endsection
