<!--About us-->
<section class="section bg-gray-100 section-xxl position-relative overflow-hidden">
	@foreach($pageData['content'] as $content)
	<div class="floating-text__left">About</div>
	<div class="container">
		<div class="row justify-content-center flex-lg-row-reverse justify-content-xl-between row-40">
			<div class="col-md-11 col-lg-5 wow fadeInRight">
				<h6 class="title-8">{{$content['subtitle_pt']}}</h6>
				<h2 class="font-weight-bold">{{$content['title_pt']}}</h2>
				<p class="big">{!! $content['text_pt'] !!}</p>
				@if (isset($content['link_label']))
				<a class="button button-md button-gradient" target="_blank" href="{{$content['link']}}">{{$content['link_label']}}</a>
				@endif
			</div>
			<div class="col-sm-10 col-md-8 col-lg-7 col-xl-6 wow fadeIn">
				<!-- Video modern-->
				<article class="video-modern">
					<img class="video-modern-image" src="{{$content['image']}}" alt="" width="584" height="385"/>
				</article>
			</div>
		</div>
	</div>
	@endforeach
</section>