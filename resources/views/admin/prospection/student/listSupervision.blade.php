@extends('layouts.app')

@section('title', 'Instrução')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Lista de Inscrições para Supervisão</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li>
        <a href="{{ url('/admin/prospection/student' ) }}">Inscrições </a>
      </li>
      <li class="active">
        <strong>Listar Inscrição</strong>
      </li>
    </ol>
  </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Inscrição  <small>Lista de todas as Inscrições já feitas para Supervisões .</small></h5>
        </div>
        <div class="ibox-content">

          <div class="table-responsive">
						<table id="dataTables" class="table table-bordered">
							<thead>
								<tr>
									<th>#</th>
									<th>Nº</th>
									<th>Inscrito</th>
									<th>E-mail</th>
									<th>CPF</th>
									<th width="100px">Código</th>
									<th width="100px">Status</th>
									<th width="100px">Data</th>
									<th width="120px">Valor da Fatura</th>
									<th>Responsável</th>
									<th>Categoria</th>
								</tr>
							</thead>


							<tbody>
								@foreach ($payload->order as $order)

								<tr>
									<td class="center">
										@if ($order->status_cash == 'Gratuito')
										<i class="fa fa-circle text-green" title="{{ getValueByColumn($order, 'status_cash') }}"></i>
										@else
										<i class="fa fa-circle" style="color:#337ab7;" title="{{ getValueByColumn($order, 'status_cash') }}"></i>
										@endif
									</td>
									<td>{{ getValueByColumn($order, 'id') }}</td>
									<td>{{ getValueByColumn($order, 'student.name') }}</td>
									<td>{{ getValueByColumn($order, 'student.email') }}</td>
									<td class="mask-cpf">{{ getValueByColumn($order, 'student.cpf') }}</td>
									<td>{{ $order->code }}</td>
									<td class="center">{{ $order->statusLabel }}</td>
									<td class="center">{{ getValueByColumn($order, 'supervision.date') }}</td>
									<td>R$ {{ formatNumber($order->value) }}</td>
									<td>{{ getValueByColumn($order, 'supervision.teacher.name') }}</td>
									<td>
										{{ getValueByColumn($order, 'supervision.courseCategory.description_pt') }}
										{{-- <ul>
											@foreach ($order->supervision->course as $course)
												<li>{{ $course->title_pt }}</li>
											@endforeach
										</ul> --}}
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@parent
<script src="{!! asset('js/plugins/dataTables/datatables.min.js') !!}" type="text/javascript"></script>

<script>
$('#dataTables').DataTable({
	responsive: true,
	pageLength: 100,
})
</script>
@endsection
