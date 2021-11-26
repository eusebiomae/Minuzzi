
<!-- Upcoming Events-->
@foreach ($pageData->content as $item)
<section class="section section-variant-1 bg-default novi-bg novi-bg-img"
	data-preset='{"title":"Events list","category":"blog","reload":false,"id":"events-list"}'>
	<div class="container-wide">
			<div class="row justify-content-xl-end row-30">
					<div class="col-xl-8">
							<div class="parallax-text-wrap">
									<h3>Blog</h3><span class="parallax-text">Minuzzi</span>
							</div>
							<hr class="divider divider-default">
					</div>
					<div class="col-xl-3 text-xl-end"><a class="button button-secondary button-nina" href="/blog">{{__('menu.productsHomeSee')}}</a></div>
			</div>
			<div class="row row-50">
				@foreach ($events as $event)
					<div class="col-md-6 col-xl-4">
							<article class="event-default-wrap">
									<div class="event-default">
											<figure class="event-default-image"><img src="{{ $event->image }}" alt=""
															width="570" height="370" />
											</figure>
											<div class="event-default-date-wrap">
													<time datetime="2021">
														<span class="event-default-date">{{ $event->scheduling_date }}</span>
														{{-- <span	class="event-default-month">{{ $event->scheduling_date }}</span>
														<span class="event-default-time">{{ $event->scheduling_date }}</span> --}}
													</time>
											</div>
											<div class="event-default-caption"><a
															class="button button-xs button-secondary button-nina"
															href="blog_details/{{$event->id}}">{{__('menu.productsDetailsButton')}}</a>
											</div>
									</div>
									<div class="event-default-inner">
											<div class="box-inline">
												{{-- <span class="icon novi-icon icon-md-middle icon-secondary mdi mdi-map-marker"></span> --}}
													{{-- <a class="event-default-link" href="single-event.html">{{ $event->title_pt }}</a> --}}
											</div>
											<h5 style="text-align: center"><a class="event-default-title" style="text-align: center" href="single-event.html">{{ internation($event, 'title') }}</a></h5>
									</div>
							</article>
						</div>
						@endforeach
			</div>
	</div>
</section>
@endforeach
