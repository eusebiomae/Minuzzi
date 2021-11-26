{{-- Faq --}}
<section class="section">
	<!-- Owl Carousel-->
	<div class="owl-carousel owl-creative" data-loop="false" data-items="1" data-sm-items="2" data-xl-items="2"  data-xxl-items="3" data-dots="true" data-mouse-drag="false">
		<!-- Box abby-->
	@foreach($pageData['content'] as $content)

		<article class="box-abby bg-primary">
			<div class="box-abby__media"><img src="{{$content['image']}}" alt="" width="248" height="373"/>
			</div>
			<div class="heading-6 box-abby-subtitle">{{$content['subtitle_pt']}}</div>
			<div class="heading-2 box-abby-title">{{$content['title_pt']}}</div>
			<p class="box-abby__caption">{!! $content['text_pt'] !!}</p>
			<a href="{{$content['link']}}" class="button">
				<span class="button-md">
					{{$content['link_label']}}
				</span>
			</a>
		</article>
	@endforeach
	</div>
</section>
