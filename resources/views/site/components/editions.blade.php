@foreach ($pageData->content as $item)
<section id="editions" class="section section-variant-1 bg-accent-accent section-way-point novi-bg novi-bg-img" id="shop"
data-preset='{"title":"Our shop","category":"shop","reload":false,"id":"our-shop"}' style="background-image: url('{{$item['image_bg']}}');">
	<div class="way-point" data-custom-scroll-to="#shop">
		<svg version="1.1" x="0px" y="0px" width="253px" height="38px" enable-background="new 0 0 253 38"
				xml:space="preserve">
				<path style="clip-path: url(#gel)" fill-rule="evenodd" clip-rule="evenodd"
						d="M252,36.001C199.397,36.001,176,0,125.815,0C76,0,52.988,36.001,0,36.001C4.336,40.465,273.563,36.001,252,36.001z">
				</path>
		</svg><span class="icon mdi mdi-chevron-down"></span>
	</div>
	<div class="container">
		<div class="row justify-content-xl-end row-30 row-fix">
			<div class="col-xl-8">
					<div class="parallax-text-wrap">
							<h3>{{__('menu.productsHome')}}</h3><span class="parallax-text">Transformadores</span>
					</div>
					<hr class="divider divider-default">
			</div>
			<div class="col-xl-3 text-xl-end"><a class="button button-default-outline button-nina"
							href="/products">{{__('menu.productsHomeSee')}}</a></div>
		</div>
			<div class="isotope-wrap">
					<div class="isotope-filters">
							<div class="isotope-filters-list-wrap">
									<ul class="isotope-filters-list">
											<li><a href="#editions" data-isotope-filter="getMonth">Últimos 3 meses</a></li>
									</ul>
							</div>
					</div>
					<div class="row row-30 row-lg-50">
						@foreach ($editions as $edition)
						<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
							<!-- Product-->
							<article class="product">
								<div class="product-body">
									<div class="product-figure-box"><a  href="/product_details/{{$edition->id}}"><img src="{{$edition->img}}" alt=""/></a>
									</div>
									<h5 class="product-title"><a href="/box_blog">{{ internation($edition, 'title')}}</a></h5>

									<div class="product-price-wrap">
										<div class="product-price">{{internation($edition, 'subtitle')}}</div>
									</div>
								</div>
							</article>
						</div>
						@endforeach
					</div>
			</div>
	</div>
</section>
@endforeach


