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
				<h2>Bem vindo à GigaPixel | &pi;+ Administração de Site</h2>
				<small>
					Neste painel de administração de site, você tem todos os recursos de forma prática e fácil.
				</small>
			</div>
		</div>
	</div>

	<div class="row" style="padding-top: 30px">

		@if (GigaGetData::getPageConfig('prospect'))
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
		@endif

		@if (GigaGetData::getPageConfig('prospect'))
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
		@endif

		@if (GigaGetData::getPageConfig('guestbook'))
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
		@endif

		{{-- @if (enableMenuItemAdmin('admin.prospection'))
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

		{{-- <a href="{{ url('/admin/content') }}">
			<div class="col-md-3">
				<div class="ibox-content text-center">
					<div class="m-b-sm">
						<i class="fa fa-cubes fa-5x"></i>
					</div>
					<h1>Conteúdo</h1>
					<p class="font-bold">Editar conteúdo do site</p>
				</div>
			</div>
		</a>
		<a href="{{ url('/admin/slide') }}">
			<div class="col-md-3">
				<div class="ibox-content text-center">
					<div class="m-b-sm">
						<i class="fa fa-image fa-5x"></i>
					</div>
					<h1>Slides</h1>
					<p class="font-bold">Editar slides do site</p>
				</div>
			</div>
		</a>
		<a href="{{ url('/admin/testemonial') }}">
			<div class="col-md-3">
				<div class="ibox-content text-center">
					<div class="m-b-sm">
						<i class="fa fa-commenting fa-5x"></i>
					</div>
					<h1>Depoimentos</h1>
					<p class="font-bold">Editar Depoimentos</p>
				</div>
			</div>
		</a> --}}
	</div>

	<div class="row" style="padding-top: 30px">
		@if (GigaGetData::getPageConfig('schoolInformation'))
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
		@endif

		@if (GigaGetData::getPageConfig('user'))
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

		@if (GigaGetData::getPageConfig('course'))
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
		@endif

		@if (GigaGetData::getPageConfig('class'))
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
		@endif
	</div>

	<div class="row" style="padding-top: 30px">
		@if (GigaGetData::getPageConfig('blog'))
		<a href="{{ url('/admin/blog') }}">
			<div class="col-md-3">
				<div class="ibox-content text-center">
					<div class="m-b-sm">
						<i class="fa fa-bold fa-5x"></i>
					</div>
					<h1>Blog</h1>
					<p class="font-bold">Editar Blog</p>
				</div>
			</div>
		</a>
		@endif
		{{-- <a href="{{ url('/admin/alimentation') }}">
			<div class="col-md-3">
				<div class="ibox-content text-center">
					<div class="m-b-sm">
						<i class="fa fa-cutlery fa-5x"></i>
					</div>
					<h1>Alimentação</h1>
					<p class="font-bold">Editar Alimentação/p>
					</div>
				</div>
			</a>
			<a href="{{ url('/admin/event') }}">
				<div class="col-md-3">
					<div class="ibox-content text-center">
						<div class="m-b-sm">
							<i class="fa fa-calendar fa-5x"></i>
						</div>
						<h1>Eventos/Calendário</h1>
						<p class="font-bold">Editar Eventos/Calendário</p>
					</div>
				</div>
			</a>
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
			</a> --}}
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
