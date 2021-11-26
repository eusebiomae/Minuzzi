@php
  $footer = GigaGetData::footer();
@endphp
<div class="inset-xl-right-70">
	<h3>{{$payload['info']['title']}}</h3>
	<h5 class="title-6">{{$payload['info']['subtitle']}}</h5>
	<ul class="list-contacts">
		<li><span class="icon mdi mdi-phone"></span><a class="big" href="tel:00000000000">{{$footer['phone']}}</a></li>
		@if (isset($footer['phone2']))
		<li><span class="icon mdi mdi-phone"></span><a class="big" href="tel:00000000000">{{$footer['phone2']}}</a></li>
		@endif
		<li><span class="icon mdi mdi-map-marker"></span><a class="big" href="#">{{$footer['address']}}</a></li>
		<li><span class="icon mdi mdi-email-outline"></span><a class="big" href="mailto:{{$footer['e-mail']}}">{{$footer['e-mail']}}</a></li>
	</ul>
	<ul class="list-social list-inline list-inline-md">
		@if (isset($footer['facebook']))
		<li><a class="icon mdi mdi-facebook" href="{{$footer['facebook']}}"></a></li>
		@endif
		@if (isset($footer['instagram']))
		<li><a class="icon mdi mdi-instagram" href="{{$footer['instagram']}}"></a></li>
		@endif
		@if (isset($footer['youtube']))
		<li><a class="icon mdi fa-youtube-play" href="{{$footer['youtube']}}"></a></li>
		@endif
	</ul>
</div>
