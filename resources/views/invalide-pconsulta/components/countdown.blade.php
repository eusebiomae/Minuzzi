<!--Countdown-->
<section class="section section-lg text-center">
	@foreach($pageData['content'] as $content)
	<div class="container wow fadeInUp">
		<h6 class="title-8">{{$content['subtitle_pt']}}</h6>
		<h2 class="font-weight-bold">{{$content['title_pt']}}</h2>
		<p class="big">{!! $content['text_pt'] !!}</p>
	</div>
	@endforeach
	<div class="container">
		<div class="countdown" data-countdown="data-countdown" data-to="2020-12-13">
			<div class="countdown-block countdown-block-days">
				<div class="countdown-body">
					<svg class="countdown-circle" x="0" y="0" width="200" height="200" viewbox="0 0 200 200" data-progress-days="">
						<circle class="countdown-circle-bg" cx="100" cy="100" r="77"></circle>
						<circle class="countdown-circle-fg clipped" cx="100" cy="100" r="90" stroke="url(#gradient-0)"></circle>
						<defs>
							<linearGradient x1="0%" y1="0%" x2="0%" y2="100%" id="gradient-0">
								<stop offset="0%" stop-color="#00427F"></stop>
								<stop offset="100%" stop-color="#05b8ff"></stop>
							</linearGradient>
						</defs>
					</svg>
					<div class="countdown-wrap">
						<div class="heading-3 countdown-counter" data-counter-days="">00</div>
					</div>
				</div>
				<div class="heading-6 countdown-title">Dias</div>
			</div>
			<div class="countdown-block countdown-block-hours">
				<div class="countdown-body">
					<svg class="countdown-circle" x="0" y="0" width="200" height="200" viewbox="0 0 200 200" data-progress-hours="">
						<circle class="countdown-circle-bg" cx="100" cy="100" r="77"></circle>
						<circle class="countdown-circle-fg clipped" cx="100" cy="100" r="90" stroke="url(#gradient-1)"></circle>
						<defs>
							<linearGradient x1="0%" y1="0%" x2="0%" y2="100%" id="gradient-1">
								<stop offset="0%" stop-color="#CD1650"></stop>
								<stop offset="100%" stop-color="#f10765"></stop>
							</linearGradient>
						</defs>
					</svg>
					<div class="countdown-wrap">
						<div class="heading-3 countdown-counter" data-counter-hours="">00</div>
					</div>
				</div>
				<div class="heading-6 countdown-title">Horas</div>
			</div>
			<div class="countdown-block countdown-block-minutes">
				<div class="countdown-body">
					<svg class="countdown-circle" x="0" y="0" width="200" height="200" viewbox="0 0 200 200" data-progress-minutes="">
						<circle class="countdown-circle-bg" cx="100" cy="100" r="77"></circle>
						<circle class="countdown-circle-fg clipped" cx="100" cy="100" r="90" stroke="url(#gradient-2)"></circle>
						<defs>
							<linearGradient x1="0%" y1="0%" x2="0%" y2="100%" id="gradient-2">
								<stop offset="0%" stop-color="#4DA130"></stop>
								<stop offset="100%" stop-color="#39e200"></stop>
							</linearGradient>
						</defs>
					</svg>
					<div class="countdown-wrap">
						<div class="heading-3 countdown-counter" data-counter-minutes="">00</div>
					</div>
				</div>
				<div class="heading-6 countdown-title">Minutos</div>
			</div>
			<div class="countdown-block countdown-block-seconds">
				<div class="countdown-body">
					<svg class="countdown-circle" x="0" y="0" width="200" height="200" viewbox="0 0 200 200" data-progress-seconds="">
						<circle class="countdown-circle-bg" cx="100" cy="100" r="77"></circle>
						<circle class="countdown-circle-fg clipped" cx="100" cy="100" r="90" stroke="url(#gradient-3)"></circle>
						<defs>
							<linearGradient x1="0%" y1="0%" x2="0%" y2="100%" id="gradient-3">
								<stop offset="0%" stop-color="#C88500"></stop>
								<stop offset="100%" stop-color="#ECB900"></stop>
							</linearGradient>
						</defs>
					</svg>
					<div class="countdown-wrap">
						<div class="heading-3 countdown-counter" data-counter-seconds="">00</div>
					</div>
				</div>
				<div class="heading-6 countdown-title">Segundos</div>
			</div>
		</div>
	</div>
</section>
