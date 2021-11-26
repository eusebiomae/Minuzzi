<!-- Call to Action -->
@foreach ($pageData->content as $item)
<section id="call" class="section section-md bg-secondary-2 text-center text-md-start section-way-point" id="people">
	<div class="way-point" data-custom-scroll-to="#people">
			<svg version="1.1" x="0px" y="0px" width="253px" height="38px" enable-background="new 0 0 253 38"
					xml:space="preserve">
					<path style="clip-path: url(#gel)" fill-rule="evenodd" clip-rule="evenodd"
							d="M252,36.001C199.397,36.001,176,0,125.815,0C76,0,52.988,36.001,0,36.001C4.336,40.465,273.563,36.001,252,36.001z">
					</path>
			</svg><span class="icon mdi mdi-chevron-down"></span>
	</div>
	<div class="container container-bigger">
			<div class="box-cta box-cta-inline">
					<div class="box-cta-inner">
							<h3 class="box-cta-title">{{internation($item, 'title')}}</h3>
							<p>{!! internation($item, 'text') !!}</p>
					</div>
					<div class="box-cta-inner"><a class="button button-default-outline button-nina"
									href="/budget">{{__('menu.budget')}}</a></div>
			</div>
	</div>
</section>
@endforeach
