  <!-- Breadcrumbs-->
  <section class="breadcrumbs-custom overlay-creative">
    @foreach ($banner as $item)
    <div class="breadcrumbs-main">
      <div class="container">
        <div class="row align-items-center flex-column-reverse flex-lg-row">
          <div class="col-xl-4 col-lg-6">
            <div class="breadcrumbs-media"><img src="{{$item['image']}}" alt="" width="486" height="295"/></div>
          </div>
          <div class="col-xl-8 col-lg-6 text-lg-left text-center">
            <h2 class="breadcrumbs-custom-title scroll-title">{{$item['title_pt']}}</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="breadcrumbs-panel">
      <div class="container">
        <ul class="breadcrumbs-custom-path">
          <li><a href="/">Início</a></li>
          <li><a href="/{{$item['link']}}">{{$item['title_pt']}}</a></li>
        </ul>
      </div>
    </div>
    @endforeach
  </section>
