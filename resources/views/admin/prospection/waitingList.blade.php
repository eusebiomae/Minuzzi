@extends('layouts.system.app')
@section('title', $module_page . ' ('. $title_page .')')

@section('css')
    <link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
@endsection
@section('content')
@include($header)

<div class="wrapper wrapper-content animated fadeInRight">

	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><?= $title_page ?></h5>
				</div>
				<div class="ibox-content">
		
					<div class="input-group">
						<div class="col-md-2">
							<label>Unidade Escolar</label>
							<select class="form-control m-b" name="account">
								<option>Selecione...</option>
								<option>Unidade I</option>
								<option>Unidade II</option>
							</select>
						</div>
						<div class="col-md-2">
							<label>Nível Educacional</label>
							<select class="form-control m-b" name="account">
								<option>Selecione...</option>
								<option>Educação Infantil</option>
								<option>Fundamental I</option>
								<option>Fundamental II</option>
							</select>
						</div>
						<div class="col-md-2">
							<label>Ano/Série</label>
							<select class="form-control m-b" name="account">
								<option>Selecione...</option>
								<option>1º Ano</option>
								<option>2º Ano</option>
								<option>3º Ano</option>
								<option>4º Ano</option>
							</select>
						</div>
						<div class="col-md-3">
							<label>Status</label>
							<select class="form-control m-b" name="account">
								<option>Selecione...</option>
								<option>Aguardando Novo Contato</option>
								<option>Não tem interesse</option>
								<option>Agendou Visita</option>
							</select>
						</div>
						<div class="col-md-1" style=" padding-top:24px;">
							<button type="button" class="btn btn-primary">
								<i class="fa fa-search" title="Pesquisar"></i>
							</button>
						</div>
					</div>
					<div class="clients-list">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-institution"></i> Unidade I</a></li>
						</ul>
						<div class="tab-content">
							<div id="tab-1" class="tab-pane active">
								<div class="full-height-scroll">
									<div class="table-responsive">
										
										<br>
										<table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px;" >
											<thead>
												<tr>
													<th>Nome</th>
													<th>Ano/Série</th>
													<th>Telefone</th>
													<th>Celular</th>
													<th>E-mail</th>
													<th>Responsável</th>
													<th>S</th>
													<th>E</th>
												</tr>
											</thead>
											<tbody>
												{{--  @foreach($data as $item)  --}}
												<tr>
													{{--  <td>{{ $item->id }}</td>
													<td>{{ $item->title_pt }}</td>
													<td>{{ $item->content_page_description_pt }}</td>
													<td>{{ $item->status }}</td>  --}}
													<td>Guilherme Santana Bergamin</td>
													<td class="center">3º Ano</td>
													<td class="center">(16) 3333-3333</td>
													<td class="center">(16) 98888-8888</td>
													<td class="center">email@dominio.com.br</td>
													<td class="center">Nome do Responsável</td>
													<td class="center"><i class="fa fa-check-circle" title="Agendou Visita"></i></td>
													<td class="center"><a href="{{ url('/prospection/guestBook/update')}}" title="Editar"><i class="fas fa-pencil-alt"></i></a></td>
												</tr>
												{{--  @endforeach  --}}
											</tbody>
											<tfoot>
												<tr>
													<th>Nome</th>
													<th>Ano/Série</th>
													<th>Telefone</th>
													<th>Celular</th>
													<th>E-mail</th>
													<th>Responsável</th>
													<th>S</th>
													<th>E</th>
												</tr>
											</tfoot>
										</table>
									</div>
									@extends('system.prospection.leads.phoneContact')
									@extends('system.prospection.leads.schedule')
								</div>
							</div>

						</div>
					</div>
		
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
	<!-- Mainly scripts -->
	<script src="{!! asset('js/plugins/metisMenu/jquery.metisMenu.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}" type="text/javascript"></script>

	<script src="{!! asset('js/plugins/dataTables/datatables.min.js') !!}" type="text/javascript"></script>

	<!-- Custom and plugin javascript -->
	<script src="{!! asset('js/inspinia.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/pace/pace.min.js') !!}" type="text/javascript"></script>

	<!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'PI - Lista de Visitas'},
                    {extend: 'pdf', title: 'PI - Lista de Visitas'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

			});
	
			{{--  $('.dataTables-example').dataTable({
				responsive: true,
				"dom": 'T<"clear">lfrtip',
				"tableTools": {
					"sSwfPath": ""
				}
			});  --}}

        });

    </script>
@endsection
