@extends('layouts.auth')

@section('content')

    <div class="passwordBox animated fadeInDown">
        <div class="row">

            <div class="col-md-12">
                <div class="ibox-content">

                    <h2 class="font-bold">Resetar senha</h2>

                    <p>

                    </p>

                    <div class="row">

                        <div class="col-lg-12">
													@if (session('status'))
														<div class="alert alert-success">
															{{ session('status') }}
														</div>
													@endif

                            <form class="m-t" role="form" action="index.html">
															{{ csrf_field() }}

															<div class="form-group">
																<input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="E-Mail" required autofocus>
																@if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
															</div>

															<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

																	<input id="password" type="password" class="form-control" name="password" placeholder="Nova Senha" required>

																	@if ($errors->has('password'))
																		<span class="help-block">
																			<strong>{{ $errors->first('password') }}</strong>
																		</span>
																	@endif
													</div>

													<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
															<label for="password-confirm" class="col-md-4 control-label"></label>

																	<input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Senha" required>

																	@if ($errors->has('password_confirmation'))
																			<span class="help-block">
																					<strong>{{ $errors->first('password_confirmation') }}</strong>
																			</span>
																	@endif
													</div>

                                <button type="submit" class="btn btn-primary block full-width m-b">Enviar nova senha</button>

                                <a href="{{ route('admin.login') }}"><small>Voltar ao Login</small></a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row text-center">
            <br><br><br>
            <a href="http://gigapixel.com.br">
                <img src="{!! asset('images/gigapixel.png') !!}" style="width: 200px;" >
                <p class="m-t"> <small>GigaPixel - Design & Technology &copy; <?= date('Y'); ?></small> </p>
            </a>
            {{--  <div class="col-md-6">
                GigaPixel - Design & Technology
            </div>
            <div class="col-md-6 text-right">
               <small>© 2017</small>
            </div>  --}}
        </div>
    </div>

		@endsection

