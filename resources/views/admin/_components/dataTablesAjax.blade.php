<div class="table-responsive">
	<table id="{{ $dataTable->id }}" class="table table-striped table-bordered table-hover" style="font-size: 12px;" >
		<thead>
			<tr>
				@foreach($dataTable->header as $header)
				<th>{{ $header->label }}</th>
				@endforeach
				<th width="5"></th>
				<th width="5"></th>
			</tr>
		</thead>
		<tbody>

		</tbody>
		<tfoot>
			<tr>
				@foreach($dataTable->header as $header)
				<th>{{ $header->label }}</th>
				@endforeach
				<th></th>
				<th></th>
			</tr>
		</tfoot>
	</table>
</div>

@section('css')
@parent
	<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
@endsection

@section('scripts')
@parent
<script src="{!! asset('js/plugins/dataTables/datatables.min.js') !!}" type="text/javascript"></script>

@endsection
