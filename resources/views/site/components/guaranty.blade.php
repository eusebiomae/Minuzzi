@foreach ($pageData->content as $items)
<section class="section section-lg bg-default novi-bg novi-bg-img" data-preset='{"title":"Privacy policy","category":"about","reload":false,"id":"privacy-policy"}'>
	<!-- section wave-->
	<div class="section-wave">
		<svg x="0px" y="0px" width="1920px" height="46px" viewbox="0 0 1920 46" preserveAspectRatio="none">
			<path d="M1920,0.5c-82.8,0-109.1,44-192.3,44c-78.8,0-116.2-44-191.7-44c-77.1,0-115.9,44-192,44c-78.2,0-114.6-44-192-44c-78.4,0-115.3,44-192,44c-76.9-0.1-119-44-192-44c-77,0-115.2,44-192,44c-73.6,0-114-44-190.9-44c-78.5,0-117.2,44-194.1,44c-75.9,0-113-44-191-44V46h1920V0.5z"></path>
		</svg>
	</div>
	<div class="container">
		<dl class="list-terms">
			<dt class="heading-3 text-center">{{ internation($items, 'title') }}</dt>
			<dd class="heading-4 text-justify">
				{!! internation($items, 'text') !!}
			</dd>
			<img src="{{$items->image}}" alt="" class="img" style="width: 300px; margin-left: -15px; margin-top: 25px;">

		</dl>
	</div>
</section>

@endforeach
