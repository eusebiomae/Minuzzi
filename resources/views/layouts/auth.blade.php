<!DOCTYPE html>
<html>

	<head>
    <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>&pi;+</title>
		<link href="{!! asset('images/favicon/favicon.ico') !!}" rel="icon">

    <link rel="stylesheet" href="{!! asset('css/vendor.css') !!}" />

    <link href="{!! asset('css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('font-awesome/css/font-awesome.css') !!}" rel="stylesheet">

    <link href="{!! asset('css/animate.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/app.css') !!}" rel="stylesheet">

	</head>

	<body class="gray-bg">
		<script>window.Laravel = <?php echo json_encode([
				'csrfToken' => csrf_token(),
			]); ?></script>

		@yield('content')

	</body>

</html>
