@extends('site.layout.site')

{{-- @section('social-top')
	<div class="top-right-menu">
		<ul class="nav pull-right">
			<li class="nav-item">
				<a href="{{ schoolInformation()->facebook }}">
					<i class="fab fa-facebook-f"></i>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{ schoolInformation()->twitter }}">
					<i class="fab fa-twitter"></i>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{ schoolInformation()->instagram }}">
					<i class="fab fa-instagram"></i>
				</a>
			</li>
		</ul>
	</div>
@endsection --}}

@section('content')

	{{-- $banner --}}
	@if (isset($banner))
		@include('site.components.banner-home')
	@endif

	{{-- SECTION about --}}
	@if(isset($pageComponents))
			@foreach ($pageComponents->contentSection as $contentSection)
				@include("site.components.{$contentSection->component}", [ 'pageData' => $contentSection ])
			@endforeach
	@endif

@endsection


