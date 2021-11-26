  <!--Swiper-->
  <section class="section swiper-container swiper-slider swiper-slider-6 bg-default bg-image-1 overlay-creative" data-autoplay="5000" data-simulate-touch="false" data-slide-effect="fade">
    <div class="swiper-wrapper">
      {{-- SLIDE --}}
      @foreach ($carousel as $item)
        <div class="swiper-slide">
          <div class="swiper-slide-caption">
            <div class="container">
              <div class="row row-30 justify-content-center flex-column-reverse flex-lg-row">
                <div class="col-lg-6">
                  <div class="swiper-media-box"><img src="{{$item['image']}}" alt="" width="1005" height="602"/>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="swiper-caption-box">
                    <div class="heading-1">
                      <span class="d-inline-block d-lg-block">{{$item['title_pt']}}</span>
                    </div>
                    <div class="swiper-caption-box__subtitle">
                      <span>{{$item['subtitle_pt']}}</span>
                    </div>
                    <a href="{{$item['link']}}" class="button button-lg button-icon button-icon-right button-gradient-outline">
                      <span class="bg button-md">
                        {{$item['label_link']}}
                      </span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <!--Swiper Pagination-->
    <div class="swiper-pagination"></div>
    <!--Swiper Navigation-->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </section>

