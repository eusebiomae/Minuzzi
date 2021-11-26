<section>
<!-- wirt_projects_context -->
	@foreach ($pageData->content as $items)
		<div id="our-products" class=" wirt_projects_context">
			<div class="prot_wrap">
				<div class="container">
					<div class="row">
						<div class=" col-md-12">
							<div class="witr_section_title">
								<div class="witr_section_title_inner text-center">
									<!-- title top -->
									<h2 class="h2-important">{{ $items['title_pt'] }}</h2>
									<!-- title middle -->
									<h3 class="h1">{{ $items['subtitle_pt']}}</h3>
									<!-- content -->
									<div>{!! $items['text_pt'] !!}</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 ">
							<div class="portfolio_nav  wittr_pfilter_menu">
								<ul id="filter" class="filter_menu ">
									<li class="current_menu_item" data-filter=".featured">Destaque</li>
									<li data-filter=".best_seller">Mais Vendidos</li>
									<li data-filter=".new_flavor">Novos Sabores</li>
									<li data-filter="*">Todos</li>
								</ul>
							</div>
							<div class="em_load witr_top">

								<!-- single portfolio -->
								@foreach ($courses as $item)
								<div class="col-lg-3  grid-item col-md-6 col-sm-12 {{ $item['show_home']}} {{ $item['best_seller']}} {{ $item['new_flavor']}}  ">
									<div class="single_protfolio">
										<div class="card">
											<img class="card-img-top" src="{{ $item['img'] }}" alt="Imagem de capa do card">
												<div class="card-body  text-center">
													<a href="/product/{{ $item['id'] }}" class="btn_prod">Detalhes</a>
												</div>
											</div>
									</div>
								</div>
								@endforeach

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endforeach
</section>
