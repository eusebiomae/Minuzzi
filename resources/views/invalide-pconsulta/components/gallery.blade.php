<section class="section section-lg pb-0 text-center">
	<div class="container wow fadeInUp">
		<h6 class="title-8">{{$payload['gallery']['pretitle']}}</h6>
		<h2 class="font-weight-bold">{{$payload['gallery']['title']}}</h2>
		<p class="big">{{$payload['gallery']['subtitle']}}</p>
		<a class="button button-lg button-gradient" href="{{$payload['gallery']['btn-link']}}">{{$payload['gallery']['btn']}}</a>
	</div>
	<div class="owl-carousel owl-style-3" data-items="1" data-sm-items="2" data-md-items="3" data-lg-items="4" data-mouse-drag="false" data-dots="true" data-loop="false" data-lightgallery="group">
		<!-- Thumbnail modern-->
		@foreach ($payload['gallery']['imgs'] as $item)
			<article class="thumbnail-modern wow fadeIn" data-wow-delay=".05s">
				<a class="thumbnail-modern-figure"  href="{{$item['video']}}" data-lightgallery="item">
					<img class="img-duotone" src="enar/images/{{$item['img']}}" alt="" width="480" height="362" data-gradient-map="#242659, #ade5e4"/>
					<div class="thumbnail-modern-overlay">
						<span class="icon mdi mdi-play"></span>
					</div>
				</a>
			</article>
		@endforeach
	</div>
</section>
