@extends('layouts.app')

@section('title', $module_page . ' ('. $title_page .')')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
@endsection

@section('content')

@include($header)

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Usuário <small>Cadastrar usuários.</small></h5>
			</div>
			<div class="ibox-content">
				<form name="formUser" method="post" action="{{ $urlAction }}" class="form-horizontal" enctype="multipart/form-data">
					<input type="hidden" id="id" name="id">

					<div class="form-group">
						@if ($fieldPageConfig->show('user_name'))
						<label class="col-sm-2 control-label">Login*</label>
						<div class="col-sm-4">
							<input type="text" id="user_name" name="user_name" class="form-control" required {!! $fieldPageConfig->attr('user_name') !!} />
							<span class="help-block m-b-none">Digite o login do usuário.</span>
						</div>
						@endif

						@if ($fieldPageConfig->show('password'))
						<label class="col-sm-1 control-label">Senha*</label>
						<div class="col-sm-5">
							<input type="password" id="password" name="password" class="form-control" {!! $fieldPageConfig->attr('password') !!} />
							<span class="help-block m-b-none">Digite a senha.</span>
						</div>
						@endif

					</div>

					<div class="form-group">

						@if ($fieldPageConfig->show('name'))
						<label class="col-sm-2 control-label">Nome*</label>
						<div class="col-sm-4">
							<input type="text" id="name" name="name" class="form-control" required {!! $fieldPageConfig->attr('name') !!} />
							<span class="help-block m-b-none">Digite o nome.</span>
						</div>
						@endif

						@if ($fieldPageConfig->show('email'))
						<label class="col-sm-1 control-label">E-mail*</label>
						<div class="col-sm-5">
							<input type="email" id="email" name="email" class="form-control" required {!! $fieldPageConfig->attr('email') !!} />
							<span class="help-block m-b-none">Digite o e-mail.</span>
						</div>
						@endif

					</div>

					<div class="form-group">

						@if ($fieldPageConfig->show('phone'))
						<label class="col-sm-2 control-label" for="phone">Telefone</label>
						<div class="col-sm-4">
							<input type="text" id="phone" name="phone" data-mask="(99) 9999-9999" class="form-control" {!! $fieldPageConfig->attr('phone') !!} />
							<span class="help-block m-b-none">Digite o Telefone.</span>
						</div>
						@endif

						@if ($fieldPageConfig->show('cellphone'))
						<label class="col-sm-1 control-label" for="cellphone">WhatsApp</label>
						<div class="col-sm-5">
							<input type="text" id="cellcellphone" name="cellphone" data-mask="(99) 9 9999-9999" class="form-control" {!! $fieldPageConfig->attr('cellphone') !!} />
							<span class="help-block m-b-none">Digite o Celular.</span>
						</div>
						@endif

					</div>

					<div class="form-group">
						@if ($fieldPageConfig->show('cellphone'))
						<label class="col-sm-2 control-label" for="user_profile_id">Perfil de Usuário</label>
						<div class="col-sm-4">
							<select id="user_profile_id" name="user_profile_id" class="form-control m-b" required {!! $fieldPageConfig->attr('user_profile_id') !!}></select>
						</div>
						@endif
					</div>

					<div class="form-group">

						@if ($fieldPageConfig->show('author'))
						<label class="col-sm-2 control-label">Autor do Blog?*</label>
						<div class="col-sm-4">
							<select id="author" name="author" class="form-control m-b" required {!! $fieldPageConfig->attr('author') !!} >
								<option value="N">Não</option>
								<option value="S">Sim</option>
							</select>
						</div>
						@endif

						@if ($fieldPageConfig->show('consultant'))
						<label class="col-sm-1 control-label">Consultor de vendas?*</label>
						<div class="col-sm-5">
							<select id="consultant" name="consultant" class="form-control m-b" required {!! $fieldPageConfig->attr('consultant') !!} >
								<option value="N">Não</option>
								<option value="S">Sim</option>
							</select>
						</div>
						@endif

					</div>

					<div class="form-group">

						@if ($fieldPageConfig->show('admin'))
						<label class="col-sm-2 control-label">Administrador de site?*</label>
						<div class="col-sm-4">
							<select id="admin" name="admin" class="form-control m-b" required {!! $fieldPageConfig->attr('admin') !!} >
								<option value="N">Não</option>
								<option value="S">Sim</option>
							</select>
						</div>
						@endif

						@if ($fieldPageConfig->show('contact_site'))
						<label class="col-sm-1 control-label" for="contact_site">Contato Site*</label>
						<div class="col-sm-5">
							<select id="contact_site" name="contact_site" class="form-control m-b" required {!! $fieldPageConfig->attr('contact_site') !!} >
								<option value="N">Não</option>
								<option value="S">Sim</option>
							</select>
						</div>
						@endif

					</div>

					@if ($fieldPageConfig->show('image'))
					<div class="form-group">
						<label class="col-sm-2 control-label">Imagem de Perfil*</label>
						<div class="col-sm-10">
							<div class="fileinput fileinput-new input-group" data-provides="fileinput">
								<div class="form-control" data-trigger="fileinput">
									<i class="glyphicon glyphicon-file fileinput-exists"></i>
									<span class="fileinput-filename"></span>
								</div>
								<span class="input-group-addon btn btn-default btn-file">
									<span class="fileinput-new">Selecionar</span>
									<span class="fileinput-exists">Alterar</span>
									<input type="file" id="fileImage" name="fileImage">
								</span>
								<a href="#" class="input-group-addon btn btn-default fileinput-exists"
									data-dismiss="fileinput">Remover</a>
							</div>
						</div>
					</div>
					@endif

					<div class="row center">
						@if(isset($data) && isset($data['image']))
							<img height="200" src="{{ Storage::url("user/{$data['image']}") }}" />
						@endif
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
<script src="{!! asset('js/plugins/jasny/jasny-bootstrap.min.js') !!}" type="text/javascript"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
	try {
		APP.scope.user = <?=isset($data) ? json_encode($data) : 'null'?>;
		APP.scope.listSelectBox = @json($listSelectBox);


		if (APP.scope.listSelectBox.userProfile) {
			populateSelectBox({
				list: APP.scope.listSelectBox.userProfile,
				target: document.getElementById('user_profile_id'),
				columnValue: "id",
				columnLabel: "desc",
			});
		}

		if (APP.scope.user) {
			populate(document.forms.formUser, APP.scope.user);
		}
	} catch (error) {
		console.warn(error);
	}
});
</script>
@endsection
