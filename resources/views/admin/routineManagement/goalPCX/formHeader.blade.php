@section('css')
@parent
<style>
		.goal-pcx-square {
			margin: auto;
			width: 34px;
			height: 34px;
			border: 1px solid #000;
			border-radius: 5px;
			text-align: center;
			font-size: 23px;
		}
	</style>
@endsection

<div class="row form-group">
	<div class="col-sm-7">
		<label class="control-label">Vendedor</label>
		<select name="user_id" class="form-control"></select>
	</div>
	<div class="col-sm-5">
		<div class="form-group col-lg-12 date">
			<label class="control-label">Data</label>
			<div class="input-group date">
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				<input type="text" name="date" class="form-control" readonly />
			</div>
		</div>
	</div>
</div>

<div class="row form-group">
	<div class="col-sm-2 center">
		<div class="goal-pcx-square" data-toggle="tooltip" data-placement="top"
		title="As coisas mais importantes a fazer amanhã">1</div>
	</div>
	<div class="col-sm-5">
		<input type="text" name="goal" class="form-control" value="" data-toggle="tooltip" data-placement="top"
		title="Qual a meta?" maxlength="256">
	</div>
	<div class="col-sm-5">
		<label for="finished" class="control-label">Finalizado</label>
		<input type="checkbox" name="finished" id="finished" class="js-switch" value="1">
	</div>
</div>

<div class="row form-group">
	<div class="col-sm-2">
		<div class="goal-pcx-square" style="font-size:13px;padding-top: 7px" data-toggle="tooltip" data-placement="top" title="Metas de vendas para amanhã">Meta</div>
	</div>
	@if ($configApp->configParameters->valueOfMeta === '0')
	<div class="col-sm-5">
		<input type="tel" min="0" name="goal_planned" class="form-control mask-numeric" value="" data-toggle="tooltip" data-placement="top" title="Planejado" maxlength="3">
	</div>
	<div class="col-sm-5">
		<input type="tel" min="0" name="goal_executed" class="form-control mask-numeric" value="" data-toggle="tooltip" data-placement="top" title="Executado" maxlength="3">
	</div>
	@else
	<div class="col-sm-5">
		<input type="tel" name="goal_planned" class="form-control mask-money" value="" data-toggle="tooltip" data-placement="top" title="Planejado" maxlength="14">
	</div>
	<div class="col-sm-5">
		<input type="tel" name="goal_executed" class="form-control mask-money" value="" data-toggle="tooltip" data-placement="top" title="Executado" maxlength="14">
	</div>
	@endif
</div>
@section('scripts')
@parent
<script>
function readonlyValid(isEdited) {
	var fields = {
		"-1": ["user_id", "date", "goal", "finished", "goal_planned", "p_planned", "c_planned", "x_planned", "goal_executed", "p_executed", "c_executed", "x_executed"],
		0: ["user_id", "date", "goal", "goal_planned", "p_planned", "c_planned", "x_planned"],
		1: [],
	};

	for (var i = fields[isEdited].length - 1; i > -1; i--) {
		var field = document.forms.formGoalPCX[fields[isEdited][i]];
		field && (field.disabled = true);
	}

	if (document.forms.formGoalPCX.typeahead_prospect && [0, -1].includes(isEdited)) {
		document.forms.formGoalPCX.typeahead_prospect.disabled = true;
		document.forms.formGoalPCX.typeahead_client.disabled = true;
		document.forms.formGoalPCX.typeahead_former_client.disabled = true;
		document.forms.formGoalPCX.typeahead_activities.disabled = true;

		document.forms.formGoalPCX.querySelectorAll("div.item-list").forEach(function(item) {
			item.querySelector('button.item-list-close').disabled = true;
			if (isEdited === -1) {
				item.querySelector('button.item-list-check').disabled = true;
			}
		});
	}

}
</script>
@endsection
