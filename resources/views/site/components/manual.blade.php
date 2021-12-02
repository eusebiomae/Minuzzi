<!-- Upcoming Events-->
@foreach ($pageData->content as $item)
    <section class="section section-variant-1 bg-default novi-bg novi-bg-img"
        data-preset='{"title":"Events list","category":"blog","reload":false,"id":"events-list"}'>
        <div class="container-wide">
            <div class="row justify-content-xl-end row-30">
                <div class="col-xl-8">
                    <div class="parallax-text-wrap">
                        <h3>Manuais</h3><span class="parallax-text">Minuzzi</span>
                    </div>
                    <hr class="divider divider-default">
                </div>
                <div class="col-xl-3 text-xl-end">
                    {{-- <a class="button button-secondary button-nina" href="/blog">ver todos</a> --}}
                </div>
            </div>

            {{-- @foreach ($manuals as $manual) --}}
            <div class="row row-50">
                <div class="col-md-3 col-xl-3">
                    <article class="event-default-wrap">
                        <div class="event-default">
                            <a href="{{ url ('assets/docs/MODELO_DE_MEDIÇÃO_TMC_220-380-440V.pdf')}}" target="blank">
                                <figure class="event-default-image"><img src="{{ url ('assets/docs/pdf_image.png') }}" alt="" width="200"
                                        height="200" style="margin: 35px;"/>
                                </figure>
                            </a>
                            <div class="event-default-date-wrap">
                                <time datetime="2021">
                                    <span class="event-default-date" style="text-align: center">{{ internation($item, 'title') }}</span>
                                </time>
                            </div>
                            {{-- <div class="event-default-caption"><a
                                        class="button button-xs button-secondary button-nina"
                                        href="blog_details/{{ $item->id }}">ver detalhes</a></div> --}}
                        </div>
                        {{-- <div class="event-default-inner">
                            <div class="box-inline">
                            </div>
                            <h5 style="text-align: center"><a class="event-default-title" style="text-align: center"
                                    href="#">{{ internation($item, 'subtitle') }}</a></h5>
                        </div> --}}
                    </article>
                </div>
            </div>
            {{-- @endforeach --}}
        </div>
    </section>
@endforeach
