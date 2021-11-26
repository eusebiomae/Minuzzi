@extends('layouts.app')

@section('title', $module_page . ' ('. $title_page .')')

@section('css')
	<link rel="stylesheet" href="{!! asset('css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/select2/select2.min.css') !!}" />

	<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/basic.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/dropzone.css') !!}" />
@endsection

@section('content')
@include($header)

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Dados da Intituição <small>Cadastro e edição da instituição.</small></h5>
			</div>
			<div class="ibox-content">
				<form name="formInformation" method="post" action="{{ $urlAction }}" enctype="multipart/form-data" class="form-horizontal">
					<input type="hidden" name="id">
					<div class="form-group">
						<label class="col-sm-2 control-label">Nome da instituição *</label>
						<div class="col-sm-9">
							<input type="text"name="name" class="form-control" size="400" maxlength="400" autofocus required>
							<span class="help-block m-b-none">Digite o Nome da instituição.</span>
						</div>
						<div class="col-sm-1">
							<div class="switch">
								<div class="onoffswitch">
									<input type="hidden" name="flg_main" value="">
									<input type="checkbox" class="onoffswitch-checkbox" id="formFlgMain" onchange="this.parentNode.firstElementChild.value = this.checked ? '1' : ''">
									<label class="onoffswitch-label" for="formFlgMain">
										<span class="onoffswitch-inner"></span>
										<span class="onoffswitch-switch"></span>
									</label>
								</div>
							</div>
							<span class="help-block m-b-none">Principal</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">CNPJ *</label>
						@if ($fieldPageConfig->show('cnpj'))
						<div class="col-sm-7">
							<input type="text" name="cnpj" class="form-control" maxlength="18" required {!! $fieldPageConfig->attr('cnpj') !!} />
							<span class="help-block m-b-none">Digite o cnpj.</span>
						</div>
						@endif
					</div>

					<div class="form-group">

						<label class="col-sm-2 control-label">Endereço *</label>
						@if ($fieldPageConfig->show('address'))
						<div class="col-sm-7">
							<input type="text" id="address" name="address" class="form-control" size="400" maxlength="400" required {!! $fieldPageConfig->attr('address') !!} />
							<span class="help-block m-b-none">Digite o endereço.</span>
						</div>
						@endif

						<label class="col-sm-1 control-label">Nº *</label>
						@if ($fieldPageConfig->show('number'))
						<div class="col-sm-2">
							<input type="number"  id="number" name="number" class="form-control" required {!! $fieldPageConfig->attr('number') !!} />
						</div>
						@endif

					</div>
					<div class="form-group">

						<label class="col-sm-2 control-label">Complemento</label>
						@if ($fieldPageConfig->show('complement'))
						<div class="col-sm-5">
							<input type="text" id="complement" name="complement" class="form-control" {!! $fieldPageConfig->attr('complement') !!} />
							<span class="help-block m-b-none">Digite o complemento.</span>
						</div>
						@endif

						<label class="col-sm-1 control-label">Bairro *</label>
						@if ($fieldPageConfig->show('neighborhood'))
						<div class="col-sm-4">
							<input type="text" id="neighborhood" name="neighborhood" class="form-control" required {!! $fieldPageConfig->attr('neighborhood') !!} />
							<span class="help-block m-b-none">Digite o bairro.</span>
						</div>
						@endif

					</div>

					<div class="form-group">

						<label class="col-sm-2 control-label">Cidade *</label>
						@if ($fieldPageConfig->show('city'))
						<div class="col-sm-5">
							<input type="text" id="city" name="city" class="form-control" required {!! $fieldPageConfig->attr('city') !!} />
							<span class="help-block m-b-none">Digite a cidade.</span>
						</div>
						@endif

						<label class="col-sm-1 control-label">UF *</label>
						@if ($fieldPageConfig->show('uf'))
						<div class="col-sm-4">
							<select id="uf" name="uf"  class="select2_demo_1 form-control" required {!! $fieldPageConfig->attr('uf') !!} >
								<option value="">Selecione a página</option>
								@foreach($listSelectBox->state as $item)
								<option value="{{ $item->id }}">{{ $item->description }}</option>
								@endforeach
							</select>
							<span class="help-block m-b-none">Selecione a UF.</span>
						</div>
						@endif

					</div>

					<div class="form-group">

						<label class="col-sm-2 control-label">CEP *</label>
						@if ($fieldPageConfig->show('cep'))
						<div class="col-sm-5">
							<input type="text" id="cep" name="cep" class="form-control" data-mask="99999-999" placeholder="" required {!! $fieldPageConfig->attr('cep') !!} />
							<span class="help-block m-b-none">Digite a cidade.</span>
						</div>
						@endif

					</div>

					<div class="form-group">

						<label class="col-sm-2 control-label">Telefone *</label>
						@if ($fieldPageConfig->show('phone1'))
						<div class="col-sm-5">
							<input type="text" id="phone1" name="phone1" class="form-control" data-mask="(99) 9999-9999" placeholder="" required {!! $fieldPageConfig->attr('phone1') !!} />
							<span class="help-block m-b-none">Digite o telefone principal.</span>
						</div>
						@endif

						@if ($fieldPageConfig->show('phone2'))
						<div class="col-sm-5">
							<input type="text" id="phone2" name="phone2" class="form-control" data-mask="(99) 9999-9999" placeholder="" {!! $fieldPageConfig->attr('phone2') !!} />
							<span class="help-block m-b-none">Digite o telefone secundário.</span>
						</div>
						@endif

					</div>

					<div class="form-group">

						<label class="col-sm-2 control-label">Celular</label>
						@if ($fieldPageConfig->show('cell_phone1'))
						<div class="col-sm-5">
							<input type="text" id="cell_phone1" name="cell_phone1" class="form-control" data-mask="(99) 9 9999-9999" placeholder="" {!! $fieldPageConfig->attr('cell_phone1') !!} />
							<span class="help-block m-b-none">Digite o celular principal.</span>
						</div>
						@endif

						@if ($fieldPageConfig->show('cell_phone2'))
						<div class="col-sm-5">
							<input type="text" id="cell_phone2" name="cell_phone2" class="form-control" data-mask="(99) 9 9999-9999" placeholder="" {!! $fieldPageConfig->attr('cell_phone2') !!} />
							<span class="help-block m-b-none">Digite o celular secundário.</span>
						</div>
						@endif

					</div>

					<div class="form-group">

						<label class="col-sm-2 control-label">E-mail</label>
						@if ($fieldPageConfig->show('email1'))
						<div class="col-sm-5">
							<input type="email" id="email1" name="email1" class="form-control" placeholder="exemplo@site.com.br" {!! $fieldPageConfig->attr('email1') !!} />
							<span class="help-block m-b-none">Digite o e-mail principal.</span>
						</div>
						@endif

						@if ($fieldPageConfig->show('email2'))
						<div class="col-sm-5">
							<input type="email" id="email2" name="email2" class="form-control" placeholder="exemplo@site.com.br" {!! $fieldPageConfig->attr('email2') !!} />
							<span class="help-block m-b-none">Digite o e-mail secundário.</span>
						</div>
						@endif

					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Redes Socias</label>
						<div class="col-sm-10">
							<div class="row">

								@if ($fieldPageConfig->show('facebook'))
								<div class="col-sm-2">
									<input type="text" id="facebook" name="facebook" class="form-control" placeholder="" {!! $fieldPageConfig->attr('facebook') !!} />
									<span class="help-block m-b-none">Digite o Link do Facebook.</span>
								</div>
								@endif

								@if ($fieldPageConfig->show('twitter'))
								<div class="col-sm-2">
									<input type="text" id="twitter" name="twitter" class="form-control" placeholder="" {!! $fieldPageConfig->attr('twitter') !!} />
									<span class="help-block m-b-none">Digite o Link do Twitter.</span>
								</div>
								@endif

								@if ($fieldPageConfig->show('instagram'))
								<div class="col-sm-2">
									<input type="text" id="instagram" name="instagram" class="form-control" placeholder="" {!! $fieldPageConfig->attr('instagram') !!} />
									<span class="help-block m-b-none">Digite o Link do Instagram.</span>
								</div>
								@endif

								@if ($fieldPageConfig->show('pinterest'))
								<div class="col-sm-2">
									<input type="text" id="pinterest" name="pinterest" class="form-control" placeholder="" {!! $fieldPageConfig->attr('pinterest') !!} />
									<span class="help-block m-b-none">Digite o Link do Pinterest.</span>
								</div>
								@endif

								@if ($fieldPageConfig->show('youtube'))
								<div class="col-sm-2">
									<input type="text" name="youtube" class="form-control" placeholder="" {!! $fieldPageConfig->attr('youtube') !!} />
									<span class="help-block m-b-none">Digite o Link do Youtube.</span>
								</div>
								@endif

								@if ($fieldPageConfig->show('linkedin'))
								<div class="col-sm-2">
									<input type="text" id="linkedin" name="linkedin" class="form-control" placeholder="" {!! $fieldPageConfig->attr('linkedin') !!} />
									<span class="help-block m-b-none">Digite o Link do Linkedin.</span>
								</div>
								@endif

							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Logotipo da instituição</label>
						<div class="col-sm-10">
							<div class="fileinput fileinput-new input-group" data-provides="fileinput">
								<div class="form-control" data-trigger="fileinput">
									<i class="glyphicon glyphicon-file fileinput-exists"></i>
									<span class="fileinput-filename"></span>
								</div>
								<span class="input-group-addon btn btn-default btn-file">
									<span class="fileinput-new">Select file</span>
									<span class="fileinput-exists">Change</span>
									<input type="file" id="fileImage" name="fileImage">
								</span>
								<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Informações da Empresa</label>
						<div class="col-sm-10">
							<textarea name="company_information" class="form-control" rows="10"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Assas</label>
						<div class="col-sm-5">
							<input type="text" name="asaas_url" class="form-control" maxlength="255">
							<span class="help-block m-b-none">Link da API</span>
						</div>
						<div class="col-sm-5">
							<input type="text" name="asaas_token" class="form-control" maxlength="128">
							<span class="help-block m-b-none">Token da API</span>
						</div>
					</div>

					<hr>
					<h3>Parametrização do Sistema</h3>
					<div class="form-group">
						<div class="col-lg-4">
							<label class="control-label">Tipo de valor na Meta</label>
							<select name="parametersApp[valueOfMeta]" class="form-control">
								<option value="0">Quantidade</option>
								<option value="1">Monetário</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-12 text-right">
							<button class="btn btn-white" type="submit">Cancelar</button>
							<button class="btn btn-primary" type="submit">Salvar alterações</button>
						</div>
					</div>
					{{ csrf_field() }}
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
@parent
	<!-- Custom and plugin javascript -->
	<script src="{!! asset('js/plugins/pace/pace.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/metisMenu/jquery.metisMenu.js') !!}" type="text/javascript"></script>

	<script src="{!! asset('js/plugins/jasny/jasny-bootstrap.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/select2/select2.full.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') !!}" type="text/javascript"></script>

	<script src="{!! asset('js/plugins/dropzone/dropzone.js') !!}" type="text/javascript"></script>

	<script>
		Dropzone.options.dropzoneForm = {
			paramName: "file", // The name that will be used to transfer the file
			maxFilesize: 2, // MB
			dictDefaultMessage: "<strong>Drop files here or click to upload. </strong></br> (This is just a demo dropzone. Selected files are not actually uploaded.)"
		};

		$(document).ready(function(){

			$('.tagsinput').tagsinput({
				tagClass: 'label label-primary'
			});

			$(".select2_demo_1").select2();
			$(".select2_demo_2").select2();
			$(".select2_demo_3").select2({
				placeholder: "Select a state",
				allowClear: true
			});

		});
	</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
	try {
		APP.scope.information = <?=isset($data) ? json_encode($data) : 'null'?>;
		APP.scope.parametersApp = <?=isset($parametersApp) ? json_encode($parametersApp) : 'null'?>;

		if (APP.scope.information) {
			populate(document.forms.formInformation, APP.scope.information)

			if (APP.scope.information.flg_main) {
				document.getElementById('formFlgMain').checked = true
			}
		}

		if (APP.scope.parametersApp) {
			populate(document.forms.formInformation, {parametersApp: APP.scope.parametersApp});
		}
	} catch (error) {
		console.warn(error);
	}
});
</script>
@endsection
