@extends('layouts.auth')

@section('content')

  <div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
      <div>
        <h1 class="logo-name">&pi;+</h1>
      </div>
      <h3>Bem vindo ao 3,14159265359</h3>
      <p>PI+ é um painel de gestão de cursos feito para sua instituição estar cada vez mais próximo dos seus alunos</p>
      <p>Faça login. Tenha tudo a um click.</p>
      <form method="post" action="{{ route('admin.login.submit') }}" class="m-t" role="form">
				{{ csrf_field() }}
        <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
          <input type="text" name="user_name" class="form-control" value="{{ old('user_name') }}" placeholder="Usuário" required autofocus>

					@if ($errors->has('user_name'))
						<span class="help-block">
							<strong>{{ $errors->first('user_name') }}</strong>
						</span>
					@endif
        </div>
				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<input type="password" name="password" class="form-control" placeholder="Senha" required>
					@if ($errors->has('password'))
						<span class="help-block">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif
				</div>
				{{-- <div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
							</label>
						</div>
					</div>
				</div> --}}
				<button type="submit" class="btn btn-primary block full-width m-b">Entrar</button>

				<a href="{{ route('admin.password.request') }}"><small>Esqueceu a senha?</small></a>

			</form>
		</div>
		<br><br><br>
		<a href="http://gigapixel.com.br">
			<img src="{!! asset('images/gigapixel.png') !!}" style="width: 200px;" >
			<p class="m-t"> <small>GigaPixel - Design & Technology &copy; 2014 - <?= date('Y'); ?></small> </p>
		</a>
	</div>

	<!-- Mainly scripts -->
	<script src="{!! asset('js/jquery-2.1.1.min.js') !!}"></script>
	<script src="{!! asset('js/bootstrap.min.js') !!}"></script>
	@endsection

