<!--Counters-->
<section class="section section-lg bg-default text-center">
	<div class="container">
		<div class="row row-30 justify-content-center">
			@foreach($pageData['content'] as $content)
				<div class="col-sm-6 col-md-4">
					<!--Counter-->
					<div class="counter-wrap block-sm">
						<div class="counter-main">
							<div class="heading-1 counter-number counter">{{$content['title_pt']}}</div>
						</div>
						<div class="big counter-text">{{$content['subtitle_pt']}}</div>
					</div>
				</div>
			@endforeach
			{{-- <div class="col-sm-6 col-md-4">
				<!--Counter-->
				<div class="counter-wrap block-sm">
					<div class="counter-main">
						<div class="heading-1 counter-number counter">{{$payload['counters']['n2']}}</div>
					</div>
					<div class="big counter-text">{{$payload['counters']['n2-t']}}</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-4">
				<!--Counter-->
				<div class="counter-wrap block-sm">
					<div class="counter-main">
						<div class="heading-1 counter-number counter">{{$payload['counters']['n3']}}</div>
						<div class="heading-3 counter-postfix">+</div>
					</div>
					<div class="big counter-text">{{$payload['counters']['n3-t']}}</div>
				</div>
			</div> --}}
		</div>
	</div>
</section>
