<!-- {{-- 	BANNER --}} -->
<section  id="banner-home" class="breadcrumbs-custom-svg text-center">
	<div class="swiper-container swiper-slider swiper-slider_height-1 swiper-main" data-loop="true"
	data-autoplay="5500" data-simulate-touch="false" data-slide-effect="fade" style="background-image: url('assets/images/banner/bg.png'); no-repeat center; background-size:cover;">
	<div class="swiper-wrapper">
		@foreach ($banners as $banner)
		<div class="swiper-slide" data-slide-bg="">
			<div class="swiper-slide-caption">
				<div class="container-wide swiper-main-section">
					<div class="row justify-content-sm-center">
							<div class="col-md-4 col-xl-4" >
									<p class="heading-1 breadcrumbs-custom-subtitle"
											data-caption-animate="blurIn" data-caption-delay="50"><img
													src="{{$banner->image}}" alt="" width="500" style="margin-right: 350px; margin-top: 150px;"/></p>
							</div>
							<div class="col-md-6 col-xl-6">
									<p class="breadcrumbs-custom-subtitle" data-caption-animate="fxRotateInUp"
											data-caption-delay="550" style="color: #fff">{{ internation($banner, 'title')}}</p>

									<p class="heading-1 breadcrumbs-custom-title" data-caption-animate="blurIn"
											data-caption-delay="50" style="color: #fff">{{ internation($banner, 'pretitle')}}</p>

									<p class="heading-2" data-caption-animate="fxRotateInDown"
											data-caption-delay="550" style="color: #fff">{{ internation($banner, 'subtitle')}}
									</p>
									<div class="group-md button-group">
											<a class="button button-secondary button-nina button-lg" href="/budget"
													data-caption-animate="fxRotateInDown"
													data-caption-delay="550">{{__('menu.budget')}}</a>
											<a class="button button-default-outline button-nina button-lg" href="/products"
													data-caption-animate="fxRotateInDown" data-caption-delay="550">{{__('menu.productsSee')}}</a>
									</div>
							</div>
					</div>
				</div>

			</div>
		</div>
		@endforeach
	</div>
</div>
<!-- Swiper Pagination-->
{{-- <div class="swiper-pagination"></div>
<div class="swiper-button-prev"></div>
<div class="swiper-button-next"></div> --}}

	{{-- @foreach ($banners as $banner)
	<div id="banner-home" class="banner home" style="background: url({{$banner['image']}}) no-repeat center; background-size:cover;">
		<div class="container">
			<h2 class="banner-title">{{$banner['title_pt']}}</h2>
			<p class="banner-subtitle">{{$banner['subtitle_pt']}}</p>
		</div>
	</div>
	@endforeach --}}
</section>

{{-- <section class="breadcrumbs-custom-svg text-center">
	<!-- Swiper-->
	<div class="swiper-container swiper-slider swiper-slider_height-1 swiper-main" data-loop="false"
			data-autoplay="5500" data-simulate-touch="false" data-slide-effect="fade">
			<div class="swiper-wrapper">
					<div class="swiper-slide" data-slide-bg="">
							<div class="swiper-slide-caption">
									<div class="container-wide swiper-main-section">
											<div class="row justify-content-sm-center">
													<div class="col-md-4 col-xl-4">
															<p class="heading-1 breadcrumbs-custom-subtitle"
																	data-caption-animate="blurIn" data-caption-delay="50"><img
																			src="images/banner/solar.png" alt="" width="350" /></p>
													</div>
													<div class="col-md-6 col-xl-6">
															<p class="breadcrumbs-custom-subtitle" data-caption-animate="fxRotateInUp"
																	data-caption-delay="550">Soluções Transformadores</p>
															<p class="heading-1 breadcrumbs-custom-title" data-caption-animate="blurIn"
																	data-caption-delay="50">Solar</p>
															<p class="heading-2" data-caption-animate="fxRotateInDown"
																	data-caption-delay="550">Transformadores Energia Solar (Fotovoltaica)
															</p>
															<div class="group-md button-group">
																	<a class="button button-secondary button-nina button-lg" href="#"
																			data-custom-scroll-to="#start" data-caption-animate="fxRotateInDown"
																			data-caption-delay="550"> start a journey</a>
																	<a class="button button-default-outline button-nina button-lg" href="#"
																			data-caption-animate="fxRotateInDown" data-caption-delay="550"> view
																			advantages</a>
															</div>
													</div>
											</div>
									</div>
							</div>
					</div>
					<div class="swiper-slide" data-slide-bg="">
							<div class="swiper-slide-caption">
									<div class="container-wide swiper-main-section">
											<div class="row justify-content-sm-center">
													<div class="col-md-6 col-xl-6">
															<p class="breadcrumbs-custom-subtitle" data-caption-animate="fxRotateInUp"
																	data-caption-delay="550">Autotransformador</p>
															<p class="heading-1 breadcrumbs-custom-title" data-caption-animate="blurIn"
																	data-caption-delay="50">ATTF</p>
															<p class="heading-2" data-caption-animate="fxRotateInDown"
																	data-caption-delay="550">Trifásicos e Monofásicos (Motores montados com,
																	chaves compensadoras)</p>
															<div class="group-md button-group">
																	<a class="button button-secondary button-nina button-lg" href="#"
																			data-custom-scroll-to="#start" data-caption-animate="fxRotateInDown"
																			data-caption-delay="550"> start a journey</a>
																	<a class="button button-default-outline button-nina button-lg" href="#"
																			data-caption-animate="fxRotateInDown" data-caption-delay="550"> view
																			advantages</a>
															</div>
													</div>
													<div class="col-md-4 col-xl-4">
															<p class="heading-1 breadcrumbs-custom-subtitle"
																	data-caption-animate="blurIn" data-caption-delay="50"><img
																			src="images/banner/Trafo.png" alt="" width="350" /></p>
													</div>
											</div>
									</div>
							</div>
					</div>
					<div class="swiper-slide" data-slide-bg="">
							<div class="swiper-slide-caption">
									<div class="container-wide swiper-main-section">
											<div class="row justify-content-sm-center">
													<div class="col-md-10 col-xl-10">
															<p class="breadcrumbs-custom-subtitle" data-caption-animate="fxRotateInUp"
																	data-caption-delay="550">Change the impression of your website visitors
																	with our template</p>
															<p class="heading-1 breadcrumbs-custom-title" data-caption-animate="blurIn"
																	data-caption-delay="50">be first</p>
															<p class="heading-2" data-caption-animate="fxRotateInDown"
																	data-caption-delay="550">Become the leader of the web with Brave</p>
															<div class="group-md button-group"><a
																			class="button button-secondary button-nina button-lg" href="#"
																			data-custom-scroll-to="#start" data-caption-animate="fxRotateInDown"
																			data-caption-delay="550"> start a journey</a><a
																			class="button button-default-outline button-nina button-lg"
																			href="#" data-caption-animate="fxRotateInDown"
																			data-caption-delay="550"> view advantages</a></div>
													</div>
											</div>
									</div>
							</div>
					</div>
			</div>
			<!-- Swiper controls-->
			<div class="swiper-pagination-wrap">
					<div class="swiper-pagination"></div>
			</div>
	</div>
	<div class="parallax-scene-js parallax-scene" data-scalar-x="5" data-scalar-y="10">
<div class="layer-01">
<div class="layer" data-depth="0.25"><img src="images/icon/minuzzi.png" alt="" width="65" /></div>
</div>
<div class="layer-02">
<div class="layer" data-depth=".55"><img src="images/icon/eletric.png" alt="" width="45" /></div>
</div>
<div class="layer-03">
<div class="layer" data-depth="0.1"><img src="images/icon/minuzzi_agro.png" alt="" width="65" /></div>
</div>
<div class="layer-04">
<div class="layer" data-depth="0.25"><img src="images/icon/luz.png" alt="" width="45" /></div>
</div>
<div class="layer-05">
<div class="layer" data-depth="0.15"><img src="images/icon/minuzzi_solar.png" alt="" width="65" /></div>
</div>
<div class="layer-06">
<div class="layer" data-depth="0.65"><img src="images/icon/recycle.png" alt="" width="45" /></div>
</div>
</div>
</section> --}}
