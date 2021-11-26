@section('css')
	<link rel="stylesheet" href="{!! asset('css/plugins/clockpicker/clockpicker.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/select2/select2.min.css') !!}" />
@endsection

<div class="row m-b-md">
	<label class="col-sm-2 control-label">Perfil do Usuário:</label>
	<div class="col-sm-10">
		<input type="text" name="desc" class="form-control" maxlength="255">
	</div>
</div>

@section('scripts')
	@parent
	<script src="{!! asset('js/plugins/clockpicker/clockpicker.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}" type="text/javascript"></script>
	{{-- input mask --}}
	<script src="{!! asset('js/plugins/jasny/jasny-bootstrap.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/select2/select2.full.min.js') !!}" type="text/javascript"></script>

	<script type="text/javascript">

	</script>
@endsection
