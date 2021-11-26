@extends('layouts.auth')

@section('content')

    <div class="passwordBox animated fadeInDown">
        <div class="row">

            <div class="col-md-12">
                <div class="ibox-content">

                    <h2 class="font-bold">Esqueceu a senha?</h2>

                    <p>
                        Digite seu endereço de e-mail e sua senha será redefinida e enviada por e-mail.
                    </p>

                    <div class="row">

                        <div class="col-lg-12">
                            <form class="m-t" role="form" action="index.html">
                                <div class="form-group">
                                  <input type="email" class="form-control" placeholder="Endereço de e-mail" required="">
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