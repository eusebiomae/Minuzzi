@section('css')
@parent
<style>

</style>
@endsection

<div class="form-group">
	@include('admin.routineManagement.goalPCX.formHeader')
	<div class="tabs-container">
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#tab-prospect">Prospects</a></li>
			<li><a data-toggle="tab" href="#tab-client">Clientes</a></li>
			<li><a data-toggle="tab" href="#tab-former_client">Ex Clientes</a></li>
			<li><a data-toggle="tab" href="#tab-activities">Atividades</a></li>
		</ul>
		<div class="tab-content">

			<div id="tab-prospect" class="tab-pane active">
				<div class="col-lg-12">
					<label>Nome do Prospect</label>
					<input type="text" name="typeahead_prospect" placeholder="..." class="typeahead_prospect form-control" /><br>
				</div>
				<div class="row">
					<div id="toTmplProspect" class="contact-box center-version" data-item-list-event-root></div>
				</div>
			</div>

			<div id="tab-client" class="tab-pane">
				<div class="col-lg-12">
					<label>Nome do Cliente</label>
					<input type="text" name="typeahead_client" placeholder="..." class="typeahead_client form-control" /><br>
				</div>
				<div class="col-lg-12">
					<div id="toTmplClient" class="contact-box center-version" data-item-list-event-root></div>
				</div>
			</div>

			<div id="tab-former_client" class="tab-pane">
				<div class="col-lg-12">
					<label>Nome do Ex client</label>
					<input type="text" name="typeahead_former_client" placeholder="..." class="typeahead_former_client form-control" /><br>
				</div>
				<div class="col-lg-12">
					<div id="toTmplFormerClient" class="contact-box center-version" data-item-list-event-root></div>
				</div>
			</div>

			<div id="tab-activities" class="tab-pane">
				<div class="col-lg-12">
					<label>Atividade</label>
					<input type="text" name="typeahead_activities" placeholder="..." class="typeahead_activities form-control" /><br>
				</div>
				<div class="col-lg-12">
					<div id="toTmplActivities" class="contact-box center-version" data-item-list-event-root></div>
				</div>
			</div>

		</div>
	</div>
</div>

<script id="tmplTypeaHead" type="text/x-dot-template">
	<div class="col-lg-6 item-list">
		<button type="button" class="item-list-close" data-remove="removePCXA('@{{= it.type }}', @{{= it.id }})">
			<i class="fa fa-times"></i>
		</button>
		<input type="text" class="item-list-input" readonly value="@{{= it.label }}">
		<button type="button" class="item-list-check" data-onclick="checkPCXA(elem, isChecked, '@{{= it.type }}', @{{= it.id }}, @{{= it.fk }})">
			<i class="fa fa-check @{{= it.executed ? 'item-list-checked' : 'item-list-noChecked' }}"></i>
		</button>
		<input type="hidden" name="@{{= it.type }}[@{{= it.key }}][id]" value="@{{= it.id }}">
		<input type="hidden" name="@{{= it.type }}[@{{= it.key }}][fk]" value="@{{= it.fk }}">
		<input type="checkbox" class="hide" name="@{{= it.type }}[@{{= it.key }}][executed]" @{{= it.executed ? 'checked' : '' }} value="1">
	</div>
</script>
