@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="text-center m-t-lg">
				<h1>
					Olá {{  Auth::user()->name }}
				</h1>
				<h2>Bem vindo à GigaPixel | CRM+ Administração de Contatos</h2>
				<small>
					Neste painel de administração de contatos, você tem todos os recursos de forma prática e fácil.
				</small>
			</div>
		</div>
	</div>

	<div class="row" style="padding-top: 30px">

		{{-- PROSPECT --}}
		{{-- @if (Auth::user()->admin === 'S' || Auth::user()->consultant === 'S')
			<a href="{{ url('/admin/prospection/prospect') }}">
				<div class="col-md-3">
					<div class="ibox-content text-center">
						<div class="m-b-sm">
							<i class="fa fa-address-card fa-5x"></i>
						</div>
						<h1>Prospect</h1>
						<p class="font-bold">Editar dados de Prospect</p>
					</div>
				</div>
			</a>
		@endif --}}

		{{-- AGENDA VISITA  --}}
		{{-- @if (Auth::user()->admin === 'S' || Auth::user()->consultant === 'S')
			<a href="{{ url('/admin/prospection/prospect') }}">
				<div class="col-md-3">
					<div class="ibox-content text-center">
						<div class="m-b-sm">
							<i class="fa far fa-calendar-alt fa-5x"></i>
						</div>
						<h1>Agenda de Visita</h1>
						<p class="font-bold">Visualizar as visitas agendadas</p>
					</div>
				</div>
			</a>
		@endif --}}

		{{-- LIVRO DE VISITAS --}}
		{{-- @if (Auth::user()->admin === 'S' || Auth::user()->consultant === 'S')
			<a href="{{ url('/admin/prospection/guestbook') }}">
				<div class="col-md-3">
					<div class="ibox-content text-center">
						<div class="m-b-sm">
							<i class="fa fa-address-book fa-5x"></i>
						</div>
						<h1>Livro de Visitas</h1>
						<p class="font-bold">Editar dados do livro de visita</p>
					</div>
				</div>
			</a>
		@endif --}}

		{{-- MATRICULA --}}
		{{-- @if (Auth::user()->admin === 'S' || Auth::user()->consultant === 'S')
			<a href="{{ url('/admin/prospection/class') }}">
				<div class="col-md-3">
					<div class="ibox-content text-center">
						<div class="m-b-sm">
							<i class="fas fa-check-square fa-5x"></i>
						</div>
						<h1>Matricula</h1>
						<p class="font-bold">Editar Registro de Matricula</p>
					</div>
				</div>
			</a>
		@endif --}}

		{{-- PÁGINA --}}
		<a href="{{ url('/admin/contentpage') }}">
			<div class="col-md-3 m-b-md">
				<div class="ibox-content text-center">
					<div class="m-b-sm">
						<i class="far fa-file-code fa-5x"></i>
					</div>
					<h1>Página</h1>
					<p class="font-bold">Editar Páginas</p>
				</div>
			</div>
		</a>

		{{-- SEÇÃO DE PÁGINA --}}
		<a href="{{ url('/admin/contentsection') }}">
			<div class="col-md-3 m-b-md">
				<div class="ibox-content text-center">
					<div class="m-b-sm">
						<i class="fas fa-puzzle-piece fa-5x"></i>
					</div>
					<h1>Seção Página</h1>
					<p class="font-bold">Editar Seção de Páginas</p>
				</div>
			</div>
		</a>

		{{-- CONTEUDO --}}
		<a href="{{ url('/admin/content') }}">
			<div class="col-md-3 m-b-md">
				<div class="ibox-content text-center">
					<div class="m-b-sm">
						<i class="fa fa-cubes fa-5x"></i>
					</div>
					<h1>Conteúdo</h1>
					<p class="font-bold">Editar conteúdo do site</p>
				</div>
			</div>
		</a>

		{{-- SLIDE  --}}
		<a href="{{ url('/admin/slide') }}">
			<div class="col-md-3 m-b-md">
				<div class="ibox-content text-center">
					<div class="m-b-sm">
						<i class="fa fa-image fa-5x"></i>
					</div>
					<h1>Slides</h1>
					<p class="font-bold">Editar slides do site</p>
				</div>
			</div>
		</a>

		{{-- TIPO DE PRODUTO  --}}
		<a href="{{ url('/admin/course_category_type') }}">
			<div class="col-md-3 m-b-md">
				<div class="ibox-content text-center">
					<div class="m-b-sm">
						{{-- <i class="fa fa-commenting fa-5x"></i> --}}
						<i class="fas fa-quote-right fa-5x"></i>
					</div>
					<h1>Tipo de Produto</h1>
					<p class="font-bold">Editar Tipo de Produto</p>
				</div>
			</div>
		</a>
		{{-- CATEGORIA DE PRODUTO  --}}
		<a href="{{ url('/admin/course_category') }}">
			<div class="col-md-3 m-b-md">
				<div class="ibox-content text-center">
					<div class="m-b-sm">
						<i class="fas fa-quote-left fa-5x"></i>
					</div>
					<h1>Categoria de Produto</h1>
					<p class="font-bold">Editar Categoria de Produto</p>
				</div>
			</div>
		</a>
		{{-- SUBCATEGORIA DE PRODUTO  --}}
		<a href="{{ url('/admin/course_subcategory') }}">
			<div class="col-md-3 m-b-md">
				<div class="ibox-content text-center">
					<div class="m-b-sm">
						<i class="fa fa-commenting fa-5x"></i>
					</div>
					<h1>Subategoria de Produto</h1>
					<p class="font-bold">Editar Subategoria de Produto</p>
				</div>
			</div>
		</a>
		{{-- PRODUTO  --}}
		<a href="{{ url('/admin/course') }}">
			<div class="col-md-3 m-b-md">
				<div class="ibox-content text-center">
					<div class="m-b-sm">
						<i class="fas fa-tags fa-5x"></i>
					</div>
					<h1>Produto</h1>
					<p class="font-bold">Editar Produto</p>
				</div>
			</div>
		</a>

		{{-- BLOG  --}}
		<a href="{{ url('/admin/blog') }}">
			<div class="col-md-3 m-b-md">
				<div class="ibox-content text-center">
					<div class="m-b-sm">
						<i class="fas fa-rss fa-5x"></i>
					</div>
					<h1>Blog</h1>
					<p class="font-bold">Editar Blog</p>
				</div>
			</div>
		</a>
		{{-- BLOG CATEGORIA --}}
		<a href="{{ url('/admin/blog/category') }}">
			<div class="col-md-3 m-b-md">
				<div class="ibox-content text-center">
					<div class="m-b-sm">
						<i class="fas fa-rss fa-5x"></i>
					</div>
					<h1>Blog</h1>
					<p class="font-bold">Editar Categoria Blog</p>
				</div>
			</div>
		</a>
		{{-- BLOG TAGS --}}
		<a href="{{ url('/admin/blog/tags') }}">
			<div class="col-md-3 m-b-md">
				<div class="ibox-content text-center">
					<div class="m-b-sm">
						<i class="fas fa-rss fa-5x"></i>
					</div>
					<h1>Blog</h1>
					<p class="font-bold">Editar Tags Blog</p>
				</div>
			</div>
		</a>


		@if (Auth::user()->admin === 'S')
			<a href="{{ url('/admin/schoolinformation') }}">
				<div class="col-md-3">
					<div class="ibox-content text-center">
						<div class="m-b-sm">
							<i class="fa fa-university fa-5x"></i>
						</div>
						<h1>Dados Empresa</h1>
						<p class="font-bold">Editar dados da Empresa</p>
					</div>
				</div>
			</a>
			<a href="{{ url('/admin/user') }}">
				<div class="col-md-3">
					<div class="ibox-content text-center">
						<div class="m-b-sm">
							<i class="fa fa-user fa-5x"></i>
						</div>
						<h1>Usuários</h1>
						<p class="font-bold">Editar dados do Usuário</p>
					</div>
				</div>
			</a>
		@endif

		{{-- CURSOS  --}}
		{{-- @if (Auth::user()->admin === 'S' || Auth::user()->consultant === 'S')
			<a href="{{ url('/admin/prospection/course') }}">
				<div class="col-md-3">
					<div class="ibox-content text-center">
						<div class="m-b-sm">
							<i class="fa fa-book fa-5x"></i>
						</div>
						<h1>Cursos</h1>
						<p class="font-bold">Editar dados dos cursos</p>
					</div>
				</div>
			</a>
		@endif --}}

		{{-- TURMAS  --}}
		{{-- @if (Auth::user()->admin === 'S' || Auth::user()->consultant === 'S')
			<a href="{{ url('/admin/prospection/class') }}">
				<div class="col-md-3">
					<div class="ibox-content text-center">
						<div class="m-b-sm">
							<i class="fa fa-graduation-cap fa-5x"></i>
						</div>
						<h1>Turmas</h1>
						<p class="font-bold">Editar dados das turmas</p>
					</div>
				</div>
			</a>
		@endif --}}

		@if (Auth::user()->admin === 'S' || Auth::user()->author === 'S')
			<a href="{{ url('/admin/blog') }}">
				<div class="col-md-3">
					<div class="ibox-content text-center">
						<div class="m-b-sm">
							<i class="fa fa-question-circle fa-5x"></i>
						</div>
						<h1>FAQ</h1>
						<p class="font-bold">Editar/Caastrar perguntas frequêntes</p>
					</div>
				</div>
			</a>
		@endif
		<a href="{{ url('/admin/team') }}">
			<div class="col-md-3">
				<div class="ibox-content text-center">
					<div class="m-b-sm">
						<i class="fa fa-users fa-5x"></i>
					</div>
					<h1>Equipe</h1>
					<p class="font-bold">Editar membros da Equipe</p>
				</div>
			</div>
		</a>
	</div>
	{{-- <div class="row" style="padding-top: 30px">
		<a href="{{ url('/admin/construction') }}">
			<div class="col-md-3">
				<div class="ibox-content text-center">
					<div class="m-b-sm">
						<i class="fa fa-building-o fa-5x"></i>
					</div>
					<h1>Estrutura</h1>
					<p class="font-bold">Editar espaços da unidade escolar</p>
				</div>
			</div>
		</a>
		<a href="{{ url('/admin/schoolinformation') }}">
			<div class="col-md-3">
				<div class="ibox-content text-center">
					<div class="m-b-sm">
						<i class="fa fa-user-plus fa-5x"></i>
					</div>
					<h1>Trabalhe Conosco</h1>
					<p class="font-bold">Editar dados de RH</p>
				</div>
			</div>
		</a>
	</div> --}}
</div>
@endsection
