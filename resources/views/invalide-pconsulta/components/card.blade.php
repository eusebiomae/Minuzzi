<div class="col-sm-6 col-md-4 col-lg-3">
	<article class="product block-md">
		<div class="product-body material">
			<div class="product-info">
				<div class="product-figure">
					<img src="{{$item['img']}}" alt="" width="" height="240"/>
					<div class="product-category mt-3">{{$item->typeFile->name}}</div>
					<div class="heading-5 product-title">{{$item['title']}}</div>
				</div>
			</div>
			<div class="product-description">
				<div class="product-rating">
					<span class="icon mdi mdi-star-outline"></span>
					<span class="icon mdi mdi-star-outline"></span>
					<span class="icon mdi mdi-star-outline"></span>
					<span class="icon mdi mdi-star-outline"></span>
					<span class="icon mdi mdi-star-outline"></span>
				</div>
				<p>{!!$item['description']!!}</p>
				<a class="button button-gray-800 mb-3 m-lg-0" href="{{$item['link']}}" target="_blank">Download</a>
			</div>
		</div>
		<div class="product-panel">
			<div class="big product-price">{{$item['subtitle']}}</div>
		</div>
	</article>

</div>
