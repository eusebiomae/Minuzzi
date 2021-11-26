<div class="row wrapper border-bottom white-bg page-heading ">

	<div class="col-lg-10 col-md-10 col-sm-10">
		<h2>{{ $config->title }}</h2>

		@if (isset($config->breadcrumbs))
		<ol class="breadcrumb">
			@foreach ($config->breadcrumbs as $key => $breadcrumb)
			<li>
				@if (isset($breadcrumb['url']))
					<a href="{{ url($breadcrumb['url']) }}">{{ $breadcrumb['label'] }}</a>
				@else
					@if (array_key_last($config->breadcrumbs) == $key)
						<strong>{{ $breadcrumb['label'] }}</strong>
					@else
						{{ $breadcrumb['label'] }}
					@endif
				@endif
			</li>
			@endforeach
		</ol>
		@endif
	</div>

	<div class="col-lg-2 col-md-2 col-sm-2" style="padding-top: 30px; text-align: right">
		@if (isset($config->btnTopRight))
		@foreach ($config->btnTopRight as $btnTopRight)
		<a href="{{ url($btnTopRight['url']) }}">
			<button class="btn {{ $btnTopRight['class'] }}">
				<i class="{{ $btnTopRight['icon'] }}"></i>
				{{ $btnTopRight['label'] }}
			</button>
		</a>
		@endforeach
		@endif
	</div>

</div>
