<div class="form-group">
	<div class="col-sm-12">
		<label class="control-label">Questão*</label>
		<input type="text" name="question" class="form-control"  required maxlength="1024" />
	</div>
	<div class="col-sm-12">
		<label class="control-label">Resposta*</label>
		<textarea name="answer" class="form-control" size="15"></textarea>
	</div>
</div>


@section('scripts')
@parent
<script>
document.addEventListener('DOMContentLoaded', function() {
	try {
		APP.scope.faq = <?=isset($data) ? json_encode($data) : 'null'?>;

		if (APP.scope.faq) {
			populate(document.forms.formFaq, APP.scope.faq);
		}
	} catch (error) {
		console.warn(error);
	}
});
</script>
@endsection
