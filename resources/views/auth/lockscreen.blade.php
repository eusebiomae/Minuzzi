@extends('layouts.auth')

@section('content')

    <div class="lock-word animated fadeInDown">
        <span class="first-word">SISTEMA</span><span>BLOQUEADO</span>
    </div>
        <div class="middle-box text-center lockscreen animated fadeInDown">
            <div>
                <div class="m-b-md">
                <img alt="image" class="img-circle circle-border" src="https://s3.amazonaws.com/uifaces/faces/twitter/ok/128.jpg">
                </div>
                <h3>Nome do Usuário</h3>
                <p>O sistema foi bloqueado por inatividade ou por outro motivo. Para ter acesso novamente, você precisa inserir sua senha.</p>
                <form class="m-t" role="form" action="index.html">
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Senha" required="">
                    </div>
                    <button type="submit" class="btn btn-primary block full-width">Desbloquear</button>
                </form>
            </div>
        </div>
    <div class="text-center lockscreen animated fadeInDown">
        <br><br><br>
        <a href="http://gigapixel.com.br">
            <img src="{!! asset('images/gigapixel.png') !!}" style="width: 200px;" >
            <p class="m-t"> <small>GigaPixel - Design & Technology &copy; 2014 - <?= date('Y'); ?></small> </p>
        </a>
    </div>
    <!-- Mainly scripts -->
    <script src="{!! asset('js/jquery-3.1.1.min.js') !!}"></script>
    <script src="{!! asset('js/bootstrap.min.js') !!}"></script>
@endsection
