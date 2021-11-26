<section id="banner_box" class="section swiper-container swiper-slider swiper-slider-4" data-loop="true">
	<div class="swiper-wrapper context-dark">
		@foreach ($pageData->content as $item)
		<div class="swiper-slide swiper-slide-2" data-slide-bg="{{$item['image_bg']}}">
					<div class="swiper-slide-caption section-md text-sm-left">
							<div class="container">
								<div class="row">
									<div class="col-sm-8 col-md-7">
										<h2 class="swiper-title-1" data-caption-animate="fadeInLeft" data-caption-delay="100" style="margin-top: 100px;">{{$item['title_pt']}}</h2>
										<h6 class="swiper-title-2" data-caption-animate="fadeInRight" data-caption-delay="250">{!! $item['text_pt'] !!}<br class="d-none d-md-block">
										</h6>
									</div>
										<div class="col-sm-4 col-md-5">
											<img src="{{$item['image']}}" alt="" class="img-generic-banner" style="margin-left: 25px;" data-caption-animate="fadeInRight" data-caption-delay="250">
										</div>
									</div>
									{{-- <div class="row col-sm-12 col-md-12">
											<div class="col-sm-8 col-md-7">
													<h4 class="swiper-title-1 text-uppercase" data-caption-animate="fadeInLeft"
															data-caption-delay="100" style="margin-top: 125px;">{{$item['title_pt']}}<br>
													</h4>
													<h6 class="swiper-title-2 text-width-medium" data-caption-animate="fadeInLeft"
															data-caption-delay="250" style="text-color: #fff">{!! $item['text_pt'] !!}</h6>
											</div>
											<div class="col-sm-4 col-md-5">
												<img src="{{$item['image']}}" alt="" class="img-home-banner" >
											</div>
									</div> --}}
							</div>
					</div>
			</div>
	@endforeach

	</div>
	<!-- Swiper Pagination-->
	<div class="swiper-pagination"></div>
	<!-- Swiper Navigation-->
	{{-- <div class="swiper-button-prev"></div>
	<div class="swiper-button-next"></div> --}}
</section>



