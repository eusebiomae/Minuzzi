@section('css')
@parent
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/switchery/switchery.css') !!}" />
	<link rel="stylesheet" href="{!! asset('cetcc/css/icon_fonts/css/all_icons.min.css') !!}" >
@endsection

<div class="col-sm-3">
	<label class="control-label">Página*</label>
	<select id="content_page_id" name="content_page_id" class="form-control m-b" required>
		<option value="">Selecione a página</option>
		@foreach($listSelectBox->contentPage as $item)
			<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
		@endforeach
	</select>
</div>
<div class="col-sm-9">
	<label class="control-label">Título*</label>
	<input type="text" id="title" name="title" class="form-control" required>
	<span class="help-block m-b-none">Digite o Título.</span>
</div>

<div class="col-sm-3">
	<label class="control-label">Icon*</label>
		<input type="text" id="icon" name="icon" class="form-control" required>
</div>


<div class="col-sm-9">
	<label class=" control-label">Descrição</label>
	<input type="text" id="description" name="description" class="form-control" style="margin-bottom:10px;">
</div>


@section('scripts')
@parent
<!-- SUMMERNOTE -->
<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}" type="text/javascript"></script>

<!-- switch -->
<script src="{!! asset('js/plugins/switchery/switchery.js') !!}" type="text/javascript"></script>


<script>
	document.addEventListener('DOMContentLoaded', function() {
		try {
			APP.scope.feature = <?=isset($data) ? json_encode($data) : 'null'?>;

			if (APP.scope.feature) {
				populate(document.forms.formFeature, APP.scope.feature);
			}

			$('.summernote').summernote();

			var elem = document.querySelector('.js-switch');
			var switchery = new Switchery(elem, { color: '#1AB394' });
		} catch (error) {
			console.warn(error);
		}
	});
</script>
@endsection
