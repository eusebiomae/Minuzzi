@php
  $footer = GigaGetData::footer();
@endphp
<section class="section section-xl bg-default">
	<div class="container">
		<div class="row row-30 row-md-50">
			<div class="col-lg-4 col-xl-5">
				{{-- INFO --}}
				<div class="inset-xl-right-70">
						<h3>{{$pageComponents['contentSection'][0]->description_pt}}</h3>
						<h5 class="title-6">{{$pageComponents['contentSection'][0]->subtitle_pt}}</h5>
					<ul class="list-contacts">
						<li>
							<span class="icon mdi mdi-phone"></span>
							<a class="big" href="tel:{{preg_replace('/\D/','',$footer->phone1)}}">
								{{$footer->phone}}
							</a>
						</li>
						@if (isset($footer->cellPhone))
						<li><span class="icon mdi mdi-phone"></span><a class="big" href="tel:{{preg_replace('/\D/','',$footer->cell_phone1)}}">{{$footer->cellPhone}}</a></li>
						@endif
						<li><span class="icon mdi mdi-map-marker"></span><a class="big" href="#">{{$footer->fullAddress}}</a></li>
						<li><span class="icon mdi mdi-email-outline"></span><a class="big" href="mailto:{{$footer->email}}">{{$footer->email}}</a></li>
					</ul>
					<ul class="list-social list-inline list-inline-md">
						@if (isset($footer['facebook']))
						<li><a class="icon mdi mdi-facebook" href="{{$footer->facebook}}"></a></li>
						@endif
						@if (isset($footer['instagram']))
						<li><a class="icon mdi mdi-instagram" href="{{$footer->instagram}}"></a></li>
						@endif
						@if (isset($footer['youtube']))
						<li><a class="icon mdi fa-youtube-play" href="{{$footer->youtube}}"></a></li>
						@endif
					</ul>
				</div>
			</div>
			<div class="col-lg-8 col-xl-7">
				{{-- FORM  --}}
				<form method="post" action="/contact/save" name="contactform" autocomplete="off" onsubmit="onSubmitContact(event)" class="rd-form rd-mailform" data-form-output="form-output-global" data-form-type="contact">
					<div class="row row-20 gutter-20">
						<div class="col-sm-6">
							<div class="form-wrap">
								<input class="form-input" id="contact-name" type="text" name="name" data-constraints="@Required">
								<label class="form-label" for="contact-name">Nome</label>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-wrap">
								<input class="form-input" id="contact-last-name" type="text" name="last_name" data-constraints="@Required">
								<label class="form-label" for="contact-last-name">Sobrenome</label>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-wrap">
								<input class="form-input" id="contact-phone" type="text" name="phone" data-constraints="@Numeric">
								<label class="form-label" for="contact-phone">Telefone</label>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-wrap">
								<input class="form-input" id="contact-email" type="email" name="email" data-constraints="@Email @Required">
								<label class="form-label" for="contact-email">E-mail</label>
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
								<label class="form-label" for="contact-message">Mensagem</label>
								<textarea class="form-input" id="contact-message" name="description_pt" data-constraints="@Required" maxlength="1000"></textarea>
								<span>Limite de Caracters 1mil.</span>
							</div>
						</div>
					</div>
					<div id="captcha-math-equations" class="form-group mt-3"></div>
					<div class="group-lg group-custom-1">
						<div class="group-custom-ie">
							<div class="unit unit-spacing-md form-text">
								<div class="unit-left"><span class="icon mdi mdi-information-outline"></span></div>
								<div class="unit-body">
									<p>Entraremos em contato assim que possível.</p>
								</div>
							</div>
						</div>
						<div>
							<button class="button button-gray-5" type="submit">Enviar mensagem</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<script src="{!! asset('js/captcha-math-equations.min.js') !!}"></script>

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
