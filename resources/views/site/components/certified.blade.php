@foreach ($pageData->content as $items)
<section class="section section-lg bg-default">
	<!-- section wave-->
	<div class="section-wave">
		<svg x="0px" y="0px" width="1920px" height="46px" viewbox="0 0 1920 46" preserveAspectRatio="none">
			<path d="M1920,0.5c-82.8,0-109.1,44-192.3,44c-78.8,0-116.2-44-191.7-44c-77.1,0-115.9,44-192,44c-78.2,0-114.6-44-192-44c-78.4,0-115.3,44-192,44c-76.9-0.1-119-44-192-44c-77,0-115.2,44-192,44c-73.6,0-114-44-190.9-44c-78.5,0-117.2,44-194.1,44c-75.9,0-113-44-191-44V46h1920V0.5z"></path>
		</svg>
	</div>
	<div class="container container-bigger">
		<div class="row row-ten row-50 justify-content-md-center align-items-lg-center justify-content-xl-between flex-lg-row-reverse">
			<div class="col-md-9 col-lg-5 col-xl-4">
				<h3>{{ internation($items, 'title')}}<br class="d-none d-xxl-block">
				</h3>
				<div class="divider divider-default"></div>
				<p class="heading-5 text-transform-justify">{!! internation($items, 'text') !!}</p>
				{{-- <p class="text-spacing-sm">If you're a multi-disciplined expert at your craft who loves figuring out new ways to do things, talking tech, playing chess, beer Fridays, and an overflowing snack cabinet, let's talk. We offer all the stuff you'd expect, and plenty of other really generous perks.</p> --}}
			</div>
			<div class="col-md-9 col-lg-5"><img src="{{$items->image}}" alt="" width="720" height="459"/>
			</div>
		</div>
	</div>
</section>
@endforeach
