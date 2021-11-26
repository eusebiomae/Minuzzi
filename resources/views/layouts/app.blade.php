<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>&pi;+ | @yield('title') </title>
	<link href="{!! asset('images/favicon/favicon.ico') !!}" rel="icon">
	@yield('css')

	<link rel="stylesheet" href="{!! asset('font-awesome/css/font-awesome.css') !!}">
	<link rel="stylesheet" href="{!! asset('css/vendor.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/sweetalert/sweetalert.css') !!}">
	<link rel="stylesheet" href="{!! asset('css/plugins/select2/select2.min.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/app.css') !!}" />

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript">
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		})

		var APP = {
			scope: {}
		};

		window.APP = APP;

		APP.userId = ({!! Auth::guard('admin')->user()->id !!})
	</script>
</head>
<body>

	<!-- Wrapper-->
	<div id="wrapper">
		<div id="sk-preloader">
			<div class="sk-fading-circle">
				<div class="sk-circle1 sk-circle"></div>
				<div class="sk-circle2 sk-circle"></div>
				<div class="sk-circle3 sk-circle"></div>
				<div class="sk-circle4 sk-circle"></div>
				<div class="sk-circle5 sk-circle"></div>
				<div class="sk-circle6 sk-circle"></div>
				<div class="sk-circle7 sk-circle"></div>
				<div class="sk-circle8 sk-circle"></div>
				<div class="sk-circle9 sk-circle"></div>
				<div class="sk-circle10 sk-circle"></div>
				<div class="sk-circle11 sk-circle"></div>
				<div class="sk-circle12 sk-circle"></div>
			</div>
		</div>
		<!-- Navigation -->
		@include('layouts.navigation')

		<!-- Page wraper -->
		<div id="page-wrapper" class="gray-bg">

			<!-- Page wrapper -->
			@include('layouts.topnavbar')

			<!-- Main view  -->
			@yield('content')

			<!-- Footer -->
			@include('layouts.footer')

		</div>
		<!-- End page wrapper-->

	</div>

	<!-- modals -->
	@yield('modals')

	<!-- End wrapper-->

	<script src="{!! asset('js/gp-ays.js') !!}"></script>
	<script src="{!! asset('js/app.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/sweetalert/sweetalert.min.js') !!}"></script>
	<script src="{!! asset('js/plugins/select2/select2.full.min.js') !!}" type="text/javascript"></script>

	@yield('scripts')

	@if (old('swal'))
		<script>
			if (swal) {
				swal({!! json_encode(old('swal')) !!})
			}
		</script>
	@endif

</body>
</html>
