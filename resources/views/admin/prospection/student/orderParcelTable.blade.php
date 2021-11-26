<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px;" >
		<caption>{{ getValueByColumn($payload, 'formPayment.description') }}</caption>
		<thead>
			<tr>
				<th width="25">Nº</th>
				<th width="50">Status</th>
				<th width="115">Valor da Fatura</th>
				<th width="100">Vencimento</th>
				<th width="115">Valor Pago</th>
				<th width="100">Data de Pag.</th>
				<th width="150">Ações</th>
				<th width="120">Documetos</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($payload->orderParcel as $orderParcel)
			<tr data-json="{{ json_encode($orderParcel) }}">
				<td class="aling-y text-center">{{ $orderParcel->n }}</td>
				<td class="aling-y text-center">{!! $orderParcel->statusLabel !!}</td>
				<td class="aling-y">R$ {{ formatNumber($orderParcel->value) }}</td>
				<td class="aling-y">{{ $orderParcel->due_date }}</td>
				<td class="aling-y">R$ {{ formatNumber($orderParcel->value_paid) }}</td>
				<td class="aling-y">{{ $orderParcel->payday }}</td>
				<td class="aling-y" class="center ">
					@if (!in_array($payload->status, ['CA', 'TR', 'FI']))
						<div class="gp-block-ruby">
							<button type="button" class="btn btn-circle btn-md gp-mr-1 {!! (!in_array($orderParcel->status, [ 'Pg', 'Ca' ])) ? 'gp-btn-green"' : 'btn-default" disabled' !!} onclick="toApprove('orderParcel', {{ $orderParcel }})" title="Pago">
								<i class="fa fa-check " title="Pago"></i>
							</button>

							<button type="button" class="btn btn-circle gp-alert gp-mr-1 {!! (in_array($orderParcel->status, [ 'Pg' ])) ? 'btn-warning"' : 'btn-default" disabled' !!} data-gp-alert="orderParcel-notPay" title="Não Pago">
								<i class="fa fa-times" title="Não Pago"></i>
							</button>

							<button type="button" class="btn btn-circle gp-alert gp-mr-1 {!! (!in_array($orderParcel->status, [ 'Pg', 'Ca' ])) ? 'btn-danger"' : 'btn-default" disabled' !!} data-gp-alert="orderParcel-delete" title="Cancelar Fatura">
								<i class="fa fa-minus" title="Cancelar Fatura"></i>
							</button>

							<button type="button" class="btn btn-circle gp-calendar gp-mr-1 {!! (!in_array($orderParcel->status, [ 'Pg', 'Ca' ])) ? 'btn-info"' : 'btn-default" disabled' !!} data-gp-alert="orderParcel-calendar" title="Calendário">
								<i class="fa fa-calendar" title="Calendário"></i>
							</button>
						</div>
					@endif
				</td>
				<td>
					@if (isset($orderParcel->asaas_json))
						<a href="{{ $orderParcel->asaas_json->bankSlipUrl }}" target="_blank" title="Boleto" class="btn btn-sm {!! (in_array($orderParcel->status, ['At', 'Ab', 'Pd'])) ? 'btn-info"' : 'btn-default" disabled' !!}>
							<i class="fa fa-dollar"></i>
						</a>
					@endif

					<a href="/bill/orderParcel/{{ $orderParcel->id }}" target="_blank" title="Recibo" class="btn btn-sm {!! (in_array($orderParcel->status, ['Pg'])) ? 'btn-ciano"' : 'btn-default" disabled' !!}>
						<i class="fa fa-file-text"></i>
					</a>

					{{-- <a href="/bill/orderParcel/{{ $orderParcel->id }}" target="_blank" title="Nota Fiscal" class="btn btn-sm < ?= (in_array($orderParcel->status, ['Pg'])) ? 'gp-btn-green"' : 'btn-default" disabled' ?>>
						<i class="fa fa-file-text"></i>
					</a> --}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
