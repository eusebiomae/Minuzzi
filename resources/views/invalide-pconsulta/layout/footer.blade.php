@php
  $payload = GigaGetData::footer();
  $motivation = GigaGetData::motivation();
@endphp

  {{-- Footer --}}
  <footer class="section footer-modern gradient-primary bg-gray-13">
    <div class="footer-modern-body section-lg">
      <div class="container wow fadeInUp">
        <div class="row row-30 row-md-50 justify-content-md-between">
          <div class="col-md-4 col-xs-12 col-sm-12 col-lg-3">
            <div class="footer-modern-brand">
              <a class="brand" href="index.html">
                <img class="brand-logo-light" src="{{$payload->image}}" alt="" width="208" height="39"/>
              </a>
            </div>
            <p class="footer-caption">{{$payload['descption']}}</p>
            <div class="footer-modern-list-social">
              <ul class="list-social list-social-3 list-inline list-inline-xl">
                <li><a class="icon mdi mdi-instagram" href="{{$payload->instagram}}"></a></li>
                <li><a class="icon mdi mdi-facebook" href="{{$payload->facebook}}"></a></li>
                <li><a class="icon mdi mdi-youtube-play" href="{{$payload->youtube}}"></a></li>
              </ul>
            </div>
            <div class="heading-6 footer-modern-title">Realização:</div>
            <img class="brand-logo-light" src="/img/uniao_sul_norte.png" alt="" width="208" height="39"/>
          </div>
          <div class="col-md-4 col-xs-12 col-sm-12 col-lg-5">
            <div class="heading-5 footer-modern-title">Contato</div>
            <ul class="footer-modern-schedule">
              <li><span>Telefone:</span><span><a href="tel:{{preg_replace('/\D/','',$payload->phone1)}}">{{$payload->phone}}</a> </span></li>
              <li><span>Pr. Oziel:</span><span><a href="https://api.whatsapp.com/send?phone=55{{preg_replace('/\D/','',$payload->cell_phone1)}}&text=Estou%20com%20d%C3%BAvida%20sobre%20o%20ENAR%202020" target="_blank"> {{$payload->cell_phone1}}</a></span></li>
              <li><span>Henrique:</span><span><a href="https://api.whatsapp.com/send?phone=55{{preg_replace('/\D/','',$payload->cell_phone2)}}&text=Estou%20com%20d%C3%BAvida%20sobre%20o%20ENAR%202020" target="_blank"> {{$payload->cell_phone2}}</a></span></li>
              <li><span>E-mail:</span><span><a href="mailto:{{$payload->email1}}">{{$payload->email}}</a></span></li>
            </ul>
          </div>
          <div class="ccol-md-4  col-xs-12 col-sm-12 col-lg-4">
            <div class="heading-5 footer-modern-title">Motivacional</div>
            <div class="owl-carousel owl-style-6 owl-dots-1" data-items="1" data-dots="true" data-autoplay="true" data-margin="30">
              <!-- Quote navy-->
              @foreach ($motivation as $item)
                <article class="quote-navy">
                  <div class="quote-navy-text">
                    <p class="q">{!!$item['phrase']!!}</p>
                  </div>
                  <div class="quote-navy-title">{{$item['name']}}</div>
                </article>
              @endforeach
            </div>
            <div class="heading-6 footer-modern-title mt-5 mb-3">Desenvolvimento:</div>
            <a href="https://gigapixel.com.br" target="_blank">
              <img class="brand-logo-light" src="http://gigapixel.com.br/wp-content/uploads/2017/08/logo-negativo.png" alt="GigaPixel - Marketing, Design e Technology" width="200"/>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-modern-panel bg-gray-7 gradient-red">
      <div class="container wow fadeInUp">
        <div class="row justify-content-center">
          <div class="col-xl-11">
            <ul class="footer-modern-nav list-inline">
              @foreach (GigaGetData::menu() as $item)
              <li class="{{ isActiveRoute($item->flg_page) }}"><a href="{{ $item->url }}" title="{{ $item->description_pt }}">{{ $item->description_pt }}</a></li>
							@endforeach
            </ul>
          </div>
          <p class="rights"><span>&nbsp;&copy;&nbsp;</span><span class="copyright-year"></span><span> Igreja Adventista do Sétimo Dia Movimento de Reforma. Todos os direitos reservados.&nbsp; - &nbsp; Desenvolvimento:</span><a href="https://gigapixel.com.br" target="_blank"><span>GigaPixel</span></a><span>.&nbsp;</span></p>
        </div>
      </div>
    </div>
  </footer>
