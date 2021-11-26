<!-- Footer Default-->
<footer class="section novi-bg novi-bg-img page-footer page-footer-default text-start bg-gray-darker section-way-point" data-preset='{"title":"Footer light 2","category":"footer, forms, gallery, social","reload":true,"id":"footer-light-2"}'>
	<!-- <section class="section section-variant-1 bg-accent-accent section-way-point novi-bg novi-bg-img" id="shop" data-preset='{"title":"Our shop","category":"shop","reload":false,"id":"our-shop"}'> -->
			<div class="way-point" data-custom-scroll-to="#shop">
					<svg version="1.1" x="0px" y="0px" width="253px" height="38px" enable-background="new 0 0 253 38" xml:space="preserve">
					<path style="clip-path: url(#gel)" fill-rule="evenodd" clip-rule="evenodd" d="M252,36.001C199.397,36.001,176,0,125.815,0                                       C76,0,52.988,36.001,0,36.001C4.336,40.465,273.563,36.001,252,36.001z"></path>
					</svg><span class="icon mdi mdi-chevron-down"></span>
			</div>
	<div class="container-wide">
		<div class="row row-40 row-md-50 justify-content-xl-between">
			<div class="col-md-6 col-xl-3">
				<div class="inset-xxl">
					<div class="unit unit-spacing-sm flex-column flex-md-row align-left">
						<a href="/"><img src="{{ url ('assets/images/logo/negative.png')}}" style="width: 100%; max-width: 240px;" /></a>
					</div>
					<p class="text-spacing-sm text-justify">{{__('footer.text')}}</p>
				</div>
			</div>
			<div class="col-md-6 col-xl-2">
				<h6>{{__('footer.links')}}</h6>
				<ul class="list-marked list-marked-primary">
					<li><a href="/#about_us">{{__('footer.about')}}</a></li>
					{{-- <li><a href="services.html">Services</a></li> --}}
					{{-- <li><a href="shop-4-columns-layout.html">Shop</a></li> --}}
					<li><a href="/blog">{{__('footer.blog')}}</a></li>
					{{-- <li><a href="grid-gallery-outside-title.html">Portfolio</a></li> --}}
					<li><a href="/contact">{{__('footer.contact')}}</a></li>
				</ul>
			</div>
			<div class="col-md-6 col-xl-3">
					<h6>{{__('footer.contactUs')}}</h6>
					<ul class="list-xs list-darker">
						<li class="box-inline"><span class="icon novi-icon icon-md-smaller icon-primary mdi mdi-map-marker"></span>
							<div><a href="http://maps.google.com/maps?q=1259+Avenida+Joaquim+Payolla,+Campinas,+CEP+13040211" target="blank">Av. Joaquim Payolla, 1259 Parque da Figueira - Campinas - São Paulo - Brasil<br class="d-none d-xxl-block"/>&nbsp;
								Cep: 13040-211</a></div>
						</li>
						<li class="box-inline"><span class="icon novi-icon icon-md-smaller icon-primary mdi mdi-phone"></span>
							<ul class="list-comma">
								<li><a href="tel:+55-19-3272-6380" target="_blank">	(19) 3272-6380</a></li>
								{{-- <li><a href="tel:#">1-800-6780-345</a></li> --}}
							</ul>
						</li>
						<li class="box-inline"><span class="icon novi-icon icon-md-smaller icon-primary mdi mdi-email-open"></span><a href="mailto:atendimento@transformadoresminuzzi.com.br?subject=Informação sobre a Minuzzi" target="_blank">atendimento@transformadoresminuzzi.com.br</a></li>
					</ul>
					<ul class="page-footer-icon-list social-icons-list">
						<li><a class="icon novi-icon icon-sm-bigger icon-gray-light mdi mdi-facebook" href="https://www.facebook.com/transformadores.minuzzi.3"></a></li>
						{{-- <li><a class="icon novi-icon icon-sm-bigger icon-gray-light mdi mdi-twitter" href="#"></a></li> --}}
						<li><a class="icon novi-icon icon-sm-bigger icon-gray-light mdi mdi-instagram" href="https://www.instagram.com/minuzzitransformadores/"></a></li>
						{{-- <li><a class="icon novi-icon icon-sm-bigger icon-gray-light mdi mdi-google" href="#"></a></li> --}}
						<li><a class="icon novi-icon icon-sm-bigger icon-gray-light mdi mdi-linkedin" href="https://www.linkedin.com/company/20526510/admin/"></a></li>
					</ul>
				</div>
			{{-- <div class="col-md-6 col-xl-3">
				<h6>newsletter</h6>
				<p class="text-spacing-sm">Keep up with our always upcoming news and updates. Enter your e-mail and subscribe to our newsletter.</p>
				<!-- RD Mailform: Subscribe-->
				<form class="rd-mailform rd-mailform-inline rd-mailform-sm" data-form-output="form-output-global" data-form-type="subscribe" method="post" action="bat/rd-mailform.php">
					<div class="rd-mailform-inline-inner">
						<div class="form-wrap">
							<input class="form-input" type="email" name="email" data-constraints="@Email @Required" id="subscribe-form-email-1"/>
							<label class="form-label" for="subscribe-form-email-1">Enter your e-mail</label>
						</div>
						<button class="button form-button button-sm button-secondary button-nina" type="submit">Subscribe</button>
					</div>
				</form>
			</div> --}}
		</div>
		<p class="rights text-center"><span>&copy;&nbsp;</span><span class="copyright-year"></span><span>&nbsp;</span><span>{{__('footer.copyright')}}</span><span>.&nbsp;</span><span style="margin-right: 125px;"></span><a href="privacy-policy.html">{{__('footer.developer')}} <a href="https://gigapixel.com.br/" target="_blank"><img src="{{ url ('assets/images/logo_gigapixel.png')}}" style="width: 100%; max-width: 150px; margin-left: 25px;" /></a> </a></p>
	</div>
</footer>
