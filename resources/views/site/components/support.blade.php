@foreach ($pageData->content as $item)

<section class="section section-lg text-center bg-gray-darker" data-preset='{"title":"Our advantages 2","category":"advantages","reload":false,"id":"our-advantages-2"}' style="background-color: #fff">
	{{-- <div class="way-point" data-custom-scroll-to="#shop">
		<svg version="1.1" x="0px" y="0px" width="253px" height="38px" enable-background="new 0 0 253 38"
				xml:space="preserve">
				<path style="clip-path: url(#gel)" fill-rule="evenodd" clip-rule="evenodd"
						d="M252,36.001C199.397,36.001,176,0,125.815,0C76,0,52.988,36.001,0,36.001C4.336,40.465,273.563,36.001,252,36.001z">
				</path>
		</svg><span class="icon mdi mdi-chevron-down"></span>
	</div> --}}
	<div class="container-wide">
		<h3 style="color: #29293a">{{__('menu.support')}}</h3>
		<div class="divider divider-default"></div>
		<div class="row row-50 justify-content-sm-center text-start">
			<div class="col-sm-10 col-md-6 col-xl-3"><a class="post-classic-figure" href="/contact">
				<article class="box-minimal box-border">
					<div class="box-minimal-icon novi-icon mdi mdi-thumb-up-outline" style="color: #29293a"></div>
					<p class="big box-minimal-title" style="color: #29293a">Abordagem Individual</p>
					<div class="divider divider-default"></div>
					<div class="box-minimal-text" style="color: #29293a">Usamos uma abordagem individual para cada cliente e nunca oferecemos um conjunto de decisões padrão para o seu negócio.</div>
				</article>
				</a>
			</div>
			<div class="col-sm-10 col-md-6 col-xl-3"><a class="post-classic-figure" href="/contact">
				<article class="box-minimal box-border">
					<div class="box-minimal-icon novi-icon mdi mdi-account-multiple"  style="color: #29293a"></div>
					<p class="big box-minimal-title" style="color: #29293a">Funcionários Qualificados</p>
					<div class="divider divider-default"></div>
					<div class="box-minimal-text" style="color: #29293a">Minuzzi possui uma equipe qualificada e pronta para trabalhar por uma solução personalizada.</div>
				</article>
			</a>
			</div>
			<div class="col-sm-10 col-md-6 col-xl-3"><a class="post-classic-figure" href="/contact">
				<article class="box-minimal box-border">
					<div class="box-minimal-icon novi-icon mdi mdi-headset"  style="color: #29293a"></div>
					<p class="big box-minimal-title" style="color: #29293a">24/7 Suporte Online</p>
					<div class="divider divider-default"></div>
					<div class="box-minimal-text" style="color: #29293a">Nosso suporte online está disponível 24 horas por dia para responder a todas as suas perguntas e ajudá-lo a resolver qualquer problema que você possa ter.</div>
				</article>
			</a>
			</div>
			<div class="col-sm-10 col-md-6 col-xl-3"><a class="post-classic-figure" href="/contact">
				<article class="box-minimal box-border">
					<div class="box-minimal-icon novi-icon mdi mdi-credit-card"  style="color: #29293a"></div>
					<p class="big box-minimal-title" style="color: #29293a">Métodos de Pagamento</p>
					<div class="divider divider-default"></div>
					<div class="box-minimal-text" style="color: #29293a">Oferecemos uma variedade de métodos de pagamento com a Minuzzi que incluem Paypal, Visa / Mastercard / American Express e muitos outros.</div>
				</article>
			</a>
			</div>
		</div>
	</div>
</section>

@endforeach
