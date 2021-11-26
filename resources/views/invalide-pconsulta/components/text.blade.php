<section class="section section-lg pb-5 text-center">
	@foreach ($pageData['content'] as $content)
		<div class="container wow fadeInUp">
			@if (isset($content['subtitle_pt']))
				<h6 class="title-8">{{$content['subtitle_pt']}}</h6>
			@endif
			@if (isset($content['title_pt']))
				<h2 class="font-weight-bold">{{$content['title_pt']}}</h2>
			@endif
			@if (isset($content['text_pt']))
				<p class="big">{!! $content['text_pt'] !!}</p>
			@endif
			@if (isset($content['link']))
				<a class="button button-lg button-gradient" href="{{$content['link']}}">{{$content['link_label']}}</a>
			@endif

		</div>
	@endforeach
</section>
