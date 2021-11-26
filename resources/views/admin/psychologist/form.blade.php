@extends('layouts.app')

@section('title', 'Formulário-Psicólogos')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
<link rel="stylesheet" href="{!! asset('cetcc/css/icon_fonts/css/all_icons.min.css') !!}" >
<link rel="stylesheet" href="{!! asset('css/plugins/sweetalert/sweetalert.css') !!}">
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />



@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Inserir Psicólogos</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/admin') }}">Home</a>
			</li>
			<li>
				<a href="{{ url('/admin/psychologist') }}">Lista de Psicólogos</a>
			</li>
			<li class="active">
				<strong>Inserir Psicólogos</strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-2">

	</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>Psicólogos <small>Cadastro de Psicólogos.</small></h5>
		</div>

		<div class="ibox-content">
			<form name="form" method="post" action="{{ url($urlAction) }}" enctype="multipart/form-data" class="form-horizontal">
				<div class="row">
					<input type="hidden" name="id">
					<label class="col-sm-2 control-label">Nome*</label>

					@if ($fieldPageConfig->show('name'))
					<div class="col-sm-10">
						<input type="text" name="name" class="form-control" required {!! $fieldPageConfig->attr('name') !!} />
						<span class="help-block m-b-none">Digite o Nome.</span>
					</div>
					@endif

				</div>

				<div class="row m-t-sm">
					<label class="col-sm-2 control-label">Telefone*</label>
					@if ($fieldPageConfig->show('phone'))
					<div class="col-sm-3">
						<input type="text" name="phone" data-mask="(99) 9999-9999" maxlength="16" class="form-control" required {!! $fieldPageConfig->attr('phone') !!} />
						<span class="help-block m-b-none">Digite o Telefone.</span>
					</div>
					@endif

					<label class="col-sm-1 control-label">WhatsApp*</label>
					@if ($fieldPageConfig->show('whatsapp'))
					<div class="col-sm-3">
						<input type="text" name="whatsapp" data-mask="(99) 9 9999-9999" maxlength="16" class="form-control" required {!! $fieldPageConfig->attr('whatsapp') !!} />
						<span class="help-block m-b-none">Digite o WhatsApp.</span>
					</div>
					@endif

					<label class="col-sm-1 control-label">E-mail*</label>
					@if ($fieldPageConfig->show('email'))
					<div class="col-sm-2">
						<input type="email" name="email" class="form-control" required {!! $fieldPageConfig->attr('email') !!} />
						<span class="help-block m-b-none">Digite o E-mail.</span>
					</div>
					@endif

				</div>

				<div class="row m-t-sm">
					<label class="col-sm-2 control-label">Especialidade*</label>
					@if ($fieldPageConfig->show('specialties'))
					<div class="col-sm-2">
						<select class="form-control m-b" name="specialties" {!! $fieldPageConfig->attr('specialties') !!} >
							<option value="">Selecione ...</option>
							<option value="Adulto">Adulto</option>
							<option value="Criança">Criança</option>
							<option value="Casal">Casal</option>
							<option value="Grupo">Grupo</option>
						</select>
						<span class="help-block m-b-none">Selecione o Especialidade.</span>
					</div>
					@endif

					<label class="col-sm-1 control-label">CRP*</label>
					@if ($fieldPageConfig->show('crp'))
					<div class="col-sm-2">
						<input type="text" name="crp" class="form-control" required {!! $fieldPageConfig->attr('crp') !!} />
						<span class="help-block m-b-none">Digite o CRP.</span>
					</div>
					@endif

					<label class="col-sm-1 control-label">Como nos conheceu?*</label>
					@if ($fieldPageConfig->show('met'))
					<div class="col-sm-4">
						<input type="text" name="met" class="form-control" required {!! $fieldPageConfig->attr('met') !!} />
						<span class="help-block m-b-none">Digite como nos conheceu.</span>
					</div>
					@endif

				</div>

				<div class="row m-t-sm">
					<label class="col-sm-2 control-label">CEP*</label>
					@if ($fieldPageConfig->show('zip_code'))
					<div class="col-sm-2">
						<input type="text" name="zip_code" data-mask="99999-999" class="form-control" required {!! $fieldPageConfig->attr('zip_code') !!} />
						<span class="help-block m-b-none">Digite o CEP.</span>
					</div>
					@endif

					<label class="col-sm-1 control-label">Estado</label>
					@if ($fieldPageConfig->show('state_id'))
					<div class="col-sm-2">
						<select class="form-control m-b" name="state_id" {!! $fieldPageConfig->attr('state_id') !!}></select>
						<span class="help-block m-b-none">Selecione o Estado</span>
					</div>
					@endif

					<label class="col-sm-1 control-label">Cidade*</label>
					@if ($fieldPageConfig->show('city'))
					<div class="col-sm-4">
						<input type="text" name="city" class="form-control" required {!! $fieldPageConfig->attr('city') !!} />
						<span class="help-block m-b-none">Digite o Cidade.</span>
					</div>
					@endif

				</div>

				<div class="row m-t-sm">
					<label class="col-sm-2 control-label">Bairro*</label>
					@if ($fieldPageConfig->show('neighborhood'))
					<div class="col-sm-2">
						<input type="text" name="neighborhood" class="form-control" required {!! $fieldPageConfig->attr('neighborhood') !!} />
						<span class="help-block m-b-none">Digite o Bairro.</span>
					</div>
					@endif

					<label class="col-sm-1 control-label">Endereço*</label>
					@if ($fieldPageConfig->show('address'))
					<div class="col-sm-2">
						<input type="text" name="address" class="form-control" required {!! $fieldPageConfig->attr('address') !!} />
						<span class="help-block m-b-none">Digite o Endereço.</span>
					</div>
					@endif

					<label class="col-sm-1 control-label">Nº*</label>
					@if ($fieldPageConfig->show('number'))
					<div class="col-sm-1">
						<input type="text" name="number" class="form-control" required {!! $fieldPageConfig->attr('number') !!} />
						<span class="help-block m-b-none">Digite o Nº.</span>
					</div>
					@endif

					<label class="col-sm-1 control-label">Complemento*</label>
					@if ($fieldPageConfig->show('complement'))
					<div class="col-sm-2">
						<input type="text" name="complement" class="form-control" required {!! $fieldPageConfig->attr('complement') !!} />
						<span class="help-block m-b-none">Digite o Complemento.</span>
					</div>
					@endif

				</div>

				<div class="row m-t-md">
					<div class="col-sm-12 text-right">
						<button class="btn btn-white gp-alert" data-gp-alert="cancel" type="submit">Cancelar</button>
						<button class="btn btn-primary gp-alert" data-gp-alert="save" type="submit">Salvar alterações</button>
					</div>
				</div>
				{{-- TABELA  --}}
				@if (isset($patientHistory))
					<div class="row m-t-lg">
						<div class="col-lg-12">
							<div class="ibox float-e-margins  ">
								<div class="ibox-content p-t-lg">
									<div class="table-responsive">
										<div class="table-responsive ">
											{{-- TABLE  --}}
											<table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px;" >
												<thead>
													<tr>
														<th>Nome</th>
														<th width="5"></th>
														<th width="5"></th>
														<th width="5"></th>
														<th width="5"></th>
													</tr>
												</thead>
												<tbody>
													<tr>

														<td></td>
														<td class="center">
															<a type="" class="" data-toggle="modal" data-target="#forward">
																<i class="fa fa-mail-forward text-success" title="Encaminhado"></i>
															</a>
														</td>

														<td class="center">
															<i class="fa fa-times-circle" title="Desativado"></i>
														</td>
														<td class="center">
																<a href="">
																	<i class="fas fa-pencil-alt" title="Editar"></i>
																</a>
														</td>
														<td class="center">
															<a href="">
																<i class="far fa-trash-alt demo4" title="Excluir"></i>
															</a>
														</td>
													</tr>
												</tbody>
												<tfoot>
													<tr>
														<th></th>
														<th></th>
														<th></th>
														<th></th>
														<th></th>
													</tr>
												</tfoot>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal inmodal" id="forward" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content animated bounceInRight">
									<form name="form2" action="">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
												<i class="fa fa-mail-forward modal-icon"></i>
												<h4 class="modal-title">Encaminhar</h4>
											<small class="font-bold">Encaminhe este pscólogo(a) para um paciente</small>
										</div>
										<div class="modal-body ">
											<div class="">
												<label class="control-label">Psicólogo(a)*</label>
												<div class="">
													<select class="form-control m-b-xs " name="psychologist_id" disabled>
														<option value="1" selected>Nome do selecionado</option>
													</select>
													<span class="help-block m-t-none">Selecione o Psicólog(a)</span>
												</div>
											</div>
											<div class="">
												<label class="control-label">Paciente*</label>
												<div class="">
													<select class="form-control m-b-xs" name="patient_id">
													</select>
													<span class="help-block m-t-none">Selecione o Paciente</span>
												</div>
											</div>
											<label class="control-label">Observação</label>
											<div class="">
												<input type="text" name="note" class="form-control" >
												<span class="help-block m-b-none">Digite uma observação.</span>
											</div>
										</div>
										<div class="modal-footer">
											<button class="btn btn-white gp-alert" data-gp-alert="cancel" type="submit">Cancelar</button>
											<button class="btn btn-primary gp-alert" data-gp-alert="save" type="submit">Salvar</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				@endif
				{{ csrf_field() }}
			</form>
		</div>
	</div>
</div>
@endsection


@section('scripts')
<!-- Mainly scripts -->
<script src="{!! asset('js/plugins/metisMenu/jquery.metisMenu.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}" type="text/javascript"></script>

<!-- Custom and plugin javascript -->
<script src="{!! asset('js/inspinia.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/pace/pace.min.js') !!}" type="text/javascript"></script>

<!-- SUMMERNOTE -->
<script src="{!! asset('js/plugins/sweetalert/sweetalert.min.js') !!}"></script>
<script src="{!! asset('js/plugins/jasny/jasny-bootstrap.min.js')!!}"></script>
<script src="{!! asset('js/plugins/dataTables/datatables.min.js') !!}" type="text/javascript"></script>

<!-- switch -->


<script>
	document.addEventListener('DOMContentLoaded', function() {
		try {
			APP.scope.form = <?=isset($data) ? json_encode($data) : 'null'?>;
			APP.scope.listSelectBox = {!! isset($listSelectBox) ? json_encode($listSelectBox) : '{}' !!};

			try {
					populateSelectBox({
						list: APP.scope.listSelectBox.states,
						target: document.forms.form.state_id,
						columnValue: "id",
						columnLabel: "abbreviation",
						selectBy: [ ],
						emptyOption: {
							label: ""
						}
					})
				} catch (error) {
alert(erro)
				}
				try {
					populateSelectBox({
						list: APP.scope.listSelectBox.patient,
						target: document.forms.form2.patient_id,
						columnValue: "id",
						columnLabel: "name",
						selectBy: [ ],
						emptyOption: {
							label: "Selecione"
						}
					})
				} catch (error) {
					alert(erro)
				} finally {
					if (APP.scope.listSelectBox.states) {
						populate(document.forms.form);
						$('[data-mask]').trigger('input')
					}
				}
			if (APP.scope.form) {
				populate(document.forms.form, APP.scope.form);
			}

			//  Sweet alert
			$('.gp-alert').click(function ($event) {
				try {
					var gpAlertKey = $event.target.dataset.gpAlert;

					var mapAlert = {
						cancel: {
							params: {
								title: "Cancelado",
								text: "As modificações não foram salvas",
								type: "error",
								showCancelButton: false,
								confirmButtonText: "Ok",
								confirmButtonColor: "#1a7bb9"
							}
						},
						save: {
							params: {
								title: "Salvo com Sucesso",
								text: "As modificações foram salvas",
								type: "success",
								showCancelButton: false,
								confirmButtonText: "Ok",
								confirmButtonColor: "#1a7bb9"
							}
						},
					}

					swal(Object.assign({
						title: "Tem certeza disso?",
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Sim",
						showCancelButton: true,
						closeOnConfirm: false
					}, mapAlert[gpAlertKey].params), mapAlert[gpAlertKey].callback);
				} catch (error) {
					console.warn(error)
				}
      });

		} catch (error) {
			console.warn(error);
		}
	});
</script>
@endsection
