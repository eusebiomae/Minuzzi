<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>

	<body>
		<div style="
			background-color: #dcdcdc;
			margin: 0px 7%;
			color: #022138;
			font-family: Verdana, monospace;
			text-align: center;
			-webkit-box-shadow: 10px 10px 32px 0px #00000033;
			-moz-box-shadow: 10px 10px 32px 0px #00000033;
			box-shadow: 10px 10px 32px 0px #00000033;
		">

			<!-- HEADER	 -->
			<div style="
				border-bottom: 5px solid #022138;
				background-color: #fff;
				padding: 0px 17%;
			">
				<a href="http://{{ request()->getHost() }}/" target="_blank" rel="noopener noreferrer">
					<img
						src="https://{{ request()->getHost() }}/cetcc/img/logo_vertical.png"
						alt="Logo"
						title="Ir para o Site"
						style="
							width: 100%;
							max-width: 290px;
						"
					>
				</a>
			</div>
			<!-- // HEADER	 -->


			<!-- BODY -->
			<div style="padding: 15px 40px;">
				<!-- Main view  -->
				@yield('content')
			</div>
			<!-- // BODY -->

			<!-- FOOTER -->
			<div style="background-color: #022138; padding: 2% 0px;">
				<a href="http://{{ request()->getHost() }}/" target="_blank" rel="noopener noreferrer">
					<img
						src="https://{{ request()->getHost() }}/storage/scholinformation/logo.png?876"
						alt="Logo"
						title="Ir para o Site"
						style="
							width: 100%;
							max-width: 70px;
						"
					>
				</a>

				<br/>

				<a href="http://{{ request()->getHost() }}/"
					target="_blank"
					rel="noopener noreferrer"
					title="Ir para Site"
					style="
						text-decoration: none;
						color: #fff;
					"
				>
					{{ request()->getHost() }}
				</a>
			</div>
		</div>
		<!-- // FOOTER -->
	</body>
</html>
