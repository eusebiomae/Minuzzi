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
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Enscrito</th>
									<th>E-mail</th>
									<th>CPF</th>
									<th width="100px">Código</th>
									<th width="100px">Status</th>
									<th width="100px">Data</th>
									<th width="120px">Valor da Fatura</th>
									<th>Responsável</th>
									<th>Cursos</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($payload->order as $order)
								<tr>
									<td>{{ getValueByColumn($order, 'student.name') }}</td>
									<td>{{ getValueByColumn($order, 'student.email') }}</td>
									<td class="mask-cpf">{{ getValueByColumn($order, 'student.cpf') }}</td>
									<td>{{ $order->code }}</td>
									<td class="center">{{ $order->statusLabel }}</td>
									<td class="center">{{ $order->supervision->date }}</td>
									<td>R$ {{ formatNumber($order->value) }}</td>
									<td>{{ getValueByColumn($order, 'supervision.teacher.name') }}</td>
									<td>
										<ul>
											@foreach ($order->supervision->course as $course)
												<li>{{ $course->title_pt }}</li>
											@endforeach
										</ul>
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
