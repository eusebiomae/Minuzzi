<article class="thumbnail-classic block-1">
	<div class="thumbnail-classic-caption">
		<div>
			<h5 class="thumbnail-classic-title text-justify" style="margin-top: 45px; margin-bottom: -25px;">
				{{ $product->description_pt }}</h5>
			<div class="thumbnail-classic-price"></div>
			<div class="thumbnail-classic-button-wrap">
				<div class="thumbnail-classic-button">
					<button class="button button-primary button-zakaria fl-bigmug-line-shopping202"
						@click="addBoxCard({{ $product['id'] }})" title="Eu quero"></button>
				</div>
			</div>
		</div>
	</div>

	<div class="product-body">
		<div class="product-figure-box"><img src="{{ $product->img }}" alt="" style="width: 190px;" />
		</div>
		<h5 class="product-title">{{ $product->title_pt }}</h5>

		<div class="product-price-wrap">
			<div class="product-price">{{ $product->subtitle_pt }}</div>
		</div>
	</div>

	@if($product->course_category_id == 1)
		<span class="product-badge product-badge-sale">Venda</span>
	@else
		<span class="product-badge product-badge-sale" style="background: #ec7f6e">Box</span>
	@endif
</article>
