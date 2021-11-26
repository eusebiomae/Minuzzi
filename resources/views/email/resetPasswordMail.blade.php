<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div style="
		width: 60vw;
		background-color: rgb(228, 228, 228);
		margin:auto;
		font-family: Arial, Helvetica, sans-serif;
		-webkit-box-shadow: 10px 10px 32px 0px #00000033;
		-moz-box-shadow: 10px 10px 32px 0px #00000033;
		box-shadow: 10px 10px 32px 0px #00000033;
	">

		<!-- PARALLAX -->
		<div style="
			background-image: url(https://cetcc.com.br/cetcc/img/logo_small.png);
			height: 140px;
			background-attachment: fixed;
			background-position: center;
			background-repeat: no-repeat;
			background-size: auto;
		">

			<!-- HEADER	 -->
			<div style="
				background: #025e88;
				background: linear-gradient(to right, #23889c,#025e88, #013569);
				height: 100%;
				color: white;
				padding: 0 0 0 0;
			">
				<a href="http://cetcc.com.br/" target="_blank" rel="noopener noreferrer">
					<img
						src="https://cetcc.com.br/cetcc/img/logo_wide2.png"
						alt="Logo Vindimo"
						title="Ir para o Site Vindimo"
						style="
							max-height: 140px;
						">
				</a>
			</div>
			<!-- // HEADER	 -->
		</div>
	<!-- // PARALLAX -->


	<!-- BODY -->
	<div style="
		padding: 15px 40px;
	">
		<h1 style="text-align: center; color: #013569">Redefinir senha</h1>

		<main style="background-color: rgba(240, 240, 240, 0.562);padding: 20px;border-radius: 15px;">
			<a href="https://cetcc.com.br/resetPassword/{{ $data['reset_password_code'] }}">
				<button type="button" name="" value="" class="css3button"
					style="
						cursor: pointer;
						font-size: 14px;
						color: #ffffff;
						padding: 12px 30px;
						background: #013569;
						border-radius: 20px;
						border: 0px;
					">
					Clique aqui para redefinir sua senha
				</button>
			</a>
		</main>
	</div>
	<!-- // BODY -->

	<!-- FOOTER -->
	<div style="
		height: auto;
		background-attachment: fixed;
		background-position: center;
		background-repeat: no-repeat;
		background-size: auto;
	">
		<div style="
			background: #025e88;
			background: linear-gradient(to right, #23889c,#025e88, #013569);
			height: 100%;
			height: 100%;
			color: white;
			text-align: end;
		">
			<a href="http://cetcc.com.br/" target="_blank" rel="noopener noreferrer">
				<img
					src="https://cetcc.com.br/cetcc/img/logo_small.png"
					alt="Logo"
					title="Ir para o Site Vindimo"
					style="
						width: 100px;
						padding: 35px;
					">
			</a>
		</div>
		<div style="
			text-align: center;
			background-color: #013569;
			padding: 10px 0;
			width: 100%;
		">
			<a href="http://cetcc.com.br/"
				target="_blank"
				rel="noopener noreferrer"
				title="Ir para Site"
				style="
					text-decoration: none;
					color: white;
				"
			>
			cetcc.com.br
			</a>
		</div>
	</div>
	<!-- // FOOTER -->

</div>
</body>
</html>
