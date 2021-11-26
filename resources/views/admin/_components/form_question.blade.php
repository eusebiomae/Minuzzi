@if (isset($questions))
<div class="form-group">
	@foreach ($questions as $question)
	<div class="form-group">
		<div class="col-sm-12">
			<div class="col-sm-12">
				<label class="control-label" style="font-size: 1.3em">{{ $question->title }}:</label>
			</div>
			<?php switch($question->flg_type):
			case '2': ?>
				<select name="question[{{ $question->id }}][{{ $question->flg_type }}]" class="form-control">
					@foreach ($question->alternative as $alternative)
						<option value="{{ $alternative->id }}">{{ $alternative->title }}</option>
					@endforeach
				</select>
			<?php break; case '3': ?>
			@foreach ($question->alternative as $alternative)
			<div class="col-sm-3">
				<div class="i-checks">
					<label>
						<input type="checkbox" value="{{ $alternative->id }}" name="question[{{ $question->id }}][{{ $question->flg_type }}][]"> <i></i>
						<span style="padding-left: 5px;">{{ $alternative->title }}</span>
					</label>
				</div>
			</div>
			@endforeach
		<?php break; case '4': ?>
		Não <input type="checkbox" name="question[{{ $question->id }}][{{ $question->flg_type }}]" class="js-switch" value="1"> Sim
		<?php break; default: ?>
		<input type="text" name="question[{{ $question->id }}][{{ $question->flg_type }}]" class="form-control">
		<?php endswitch; ?>
	</div>
</div>
@endforeach
</div>
@endif

@section('scripts')
@parent
<script>

</script>
@endsection
