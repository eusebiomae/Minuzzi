<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px;" >
		<thead>
			<tr>
				@foreach($dataTable->header as $header)
				<th>{{ $header->label }}</th>
				@endforeach
				<th width="5"></th>
				<th width="5"></th>
				<th width="5"></th>
			</tr>
		</thead>
		<tbody>
			@foreach($dataTable->data as $data)
			<tr>
				@foreach($dataTable->header as $header)
					<td
						data-edit-row-key="{{ $header->column }}"
						class="{{ isset($dataTable->classColumn) && isset($dataTable->classColumn[$header->column]) ? $dataTable->classColumn[$header->column] : (isset($header->classColumn) ? $header->classColumn :  null) }}"
					>
						{!! getValueByColumn($data, $header->column) !!}
					</td>
				@endforeach

				<td class="center">
					@if(empty($data->deleted_at))
					<i class="fa fa-check-circle" title="Agendou Visita"></i>
					@else
					<i class="fa fa-times-circle" title="Agendou Visita"></i>
					@endif
				</td>

				<td class="center">
					@if(empty($data->deleted_at))
						@if(isset($data_target_modal))
						<a onclick="editRow(event, '#{{ $data_target_modal }} form')">
							<i class="fas fa-pencil-alt" data-toggle="modal" data-target="#{{ $data_target_modal }}" title="Editar"></i>
						</a>
						@else
						<a href="{{ url($url_page . "/update/{$data->id}") }}">
							<i class="fas fa-pencil-alt" title="Editar"></i>
						</a>
						@endif
					@endif
				</td>

				<td class="center">
					@if(empty($data->deleted_at))
					<a href="{{ url($url_page . '/delete/' . $data->id) }}">
						<i class="far fa-trash-alt demo4" title="Excluir"></i>
					</a>
					@else
					<a href="{{ url($url_page . '/enable/' . $data->id) }}">
						<i class="far fa-check-circle demo4" title="Habilitar"></i>
					</a>
					@endif

					@if(isset($dataTable->hidden))
					@foreach($dataTable->hidden as $hidden)
					<input type="hidden" data-edit-row-key="{{ $hidden }}" value="{{ htmlentities($data->{$hidden}) }}">
					@endforeach
					@endif

					@if(isset($dataTable->dataHidden) && $dataTable->dataHidden)
					<input type="hidden" data-edit-row-key="dataHidden" value="{{ htmlentities(json_encode($data)) }}">
					@endif
				</td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				@foreach($dataTable->header as $header)
				<th>{{ $header->label }}</th>
				@endforeach
				<th></th>
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
