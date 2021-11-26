<div class="row m-b-md">
	@if ($fieldPageConfig->show('description_pt'))
	<label class="col-sm-2 control-label">Nome*</label>
	<div class="col-sm-6 ">
		<input type="text" name="description_pt" class="form-control" {!! $fieldPageConfig->attr('description_pt') !!} maxlength="45">
		<span class="help-block m-b-none">Digite o nome.</span>
	</div>
	@endif
	@if ($fieldPageConfig->show('flg'))
	<label class="col-sm-1 control-label">Flag*</label>
	<div class="col-sm-3 ">
		<input type="text" name="flg" class="form-control" {!! $fieldPageConfig->attr('flg') !!} maxlength="3">
		<span class="help-block m-b-none">Digite o Flag -  Max 3 caracters.</span>
	</div>
	@endif
</div>
