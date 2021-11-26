@extends('layouts.cetccMail')

@section('content')
<h1 style="text-align: center;">Confirmação de E-mail</h1>
<p>Falta pouco! Confirme no botao para "Ativar a sua conta".</p>
<p>Com a ativação feita você terá o seu login e senha ativado para entrar na área do aluno.</p>
<p>Onde irá desfrutar materias, informações sobre o curso entre outros recursos da plataforma.</p>
<div style="width: 100%; text-align: center; padding: 20px 0 0 0;">
	<a href="https://cetcc.com.br/emailConfirmation/{{ $data->email_confirmation_code }}"
		style="
		text-decoration: none;
		margin: 10px;
		padding: 10px;
		color:white;
		border-radius:5px;
		border: #013569;
		background: #025e88;
		background: linear-gradient(to right, #23889c,#025e88, #013569);
		">
		Ativar a sua conta
	</a>
</div>
@endsection
