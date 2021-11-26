@section('css')
	{{-- <link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" /> --}}
	{{-- <link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" /> --}}

	<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/clockpicker/clockpicker.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/switchery/switchery.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/select2/select2.min.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/iCheck/custom.css') !!}" />
@endsection

<div class="form-group" >
	<label class="col-sm-2 control-label">Data do Evento</label>
	<div class="col-sm-4" id="data_1">
		<div class="input-group date">
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				<input type="text" id="event_date" name="event_date"  class="form-control" readonly required>
		</div>
	</div>
	<label class="col-sm-2 control-label">Hora do Evento</label>
	<div class="col-sm-4">
		<div class="input-group clockpicker" data-autoclose="true">
			<input type="text" id="event_time" name="event_time"  class="form-control" readonly>
			<span class="input-group-addon">
					<span class="fa fa-clock-o"></span>
			</span>
		</div>
	</div>
</div>
<div class="form-group" >
	<label class="col-sm-2 control-label">Calendário</label>
	<div class="col-sm-4">
		<select id="calendar_id" name="calendar_id" class="select2_demo_1 form-control" required>
		</select>
	</div>
	<label class="col-sm-2 control-label">Privacidade</label>
	<div class="col-sm-4">
		<select id="calendar_privacy_id" name="calendar_privacy_id" class="select2_demo_1 form-control" required>
		</select>
	</div>
</div>
<div class="form-group" >
	<label class="col-sm-2 control-label">Aula Status</label>
	<div class="col-sm-4">
		<select id="class_status" name="class_status" class="select2_demo_1 form-control" required>
			<option value="1">Suspensão de Aula</option>
			<option value="2">Suspensão Parcial de aula (Manhã)</option>
			<option value="3">Suspensão Parcial de aula (Tarde)</option>
			<option value="4">Aula Normal</option>
			<option value="5">Aula com evento</option>
		</select>
	</div>
	{{-- <label class="col-sm-2 control-label">Repetir Anualmente</label> --}}
	<div class="i-checks col-sm-3"><label> <input type="checkbox" value="1" name="annual_repeat"> <i></i>Repetir Anualmente</label></div>

	{{-- <div class="col-sm-1">
		<input type="checkbox" id="annual_repeat" name="annual_repeat" class="js-switch" />
	</div> --}}
	{{-- <label class="col-sm-1 control-label">Status</label>
	<div class="col-sm-2">
		<input type="checkbox" id="status" name="status" class="js-switch" checked />
	</div> --}}
	<div class="i-checks col-sm-3"><label> <input type="checkbox" value="1" name="status" checked=""> <i></i>Status</label></div>

</div>
<div class="form-group">
	<label class="col-sm-2 control-label">Localização</label>
	<div class="col-sm-10">
		<input type="text" id="localization" name="localization" class="form-control" />
		<span class="help-block m-b-none">Digite o local do evento.</span>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">Título PT-BR</label>
	<div class="col-sm-10">
		<input type="text" id="title_pt" name="title_pt" class="form-control" required />
		<span class="help-block m-b-none">Digite o título em Português.</span>
	</div>
</div>
{{-- EUA AND ES  --}}
{{-- <div class="form-group">
	<label class="col-sm-2 control-label">Título EN</label>
	<div class="col-sm-10">
		<input type="text" id="title_en" name="title_en" class="form-control" required>
		<span class="help-block m-b-none">Digite o título em Inglês.</span>
	</div>
</div> --}}
{{-- <div class="form-group">
	<label class="col-sm-2 control-label">Título ES</label>
	<div class="col-sm-10">
		<input type="text" id="title_es" name="title_es" class="form-control" />
		<span class="help-block m-b-none">Digite o título em Espanhol.</span>
	</div>
</div> --}}
<div class="form-group" >
	<div class="wrapper wrapper-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Digite o conteúdo em Português*</h5>
					</div>
					<div class="ibox-content no-padding">
						<textarea id="description_pt" name="description_pt" class="summernote" required></textarea>
					</div>
				</div>
			</div>
		</div>
		{{-- EUA AND ES  --}}
		{{-- <div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Digite o conteúdo em Inglês*</h5>
					</div>
					<div class="ibox-content no-padding">
						<textarea id="description_en" name="description_en" class="summernote" required></textarea>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Digite o conteúdo em Espanhol</h5>
					</div>
					<div class="ibox-content no-padding">
						<textarea id="description_es" name="description_es" class="summernote"></textarea>
					</div>
				</div>
			</div>
		</div> --}}
	</div>
</div>
@section('scripts')
@parent

<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/clockpicker/clockpicker.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/iCheck/icheck.min.js') !!}" type="text/javascript"></script>
<script>
	$(document).ready(function(){
		try {
			if (APP.listSelectBox) {
				if (APP.listSelectBox.calendar) {
					populateSelectBox({
						list: APP.listSelectBox.calendar,
						target: document.forms.form.calendar_id,
						columnValue: "id",
						columnLabel: "description_pt",
						selectBy: (APP.payload && APP.payload.data && APP.payload.data.calendar_id) ? [APP.payload.data.calendar_id] : null,
						emptyOption: {
							label: "Selecione..."
						}
					});
				}

				if (APP.listSelectBox.calendarPrivacy) {
					populateSelectBox({
						list: APP.listSelectBox.calendarPrivacy,
						target: document.forms.form.calendar_privacy_id,
						columnValue: "id",
						columnLabel: "description_pt",
						selectBy: (APP.payload && APP.payload.data && APP.payload.data.calendar_privacy_id) ? [APP.payload.data.calendar_privacy_id] : null,
						emptyOption: {
							label: "Selecione..."
						}
					});
				}
			}

		} catch(error) {
			console.warn(error);
		}
		$('.i-checks').iCheck({
				checkboxClass: 'icheckbox_square-green',
				radioClass: 'iradio_square-green',
		});
		setDatePicker('.date');
		$('.clockpicker').clockpicker();
		// $('input').iCheck();
	});
</script>
@endsection
