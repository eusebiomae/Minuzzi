<div class="input-group">
	<form action="">
		<div class="col-md-2">
			<label>Unidade Escolar</label>
			<select class="form-control m-b" id="schoolUnit" name="schoolUnit">
				<option value="">Selecione...</option>
				if(isset($listSelectBox->schoolUnit))
				@foreach($listSelectBox->schoolUnit as $item)
				<option value="{{ $item->id }}">{{ $item->fantasy_name }}</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-2">
			<label>Nível Educacional</label>
			<select class="form-control m-b" id="educationalLevel" name="educationalLevel">
				<option value="">Selecione...</option>
				@if(isset($listSelectBox->educationalLevel))
				@foreach($listSelectBox->educationalLevel as $item)
				<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
				@endforeach
				@endif
			</select>
		</div>
		<div class="col-md-2 skspinner-content">
			<label>Ano/Série</label>
			<select class="form-control m-b" id="schoolGrade" name="schoolGrade">
				<option value="">Selecione...</option>
				@if(isset($listSelectBox->schoolGrade))
				@foreach($listSelectBox->schoolGrade as $item)
				<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
				@endforeach
				@endif
			</select>
		</div>
		<div class="col-md-3">
			<label>Status</label>
			<select class="form-control m-b" id="leadsStatus" name="leadsStatus">
				<option value="">Selecione...</option>
				@if(isset($listSelectBox->leadsStatus))
					@foreach($listSelectBox->leadsStatus as $item)
					<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
					@endforeach
				@endif
			</select>
		</div>
		<div class="col-md-1" style=" padding-top:24px;">
			<button type="submit" class="btn btn-primary">
				<i class="fa fa-search" title="Pesquisar"></i>
			</button>
		</div>
	</form>
</div>

@section('scripts')
	@parent
<script>
	loadChangeSelect({
		elemSelectChange: '#educationalLevel',
		elemSelectTarget: '#schoolGrade',
		elemParentSelectTarget: 'div.skspinner-content',
		url: '{{ url('/configuration/schoolgrade/') }}/',
		optionEmpty: {
			text: "Selecione..."
		}
	});

	document.getElementById('schoolUnit').value = '{{ $reqParams->schoolUnit }}';
	document.getElementById('educationalLevel').value = '{{ $reqParams->educationalLevel }}';
	document.getElementById('schoolGrade').value = '{{ $reqParams->schoolGrade }}';
	document.getElementById('leadsStatus').value = '{{ $reqParams->leadsStatus }}';
</script>
@endsection
