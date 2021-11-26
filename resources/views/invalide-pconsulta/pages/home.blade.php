@extends('site.layout.layout')
@section('content')


{{-- <div class="ie-panel"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="enar/images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div> --}}
  {{-- Carousel --}}
  @include('site.components.carousel')

  {{-- Countdown --}}
  @include('site.components.countdown')

  {{-- Material --}}
  @include('site.components.material')

  {{-- Counters --}}
  @include('site.components.counters')

  {{-- Faq --}}
  @include('site.components.faq')

  <!-- Gallery -->
  @include('site.components.gallery')

  <!--Testimonials-->
  <section class="section section-xxl bg-gray-100 section-decor-1">
    <div class="container tabs-custom tabs-style-2">
      <div class="row row-30 justify-content-center">
        <div class="col-md-7 wow fadeInLeft">
          <h6 class="title-8">Testemunho</h6>
          <h2 class="font-weight-bold">O que nossos clientes dizem</h2>
          <!--Tab panes-->
          <div class="tab-content inset-xl-right-40">
            <div class="tab-pane fade show active" id="tabs-1-1">
              <!-- Quote modern-->
              <article class="quote-modern">
                <div class="big quote-modern-text">
                  <p class="q">I am extremely pleased with the process of purchasing my new Honda Africa Twin from Brightcycle. I knew exactly what I wanted so it was easy to choose and purchase this motorcycle.</p>
                </div>
                <div class="heading-5 quote-modern-title">Helen Russell</div>
                <div class="quote-modern-subtitle">Regular Client</div>
              </article>
            </div>
            <div class="tab-pane fade" id="tabs-1-2">
              <!-- Quote modern-->
              <article class="quote-modern">
                <div class="big quote-modern-text">
                  <p class="q">I've bought two motorcycles from this place and never plan to shop anywhere else! Low-pressure atmosphere, friendly mechanics, and excellent prices. I'm treated like family here!</p>
                </div>
                <div class="heading-5 quote-modern-title">Joseph Wilson</div>
                <div class="quote-modern-subtitle">Regular Client</div>
              </article>
            </div>
            <div class="tab-pane fade" id="tabs-1-3">
              <!-- Quote modern-->
              <article class="quote-modern">
                <div class="big quote-modern-text">
                  <p class="q">Extremely helpful staff. The team at Brightcycle saved my road trip! I called all over town looking for a new motorcycle and they provided me with what I needed, quickly and efficiently.</p>
                </div>
                <div class="heading-5 quote-modern-title">Eric Thompson</div>
                <div class="quote-modern-subtitle">Regular Client</div>
              </article>
            </div>
            <div class="tab-pane fade" id="tabs-1-4">
              <!-- Quote modern-->
              <article class="quote-modern">
                <div class="big quote-modern-text">
                  <p class="q">Great, friendly service. Brightcycle never tried to sell me something I don't need. They've never snobbed my weird taste in motorbikes and that’s why I recommend them to everyone!</p>
                </div>
                <div class="heading-5 quote-modern-title">Gary Wood</div>
                <div class="quote-modern-subtitle">Regular Client</div>
              </article>
            </div>
            <div class="tab-pane fade" id="tabs-1-5">
              <!-- Quote modern-->
              <article class="quote-modern">
                <div class="big quote-modern-text">
                  <p class="q">This place is awesome.  I was looking for a reliable place to buy a motorcycle and Brightcycle team proved to be extremely friendly and helpful. They set me up with the Kawasaki Ninja.</p>
                </div>
                <div class="heading-5 quote-modern-title">Amy Washington</div>
                <div class="quote-modern-subtitle">Regular Client</div>
              </article>
            </div>
          </div>
        </div>
        <div class="col-md-5 wow fadeInRight">
          <!--Nav tabs-->
          <ul class="nav nav-tabs">
            <li class="nav-item" role="presentation"><a class="nav-link active" href="#tabs-1-1" data-toggle="tab"><img src="enar/images/user-5-89x89.jpg" alt="" width="89" height="89"/></a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-1-2" data-toggle="tab"><img src="enar/images/user-12-89x89.jpg" alt="" width="89" height="89"/></a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-1-3" data-toggle="tab"><img src="enar/images/user-13-89x89.jpg" alt="" width="89" height="89"/></a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-1-4" data-toggle="tab"><img src="enar/images/user-14-89x89.jpg" alt="" width="89" height="89"/></a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-1-5" data-toggle="tab"><img src="enar/images/user-4-89x89.jpg" alt="" width="89" height="89"/></a></li>
          </ul>
        </div>
      </div>
    </div>
  </section>
@endsection
