{{-- SECTION benefits --}}
@foreach ($pageData->content as $item)
<section class="section section-variant-1  section-way-point novi-bg novi-bg-img" id="shop"
data-preset='{"title":"Our shop","category":"shop","reload":false,"id":"our-shop"}'>
{{-- <div class="way-point" data-custom-scroll-to="#shop">
	<svg version="1.1" x="0px" y="0px" width="253px" height="38px" enable-background="new 0 0 253 38"
			xml:space="preserve">
			<path style="clip-path: url(#gel)" fill-rule="evenodd" clip-rule="evenodd"
					d="M252,36.001C199.397,36.001,176,0,125.815,0C76,0,52.988,36.001,0,36.001C4.336,40.465,273.563,36.001,252,36.001z">
			</path>
	</svg><span class="icon mdi mdi-chevron-down"></span>
</div> --}}
<div class="container container-wide">
	<div class="row justify-content-xl-end row-30 row-fix">
		<div class="col-xl-8">
				<div class="parallax-text-wrap">
						<h3>{{__('menu.productsHome')}}</h3><span class="parallax-text" style="color: #f2f3f9">Transformadores</span>
				</div>
				<hr class="divider divider-default">
		</div>
		<div class="col-xl-3 text-xl-end">
            {{-- <a class="button button-default-outline button-nina" href="shop-4-columns-layout.html">Ver todos</a> --}}
        </div>
	</div>

    {{-- <div class="row row-30 row-lg-50"> --}}
        <div class="row row-xl row-shop row-fix">
            <div class="col-xl-12 col-md-12 col-sm-12">
                <div class="row row-30 row-lg-50 text-start">
        @foreach ($products as $product)
        <div class="col-md-4 col-lg-3">
            <figure class="block-with-details book-info" style="box-shadow: 0 0 5px 0 rgb(163, 163, 163); ">
              <div class="perspective">
                <div class="book" data-book="book-1">
                  <div class="cover">
                    <div class="front"></div>
                        <a href="product_details/{{$product->id}}"><img src="{{$product->img}}" alt="" style="width: 200px; height: 246px;" /></a>
                    <div class="inner inner-left"></div>
                  </div>
                  <div class="inner inner-right"></div>
                </div>
              </div>

              <div class="figcaption">
                <h5 class="book-title">{{internation($product, 'title')}}</h5>
                <div class="book-button"><a class="button button-sm button-secondary button-nina" href="product_details/{{$product->id}}">{{__('menu.productsDetailsButton')}}</a></div>
              </div>

              <div class="details">
                <ul>
                  <li>
                    <h5>{{$product->title_pt}}
                    </h5>
                    <p class="book-cite"><b>{{__('menu.productsCategory')}}</b></p>
                    <p class="book-cite">{{$product->courseCategory->description_pt}}</p>
                    <p class="book-cite"><b>{{__('menu.productsSubcategory')}}</b></p>
                    <p class="book-cite">{{$product->courseSubcategory->description_pt}}</p>
                    <div class="heading-6">{{internation($product, 'subtitle')}}</div>
                  </li>
                </ul>
                <div class="book-button"><a class="button button-sm button-secondary button-nina" href="product_details/{{$product->id}}">{{__('menu.productsDetailsButton')}}</a></div>
              </div><span class="close-details"></span>
            </figure>
        </div>
        @endforeach
                </div>
            </div>
        </div>
	{{-- </div> --}}
</div>
</section>
@endforeach
<canvas></canvas>
