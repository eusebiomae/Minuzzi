<section class="section section-lg bg-default text-center">
	<div class="container">
		<div class="row">
			<div class="col-12 my-3">
				<div class="ibox-content gp-font-4">
					<div id="wizardForm" action="#" class="wizard-big">
					{{-- STEP 1 Dados de Acesso --}}
						<h1 data-step="1">Dados de Acesso</h1>
						<fieldset data-step="1">
							@if (isset($isAdmin) && $isAdmin)
							<div class="row form-group">
								<div class="col-sm-12">
									<label class="control-label">Aluno</label>
									<select name="student" class="form-control js-example-data-ajax" onchange="onChangeStudent(this.value)" required></select>
								</div>
							</div>
							@else
							<div class="row" data-login>
								{{-- Login --}}
								<div class="col-lg-5">
									<h2 class="mb-4">Já é cadastrado?</h2>
									<form name="formLogin">
										{{ csrf_field() }}
										<div class="form-group">
											<label>E-mail ou CPF*</label>
											<input name="identification" type="text" class="form-control required">
										</div>
										<div class="form-group">
											<label>Senha*</label>
											<input name="password" type="password" class="form-control required">
										</div>
										<small><a href="javascript:formShowReset()">Esqueci minha senha</a></small>
									</form>
									{{-- <div class="alert alert-warning m-t-sm">
										<b>Dicas para sempre acessar sua conta:</b><br>
										1 - A senha do site antigo não é a mesma do site novo.<br>
										2 - Digite seu CPF ou o seu e-mail cadastrado.<br>
										3 - Por padrão a sua senha de acesso é o seu CPF.<br>
										4 - Caso altere a senha após efetuar o login use uma senha segura e que seja fácil relembrar.<br>
									</div> --}}
								</div>
								<div class="col-lg-2 m-auto">
									<span>Ou</span>
									<div class="divider"></div>
								</div>
								{{-- Cadastro --}}
								<div class="col-lg-5">
									<h2 class="mb-4">Fazer Cadastro</h2>
									<form name="formRegister">
										{{ csrf_field() }}
										<div class="form-group">
											<label>Nome Completo*</label>
											<input name="name" type="text" class="form-control required">
										</div>
										<div class="form-group">
											<label>E-mail*</label>
											<input name="email" type="text" class="form-control required email">
										</div>
										<div class="form-group">
											<label>CPF*</label>
											<input name="cpf" type="text" class="form-control mask-cpf required">
										</div>
										<div class="form-group">
											<label>Senha*</label>
											<input name="password" type="password" class="form-control required">
										</div>
										<div class="form-group">
											<label>Confirme a senha*</label>
											<input name="confirm" type="password" class="form-control required">
										</div>
									</form>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-5">
									<h2 class="mb-4" data-reset style="display:none;">Resetar senha</h2>
									@include('student_area.components.formReset')
								</div>
							</div>
							<div id="msgAlertLogin" class="hide alert alert-danger">
								Você precisa inserir seus dados de login ou preencher os dados para uma nova inscrição.
							</div>
							<div id="msgPassword" class="hide alert alert-danger">
								Senhas digitadas precisam ser identicas. Por favor digite novamente!
							</div>
							<div id="msgErrorLogin" class="hide alert alert-danger">
								<span></span>
							</div>
							@endif
						</fieldset>

					{{-- STEP 2 Dados Pessoais --}}
					<h1 data-step="2">Dados Pessoais</h1>
					<fieldset data-step="2">
						<h2 class="mb-4">Meus dados</h2>
						<form name="formProfile">
							{{ csrf_field() }}
							<input type="hidden" name="id">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group text-left d-flex">
										<div class="i-checks"><label> <input type="checkbox" value="S" name="kids"> <i></i> Enar Kids</label></div>
									</div>
								</div>
								<div class="col-lg-4 col-md-6">
									<div class="form-group">
										<label>Nome Completo*</label>
										<input name="name" type="text" class="form-control required" disabled>
									</div>
								</div>
								<div class="col-lg-4 col-md-6">
									<div class="form-group">
										<label>E-mail*</label>
										<input name="email" type="text" class="form-control required email" disabled>
									</div>
								</div>
								<div class="col-lg-4 col-md-12">
									<div class="form-group">
										<label>CPF*</label>
										<input name="cpf" type="text" class="form-control mask-cpf required" disabled>
									</div>
								</div>
								<div class="col-lg-6 col-md-12 d-none">
									<div class="form-group">
										<label>Mãe*</label>
										{{-- REQUIRED --}}
										<input name="mother" type="text" class="form-control">
									</div>
								</div>
								<div class="col-lg-6 col-md-12 d-none">
									<div class="form-group">
										<label>Pai</label>
										<input name="father" type="text" class="form-control">
									</div>
								</div>
								<div class="col-lg-4 col-md-12">
									<div class="form-group">
										<label>Genero</label>
										<div class="btn-group btn-group-toggle" data-toggle="buttons">
											<label class="btn btn-white gp-genero">
												<input type="radio" name="gender" value="male"> Masculino
											</label>
											<label class="btn btn-white gp-genero">
												<input type="radio" name="gender" value="feminine"> Feminino
											</label>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-6">
									<div class="form-group">
										<label>RG*</label>
										<input type="text" name="rg" class="form-control mask-rg required" maxlength="14">
									</div>
								</div>
								<div class="col-lg-4 col-md-6">
									<div class="form-group">
										<label>CEP*</label>
										<input name="zip_code" type="text" class="form-control required mask-cep">
									</div>
								</div>

								<div class="col-lg-3 col-md-8">
									<div class="form-group">
										<label>Endereço*</label>
										<input name="address" type="text" class="form-control required">
									</div>
								</div>
								<div class="col-lg-2 col-md-4">
									<div class="form-group">
										<label>Nº*</label>
										<input type="text" name="n" class="form-control" maxlength="32" autofocus required placeholder="">
									</div>
								</div>
								<div class="col-lg-3 col-md-6 col-12 ">
									<div class="form-group">
										<label>Bairro*</label>
										<input type="text" name="neighborhood" class="form-control" maxlength="450" autofocus required placeholder="">
									</div>
								</div>
								<div class="col-lg-2 col-md-6">
									<div class="form-group">
										<label>Cidade*</label>
										<input name="city" type="text" class="form-control required">
									</div>
								</div>
								<div class="col-lg-2">
									<div class="form-group">
										<label>Estado*</label>
										<select name="state_id" type="text" class="form-control required"></select>
									</div>
								</div>
								<div class="col-lg-auto col-md-6">
									<div class="form-group">
										<label>Telefone</label>
										<input name="phone" type="text" class="form-control mask-phone">
									</div>
								</div>
								<div class="col-lg-auto col-md-6">
									<div class="form-group">
										<label>Celular *</label>
										<input name="cell_phone" type="text" class="form-control mask-cell required">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label>Modalidade de participação:*</label>
										<div class="i-checks"><label> <input type="radio" value="E" name="formation" checked=""> <i></i> EA (Exclusivamente Avaliativa)</label></div>
										<div class="i-checks"><label> <input type="radio" value="A" name="formation"> <i></i> AP (Avaliativa Premiável)</label></div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Relação com a /igreja:</label>
										<div class="i-checks"><label> <input type="radio" value="M" name="tcc_experience" checked=""> <i></i> Membro </label></div>
										<div class="i-checks"><label> <input type="radio" value="I" name="tcc_experience"> <i></i> Interessado </label></div>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label class="font-normal">Data de Nascimento</label>
										<div class="input-group date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<input type="text" name="birth_date" class="form-control" readonly>
										</div>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label for="plus_information">Mais Informação</label>
										<textarea name="complement" class="form-control" id="plus_information" rows="3"></textarea>
									</div>
								</div>
							</div>
						</form>
					</fieldset>

					{{-- STEP 6 Supervisão --}}
						@if(isset($payload->supervision))
						<h1 data-step="6">Supervisão</h1>
						<fieldset data-step="6">
							<form name="formSupervision">
								{{ csrf_field() }}
								<div class="row" style="margin-bottom: 5px">
									<select name="supervision_id" class="form-control required" onchange="selectedSupervision(this.value)"></select>
								</div>
								<div id="supervision" class="row"></div>
							</form>
						</fieldset>
						@else

					{{-- STEP 3 Prova --}}
						<h1 data-step="3">Prova</h1>
						<fieldset data-step="3">
							<form name="formCourse">
								{{ csrf_field() }}
								<div class="row text-left	">
									<div class="col-sm-4">
										<label class="control-label">Tipo</label>
										<select name="type" class="form-control" onchange="onChangefilterCourse(event, 'type')"></select>
									</div>
									<div class="col-sm-4">
										<label class="control-label">Categoria</label>
										<select name="category" class="form-control" onchange="onChangefilterCourse(event, 'category')"></select>
									</div>
									<div class="col-sm-4">
										<label class="control-label">Subcategoria</label>
										<select name="subcategory" class="form-control" onchange="onChangefilterCourse(event, 'subcategory')"></select>
									</div>
									<div class="col-sm-8 my-3">
										<label class="control-label">Curso*</label>
										<select name="course_id" class="form-control required" onchange="selectedCourse(this.value)"></select>
									</div>
									<div class="col-sm-4 my-3">
										<label class="control-label">Turma*</label>
										<select class="form-control required" name="class_id" onchange="onChangeClass(event)"></select>
									</div>
								</div>
								<div id="courseInfo" class="row"></div>
								<hr class="hr">
								<div class="row" id="additional"></div>
							</form>
						</fieldset>

					{{-- STEP 4 Pagamento --}}
						<h1 data-step="4">Pagamento</h1>
						<fieldset data-step="4">
							<form name="formFormPayment">
								@if (isset($isAdmin) && $isAdmin)
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label>Responsável pela venda</label>
											<select class="form-control" name="responsible_id"></select>
										</div>
									</div>

									<div class="col-sm-9 text-right">
										<button type="button" class="btn btn-default" onclick="specialNegotiation()" data-btn-special-negotiation>Negociação especial</button>
									</div>
								</div>
								@endif

								<div class="row">
									<div class="col-sm-9">
										<div class="row">

											<div class="col-md-5" data-specialNegotiation="0">
												<div class="form-group">
													<label>Forma de Pagamento</label>
													<select class="form-control m-b" name="formPayment" onchange="setFormPaymentParcel(this.value)"></select>
												</div>
											</div>
											<div class="col-md-4" data-specialNegotiation="0">
												<label>Nº de Parcela</label>
												<select class="form-control m-b" name="course_form_payment_id" onchange="changeFormPaymentParcel(this)"></select>
											</div>

											<div class="col-sm-3 hide" data-specialNegotiation="1">
												<div class="form-group">
													<label>Forma de Pagamento</label>
													<select class="form-control m-b" name="formPayment" disabled onchange="setFormPaymentParcel(this.value)"></select>
												</div>
											</div>
											<div class="col-sm-2 hide" data-specialNegotiation="1">
												<label class="control-label">Parcelas</label>
												<input type="number" name="specialNegotiation[parcel]" class="form-control" value="0" maxlength="5" disabled onkeyup="specialNegotiationRecalcValues('parcel')" onchange="specialNegotiationRecalcValues('parcel')">
											</div>
											<div class="col-sm-3 hide" data-specialNegotiation="1">
												<label class=" control-label">Valor da Parcela</label>
												<input type="tel" name="specialNegotiation[value]" class="form-control mask-currency" value="0" disabled onkeyup="specialNegotiationRecalcValues('value')">
											</div>

											{{-- <div class="col-md-3" title="Selecione o melhor dia para pagamento">
												<label>Dia de vencimento</label>
												<select class="form-control m-b" name="expiration_day">
													<option value="5">5</option>
													<option value="10">10</option>
													<option value="15">15</option>
													<option value="20">20</option>
													<option value="25">25</option>
												</select>
											</div> --}}
										</div>

										{{-- Cupom de Desconto --}}
										{{-- <div class="row">
											<div class="col-md-3" data-specialNegotiation="0">
												<label>Cupom de desconto</label>
												<div data-btn-apply-discount>
													<input type="text" name="discount_coupon" id="discountCoupon" class="form-control">
													<button class="btn btn-light" type="button" onclick="applyDiscount(event)">Aplicar</button>
												</div>
											</div>
										</div> --}}
										{{-- / Cupom de Desconto --}}
									</div>
									<div id="valueParcel" class="col-md-auto text-right"></div>
								</div>

								{{-- CREDITO --}}
								<div id="creditCard" class="hide">
									<div class="row mt-5">
										<div class="col-lg-4">
											<div class="form-group">
												<label>Nome do Titular*</label>
												<input type="text" name="cardholder" placeholder="" class="gp-w form-control required">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label>Nº do Cartão*</label>
												<input type="text" name="number_card" placeholder="" class="gp-w form-control required">
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label>Cod. de Seg.*</label>
												<input type="text" name="security_code" placeholder="" class="gp-w form-control required">
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<label>Validade*</label>
												<input type="text" name="shelf_life" placeholder="" class="gp-w form-control required mask-creditcard-shelf_life">
											</div>
										</div>
									</div>
									<div class="row mt-0">
										<div class="col-lg-4">
											<div class="form-group">
												<label>CPF do Titular*</label>
												<input type="text" name="cpf" placeholder="" class="gp-w form-control required mask-cpf">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label>Data de Nascimento*</label>
												<div class="input-group date">
													<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
													<input type="text" name="birth_date" placeholder="" class="gp-w form-control required" readonly>
												</div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label>Telefone*</label>
												<input type="text" name="phone" placeholder="" class="gp-w form-control required mask-cellphone">
											</div>
										</div>
									</div>
									<div class="row mt-0">
										<div class="col-lg-4">
											<div class="form-group">
												<label>E-mail do Titular*</label>
												<input type="text" name="email" placeholder="E-mail do Titular" class="gp-w form-control required">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label>CEP*</label>
												<input type="text" name="zip_code" placeholder="" class="gp-w form-control required mask-cep">
											</div>
										</div>
										<div class="col-lg-4">
											<div class="form-group">
												<label>Nº*</label>
												<input type="text" name="address_number" placeholder="" class="gp-w form-control required">
											</div>
										</div>
									</div>
								</div>

								{{-- Boleto // Debito --}}
								<div id="billetDebit" class="row my-5 mx-3"></div>
							</form>
						</fieldset>
						@endif

					{{-- STEP 5 Confirmação --}}
						<h1 style="min-width:150px;" data-step="5">Confirmação</h1>
						<fieldset data-step="5">
							<div class="row text-center">
								<div class="col-12">
									<h1 class="mt-5 mt-md-none">Inscrição feita com Sucesso!</h1>
									<div id="billetBtn" class="hide" style="text-align: center">
										Imprima seu <a href="http://" target="_blank">Boleto aqui</a> para efetuar o pagamento
									</div>
									<div id="errorPayments" class="hide">
										Houve um erro na API de pagamento, sua inscrição já foi efetuada, e nossa equipe entrará em contato em breve
									</div>
								</div>
							</div>
						</fieldset>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script id="tmplCourse" type="text/x-dot-template">
	<div class="col-md-4">
		<figure class="my-3">
			<img src="@{{= it.img || 'cetcc/img/courses/exemplo.png' }}" alt="@{{= it.subtitle_pt }}" style="width:100%; border-radius:10px;">
		</figure>
	</div>
	<div class="col-md-8 my-3">
		<h4><b>Nome:</b> @{{= it.title_pt }}</h4>
		<span><b>Categoria:</b> @{{= it.course_category.description_pt }}</span><br />
		<span><b>Sub-categoria:</b> @{{= it.course_subcategory.description_pt }}</span><br />
		<span><b>Tipo:</b> @{{= it.course_category_type.title }}</span><br />
		<span><b>Data do início do Turma:</b> <span id="classStartDate"></span> </span><br />
	</div>
</script>

<script id="tmplSupervision" type="text/x-dot-template">
	<div class="col-12">
		<h4>@{{= it.label }}</h4>
		<div>Responsável: <b>@{{= it.teacher.name }}</b></div>
		<div>
			<label><input type="radio" name="supervisionType" value="1" style="display: inline-block" onchange="" required /> Ex-alunos do CETCC: R$ @{{= numberWithCommas(it.value_1, 2) }} </label>
			<label><input type="radio" name="supervisionType" value="2" style="display: inline-block" onchange="" required /> Avulso: R$ @{{= numberWithCommas(it.value_2, 2) }} </label>
		</div>
		<hr>
		<h2>Pagamento</h2>

		<div>@{{= document.getElementById('tmplCard').innerHTML }}</div>
	</div>
</script>

<script id="tmplCard" type="text/x-dot-template">
	<div class="row mt-5">
		<div class="col-4">
			<div class="form-group">
				<label>Nome do Titular*</label>
				<input type="text" name="cardholder" placeholder="" class="gp-w form-control required">
			</div>
		</div>
		<div class="col-4">
			<div class="form-group">
				<label>Nº do Cartão*</label>
				<input type="text" name="number_card" placeholder="" class="gp-w form-control required">
			</div>
		</div>
		<div class="col-2">
			<div class="form-group">
				<label>Cod. de Seg.*</label>
				<input type="text" name="security_code" placeholder="" class="gp-w form-control required">
			</div>
		</div>
		<div class="col-2">
			<div class="form-group">
				<label>Validade*</label>
				<input type="text" name="shelf_life" placeholder="" class="gp-w form-control required mask-creditcard-shelf_life">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-4">
			<div class="form-group">
				<label>CPF do Titular*</label>
				<input type="text" name="cpf" placeholder="" class="gp-w form-control required mask-cpf">
			</div>
		</div>
		<div class="col-4">
			<div class="form-group">
				<label>Data de Nascimento*</label>
				<div class="input-group date">
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					<input type="text" name="birth_date" placeholder="" class="gp-w form-control required" readonly>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="form-group">
				<label>Telefone*</label>
				<input type="text" name="phone" placeholder="" class="gp-w form-control required mask-cellphone">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-4">
			<div class="form-group">
				<label>E-mail do Titular*</label>
				<input type="text" name="email" placeholder="E-mail do Titular" class="gp-w form-control required">
			</div>
		</div>
		<div class="col-4">
			<div class="form-group">
				<label>CEP*</label>
				<input type="text" name="zip_code" placeholder="" class="gp-w form-control required mask-cep">
			</div>
		</div>
		<div class="col-4">
			<div class="form-group">
				<label>Nº*</label>
				<input type="text" name="address_number" placeholder="" class="gp-w form-control required">
			</div>
		</div>
	</div>
</script>

@section('css')
@parent
	<link rel="stylesheet" href="{!! asset('css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') !!}" />
	<link href="{!! asset ('css/bootstrap.min-painel.css') !!}" rel="stylesheet"/>
	{{-- <link href="{!! asset ('font-awesome/css/font-awesome.css') !!}" rel="stylesheet"/> --}}
	<link href="{!! asset ('css/plugins/iCheck/custom.css') !!}" rel="stylesheet">
	<link href="{!! asset ('css/plugins/steps/jquery.steps.css') !!}" rel="stylesheet"/>
	<link href="{!! asset ('css/animate-painel.css') !!}" rel="stylesheet">
	<link href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" rel="stylesheet"/>
	{{-- <link href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css')!!}" rel="stylesheet"/> --}}
	<link href="{!! asset('css/plugins/switchery/switchery.css')!!}" rel="stylesheet"/>
	<link href="{!! asset('css/style-painel.css')!!}" rel="stylesheet"/>
	{{-- <link href="{!! asset('css/plugins/sweetalert/sweetalert.css') !!}" rel="stylesheet" /> --}}
	{{-- <link rel="stylesheet" href="{!! asset('css/plugins/select2/select2.min.css') !!}" /> --}}
	<style>
		#wizardForm .select2-selection__rendered {
			min-height: 30px;
		}

		div[data-btn-apply-discount] input {
			width: calc(100% - 74px);
			display: inline-block !important;
			margin: 0;
		}

		div[data-btn-apply-discount] button {
			width: 70px;
			border-radius: 0 4px 4px 0;
		}
		.page-header{
			padding: 0;
			margin: 0;
			border: none;
		}
	</style>
@endsection

@section('scripts')
@parent
{{-- CONFLITO --}}
<script src="{!! asset('js/gp-ays.js') !!}"></script>
<script src="{!! asset('js/plugins/steps/jquery.steps.min.js') !!}"></script>
<script src="{!! asset('js/plugins/validate/jquery.validate.min.js') !!}"></script>
<script src="{!! asset('js/plugins/switchery/switchery.js') !!}"></script>
<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>
<script src="{!! asset('js/plugins/iCheck/icheck.min.js') !!}"></script>

<!-- Mainly scripts -->

<script src="{!! asset('js/plugins/select2/select2.full.min.js') !!}" type="text/javascript"></script>
{{-- <script src="{!! asset('js/plugins/sweetalert/sweetalert.min.js') !!}"></script> --}}
<script src="{!! asset('js/jquery.inputmask.min.js') !!}"></script>
<script>

	try {
		typeof APP == 'undefined' && (APP = {})
		APP.payload = {!! isset($payload) ? json_encode($payload) : '{}' !!}
		APP.search = searchToObj()
		APP.display = {}

		if (APP.payload.states) {
			populateSelectBox({
				list: APP.payload.states,
				target: document.forms.formProfile.state_id,
				columnValue: "id",
				columnLabel: "abbreviation",
				selectBy: [ ],
				emptyOption: {
					label: ""
				}
			})
		}
	} catch (error) {
		console.warn(error)
	}

	function applyDiscount(event) {
		console.log(1234);
		event.preventDefault()

		APP.display.discount = null
		$.ajax({
			url: '/student_area/api/apply_discount',
			type: 'post',
			data: {
				code: document.getElementById('discountCoupon').value,
				courseId: APP.course.id,
			},
		}).then(function(resp) {
			if (resp) {
				APP.discount = resp
			} else {
				swal({
					type: 'warning',
					title: "Esse cupom não é válido",
				})
			}
			updateDisplayValue()
		})
	}

	function checkAdditional(event) {
		var target = event.target.closest('[data-key]')
		var elemCheckbox = target.querySelector('input[type="checkbox"]')
		var elemIcon = target.querySelector('i[data-tmpl-icon]')

		elemCheckbox.checked = !elemCheckbox.checked
		if (elemCheckbox.checked) {
			target.classList.add('alert-success')
			elemIcon.classList.remove('fa-ban')
			elemIcon.classList.add('fa-check')
		} else {
			target.classList.remove('alert-success')
			elemIcon.classList.add('fa-ban')
			elemIcon.classList.remove('fa-check')
		}
	}
	// FILTER COURSE
	function onChangefilterCourse(event, key) {
		var newCourses = []
		var type = document.forms.formCourse.type.value
		var category = document.forms.formCourse.category.value
		var subCategory = document.forms.formCourse.subcategory.value
		var courses = APP.payload.courses


		for (var i = 0; i < courses.length; i++) {
			var course =  courses[i]

			if (type && course.course_category_type_id 		!= type) {
				continue
			}
			if (category && course.course_category_id != category) {
				continue
			}
			if (subCategory && course.course_subcategory_id != subCategory) {
				continue
			}
			newCourses.push(course)
		}

		populateSelectBox({
			list: newCourses,
			target: document.forms.formCourse.course_id,
			columnValue: "id",
			columnLabel: "title_pt",
		})

		populateSelectBox({
			list: [],
			target: document.forms.formCourse.class_id,
			columnValue: "id",
			columnLabel: "name",
		})

		document.forms.formCourse.course_id.dispatchEvent(new Event('change'))
		document.forms.formCourse.class_id.dispatchEvent(new Event('change'))
	}

	// FILTER CATEGORY
	function onChangefilterCategory(event, key) {
	}

	// FILTER SUBCATEGORY
	function onChangefilterSubcategory(event, key) {
	}

	function formShowReset() {
		document.querySelector('[data-login]').style.display = 'none'
		document.forms.formReset.style.display = null
		document.querySelector('[data-reset]').style.display = null
		document.querySelector('[role="menu"]').style.display = 'none'
	}

	function formLogin() {
		document.querySelector('[data-login]').style.display = null
		document.forms.formReset.style.display = 'none'
		document.querySelector('[data-reset]').style.display = 'none'
		document.querySelector('[role="menu"]').style.display = null
	}

	function setDataProfile(data) {
		try {
			document.forms.formProfile.reset()
			document.forms.formProfile.id.value = ''
			if (data) {
				APP.payload.student = data
				populate(document.forms.formProfile, APP.payload.student)
				wizardFormNextStep()
			} else {
				document.forms.formProfile.reset()
			}

			document.forms.formProfile.name.disabled = document.forms.formProfile.name.value != ''
			document.forms.formProfile.email.disabled = document.forms.formProfile.email.value != ''
			document.forms.formProfile.cpf.disabled = document.forms.formProfile.cpf.value != ''
		} catch (error) {
			console.warn(error)
		}
	}

	function setDataFormPayment() {
		var formPayment = null

		var additional = new FormData(document.forms.formCourse).getAll('additional[]')
		APP.additionals = null

		if (additional.length) {
			APP.additionals = APP.course.course_additional.filter(function(item) { return additional.includes(''+item.additional_id) })
		}

		APP.additionalFormPayment = null
		// cria o mapeamento das formas de pagamento/parcelas por adicional
		if (APP.additionals) {
			APP.additionalFormPayment = APP.additionals.reduce(function(carry, item) {
				var formPaymentId = item.form_payment_id

				if (!carry[formPaymentId]) {
					carry[formPaymentId] = {
						id: item.form_payment_id,
						label: item.form_payment.description,
						formPayment: item.form_payment,
						parcelOpts: {},
					}
				}

				if (!carry[formPaymentId].parcelOpts[item.parcel]) {
					carry[formPaymentId].parcelOpts[item.parcel] = {
						parcel: item.parcel,
						value: 0,
						full_value: 0,
					}
				}

				carry[formPaymentId].parcelOpts[item.parcel].value += parseFloat(item.value)
				carry[formPaymentId].parcelOpts[item.parcel].full_value += parseFloat(item.full_value)

				return carry
			}, {})
		}

		APP.courseFormPayment = APP.course.course_form_payment.reduce(function(carry, item) {
			var formPaymentId = item.form_payment_id

			// verifica se existe formas de pagamentos para adicionais
			if (APP.additionalFormPayment) {
				// verifica se a forma de pagamento do curso existe nos adicionais
				if (APP.additionalFormPayment[formPaymentId]) {
					var additionalFormPayment = APP.additionalFormPayment[formPaymentId]

					if (!additionalFormPayment.parcelOpts[item.parcel]) {
						return carry
					}

					//verifica se a forma de pagamento já foi mapeada
					if (!carry[formPaymentId]) {
						carry[formPaymentId] = {
							id: item.form_payment_id,
							label: item.form_payment.description,
							formPayment: item.form_payment,
							parcelOpts: []
						}
					}

					var fullValue = parseFloat(item.full_value) + additionalFormPayment.parcelOpts[item.parcel].full_value
					var value =  fullValue / item.parcel
					// adiciona a opção de parcelamento
					carry[formPaymentId].parcelOpts.push({
						id: item.id,
						label: "x" + item.parcel + " R$" + numberWithCommas(value, 2),
						parcel: item.parcel,
						value: value,
						full_value: fullValue,
					})

					// verifica se já existe uma forma de pagamento selecionada
					if (!formPayment || APP.search.formPayment == item.id) {
						formPayment = item.form_payment_id
					}
				}

				return carry
			}

			//verifica se a forma de pagamento já foi mapeada
			if (!carry[formPaymentId]) {
				carry[formPaymentId] = {
					id: item.form_payment_id,
					label: item.form_payment.description,
					formPayment: item.form_payment,
					parcelOpts: []
				}
			}

			// adiciona a opção de parcelamento
			carry[formPaymentId].parcelOpts.push({
				id: item.id,
				label: "x" + item.parcel + " R$" + numberWithCommas(item.value, 2),
				parcel: item.parcel,
				value: item.value,
				full_value: item.full_value,
			})

			if (!formPayment || APP.search.formPayment == item.id) {
				formPayment = item.form_payment_id
			}

			return carry
		}, {})

		// verifica se a forma de pagamento do adicional existe nas formas de pagamanto do curso
		for (var formPaymentId in APP.additionalFormPayment) {
			if (!APP.courseFormPayment.hasOwnProperty(formPaymentId)) {

				var additionalFormPayment = APP.additionalFormPayment[formPaymentId]

				APP.courseFormPayment[formPaymentId] = {
					id: additionalFormPayment.id,
					label: additionalFormPayment.label,
					formPayment: additionalFormPayment.formPayment,
					parcelOpts: [],
				}

				for (var key in additionalFormPayment.parcelOpts) {
					var parcelOpts = additionalFormPayment.parcelOpts[key]

					APP.courseFormPayment[formPaymentId].parcelOpts.push({
						id: '',
						label: "x" + parcelOpts.parcel + " R$" + numberWithCommas(parcelOpts.value, 2),
						parcel: parcelOpts.parcel,
						value: parcelOpts.value,
						full_value: parcelOpts.full_value,
					})
				}

			}
		}

		var elemSpecialNegotiationFormPayment = document.querySelector('form[name="formFormPayment"] [data-specialNegotiation="0"] [name="formPayment"]')
		if (elemSpecialNegotiationFormPayment) {
			var courseFormPayment = Object.values(APP.courseFormPayment)
			populateSelectBox({
				list: courseFormPayment,
				target: elemSpecialNegotiationFormPayment,
				columnValue: "id",
				columnLabel: "label",
				selectBy: formPayment ? [ formPayment ] : [],
			})
		}

		if (formPayment) {
			setFormPaymentParcel(formPayment)
		} else {
			if (courseFormPayment.length) {
				setFormPaymentParcel(courseFormPayment[0].id)
			}
		}
	}

	function getCourseFormPaymentParcel() {
		return document.formFormPayment && document.formFormPayment.course_form_payment_id.options[document.formFormPayment.course_form_payment_id.selectedIndex].dataJson
	}

	function setFormPaymentParcel(idFormPayment) {
		// creditCard
		APP.idFormPayment = idFormPayment
		var payload = null
		var formPayment = null

		if (specialNegotiation.is) {
			formPayment = APP.payload.formPayment.find(function(item) { return item.id == idFormPayment })
		} else {
			payload = APP.courseFormPayment[idFormPayment];
			formPayment = payload.formPayment
		}

		try {

			if (formPayment) {
				setInstruction(generateInstruction(formPayment))
			}

			document.getElementById('creditCard').classList.add('hide')

			if (formPayment.flg_type == 'card') {
				document.getElementById('creditCard').classList.remove('hide')
			}
		} catch (error) {
			console.warn(error)
		}

		if (specialNegotiation.is) {
			return
		}

		populateSelectBox({
			list: payload.parcelOpts,
			target: document.forms.formFormPayment.course_form_payment_id,
			columnValue: "id",
			columnLabel: "label",
			selectBy: APP.search.formPayment ? [ APP.search.formPayment ] : [],
		})

		try {
			var parcelId = payload.parcelOpts[0].id

			if (APP.search.formPayment && payload.parcelOpts.find(function(item) { return item.id == APP.search.formPayment  })) {
				parcelId = APP.search.formPayment
			}

			changeFormPaymentParcel(parcelId)
		} catch (error) {
			console.warn(error)
		}
	}

	function setInstruction(html) {
		document.getElementById('billetDebit').innerHTML = html
	}

	function changeFormPaymentParcel(val) {
		if (typeof val == "object") {
			APP.display.formPaymentParcel = getCourseFormPaymentParcel()
		} else {
			APP.display.formPaymentParcel = APP.courseFormPayment[APP.idFormPayment].parcelOpts.find(function(item) { return item.id == val })
		}

		updateDisplayValue()
	}

	function updateDisplayValue() {
		var display = APP.display
		if (!display.formPaymentParcel) {
			display.formPaymentParcel = {
				value: 0,
				parcel: 0,
			}
		}

		if (specialNegotiation.is) {
			var parcel = strToNumber(document.querySelector('[name="specialNegotiation[parcel]"]').value)
			var value = strToNumber(document.querySelector('[name="specialNegotiation[value]"]').value)
		} else {
			var parcel = display.formPaymentParcel.parcel
			var value = display.formPaymentParcel.value
		}

		var valueTotal = value * parcel

		var displayHTML = '<h3>x' + parcel + ' R$' + numberWithCommas(value, 2) + '</h3>'

		if (APP.discount) {
			displayHTML += '<h4>Valor parcial: R$'+ numberWithCommas(valueTotal, 2) +'</h4>'

			var discount = 0

			if (APP.discount.percentage) {
				discount = APP.discount.percentage / 100 * value
			} else
			if (APP.discount.value) {
				discount = APP.discount.value / parcel
			}

			value -= discount

			if (value < 0) {
				value = 0
			}

			displayHTML += 'Com Desconto de R$' + numberWithCommas(discount * parcel)
			displayHTML += '<h3>x' + parcel + ' R$' + numberWithCommas(value, 2) + '</h3>'
		}

		displayHTML += '<h4>Valor total: R$'+ numberWithCommas(value * parcel, 2) +'</h4>'
		document.getElementById('valueParcel').innerHTML = displayHTML
	}

	function generateInstruction(dataFormPayment) {
		function tmpl(p) {
			return '<div class="col-12">\
				<h4>'+ (p.title || '') +'</h4>\
				<div>'+ (p.content || '') +'</div>\
			</div>'
		}

		var html = ''

		if (dataFormPayment.introduction) {
			var introduction = dataFormPayment.introduction
			for (var i = 0; i < introduction.length; i++) {
				html += tmpl({
					title: introduction[i].title,
					content: introduction[i].description,
				})
			}
		}

		if (dataFormPayment.bank_account) {
			var bankAccount = dataFormPayment.bank_account
			for (var i = 0; i < bankAccount.length; i++) {
				html += tmpl({
					title: 'Conta Bancária',
					content: '<div class="row">\
						<div class="col-6"><strong>Nome do Titular:</strong> '+ (bankAccount[i].name || '') +'</div>\
						<div class="col-6"><strong>CPF:</strong> '+ (bankAccount[i].cpf || '') +'</div>\
						<div class="col-6"><strong>Banco:</strong> '+ (bankAccount[i].bank.name || '') +'</div>\
						<div class="col-6"><strong>Agência:</strong> '+ (bankAccount[i].agency || '') +'</div>\
						<div class="col-6"><strong>Nº Conta:</strong> '+ (bankAccount[i].account || '') +'</div>\
					</div>',
				})
			}
		}

		return html
	}

	function validateForm(form) {
		form.validate().settings.ignore = ":disabled,:hidden";
		return form.valid();
	}

	function wizardFormNextStep() {
		wizardFormNextStep.can = true
		$("#wizardForm").steps("next");
	}
	wizardFormNextStep.can = false
	wizardFormNextStep.ajax = false

	function setCourses() {
		populateSelectBox({
			list: APP.payload.categoryType,
			target: document.forms.formCourse.type,
			columnValue: "id",
			columnLabel: "title",
			emptyOption: {
				label: "Selecione..."
			},
		})
		populateSelectBox({
			list: APP.payload.category,
			target: document.forms.formCourse.category,
			columnValue: "id",
			columnLabel: "description_pt",
			emptyOption: {
				label: "Selecione..."
			},
		})

		populateSelectBox({
			list: APP.payload.subCategory,
			target: document.forms.formCourse.subcategory,
			columnValue: "id",
			columnLabel: "description_pt",
			emptyOption: {
				label: "Selecione..."
			},
		})

		populateSelectBox({
			list: APP.payload.courses,
			target: document.forms.formCourse.course_id,
			columnValue: "id",
			columnLabel: "title_pt",
			selectBy: APP.search.course ? [ APP.search.course ] : [],
		})

		selectedCourse(APP.search.course)

		$('form[name="formCourse"] .select2').select2()
	}

	function listAdditional(additionals) {
		var elemAdditional = document.getElementById('additional')
		var innerHTML = '';

		if (additionals && additionals.length) {
			var payload = additionals.reduce(function(carry, item) {
				if (!carry.additionals[item.additional_id]) {
					carry.additionals[item.additional_id] = {
						title: item.title,
						additional_id: item.additional_id,
						payload: [],
					}
				}

				carry.additionals[item.additional_id].payload.push(item)

				if (!carry.formPayment[item.form_payment_id]) {
					carry.formPayment[item.form_payment_id] = item.form_payment
				}

				return carry
			}, {
				additionals: {},
				formPayment: {},
			})

			var tHead = ''

			for (var key in payload.formPayment) {
				var formPayment = payload.formPayment[key]
				tHead += '<th class="text-right">'+ formPayment.description +'</th>'
			}

			innerHTML = '<h2>Adicionais <small>Selecione o adicional desejado</small></h2>\
			<table class="table table-striped" style="width: 100%">\
				<thead class="thead-light">\
					<tr>\
						<th></th>\
						<th>Adicional</th>\
						'+ tHead +'\
					</tr>\
				</thead>\
				<tbody>'

			for (var key in payload.additionals) {
				var additional = payload.additionals[key]

				var tHead = ''
				for (var formPaymentKey in payload.formPayment) {
					var it = null

					for (var i = 0; i < additional.payload.length; i++) {
						if (formPaymentKey == additional.payload[i].form_payment_id) {
							it = additional.payload[i]
							break
						}
					}

					if (it) {
						if (!it.full_value) {
							it.full_value = 0
						}

						tHead += '<td class="text-right">R$ '+ numberWithCommas(it.full_value, 2) +'</td>'
					} else {
						tHead += '<td></td>'
					}
				}

				innerHTML += '<tr data-key="'+ key +'" class="alert" style="cursor:pointer" title="Clique para selecionar" onclick="checkAdditional(event)">\
					<td><input type="checkbox" name="additional[]" value="'+ key +'" class="hide" /><i data-tmpl-icon class="fa fa-ban"></i></td>\
					<td>'+ additional.title +'</td>\
					'+ tHead +'\
				</tr>'
			}

			innerHTML += '</tbody></table>'
		}

		elemAdditional.innerHTML = innerHTML
	}

	function selectedCourse(idCourse) {
		var course = idCourse ? APP.payload.courses.find(function (item) { return item.id == idCourse }) : APP.payload.courses[0]

		document.getElementById('courseInfo').innerHTML = ''

		APP.course = course;
		if (course) {
			if (APP.search.course && APP.search.course == course.id) {
				document.forms.formCourse.type.value = course.course_category_type_id
				document.forms.formCourse.category.value = course.course_category_id
				document.forms.formCourse.subcategory.value = course.course_subcategory_id
			}

			var classId = (APP.search.course == idCourse && APP.search.class) || (course.class[0] && course.class[0].id)

			populateSelectBox({
				list: course.class,
				target: document.forms.formCourse.class_id,
				columnValue: "id",
				columnLabel: "name",
				selectBy: [ classId ],
			})

			selectedClass(classId)

			document.forms.formCourse.class_id.dispatchEvent(new Event('change'))

			listAdditional(course.course_additional)
		}

		return null
	}

	function onChangeClass(event) {
		var itemClass = event.target.value;
		selectedClass(itemClass);
	}

	function selectedClass(idClass) {
		var innerHTML = ''
		if (idClass) {
			var data = APP.course.class.find(function(item) { return item.id == idClass })

			innerHTML = data.start_date || ''
		}

		// document.getElementById('classStartDate').innerHTML = innerHTML
	}

	function setSupervision() {
		if (APP.payload.hasSetSupervision) {
			console.log('hasSetSupervision');
			return;
		}
		APP.payload.hasSetSupervision = true

		APP.payload.supervision = APP.payload.supervision.map(function (item) {
			var course = item.course.reduce(function(carry, item) {
				carry.push(item.title_pt)

				return carry
			}, []).join(' | ')

			item.label = item.date + ' - ' + course

			return item
		})

		populateSelectBox({
			list: APP.payload.supervision,
			target: document.forms.formSupervision.supervision_id,
			columnValue: "id",
			columnLabel: "label",
			selectBy: APP.search.supervision ? [ APP.search.supervision ] : [],
		})

		if (APP.search.supervision) {
			selectedSupervision(APP.search.supervision)
		}
	}

	function selectedSupervision(id) {
		var supervision = APP.payload.supervision.find(function(item) { return item.id == id })
		document.getElementById('supervision').innerHTML = ''

		if (supervision) {
			var tmpl = setTmplInsertAdjacentHTML({
				tmpl: 'tmplSupervision',
				toTmpl: 'supervision',
				data: supervision,
			});

			if (APP.search.type) {
				tmpl.querySelector('[name="supervisionType"][value="'+ APP.search.type +'"]').checked = true
			}

			updateInputMask()
			setDatePicker(tmpl.querySelectorAll('.input-group.date'), {
				startView: 2,
				// endDate: new Date( currentDate.getFullYear() - 18, currentDate.getMonth(), currentDate.getDate(), 0),
			})
		}
	}

	function normalizeErrorAssas(errors) {
		return errors.reduce(function(carry, item) {
			if (!carry.code.includes(item.code)) {
				carry.code.push(item.code)
			}

			carry.desc.push(item.description)

			return carry
		}, {
			code: [],
			desc: []
		})
	}

	function confirmPayment(params) {
		if (APP.orderResp) {
			wizardFormNextStep()
			return true
		}
		wizardFormNextStep.ajax = true

		if (APP.orderId) {
			params.data += '&orderId=' + APP.orderId
		}

		if (APP.payload.student && APP.payload.student.id) {
			params.data += '&student_id=' + APP.payload.student.id
		}

		if (APP.discount) {
			params.data += '&course_discount_id=' + APP.discount.course_discount_id
		}

		var courseFormPaymentParcel = getCourseFormPaymentParcel()
		if (courseFormPaymentParcel) {
			params.data += '&courseFormPaymentParcel=' + getCourseFormPaymentParcel().parcel
		}

		$.ajax({
			url: '/student_area/api/confirm_payment',
			type: 'post',
			data: params.data,
		})
		.then(function(resp) {
			wizardFormNextStep.ajax = false

			if (typeof resp != "object") {
				resp = JSON.parse(resp)
			}

			if (resp.order) {
				APP.orderId = resp.order.id
			}

			if (resp.showError) {
				if (resp.showError.errors) {
					throw normalizeErrorAssas(resp.showError.errors).desc.join('\n')
				}

				throw resp.showError
			}

			if (resp.payments.errors) {
				var errorAssas = normalizeErrorAssas(resp.payments.errors)

				if (errorAssas.code.some(function(code) { return [ 'invalid_creditCard' ].includes(code) })) {
					throw errorAssas.desc.join('\n')
				}

				document.getElementById('errorPayments').classList.remove('hide')
			}

			APP.orderResp = resp
			if (APP.orderResp.payments && APP.orderResp.payments.billingType == 'BOLETO') {
				document.getElementById('billetBtn').querySelector('a').setAttribute('href', APP.orderResp.payments.bankSlipUrl)
				document.getElementById('billetBtn').classList.remove('hide')
			}
		})
		.then(wizardFormNextStep)
		.catch(function(error) {
			console.warn(error)

			if (typeof error == "object") {
				error = JSON.stringify(error)
			}

			swal({
				title: 'Erro ao efetuar a inscrição',
				type: 'warning',
				text: error,
			})
		})
	}

	$(document).ready(function() {

		$("#wizardForm").steps({
			bodyTag: "fieldset",
			labels: {
				next: 'Próximo',
				previous: 'Anterior',
				finish: 'Ir para área do aluno',
			},
			onStepChanging: function (event, currentIndex, newIndex) {
				console.log(currentIndex, newIndex);
				if (wizardFormNextStep.ajax) {
					return false
				}

				if (currentIndex > newIndex || wizardFormNextStep.can) {
					wizardFormNextStep.can = false

					document.dispatchEvent(new CustomEvent('shoppingJourney', {
						detail: {
							event: event,
							currentIndex: currentIndex,
							newIndex: newIndex,
						}
					}))

					return true;
				}

				var form = null

				switch (currentIndex) {
					case 0: {
						if (newIndex == 1) {
							if (document.querySelector('select[name="student"]')) {
								if (APP.payload.student) {
									if (typeof APP.payload.student == "boolean") {
										setDataProfile()
										return true
									}

									if (typeof APP.payload.student == "object" && APP.payload.student.id) {
										setDataProfile(APP.payload.student)
										return true
									}

									wizardFormNextStep.ajax = true
									$.ajax({
										url: '/admin/api/student/' + APP.payload.student,
										type: 'get',
									}).then(function(resp) {
										wizardFormNextStep.ajax = false

										setDataProfile(resp)
									})

									return false
								}

								return false
							}

							if (APP.payload.student) {
								return true
							}

							document.getElementById('msgAlertLogin').classList.add('hide')
							document.getElementById('msgPassword').classList.add('hide')
							document.getElementById('msgErrorLogin').classList.add('hide')

							var formRegister = document.forms.formRegister

							if (document.forms.formLogin.identification.value) {
								form = $(document.forms.formLogin)
							} else
							if (formRegister.name.value || formRegister.email.value || formRegister.cpf.value || formRegister.password.value || formRegister.confirm.value) {
								if (formRegister.password.value != formRegister.confirm.value) {
									document.getElementById('msgPassword').classList.remove('hide');
									formRegister.password.value = ''
									formRegister.confirm.value = ''
									formRegister.password.focus()
									return false;
								}
								form = $(formRegister)

							} else {
								document.getElementById('msgAlertLogin').classList.remove('hide')
							}

							if (form && validateForm(form)) {
								wizardFormNextStep.ajax = true
								$.ajax({
									url: '/student_area/api/loginRegister',
									type: 'post',
									data: form.serialize(),
								})
								.then(function(resp) {
									wizardFormNextStep.ajax = false
									var elemMsgErrorLogin = document.getElementById('msgErrorLogin')
									if (resp) {
										if (resp.codeRequest) {
											elemMsgErrorLogin.classList.remove('hide')
											var codeRequest = {
												'_335': 'Usúario já existe',
												'_345': 'Usuário ou senha incorreto!',
												'_300': 'Erro ao cadastrar',
											}

											elemMsgErrorLogin.querySelector('span').innerText = codeRequest[resp.codeRequest] || 'Usuário ou senha incorreto!'
										} else {
											setDataProfile(resp)
										}
										// wizardFormNextStep()
									} else {
										elemMsgErrorLogin.classList.remove('hide')
										elemMsgErrorLogin.querySelector('span').innerText = 'Usuário ou senha incorreto!'

										console.warn(resp)
									}
								})
							}
						}

						return false
					}
					break
					case 1: {
						// setCourses();
						// return true;
						form = $(document.forms.formProfile)

						if (validateForm(form)) {
							wizardFormNextStep.ajax = true
							$.ajax({
								url: '/student_area/api/account_data',
								type: 'post',
								data: form.serialize(),
							})
							.then(function(resp) {
								wizardFormNextStep.ajax = false
								setDataProfile(resp)
							})
							.then(function() {
								if (newIndex == 2) {
									if (APP.search.supervision) {
										setSupervision()
									} else {
										setCourses()
									}
								}
							})
						}
					}
					break
					case 2: {
						if (newIndex === 3) {
							var formSupervision = document.forms.formSupervision

							if (formSupervision) {
								validateForm($(formSupervision)) && confirmPayment({
									data: $(formSupervision).serialize(),
								})
							} else {
								if (validateForm($('form[name="formCourse"]'))) {
									setTimeout(setDataFormPayment, 300)
									wizardFormNextStep()
									// return true
								} else {
									return false
								}

							}

							if (APP.payload.formPayment) {
								populateSelectBox({
									list: APP.payload.formPayment,
									target: document.querySelector('form[name="formFormPayment"] [data-specialNegotiation="1"] [name="formPayment"]'),
									columnValue: "id",
									columnLabel: "description",
									selectBy: [],
								})
							}

						}
					}
					break
					case 3: {
						if (newIndex === 4) {
							var formFormPayment = document.forms.formFormPayment

							if (formFormPayment && $(formFormPayment).valid()) {
								confirmPayment({
									data: $(document.forms.formCourse).serialize() + '&' + $(formFormPayment).serialize(),
								})
							}

						}
					}
					break
				}

				// Clean up if user went backward before
				if (currentIndex < newIndex) {
					// To remove error styles
					$(".body:eq(" + newIndex + ") label.error", form).remove();
					$(".body:eq(" + newIndex + ") .error", form).removeClass("error");
				}

				// Disable validation on fields that are disabled or hidden.

				return false;
			},
			onStepChanged: function (event, currentIndex, priorIndex) {
				var formSelector = ''

				if (currentIndex === 1) {
					formSelector = 'formProfile'
				} else
				if (currentIndex === 3) {
					formSelector = 'formFormPayment'

					populate(document.forms.formFormPayment, {
						cardholder: APP.payload.student.name,
						cpf: APP.payload.student.cpf,
						birth_date: APP.payload.student.birth_date,
						phone: APP.payload.student.phone,
						email: APP.payload.student.email,
						zip_code: APP.payload.student.zip_code,
						address_number: APP.payload.student.n,
					})
				}

				switch (currentIndex) {
					case 1:
					case 3: {
						currentDate = new Date

						updateInputMask()

						setDatePicker('form[name="'+ formSelector +'"] .input-group.date', {
							startView: 2,
							// endDate: new Date( currentDate.getFullYear() - 18, currentDate.getMonth(), currentDate.getDate(), 0),
						})
					}
					break
				}
			},
			onFinishing: function (event, currentIndex) {


				location.href = '/student_area/order/' + APP.orderResp.order.id

				return false
			},
			onFinished: function (event, currentIndex) {
				// var form = $(this);

				// Submit form input
				// form.submit();
				console.log(event, currentIndex);
			}
		}).validate({
			errorPlacement: function (error, element) {
				element.before(error);
			},
			rules: {
				confirm: {
					equalTo: "#password"
				}
			}
		});

		setDataProfile(APP.payload.student);
		updateInputMask()

	});
</script>

@if (isset($isAdmin) && $isAdmin)
<script>
	function specialNegotiation() {
		if (specialNegotiation.is) {
			$('[data-specialNegotiation="0"]').removeClass('hide')
			$('[data-specialNegotiation="0"]').find('input, select').prop('disabled', false)
			$('[data-specialNegotiation="1"]').addClass('hide')
			$('[data-specialNegotiation="1"]').find('input, select').prop('disabled', true)
			$('[data-btn-special-negotiation]').removeClass('btn-primary')
			$('[data-btn-special-negotiation]').addClass('btn-default')
		} else {
			$('[data-specialNegotiation="0"]').addClass('hide')
			$('[data-specialNegotiation="0"]').find('input, select').prop('disabled', true)
			$('[data-specialNegotiation="1"]').removeClass('hide')
			$('[data-specialNegotiation="1"]').find('input, select').prop('disabled', false)
			$('[data-btn-special-negotiation]').addClass('btn-primary')
			$('[data-btn-special-negotiation]').removeClass('btn-default')
		}

		specialNegotiation.is = !specialNegotiation.is
		updateDisplayValue()
	}
	specialNegotiation.is = false

	function specialNegotiationRecalcValues(name) {
		updateDisplayValue()
	}

	function onChangeStudent(id) {
		if (id) {
			APP.payload.student = id
			$("#wizardForm").steps("next")
		}
	}

	function selectedStudent(id) {
		if (id) {
			var $elemStudentSelect = $('select[name="student"]')
			$elemStudentSelect.val(null).trigger('change')
			studentSetSelect2()
			onChangeStudent(id)
		}
	}

	function getTextLabel(resp) {
		var text = []

		resp.cpf && text.push(resp.cpf)
		resp.name && text.push(resp.name)
		resp.email && text.push(resp.email)

		return text.join(' | ')
	}

	function studentSetSelect2() {
		$('[name="student"]').select2({
			placeholder: "Selecione o aluno",
			ajax: {
				url: '/admin/api/student',
				dataType: 'json',
				delay: 250,
				processResults: function(data) {
					return {
						results: data
					};
				},
			},
			language: {
				noResults: function() {
					return 'Nenhum resultado encontrado <a href="javascript:selectedStudent(true)" role="menuitem">Efetuar cadastro</a>';
				}
			},
			escapeMarkup: function (markup) {
				return markup
			},
			templateResult: function(resp) {
				if (resp.loading) {
					return 'Carregando...';
				}

				return getTextLabel(resp)
			},
			templateSelection: function(resp) {
				return getTextLabel(resp)
			},
		})
	}

	document.addEventListener('DOMContentLoaded', function() {
		$(function() {
			studentSetSelect2()
		})


	})
</script>
@else
<script>
	specialNegotiation = {
		is: false
	}
</script>
@endif

@if (in_array(old('codeResponse'), [201, 401]))
<script>
	$(document).ready(function() {
		formShowReset()
	})
</script>
@endif
<script>
	$(document).ready(function () {
			$('.i-checks').iCheck({
					checkboxClass: 'icheckbox_square-green',
					radioClass: 'iradio_square-green',
			});
			$('[name="kids"]').on('ifChanged', function(event){
				if (event.target.checked) {
					$('[name="mother"]').parent().parent().removeClass('d-none');
					$('[name="father"]').parent().parent().removeClass('d-none');
					$('[name="mother"]').addClass('required');
				} else {
					$('[name="mother"]').parent().parent().addClass('d-none');
					$('[name="father"]').parent().parent().addClass('d-none');
					$('[name="mother"]').removeClass('required');
				}
			});

			if ($('.checked.icheckbox_square-green').length == 1) {
				$('[name="mother"]').parent().parent().removeClass('d-none');
				$('[name="father"]').parent().parent().removeClass('d-none');
				$('[name="mother"]').addClass('required');
			}




		// $('[name="father"]').removeClass('d-none');
	});





</script>
@endsection
