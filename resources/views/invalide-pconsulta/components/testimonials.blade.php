<section class="section section-xxl bg-gray-100 section-decor-1">
	<div class="container tabs-custom tabs-style-2">
		<div class="row row-30 justify-content-center">
			<div class="col-md-7 wow fadeInLeft">
				{{-- {!!$testimonial!!} --}}
				<h6 class="title-8">Depoimentos</h6>
				<h2 class="font-weight-bold">O que nossos Participantes dizem</h2>
				<!--Tab panes-->
				<div class="tab-content inset-xl-right-40">
					@foreach ($testimonial as $index => $item)
				<div class="tab-pane fade {{($index == 0) ? 'active show': ''}}" id="tabs-1-{{$index}}">
						<!-- Quote modern-->
						<article class="quote-modern">
							<div class="big quote-modern-text">
								<p class="q">{{$item['abstract_pt']}}</p>
							</div>
							<div class="heading-5 quote-modern-title">{{$item['name']}}</div>
							<div class="quote-modern-subtitle">{{$item['office']}}</div>
						</article>
					</div>
					@endforeach
					{{-- <div class="tab-pane fade" id="tabs-1-2">
						<!-- Quote modern-->
						<article class="quote-modern">
							<div class="big quote-modern-text">
								<p class="q">I've bought two motorcycles from this place and never plan to shop anywhere else! Low-pressure atmosphere, friendly mechanics, and excellent prices. I'm treated like family here!</p>
							</div>
							<div class="heading-5 quote-modern-title">Joseph Wilson</div>
							<div class="quote-modern-subtitle">Regular Client</div>
						</article>
					</div>
					<div class="tab-pane fade" id="tabs-1-3">
						<!-- Quote modern-->
						<article class="quote-modern">
							<div class="big quote-modern-text">
								<p class="q">Extremely helpful staff. The team at Brightcycle saved my road trip! I called all over town looking for a new motorcycle and they provided me with what I needed, quickly and efficiently.</p>
							</div>
							<div class="heading-5 quote-modern-title">Eric Thompson</div>
							<div class="quote-modern-subtitle">Regular Client</div>
						</article>
					</div>
					<div class="tab-pane fade" id="tabs-1-4">
						<!-- Quote modern-->
						<article class="quote-modern">
							<div class="big quote-modern-text">
								<p class="q">Great, friendly service. Brightcycle never tried to sell me something I don't need. They've never snobbed my weird taste in motorbikes and that’s why I recommend them to everyone!</p>
							</div>
							<div class="heading-5 quote-modern-title">Gary Wood</div>
							<div class="quote-modern-subtitle">Regular Client</div>
						</article>
					</div>
					<div class="tab-pane fade" id="tabs-1-5">
						<!-- Quote modern-->
						<article class="quote-modern">
							<div class="big quote-modern-text">
								<p class="q">This place is awesome.  I was looking for a reliable place to buy a motorcycle and Brightcycle team proved to be extremely friendly and helpful. They set me up with the Kawasaki Ninja.</p>
							</div>
							<div class="heading-5 quote-modern-title">Amy Washington</div>
							<div class="quote-modern-subtitle">Regular Client</div>
						</article>
					</div> --}}
				</div>
			</div>
			<div class="col-md-5 wow fadeInRight">
				<!--Nav tabs-->
				<ul class="nav nav-tabs">
					@foreach ($testimonial as $index => $item)
						<li class="nav-item" role="presentation"><a class="nav-link {{($index == 0) ? 'active show': ''}}" href="#tabs-1-{{$index}}" data-toggle="tab"><img src="{{$item['image']}}" alt="" width="89" height="89"/></a></li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</section>
