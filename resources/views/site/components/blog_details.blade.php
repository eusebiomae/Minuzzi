{{-- @foreach ($pageData->content as $item)
	<section id="blog_details" class="section section-xxl swiper-slide-blog" style="background-image: url('{{$item['image_bg']}}');">
		<div class="container">
			<!-- Owl Carousel-->
			<div class="owl-carousel" data-items="1" data-sm-items="2" data-lg-items="3" data-margin="30" data-dots="true" data-mouse-drag="false">


				<!-- Post Classic-->
				<article class="post post-classic box-md wow slideInDown">
					<a class="post-classic-figure" href="blog-post.html"><img src="{{$blog->image}}" alt="" width="370" height="239"/></a>
					<div class="post-classic-content">
						<div class="post-classic-time">
							<time datetime="2020-08-09">{{$blog->scheduling_date}}</time>
						</div>
						<h5 class="post-classic-title">{{$blog->title_pt}}</h5>
						<p class="post-classic-text">{{!! $blog->text_pt !!}}</p>

						<a class="entry-more" href="blog_post_details/{{$blog->id}}" data-toggle="modal" data-target="#model-quote{{ $blog->id }}" id="modelquote{{ $blog->id }}"><i class="fa fa-plus"></i>
							<span>Ler mais</span>
						</a>
					</div>
				</article>
			</div>
		</div>
	</div>
</section>
@endforeach --}}

@foreach ($pageData->content as $item)
<section class="section section-xl bg-default text-md-left">
	<div class="container">
		<div class="row row-50 row-md-60">
			<div class="col-lg-12 col-xl-12">
				<div class="inset-xl-right-100">
					<div class="row row-50 row-md-60 row-lg-80">
						<div class="col-sm-12 col-md-12 col-xl-12">
							<article class="post post-modern-1 box-xxl">
								<div class="post-modern-panel">
									{{-- <div>{{ $blog->category }}</div> --}}
									<div><span class="icon mdi mdi-calendar-clock"></span>
										<time class="post-modern-time"
										datetime="2020-09-08">{{ $blog->scheduling_date }}</time>
									</div>
									<div><span class="icon mdi mdi-account"></span>
										<time class="post-modern-time"
										datetime="2020-09-08">{{__('blog.by')}}{{ $blog->author }}</time>
									</div>
								</div>
								<h3 class="post-modern-title">{{ internation($blog, 'title') }}</h3><hr/>
								<div class="post-modern-figure"><img src="{{ $blog->image }}" alt="" width="800"
									height="394" />
								</div>
								<p class="post-modern-text">{!! internation($blog, 'text') !!}</p>
							</article>
							<!-- Quote Classic-->
							<article class="quote-classic quote-classic-2">
								<div class="quote-classic-text">
									<div class="q">{{ $blog->tags }}</div>
								</div>
							</article>
							<div class="single-post-bottom-panel">
								<div class="group-sm group-justify">
									<div>
										<div class="group-xs group-middle"><span
											class="list-social-title">{{__('blog.share')}}</span>
											<div>
												<ul class="list-inline list-social list-inline-sm">
													<li><a title="Facebook" class="icon mdi mdi-facebook" href="" id="facebook-share-btt" rel="nofollow" target="_blank" class="facebook-share-button"></a></li>
													<li><a title="Twitter" class="icon mdi mdi-twitter" href="" id="twitter-share-btt" rel="nofollow"
														target="_blank" class="twitter-share-button"></a></li>
														{{-- <li><a title="E-mail" class="icon mdi mdi-email" href="" id="mail-share-btt" rel="nofollow" target="_blank" class="mail-share-button"></a></li> --}}
														<li><a title="Whatsapp" class="icon mdi mdi-whatsapp" href="" id="whatsapp-share-btt" rel="nofollow" target="_blank"></a></li>
														{{-- <li><a class="icon mdi mdi-linkedin" href="" id="linkedin-share-btt" rel="nofollow" target="_blank" class="linkedin-share-button"></a></li> --}}
														<li><a title="Telegram" class="icon mdi mdi-telegram" href="" id="telegram-share-btt" rel="nofollow" target="_blank" class="telegram-share-button"></a></li>
														{{-- <li><a title="Pinterest" class="icon mdi mdi-pinterest" href="" id="pinterest-share-btt" rel="nofollow" target="_blank" class="pinterest-share-button"></a></li> --}}
														{{-- <li><a class="icon mdi mdi-google-plus" href="" id="google-plus-share-btt" rel="nofollow" target="_blank" class="google-plus-share-button"></a></li> --}}
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script>
			//Constrói a URL depois que o DOM estiver pronto FACEBOOK
			document.addEventListener("DOMContentLoaded", function() {
				//altera a URL do botão
				document.getElementById("facebook-share-btt").href = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(window.location.href);
			}, false);

			//Constrói a URL depois que o DOM estiver pronto TWITTER
			document.addEventListener("DOMContentLoaded", function() {
				var url = encodeURIComponent(window.location.href);
				var titulo = encodeURIComponent(document.title);
				//var via = encodeURIComponent("usuario-twitter"); //nome de usuário do twitter do seu site
				//altera a URL do botão
				document.getElementById("twitter-share-btt").href = "https://twitter.com/intent/tweet?url=" + url +
				"&text=" + titulo;

				//se for usar o atributo via, utilize a seguinte url
				//document.getElementById("twitter-share-btt").href = "https://twitter.com/intent/tweet?url="+url+"&text="+titulo+"&via="+via;
			}, false);

			//Constrói a URL depois que o DOM estiver pronto EMAIL
			document.addEventListener("DOMContentLoaded", function() {
				var url = window.location.href; //url
				var title = encodeURIComponent(document.title); //título
				var mailToLink = "mailto:?subject="+title;

				//tenta obter o conteúdo da meta tag description
				var desc = document.querySelector("meta[name='description']");
				desc = (!!desc)? desc.getAttribute("content") : null;

				//se a meta tag description estiver ausente...
				if(!desc){
					//...tenta obter o conteúdo da meta tag og:description
					desc = document.querySelector("meta[property='og:description']");
					desc = (!!desc)? desc.getAttribute("content") : null;
				}
				//Se houver descrição, combina a descrição com a url
				//senão o corpo da mensagem terá apenas a url
				var body = (!!desc)? desc + " " + url : url;
				//altera o link do botão
				mailToLink = mailToLink + "&body=" + encodeURIComponent(body);
				document.getElementById("mail-share-btt").href = mailToLink;
			}, false);

			//Constrói a URL depois que o DOM estiver pronto WHASTAPP
			document.addEventListener("DOMContentLoaded", function() {
				//conteúdo que será compartilhado: Título da página + URL
				var conteudo = encodeURIComponent(document.title + " " + window.location.href);
				//altera a URL do botão
				document.getElementById("whatsapp-share-btt").href = "https://api.whatsapp.com/send?text=" + conteudo;
			}, false);

			//Constrói a URL depois que o DOM estiver pronto LINKEDIN
			document.addEventListener("DOMContentLoaded", function() {
				var url = encodeURIComponent(window.location.href); //url
				var titulo = encodeURIComponent(document.title); //título
				var linkedinLink = "https://www.linkedin.com/shareArticle?mini=true&url="+url+"&title="+titulo;

				//tenta obter o conteúdo da meta tag description
				var summary = document.querySelector("meta[name='description']");
				summary = (!!summary)? summary.getAttribute("content") : null;

				//se a meta tag description estiver ausente...
				if(!summary){
					//...tenta obter o conteúdo da meta tag og:description
					summary = document.querySelector("meta[property='og:description']");
					summary = (!!summary)? summary.getAttribute("content") : null;
				}
				//altera o link do botão
				linkedinLink = (!!summary)? linkedinLink + "&summary=" + encodeURIComponent(summary) : linkedinLink;
				document.getElementById("linkedin-share-btt").href = linkedinLink;
			}, false);


			//Constrói a URL depois que o DOM estiver pronto TELEGRAM
			document.addEventListener("DOMContentLoaded", function() {
				var url = encodeURIComponent(window.location.href); //url
				var title = encodeURIComponent(document.title); //título
				var telegramLink = 'https://telegram.me/share/url?url=' + url + '&text=' + title;
				document.getElementById("telegram-share-btt").href = telegramLink;
			}, false);

			//Constrói a URL depois que o DOM estiver pronto PINTEREST
			document.addEventListener("DOMContentLoaded", function() {
				var url = encodeURIComponent(window.location.href);

				//tenta obter o conteúdo da meta tag description
				var desc = document.querySelector("meta[name='description']");
				desc = (!!desc)? desc.getAttribute("content") : null;

				//se a meta tag description estiver ausente...
				if(!desc){
					//...tenta obter o conteúdo da meta tag og:description
					desc = document.querySelector("meta[property='og:description']");
					desc = (!!desc)? desc.getAttribute("content") : null;
				}

				//metas tags description e og:description ausentes
				if(!desc){
					//obtém title
					desc = document.title;
				}

				//altera a URL do botão
				document.getElementById("pinterest-share-btt").href = "https://www.pinterest.com/pin/create/button/?url="+url+"&description="+encodeURIComponent(desc);
			}, false);

		</script>

	</section>
	@endforeach
