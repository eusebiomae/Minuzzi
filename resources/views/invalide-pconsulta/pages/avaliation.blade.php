@extends('site.layout.layout')

@section('content')

  @include('site.components.banner')

  @include('site.components.material')

  <section class="section section-xl position-relative overflow-hidden text-center">
    <div class="floating-text__left">2019</div>
    <div class="container position-relative">
      <h6 class="title-8 wow fadeInUp">Provas e gabaritos antigos</h6>
      <h2 class="font-weight-bold wow fadeInUp">Área de estudo</h2>
      <div class="row row-xl row-30 row-md-50">
        <!-- Products-->
        @foreach ($payload['study_area'] as $item)
          <div class="col-sm-6 col-lg-4">
            <article class="product block-md">
              <div class="product-body material">
                <div class="product-info">
                  <div class="product-figure"><img src="enar/images/{{$item['img']}}" alt="" width="" height="240"/>
                  <div class="product-category mt-3">{{$item['subtitle']}}</div>
                  <div class="heading-5 product-title">{{$item['title']}}</div>
                  </div>
                </div>
                <div class="product-description">
                  <div class="product-rating"><span class="icon mdi mdi-star-outline"></span><span class="icon mdi mdi-star-outline"></span><span class="icon mdi mdi-star-outline"></span><span class="icon mdi mdi-star-outline"></span><span class="icon mdi mdi-star-outline"></span></div>
                  <p>{{$item['descption']}}</p>
                  <a class="button button-gray-800" href="{{$item['link']}}">{{$item['btn']}}</a>
                </div>
              </div>
              <div class="product-panel">
                <div class="big product-price">{{$item['date']}}</div>
                <div class="product-share">
                  <div class="product-share-button linearicons" data-custom-toggle="" data-custom-toggle-disable-on-blur="true"></div>
                  <ul class="product-share-list list-inline">
                    <li><a class="icon mdi mdi-facebook" href="{{$item['face']}}"></a></li>
                    <li><a class="icon mdi mdi-instagram" href="{{$item['inst']}}"></a></li>
                  </ul>
                </div>
              </div>
            </article>
          </div>
          @endforeach
        {{-- <div class="col-12"><a class="button button-gradient button-md" href="shop.html">View all products</a></div> --}}
      </div>
    </div>
  </section>

@endsection

