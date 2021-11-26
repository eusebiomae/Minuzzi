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
						class="{{ isset($dataTable->classColumn) && isset($dataTable->classColumn[$header->column]) ? $dataTable->classColumn[$header->column] : null }}"
					>
						{!! getValueByColumn($data, $header->column) !!}
					</td>
				@endforeach

				<td class="center">
					<i class="{{ getValueByColumn($data, 'statusData.ico') }}" title="{{ getValueByColumn($data, 'statusData.label') }}" style="color:{{ getValueByColumn($data, 'statusData.color') }};"></i>
				</td>

				<td class="center">
						@if($data->status =='draft')
						<a href="{{ url($url_page . "/update/{$data->id}") }}">
							<i class="fas fa-pencil-alt" title="Editar"></i>
						</a>
						@else
						<a href="#"  onclick="">
							<i class="fa fa-eye" data-toggle="modal" data-target="" title="Visualizar" ></i>
						</a>
						@endif
				</td>
				<td class="center">
					@if($data->status =='draft')
						<a onclick="" class="btn btn-success btn-sm gp-alert" data-gp-alert="valido" title="Aprovar" style="background:#40aa58; border-color:#40aa58;" data-json="{{ $data }}">
							Aprovar
							<i class="fa fa-check-circle"></i>
						</a>
					@elseif($data->status =='current')
						<a class="btn btn-warning btn-sm gp-alert" data-gp-alert="inativo" title="Inativar" data-json="{{ $data }}">
							Inativar
							<i class="fa fa-times-circle"></i>
						</a>
					@else
						<a onclick="" class="btn btn-sm btn-white" title="Já esta Inativo" disabled>
							Inativo
						</a>
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
