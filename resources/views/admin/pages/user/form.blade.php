
@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
@endsection

	      	<div class="form-group">
	      		<label class="col-sm-2 control-label">Login*</label>
	          <div class="col-sm-4">
	          	<input type="text" id="user_name" name="user_name" class="form-control" required>
	          	<span class="help-block m-b-none">Digite o login do usuário.</span>
	          </div>
						<label class="col-sm-1 control-label">Senha*</label>
						<div class="col-sm-5">
							<input type="password" id="password" name="password" class="form-control">
							<span class="help-block m-b-none">Digite a senha.</span>
						</div>
	      	</div>
	      	<div class="form-group">
	      	</div>
	      	<div class="form-group">
	      		<label class="col-sm-2 control-label">Nome*</label>
	          <div class="col-sm-10">
	          	<input type="text" id="name" name="name" class="form-control" required>
	          	<span class="help-block m-b-none">Digite o nome.</span>
	          </div>
	      	</div>
	      	<div class="form-group">
	      		<label class="col-sm-2 control-label">E-mail*</label>
	          <div class="col-sm-10">
	          	<input type="email" id="email" name="email" class="form-control" required>
	          	<span class="help-block m-b-none">Digite o e-mail.</span>
	          </div>
	      	</div>

	      	<div class="form-group">
	      		<label class="col-sm-2 control-label">Autor do Blog?*</label>
            <div class="col-sm-2">
            	<select id="author" name="author" class="form-control m-b" required>
                <option value="N">Não</option>
                <option value="S">Sim</option>
            	</select>
            </div>
						<label class="col-sm-2 control-label">Consultor de vendas?*</label>
						<div class="col-sm-2">
							<select id="consultant" name="consultant" class="form-control m-b" required>
								<option value="N">Não</option>
								<option value="S">Sim</option>
							</select>
						</div>
						<label class="col-sm-2 control-label">Administrador de site?*</label>
						<div class="col-sm-2">
							<select id="admin" name="admin" class="form-control m-b" required>
								<option value="N">Não</option>
								<option value="S">Sim</option>
							</select>
						</div>
					</div>

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
					<div class="row center">
						@if(isset($data) && isset($data['image']))
							<img height="200" src="{{ Storage::url("user/{$data['image']}") }}" />
						@endif
					</div>

@section('scripts')
@parent
<script src="{!! asset('js/plugins/jasny/jasny-bootstrap.min.js') !!}" type="text/javascript"></script>
@endsection
