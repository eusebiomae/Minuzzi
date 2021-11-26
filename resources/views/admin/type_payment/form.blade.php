@section('css')
@parent

@endsection

@section('scripts')
@parent

@endsection

<div class="form-group">
	<div class="col-sm-12">
		<label class="control-label">Tipo de Pagamento</label>
		@if ($fieldPageConfig->show('description'))
		<input type="text" name="description" class="form-control" {!! $fieldPageConfig->attr('description') !!} />
		@endif
	</div>
</div>
