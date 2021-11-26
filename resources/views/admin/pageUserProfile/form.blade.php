@section('css')
	<link rel="stylesheet" href="{!! asset('css/plugins/clockpicker/clockpicker.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/select2/select2.min.css') !!}" />
@endsection

<div class="row m-b-md">
</div>
<div class="row m-b-md">
	<label class="col-sm-2 control-label" form="user_profile_id">Perfil do Usuário</label>
	<div class="col-sm-2">
		<select name="user_profile_id"  id="user_profile_id" class="form-control select2"></select>
	</div>
	<label class="col-sm-1 control-label" form="page_module_id">Módulo</label>
	<div class="col-sm-2">
		<select name="page_module_id"  id="page_module_id" class="form-control select2"></select>
	</div>
	<label class="col-sm-2 control-label" form="page_config_id">Pagina</label>
	<div class="col-sm-3">
		<select name="page_config_id"  id="page_config_id" class="form-control select2"></select>
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
		setClockpicker('.clockpicker input');
		setDatePicker('.input-group.date', {
			startView: 2,
		});

		$(document).ready(function() {
			populateSelectBox({
				list: APP.listSelectBox.pageConfig,
				target: document.form.page_config_id,
				columnValue: "id",
				columnLabel: "desc",
				selectBy: (APP.payload && APP.payload.data && APP.payload.data.page_config_id) ? [APP.payload.data.page_config_id] : null,
				emptyOption: {
					label: "Selecione..."
				}
			})

			populateSelectBox({
				list: APP.listSelectBox.pageModule,
				target: document.form.page_module_id,
				columnValue: "id",
				columnLabel: "desc",
				selectBy: (APP.payload && APP.payload.data && APP.payload.data.page_module_id) ? [APP.payload.data.page_module_id] : null,
				emptyOption: {
					label: "Selecione..."
				}
			})

			populateSelectBox({
				list: APP.listSelectBox.userProfile,
				target: document.form.user_profile_id,
				columnValue: "id",
				columnLabel: "desc",
				selectBy: (APP.payload && APP.payload.data && APP.payload.data.user_profile_id) ? [APP.payload.data.user_profile_id] : null,
				emptyOption: {
					label: "Selecione..."
				}
			})
		});

	</script>
@endsection
