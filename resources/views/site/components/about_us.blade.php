{{-- SECTION about --}}
@foreach ($pageData->content as $item)
<section id="about_us" class="section section-variant-1 bg-default text-start novi-bg novi-bg-img"
		data-preset='{"title":"About us 4","category":"about","reload":true,"id":"about-us-4"}'>
		<!-- section wave-->
		<div class="section-wave">
				<svg x="0px" y="0px" width="1920px" height="46px" viewbox="0 0 1920 46" preserveAspectRatio="none">
						<path
								d="M1920,0.5c-82.8,0-109.1,44-192.3,44c-78.8,0-116.2-44-191.7-44c-77.1,0-115.9,44-192,44c-78.2,0-114.6-44-192-44c-78.4,0-115.3,44-192,44c-76.9-0.1-119-44-192-44c-77,0-115.2,44-192,44c-73.6,0-114-44-190.9-44c-78.5,0-117.2,44-194.1,44c-75.9,0-113-44-191-44V46h1920V0.5z">
						</path>
				</svg>
		</div>
		<div class="container-wide">
				<div class="row justify-content-xl-end row-50">
						<div class="col-xl-6">
								<div class="parallax-text-wrap">
										<h3>{{__('menu.about_us')}}</h3><span class="parallax-text">Minuzzi</span>
								</div>
								<hr class="divider divider-left divider-default">
								<div class="row row-fix">
										<div class="col-xl-11">
												<div class="tabs-custom tabs-horizontal tabs-line" id="tabs-1">
														<!-- Nav tabs-->
														<ul class="list-fix nav nav-tabs">
																<li class="nav-item"><a class="nav-link active" href="#tabs-1-1"
																				data-bs-toggle="tab">{{__('menu.resume')}}</a></li>
																{{-- <li class="nav-item"><a class="nav-link" href="#tabs-1-2"
																				data-bs-toggle="tab">Fundador</a></li>
																<li class="nav-item"><a class="nav-link" href="#tabs-1-3"
																				data-bs-toggle="tab">Missão</a></li> --}}
														</ul>
														<!-- Tab panes-->
														<div class="tab-content">
																<div class="tab-pane fade show active" id="tabs-1-1">
																		<p>{{__('construction.resumeContent1')}}</p>
																		<p>{{__('construction.resumeContent2')}}</p>
																		<a class="button button-default-outline button-nina" href="/about_us">{{__('construction.more')}}</a>
																</div>
																<div class="tab-pane fade" id="tabs-1-2">
																		<!-- Card info-->
																		<article class="card-info">
																				<div class="card-info-aside"><img class="card-info-image"
																								src="{{ url('assets/images/roy-henry-150x150.jpg') }}"  alt="" width="150"
																								height="150" />
																				</div>
																				<div class="card-info-main">
																						<h5 class="card-info-title">Roy Henry</h5>
																						<p class="card-info-subtitle">Founder</p>
																						<p>Roy is the main person behind Brave. He is the multitalented
																								manager and a former UX designer who is a true mine of creative
																								ideas for everyone at our team.</p><a
																								class="button button-default-outline button-nina"
																								href="#">learn more</a>
																				</div>
																		</article>
																</div>
																<div class="tab-pane fade" id="tabs-1-3">
																		<div class="box-width-2">
																				<p>In the digital age, we are marketing ourselves on the web. That is
																						why we aim to make it as easy and affordable for everyone to take
																						charge of their web presence. Words like "tweet" and "yelp" should
																						be part of your marketing campaign, and not part of your stress.</p>
																				<!-- Quote minimal-->
																				<article class="quote-minimal">
																						<p class="quote-minimal-text">We strive to create a memorable web
																								image for everyone.</p>
																				</article>
																				<p>We establish a relationship with all of our clients, and we feel it
																						is our responsibility to help them grow and harness the opportunity
																						of their presence on the Internet.</p><a
																						class="button button-default-outline button-nina" href="#">learn
																						more</a>
																		</div>
																</div>
														</div>
												</div>
										</div>
								</div>
						</div>
						<div class="col-xl-5 text-center">
								<div class="image-position-01">
										<div class="blick-wrap"><img class="image-wrap" src="{{ url('assets/images/banner/engenheiro.png') }}"
														alt="" width="940" height="852" />
												<!-- <div class="blick-overlay" data-blick-overlay="ipad"></div> -->
												<!-- <div class="blick-content"><img src="images/banner/engenheiro.png" alt=""></div> -->
										</div>
								</div>
						</div>
				</div>
		</div>
</section>
@endforeach

