	<!-- Blog-->
	@foreach ($pageData->content as $item)
	<section class="section section-xl bg-gray-lighter novi-bg novi-bg-img" data-preset='{"title":"Blog grid","category":"blog","reload":true,"id":"blog-classic"}'>
		<!-- section wave-->
		<div class="section-wave">
			<svg x="0px" y="0px" width="1920px" height="46px" viewbox="0 0 1920 46" preserveAspectRatio="none">
				<path d="M1920,0.5c-82.8,0-109.1,44-192.3,44c-78.8,0-116.2-44-191.7-44c-77.1,0-115.9,44-192,44c-78.2,0-114.6-44-192-44c-78.4,0-115.3,44-192,44c-76.9-0.1-119-44-192-44c-77,0-115.2,44-192,44c-73.6,0-114-44-190.9-44c-78.5,0-117.2,44-194.1,44c-75.9,0-113-44-191-44V46h1920V0.5z"></path>
			</svg>
		</div>

		<div class="container container-bigger">
			<div class="row row-fix row-ten row-50 row-md-90 justify-content-md-center justify-content-xl-between">
				<div class="col-md-9 col-lg-7 col-xl-6 text-center">
					<div class="row row-30">
						@foreach ($blogs as $blog)
						<div class="col-md-6">

							<article class="post-blog"><a class="post-blog-image" href="blog_details/{{$blog->id}}"><img src="{{ $blog->image }}" alt="" width="420" height="305"/></a>
								<div class="post-blog-caption">
									<div class="post-blog-caption-header">
										<ul class="post-blog-tags">
											<li><a class="button-tags" href="blog_details/{{$blog->id}}">{{$blog->blogCategory->description_pt}}</a></li>
										</ul>
										<ul class="post-blog-meta">
											<li><span>{{__('blog.by')}}</span>&nbsp;{{ $blog->author }}</li>
										</ul>
									</div>
									<div class="post-blog-caption-body">
										<h5><a class="post-blog-title" href="blog_details/{{$blog->id}}">{!! internation($blog, 'title') !!}</a></h5>
										<p>{!! internation($blog, 'subtitle') !!}</p>
									</div>
									<div class="post-blog-caption-footer">
										<time datetime="2021">{{ $blog->scheduling_date }}</time>
									</div>
								</div>
							</article>

						</div>
						@endforeach
					</div>

				</article><a class="button button-default-outline button-nina button-block button-blog" href="#">{{__('blog.more')}}</a>
				{{-- <ul class="pagination-custom">
					<li class="active"><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
				</ul> --}}
			</div>

			<div class="col-md-4 col-lg-4 col-xl-3 blog-aside">
				<div class="blog-aside-item">
					<h6>{{__('blog.search')}}</h6>
					<form class="rd-search rd-search-modern" action="search-results.html" method="GET">
						<div class="form-wrap">
							<input class="rd-search-input form-input" id="rd-search-input" type="text" name="s" autocomplete="off">
							<label class="form-label form-label" for="rd-search-input">{{__('blog.search')}}</label>
						</div>
						<button class="button mdi mdi-magnify" type="submit"></button>
					</form>
				</div>
				<div class="blog-aside-item">
					<h6>{{__('blog.file')}}</h6>
					<ul class="list-marked list-marked-secondary">
						<li><a href="#">January 2020</a></li>
						<li><a href="#">February 2020</a></li>
						<li><a href="#">March 2020</a></li>
						<li><a href="#">April 2020</a></li>
						<li><a href="#">May 2020</a></li>
					</ul>
				</div>
				<div class="blog-aside-item">
					<h6>categories</h6>
					<ul class="list-marked list-marked-secondary">
						<li><a href="#">Solar</a></li>
						<li><a href="#">Trifásico</a></li>
						<li><a href="#">Monofásico</a></li>
						<li><a href="#">Trifásicos Isoladores</a></li>
						<li><a href="#">Baixa Tensão</a></li>
						<li><a href="#">Indutores</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
@endforeach
