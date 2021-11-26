@extends('layouts.site.site')

@section('title', 'Home')

@section('content')
<!-- Page Title
============================================= -->
<section class="bg-overlay bg-overlay-gradient pb-0">
	<div class="bg-section" >
		<img src="{!! asset('storage/slides/' . $results->slide[0]->image) !!}" alt="Background"/>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="page-title title-1 text-center">
					<div class="title-bg">
						<h2>{{ internation($results->slide[0], 'title')}}</h2>
					</div>
					<ol class="breadcrumb">
						<li><a href="/home">{{ trans('menu.home')}}</a></li>
						<li><a href="#">{{ trans('menu.bilingualTeaching')}}</a></li>
						<li class="active">{{ trans('menu.bilingualism')}}</li>
					</ol>
				</div>
				<!-- .page-title end -->
			</div>
			<!-- .col-md-12 end -->
		</div>
		<!-- .row end -->
	</div>
	<!-- .container end -->
</section>

<!-- Shortcode #1 
============================================= -->
<section id="shotcode-1" class="shotcode-1 text-center-xs text-center-sm">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="heading heading-4">
							<div class="heading-bg heading-right">
								<p class="mb-0">{{ internation($results->bilingualism[0], 'subtitle') }}</p>
								<h2>{{ internation($results->bilingualism[0], 'title')}}</h2>
							</div>
						</div>
						<!-- .heading end -->
					</div>
				</div>
			</div>
			<!-- .col-md-12 end -->
			<div class="col-xs-12 col-sm-12 col-md-12">
			
				{{--  <p class="mb-60">A Bee Happy, apesar de ser uma escola bilíngue, segue a estrutura curricular estipulada pelo MEC. Aqui o aprendizado de dois idiomas simultaneamente nada mais é do que uma ferramenta de aprendizagem na qual as crianças podem se desenvolver globalmente.</p>
				<p class="mb-60">Abaixo respondemos algumas dúvidas mais frequentes. No entanto, é importante que você venha conhecer a escola, clique aqui para agendar uma visita.</p>  --}}
				
				<?= internation($results->bilingualism[0], 'text') ?>
				<!-- <a class="btn btn-secondary mb-30-xs" href="#">Proposta Pedagógica</a> -->
			</div>
			<!-- .col-md-6 end -->
		</div>
		<!-- .row end -->
	</div>
	<!-- .container end -->
</section>

<section>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="heading heading-4">
							<div class="heading-bg heading-right">
								<p class="mb-0">{{ internation($results->questions[0], 'subtitle') }}</p>
								<h2>{{ internation($results->questions[0], 'title') }}</h2>
							</div>
						</div>
						<!-- .heading end -->
					</div>
				</div>
			</div>
			<!-- .col-md-12 end -->
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="panel-group accordion" id="accordion02" role="tablist" aria-multiselectable="true">
					@foreach($results->questions as $item)
					<!-- Panel 01 -->
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="{{ $item->id}} ">
							<h4 class="panel-title">
								<a class="accordion-toggle" 
									role="button" 
									data-toggle="collapse" 
									data-parent="#accordion02" 
									href="#collapse02-{{ $item->id}}" 
									aria-expanded="true" 
									aria-controls="collapse02-{{ $item->id}}"> {{ internation($item, 'title') }}  
								</a>
								<span class="icon"></span>
							</h4>
						</div>
						<div id="collapse02-{{ $item->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="{{ $item->id}} ">
							<div class="panel-body">
								<?= internation($item, 'text') ?>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<!-- End .Accordion-->
			</div>
			{{--  <div class="col-xs-12 col-sm-12 col-md-12">
				<div class="panel-group accordion" id="accordion02" role="tablist" aria-multiselectable="true">
					
					<!-- Panel 01 -->
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingOne">
							<h4 class="panel-title">
								<a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion02" href="#collapse02-1" aria-expanded="true" aria-controls="collapse02-1"> O que é Bilinguismo de Imersão? </a>
								<span class="icon"></span>
							</h4>
						</div>
						<div id="collapse02-1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">
								A Bee Happy é uma escola bilíngue de imersão, ou seja, nela, nos comunicamos a maior tempo em inglês. De acordo com Baker (2001) para assegurar que as crianças sejam capazes de ouvir, entender e se comunicar na segunda língua é necessário que a imersão aconteça entre 4 e 6 horas por dia. Utilizamos uma abordagem conhecida como “Communicative Approach”. Este método, segundo Richards e Rogers (1986), propõe uma abordagem da língua inglesa através de situações cotidianas comuns ao universo do aluno, ou seja, o aluno pratica o idioma em situações reais de comunicação através da contextualização, construindo um significado. Assim, ensinamos a criança a se comunicar de maneira natural, sem dificuldades, da mesma forma como aprendeu sua língua materna. 
							</div>
						</div>
					</div>
					
					<!-- Panel 02 -->
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingTwo">
							<h4 class="panel-title">
								<a class="accordion-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion02" href="#collapse02-2" aria-expanded="false" aria-controls="collapse02-2"> Existe uma idade adequada para entrar em contato com o novo idioma? </a>
							</h4>
						</div>
						<div id="collapse02-2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
							<div class="panel-body">
								<strong>Estudos atuais apontam que quanto mais cedo a criança entra em contato com uma segunda língua, mais efetiva será esta aquisição (Baker, 1989).</strong> Nas crianças pequenas, o hemisfério esquerdo do cérebro ainda está estabelecendo conexões neuronais, por isso, elas aprendem uma segunda língua com mais facilidade e adquirem uma pronúncia mais aproximada com a pronúncia dos nativos (Brown, 1980).
							</div>
						</div>
					</div>
					
					<!-- Panel 03 -->
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingThree">
							<h4 class="panel-title">
								<a class="accordion-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion02" href="#collapse02-3" aria-expanded="false" aria-controls="collapse02-3"> COMO FUNCIONA O ENSINO BILÍNGUE? </a>
							</h4>
						</div>
						<div id="collapse02-3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
							<div class="panel-body">
								Crianças aprendem uma língua através das interações sociais vivenciadas. Constroem o conhecimento da língua ouvindo outras pessoas e aprendem as construções verbais adequadas a medida que aprendem a falar. Com uma segunda língua não é diferente. No início irão memorizar algumas frases e palavras, depois começam a montar frases, comentem erros, mas isso faz parte do processo de aprendizado. É normal que neste início a criança continue utilizando a língua nativa. Logo após haverá um período não-verbal, em que a criança, observando e escutando os professores, começa a entender as frases e comandos na segunda língua, mas ainda não se sente confortável vocalizando. Depois, como se estivessem aprendendo a falar novamente, irão usar frases feitas até conseguirem se expressar na nova língua. Não se preocupe se ocasionalmente a criança misture as dois idiomas, é normal. Isto ocorre, geralmente, quando a criança está tentando clarificar uma idéia ou ambiguidade, ou então quando estão tentando comunicar uma expressão que ainda não sabem na segunda língua (Garcia, 2002). <br><br>A Bee Happy trabalha o conteúdo acadêmico nas duas línguas, isto porque o aprendizado de um novo idioma deve ser contextualizado e ter sentido. Seguindo a pedagogia de projetos, os professores são capacitados para planejar as aulas em torno das quatro habilidades da língua: ouvir, falar, ler e escrever, apreendendo todo o conteúdo desenvolvido.

							</div>
						</div>
					</div>
				</div>
				<!-- End .Accordion-->
			</div>  --}}
			<!-- .col-md-6 end -->
		</div>
		<!-- .row end -->
	</div>
	<!-- .container end -->
</section>
@endsection