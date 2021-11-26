      <!-- Product Page-->
      @foreach ($pageData->content as $item)
      <section class="section section-lg bg-default novi-bg novi-bg-img" data-preset='{"title":"Product single","category":"shop","reload":true,"id":"product-single"}'>
        <!-- section wave-->
        <div class="section-wave">
          <svg x="0px" y="0px" width="1920px" height="46px" viewbox="0 0 1920 46" preserveAspectRatio="none">
            <path d="M1920,0.5c-82.8,0-109.1,44-192.3,44c-78.8,0-116.2-44-191.7-44c-77.1,0-115.9,44-192,44c-78.2,0-114.6-44-192-44c-78.4,0-115.3,44-192,44c-76.9-0.1-119-44-192-44c-77,0-115.2,44-192,44c-73.6,0-114-44-190.9-44c-78.5,0-117.2,44-194.1,44c-75.9,0-113-44-191-44V46h1920V0.5z"></path>
          </svg>
        </div>
        <div class="container container-bigger product-single">
          <div class="row row-fix row-ten justify-content-sm-center justify-content-lg-between row-30 align-items-lg-center">

            <!-- Imagem Produto -->
            <div class="col-lg-4 col-xl-5 col-xxl-4">
              <div class="product-single-preview">
                <div class="unit flex-column flex-md-row align-items-md-center unit-spacing-md-midle unit--inverse unit-sm">
                  {{-- <div class="unit-body">
                    <ul class="product-thumbnails">
                      <li class="active" data-large-image="images/shop-01-420x550.png"><img src="images/shop-01-54x71.png" alt="" width="54" height="71"></li>
                      <li data-large-image="images/shop-02-420x550.png"><img src="images/shop-02-10x71.png" alt="" width="10" height="71"></li>
                    </ul>
                  </div> --}}
                  <div class="unit-right product-single-image">
                    <div class="product-single-image-element"><img class="product-image-area animateImageIn" src="{{$product->img}}" alt=""></div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Conteudo Produto -->
            <div class="col-lg-6 col-xl-5 col-xxl-5 text-center text-lg-start">
                <div class="product-button"><a class="button button-secondary button-nina"
                    href="/orcamento">Orçamento</a>
                </div>
              <h3>{{internation($product, 'title')}}</h3>
              <div class="divider divider-default"></div>
              <p class="text-spacing-sm">{!! internation($product, 'description') !!}</p>
              <ul class="inline-list">
                <li class="text-middle">
                  <h6>{{$product->price}}</h6>
                </li>
                <li class="text-middle"><a class="button button-sm button-secondary button-nina" href="/budget/{{$product->id}}">{{__('menu.productsDetailsButtonBudget')}}</a></li>
              </ul>
            </div>
          </div>
        </div>
      </section>

      <section class="section section-lg bg-gray-lighter text-center novi-bg novi-bg-img" data-preset='{"title":"Products 1","category":"shop","reload":false,"id":"products-1"}'>
        <div class="container container-wide">
          <h3>{{__('menu.productsKnow')}}</h3>
          <div class="divider divider-default"></div>
            <div class="row justify-content-xl-end row-30 row-fix">
              <div class="col-xl-3 text-xl-end"><a class="button button-default-outline button-nina"
						   href="/products">{{__('menu.productsHomeSee')}}</a>
              </div>
            </div>
          <div class="row row-30">
            @foreach ($editions as $edition)
            <div class="col-md-6 col-lg-4 col-xl-4 col-xxl-4">
              <div class="product">
                <div class="product-image"><a href="/product_details/{{$edition->id}}"><img src="{{$edition->img}}" alt="" width="188" height="246"/></a></div>
                <div class="product-title">
                  <h5><a href="/product_details/{{$edition->id}}">{{internation($edition, 'title')}}<br class="d-none d-xxl-block">&nbsp;
                    {{internation($edition, 'subtitle')}}</a></h5>
                </div>
                <div class="product-price">
                  <h6>{{$edition->price}}</h6>
                </div>
                <div class="product-button"><a class="button button-secondary button-nina" href="/product_details/{{$edition->id}}">{{__('menu.productsDetailsButton')}}</a></div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </section>
      @endforeach
