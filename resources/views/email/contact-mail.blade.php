<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>E-mail de Contato</title>
	<style>
		.container{
			display: flex;
			flex-direction: column;
			justify-content: center;
			width: 500px;
			margin: auto;
			box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
			background-color: white;
		}
		ul{
			list-style: none;
			padding: 0;
		}
		.item {
			order: 5; /* default is 0 */
			padding: 20px;
		}
		.text-center{
			text-align: center;
		}
		.header{
			background: linear-gradient(to right, #31B4CE,#007FB8, #004589);
			color: white;
		}
		.header a{
			color: white;
			text-decoration: none;
		}
		.text-uppercase{
			text-transform:uppercase;
		}
		body{
			font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
			height: 100vh;
			margin:0;
			padding:0;
			display:flex;
		}

	</style>
</head>
<body>
	@php
		$data = GigaGetData::footer();
	@endphp
	<ul class="container">
		<li class="item header text-center">
			<img src="/{{$data['image']}}" alt="Logo empresa" height="50px" style="margin: 10px 0">
		</li>
		<li class="item text-center text-uppercase"><b>{{ $payload['subject'] }}</b></li>
		<li class="item">{{ $payload['description_pt'] }}</li>
		<li class="item">
			<b>Ass:</b> {{ $payload['name'] }} {{$payload['last_name']}}.<br>
			{{ $payload['email'] }}.<br>
			{{ $payload['phone'] }}.
		</li>
		<li class="item header text-center" style="margin:0px 0;">
			Enviado pelo site <a href="#" title="Ir para o Site">{{$data['name']}}</a>
		</li>
	</ul>
</body>
</html>
