@section('css')
@parent
<link rel="stylesheet" href="{!! asset('css/plugins/iCheck/custom.css') !!}" />
@endsection

<div class="col-lg-12">

	<div class="form-group">
		@if($configApp->showFormFields ? $configApp->showFormFields->responsible_seller : true)
		<div class="col-sm-6">
			<label class="control-label">Vendedor Responsável</label>
			<select class="form-control" name="responsibleSeller[]" multiple size="3"></select>
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->flg_type : true)
		<div class="col-sm-6">
			<label class="control-label">Tipo</label>
			<select name="flg_type" class="form-control">
				<option value="P">Prospect</option>
				<option value="C">Cliente</option>
				<option value="X">Ex cliente</option>
			</select>
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->email : true)
		<div class="col-sm-6">
			<label class="control-label">Email</label>
			<input type="text" id="email" name="email" class="form-control" value="" required>
		</div>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				document.getElementById("email").addEventListener("change", exists_email);
			});
		</script>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->student_name : true)
		<div class="col-sm-6">
			<label class="control-label">Nome</label>
			<input type="text" id="student_name" name="student_name" class="form-control" value="" required>
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->student_last_name : true)
		<div class="col-sm-4">
			<label class="control-label">Sobrenome</label>
			<input type="text" id="student_last_name" name="student_last_name" class="form-control" value="" required>
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->badge_name : true)
		<div class="col-sm-4">
			<label class="control-label">Nome Social</label>
			<input type="text" id="badge_name" name="badge_name" class="form-control" value="">
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->birth_date : true)
		<div class="col-lg-4">
			<div class="form-group col-lg-12 date">
				<label class="control-label">Data de Nascimento </label>
				<div class="input-group date">
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					<input type="text" id="birth_date" name="birth_date" class="form-control" readonly>
				</div>
			</div>
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->gender : true)
		<div class="col-lg-2">
			<label class="control-label">Gênero </label>
			<select class="form-control" id="gender" name="gender">
				<option value="">Selecione...</option>
				<option value="M">Masculino</option>
				<option value="F">Feminino</option>
				<option value="O">Outro</option>
			</select>
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->cpf : true)
		<div class="col-sm-5">
			<label class="control-label">CPF</label>
			<input type="text" id="cpf" name="cpf" class="form-control" value="">
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->rg : true)
		<div class="col-sm-5">
			<label class="control-label">RG</label>
			<input type="text" id="rg" name="rg" class="form-control" value="">
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->dispatcher_organ : true)
		<div class="col-sm-2">
			<label class="control-label">Orgão Expedidor</label>
			<input type="text" id="dispatcher_organ" name="dispatcher_organ" class="form-control" maxlength="8" value="">
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->address : true)
		<div class="col-sm-10">
			<label class="control-label">Endereço</label>
			<input type="text" id="address" name="address" class="form-control" value="">
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->number : true)
		<div class="col-sm-2">
			<label class="control-label">Nº</label>
			<input type="text" id="number" name="number" class="form-control" value="">
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->complement : true)
		<div class="col-sm-6">
			<label class="control-label">Complemento</label>
			<input type="text" id="complement" name="complement" class="form-control" value="">
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->reference : true)
		<div class="col-sm-6">
			<label class="control-label">Referência</label>
			<input type="text" id="reference" name="reference" class="form-control" value="">
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->district : true)
		<div class="col-sm-4">
			<label class="control-label">Bairro</label>
			<input type="text" id="district" name="district" class="form-control" value="">
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->city : true)
		<div class="col-sm-3">
			<label class="control-label">Cidade</label>
			<input type="text" id="city" name="city" class="form-control" value="">
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->state : true)
		<div class="col-sm-3">
			<label class="control-label">UF</label>
			<select class="form-control" name="state"></select>
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->zip_code : true)
		<div class="col-sm-2">
			<label class="control-label">CEP</label>
			<input type="text" id="zip_code" name="zip_code" class="form-control" value="">
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->phone : true)
		<div class="col-sm-3">
			<label class="control-label">Telefone Residencial</label>
			<input type="text" id="phone" name="phone" class="form-control mask-cellphone" value="">
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->cel_phone : true)
		<div class="col-sm-3">
			<label class="control-label">Celular</label>
			<input type="text" id="cel_phone" name="cel_phone" class="form-control mask-cellphone" value="" required>
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->other_contact : true)
		<div class="col-sm-3">
			<label class="control-label">Outro Contato</label>
			<input type="text" id="other_contact" name="other_contact" class="form-control" value="">
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->whatsapp : true)
		<div class="col-sm-3">
			<label class="control-label">WhatsApp</label>
			<input type="text" id="whatsapp" name="whatsapp" class="form-control mask-cellphone" value="">
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->company_name : true)
		<div class="col-sm-12">
			<label class="control-label">Empresa</label>
			<input type="text" id="company_name" name="company_name" class="form-control" value="">
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->office : true)
		<div class="col-sm-6">
			<label class="control-label">Cargo</label>
			<input type="text" id="office" name="office" class="form-control" value="">
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->department : true)
		<div class="col-sm-6">
			<label class="control-label">Departamento</label>
			<input type="text" id="department" name="department" class="form-control" value="">
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->commercial_phone : true)
		<div class="col-sm-5">
			<label class="control-label">Telefone Comercial</label>
			<input type="text" id="commercial_phone" name="commercial_phone" class="form-control mask-cellphone" value="" required>
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->branch_line : true)
		<div class="col-sm-2">
			<label class="control-label">Ramal</label>
			<input type="text" id="branch_line" name="branch_line" class="form-control" value="">
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->fax : true)
		<div class="col-sm-5">
			<label class="control-label">FAX</label>
			<input type="text" id="fax" name="fax" class="form-control" value="">
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->commercial_email : true)
		<div class="col-sm-12">
			<label class="control-label">Email Comercial</label>
			<input type="text" id="commercial_email" name="commercial_email" class="form-control" value="">
		</div>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				document.getElementById("commercial_email").addEventListener("change", exists_email);
			});
		</script>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->course_category_id : true)
		<div class="col-sm-4">
			<label class="control-label">Categoria do Curso</label>
			<select class="form-control" name="course_category_id" onchange="updateCoursesByCategory()"></select>
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->course_id : true)
		<div class="col-sm-4">
			<label class="control-label">Curso de interesse</label>
			<select class="form-control" name="course_id"></select>
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->is_formed_in_psychology : true)
		<div class="col-sm-4">
			<div style="display: table; min-height: 59px">
				<div style="display: table-cell;vertical-align: middle">
					<label for="is_formed_in_psychology" class="control-label">É formado em psicologia?</label>
					<input type="checkbox" name="is_formed_in_psychology" id="is_formed_in_psychology" class="js-switch" value="1">
				</div>
			</div>
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->level_of_interest : true)
		<div class="col-sm-5">
			<label for="level_of_interest" class="control-label">Qual seu nível de interesse?</label>
			<div class="form-group">

				<div class="i-checks">
					<label class="control-label">
						<input type="radio" name="level_of_interest" value="1">
						<i></i> Inicio imédiato
					</label>
				</div>

				<div class="i-checks">
					<label class="control-label">
						<input type="radio" name="level_of_interest" value="2">
						<i></i> Inicio futuro
					</label>
				</div>

				<div class="i-checks">
					<label class="control-label">
						<input type="radio" name="level_of_interest" value="3" checked>
						<i></i> Não sei responder
					</label>
				</div>

			</div>
		</div>
		@endif

		@if($configApp->showFormFields ? $configApp->showFormFields->observation : true)
		<div class="col-sm-12">
			<label class="control-label">Anotações Importantes:</label>
			<div class="ibox-content no-padding">
				<textarea id="observation" name="observation" class="summernote"></textarea>
			</div>
		</div>
		@endif

	</div>

	@if($configApp->showFormFields ? $configApp->showFormFields->img : true)
	<div class="col-lg-12">
		<div class="form-group">
			<label class="col-sm-2 control-label">Imagem em destaque*</label>
			<div class="col-sm-10">
				<div class="fileinput fileinput-new input-group" data-provides="fileinput">
					<div class="form-control" data-trigger="fileinput">
						<i class="glyphicon glyphicon-file fileinput-exists"></i>
						<span class="fileinput-filename"></span>
					</div>
					<span class="input-group-addon btn btn-default btn-file">
						<span class="fileinput-new">Selecionar</span>
						<span class="fileinput-exists">Alterar</span>
						<input type="file" id="fileImage" name="fileImage" value="">
					</span>
					<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
				</div>
				<div id="img" class="img"></div>
			</div>
		</div>
	</div>
	@endif

	<div class="clear-both"></div>
</div>

<div class="modal inmodal fade" id="myModalConf" tabindex="-1" role="dialog" aria-hidden="true" backdrop="static">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Já existe um contato cadastrado com esse e-mail</h4>
			</div>
			<div class="modal-body">
				<h3>Gostaria de atualizar os dados desse contato cadastrado?</h3>
			</div>
			<div class="modal-footer" style="text-align: center;margin: 0;">
				<button type="button" class="btn btn-danger" data-dismiss="modal" style="margin: 0 15px;"
					onclick="exists_email.clickNot()">Não</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal" style="margin: 0 15px;"
					onclick="exists_email.clickYes()">Sim</button>
			</div>
		</div>
	</div>
</div>

@section('scripts')
@parent
<script src="{!! asset('js/plugins/iCheck/icheck.min.js') !!}" type="text/javascript"></script>

<script>
	$(document).ready(function() {
		$('.i-checks').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green',
		});
		updateSwitchery();
	});

	function exists_email(event) {
		if (event.target.value) {
			$.ajax({
				url: "/admin/prospection/prospect/exists_email",
				dataType: "json",
				method: "post",
				data: {
					id: event.target.form.id.value,
					email: event.target.value,
				}
			}).then(function(id) {
				if (id) {
					exists_email.id = id;
					$('#myModalConf').modal();
				}
			});
		}
	}

	exists_email.clickNot = function() {}

	exists_email.clickYes = function() {
		window.location.href = "/admin/prospection/prospect/update/" + this.id;
	}
</script>
@endsection
