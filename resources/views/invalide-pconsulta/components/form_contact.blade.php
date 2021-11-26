<form method="post" action="/contact/save" name="contactform" autocomplete="off" onsubmit="onSubmitContact(event)" class="rd-form rd-mailform" data-form-output="form-output-global" data-form-type="contact">
	{{ csrf_field() }}
	<div class="row row-20 gutter-20">
		<div class="col-sm-6">
			<div class="form-wrap">
				<input class="form-input" id="contact-name" type="text" name="name" data-constraints="@Required">
				<label class="form-label" for="contact-name">Name*</label>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-wrap">
				<input class="form-input" id="contact-surname" type="text" name="surname" data-constraints="@Required">
				<label class="form-label" for="contact-surname">Sobrenome*</label>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-wrap">
				<input class="form-input" id="contact-phone" type="text" name="phone" data-constraints="@Numeric">
				<label class="form-label" for="contact-phone">Telefone*</label>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-wrap">
				<input class="form-input" id="contact-email" type="email" name="email" data-constraints="@Email @Required">
				<label class="form-label" for="contact-email">E-mail*</label>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="form-wrap">
				<input class="form-input" id="contact-subject" type="text" name="subject" data-constraints="@Required">
				<label class="form-label" for="contact-subject">Assunto*</label>
			</div>
		</div>
		<div class="col-12">
			<div class="form-wrap">
				<label class="form-label" for="contact-message">Mensagem*</label>
				<textarea class="form-input" id="contact-message" name="message" data-constraints="@Required" maxlength="1000"></textarea>
				{{-- <span>Limite de Caracters 1mil.</span> --}}
			</div>
		</div>
	</div>
	<div class="group-lg group-custom-1">
		<div class="group-custom-ie">
			<div class="unit unit-spacing-md form-text">
				<div class="unit-left"><span class="icon mdi mdi-information-outline"></span></div>
				<div class="unit-body">
					<p>Atenção! Responderemos seu E-mail na qual não há necessidade de responder</p>
				</div>
			</div>
		</div>
		<div>
			<button class="button button-gray-5" type="submit">Enviar mensagem</button>
		</div>
	</div>
</form>

@section('scripts')
@parent
<script>
	var captchaMathEquations = new CaptchaMathEquations("captcha-math-equations", {
		classInput: "form-control"
	}).init()

function onSubmitContact(event) {
	if (!captchaMathEquations.checkValidity()) {
		event.preventDefault()
	}
}
</script>
@endsection

