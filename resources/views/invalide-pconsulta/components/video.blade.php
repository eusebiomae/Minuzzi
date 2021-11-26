<section>
	<div class="owl-carousel owl-style-3" data-items="1" data-sm-items="2" data-md-items="3" data-lg-items="4" data-mouse-drag="false" data-dots="true" data-loop="false" data-lightgallery="group">
		<!-- Thumbnail modern-->
		@foreach ($video as $item)

			<article class="thumbnail-modern wow fadeIn" data-wow-delay=".05s">
				<a class="thumbnail-modern-figure"  href="{{$item['link']}}" data-lightgallery="item">
					<img class="img-duotone" src="{{$item['image']}}" alt="{{$item['title']}}" width="480" height="362" data-gradient-map="#242659, #ade5e4"/>
					<div class="thumbnail-modern-overlay">
						<span class="icon mdi mdi-play"></span>
					</div>
				</a>
			</article>

		@endforeach
	</div>
</section>
