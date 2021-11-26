<!DOCTYPE html>
<html lang="pt-br">
<head>
	{{-- MUDAR METATAGS --}}
	<?php $metaTags = [
		'url' => 'http://www.enar.com.br',
		'company' => 'Centro de Estudo em Terapia Cognitivo-Comportamental - São Paulo/SP',
		'keywords' => 'CETCC, psicologia, terapia comportamental, tcc, Terapia Cognitivo Comportamental, escola, são paulo, escola são paulo, pós-graduacao, especialização, psicólogo, beck, tcc do beck, especilização São Paulo',
		'description' => 'O CETCC é a Escola de Pós-graduacão em Terapia Cognitivo-comportamental de Beck que mais forma especialistas na abordagem, atualmente.',
		'Robots' => 'index, follow',
		'viewport' => 'width=device-width, initial-scale=1.0',
		'author' => 'GigaPixel -  Design & Technology',
	] ?>
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	@if (isset($pageComponents))
		@foreach ($pageComponents->metaTag as $metaTag)
			<?php $metaTags[$metaTag->name] = $metaTag->content ?>
		@endforeach
	@endif

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!--IE Compatibility Meta-->

	@foreach ($metaTags as $name => $content)
		<meta name="{{ $name }}" content="{{ $content }}" />
	@endforeach

	{{-- <link rel="icon" href="{!! asset('enar/images/favicon.ico') !!}" type="image/x-icon"> --}}
	<link rel="icon" href="{!! asset('enar/images/icon.png') !!}" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900">
	<link rel="stylesheet" href="{!! asset('enar/css/bootstrap.css') !!}">
	<link rel="stylesheet" href="{!! asset('enar/css/fonts.css') !!}">
	<link rel="stylesheet" href="{!! asset('enar/css/style.css') !!}">
	<link rel="stylesheet" href="{!! asset('css/plugins/sweetalert/sweetalert.css') !!}">

	@yield('css')
	{{-- <link href="{!! asset('cetcc/css/style.css') !!}" rel="stylesheet">
	<link href="{!! asset('cetcc/css/custom.css') !!}" rel="stylesheet"> --}}
	<link href="{!! asset('enar/css/custom.css') !!}" rel="stylesheet">
	<title>@yield('title') | Enar </title>
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Global site tag (gtag.js) - Google Analytics -->
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-146580573-1');
</script>
</head>
<body>
	<div class="page" id="page1">
		<!-- Page wrapper -->
		@include('site.components.preloader')
		@include('site.layout.topnavbar')
		<main>
			<!-- Main view  -->
			@yield('content')
		</main>

		<!-- Footer -->
		@include('site.layout.footer')
	</div>
@show
<!-- Footer Scripts
	============================================= -->
	<script src="{!! asset('js/plugins/sweetalert/sweetalert.min.js') !!}"></script>
	<script src="{!! asset('enar/js/core.min.js') !!}"></script>
	<script src="{!! asset('enar/js/script.js') !!}"></script>
	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		})
	</script>
  @yield('scripts')

</body>
</html>
