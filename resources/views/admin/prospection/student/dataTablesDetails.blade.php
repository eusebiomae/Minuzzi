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
					@if($data->status =='Pago')
					<i class="fa fa-check-circle fa-2x" title="Pago" style="color:#40aa58;"></i>
					@elseif($data->status =='Pendente')
					<i class="fa fa-exclamation-circle fa-2x text-warning" title="Pendente"></i>
					@else
					<i class="fa fa-times-circle fa-2x text-danger " title="Atrasado" ></i>
					@endif
				</td>

				<td class="center ">
					<div class="gp-block-ruby">
						<button type="button" class="btn gp-btn-green gp-mr-1" data-toggle="modal" data-target="#myModal">Pago</button>
						<button type="button" class="btn btn-warning gp-mr-1 gp-alert" data-gp-alert="markPay">Não Pago</button>
						<button type="button" class="btn btn-danger gp-alert" data-gp-alert="delete">Cancelar Fatura</button>
					</div>
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
