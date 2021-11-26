	<!-- Blog-->
	@foreach ($pageData->content as $item)
	<section class="section section-xl bg-gray-lighter novi-bg novi-bg-img" data-preset='{"title":"Blog classic","category":"blog","reload":true,"id":"blog-classic"}'>
		<!-- section wave-->
		<div class="section-wave">
				<svg x="0px" y="0px" width="1920px" height="46px" viewbox="0 0 1920 46" preserveAspectRatio="none">
		<path d="M1920,0.5c-82.8,0-109.1,44-192.3,44c-78.8,0-116.2-44-191.7-44c-77.1,0-115.9,44-192,44c-78.2,0-114.6-44-192-44c-78.4,0-115.3,44-192,44c-76.9-0.1-119-44-192-44c-77,0-115.2,44-192,44c-73.6,0-114-44-190.9-44c-78.5,0-117.2,44-194.1,44c-75.9,0-113-44-191-44V46h1920V0.5z"></path>
	</svg>
		</div>
		<div class="container container-bigger">
				<div class="row row-ten row-50 row-md-90 justify-content-md-center justify-content-xl-between">
						<div class="col-md-9 col-lg-6 blog-classic-main text-center" style="margin-inline: 250px;">
								<!-- Post classic-->
								@foreach ($blogs as $blog)
								<article class="post-classic">
										<a class="post-classic-media" href="blog_details/{{$blog->id}}"><img src="{{ $blog->image }}" alt="" width="870" height="580" /></a>
										<div class="post-classic-body">
												<p class="post-classic-title"><a href="blog_details/{{$blog->id}}">{{ internation($blog, 'title') }}</a></p>
												<ul class="post-classic-meta">
														<li><span class="icon mdi mdi-account"></span><span>{{__('blog.by')}} {{ $blog->author }}</span></li>
														<li><span class="icon mdi mdi-calendar-clock"></span>
																<time datetime="2021-09-08">{{ $blog->scheduling_date }}</time>
														</li>
														{{-- <li><span class="icon mdi mdi-tag"></span>Business</li> --}}
												</ul>
												<div class="post-classic-text">
														<p>{!! internation($blog, 'text') !!}</p>
												</div>
												<div class="post-classic-footer"><a class="button button-sm button-secondary button-nina" href="blog_details/{{$blog->id}}">{{__('blog.read')}}</a>
														<div>
																{{-- <ul class="post-classic-info">
																		<li><span class="icon mdi mdi-eye"></span><span>193</span></li>
																		<li><a href="blog_details/id"><span class="icon mdi mdi-comment"></span><span>3</span></a></li>
																</ul> --}}
														</div>
												</div>
										</div>
								</article>
								@endforeach

								</article><a class="button button-default-outline button-nina button-block button-blog" href="#">{{__('blog.more')}}</a>
								{{-- <ul class="pagination-custom">
										<li class="active"><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a href="#">4</a></li>
								</ul> --}}
						</div>

						<div class="col-md-9 col-lg-4 col-xl-3 blog-aside">
								{{-- <div class="blog-aside-item">
										<h6>{{__('blog.search')}}</h6>
										<form class="rd-search rd-search-modern" action="search-results.html" method="GET">
												<div class="form-wrap">
														<input class="rd-search-input form-input" id="rd-search-input" type="text" name="s" autocomplete="off">
														<label class="form-label form-label" for="rd-search-input">{{__('blog.search')}}</label>
												</div>
												<button class="button mdi mdi-magnify" type="submit"></button>
										</form>
								</div> --}}
								{{-- <div class="blog-aside-item">
										<h6>{{__('blog.file')}}</h6>
										<ul class="list-marked list-marked-secondary">
												<li><a href="#">January 2020</a></li>
												<li><a href="#">February 2020</a></li>
												<li><a href="#">March 2020</a></li>
												<li><a href="#">April 2020</a></li>
												<li><a href="#">May 2020</a></li>
										</ul>
								</div> --}}
								{{-- <div class="blog-aside-item">
										<h6>About us</h6>
										<p>Made to be used by anyone who is looking for a stunning multifunctional website, this template is a universal solution, which can be used already after being installed. It differs from other similar projects in everything -
												be it the initial concept or the final look.</p><a class="button button-xs button-default-outline button-nina" href="about-us.html">learn more</a>
								</div>
								<div class="blog-aside-item">
										<h6>categories</h6>
										<ul class="list-marked list-marked-secondary">
												<li><a href="#">Business</a></li>
												<li><a href="#">Tips & Tricks</a></li>
												<li><a href="#">Reviews</a></li>
												<li><a href="#">News</a></li>
												<li><a href="#">Marketing</a></li>
										</ul>
								</div> --}}
								{{-- <div class="blog-aside-item">
										<h6>twitter feed</h6>
										<ul class="twitter list-twitter" data-twitter-username="templatemonster">
												<li data-twitter-type="tweet">
														<div class="unit flex-sm-row">
																<div class="unit-left"><span class="mdi mdi-twitter twitter-icon icon-md-middle"></span></div>
																<div class="unit-body">
																		<p data-tweet="text"></p>
																		<time data-date="text" data-datetime="datetime" datetime="2020"></time>
																</div>
														</div>
												</li>
										</ul>
								</div> --}}
								{{-- <div class="blog-aside-item post-minimal-wrapper">
										<h6>recent blog posts</h6>
										<!-- Post minimal-->
										<article class="post-minimal">
												<p class="post-minimal-title"><a href="single-post.html">How to Turn Small Talk Into Smart Conversation</a></p>
												<time class="post-minimal-time" datetime="2020">Feb 27, 2020 at 5:47 pm</time>
										</article>
										<!-- Post minimal-->
										<article class="post-minimal">
												<p class="post-minimal-title"><a href="single-post.html">The Top 5 Reasons Why ‘The Customer Is Always Right’ Is Wrong</a></p>
												<time class="post-minimal-time" datetime="2020">Feb 27, 2020 at 5:47 pm</time>
										</article>
										<!-- Post minimal-->
										<article class="post-minimal">
												<p class="post-minimal-title"><a href="single-post.html">It’s 10 AM. Do You Know What Your Sales Reps Are Doing?</a></p>
												<time class="post-minimal-time" datetime="2020">Feb 27, 2020 at 5:47 pm</time>
										</article>
								</div> --}}
								{{-- <div class="blog-aside-item">
										<!-- Facebook Feed-->
										<div id="fb-root">
												<div class="fb-page-responsive">
														<div class="fb-page" data-href="https://www.facebook.com/TemplateMonster" data-tabs="timeline" data-height="540" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
																<div class="fb-xfbml-parse-ignore">
																		<blockquote cite="https://www.facebook.com/TemplateMonster"><a href="https://www.facebook.com/TemplateMonster">TemplateMonster</a></blockquote>
																</div>
														</div>
												</div>
										</div>
								</div> --}}
						</div>
				</div>
		</div>
</section>
@endforeach
