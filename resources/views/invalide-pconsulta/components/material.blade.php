<!-- Material -->
<section class="section section-xl text-center position-relative overflow-hidden gradient-yellow">
	<div class="floating-text__right">Enar</div>
	@foreach($pageData['content'] as $content)
	<div class="container position-relative">
		<h6 class="title-8 wow fadeInUp text-white">{{$content['subtitle_pt']}}</h6>
		<h2 class="font-weight-bold wow fadeInUp text-white">{{$content['title_pt']}}</h2>
		<div class="row row-30 row-narrow-80 row-xl ">
			<div class="col-lg-12">
				<div class="box-offer shadow p-lg-5 py-5">
					<div class="box-offer__header">
						<h2 class="d-none d-lg-flex box-offer__title"><span>Material Didático</span><span>Revistas e Palestras</span></h2>
						<h2 class="d-block d-lg-none">
							<span>Material Didático</span>
							<span>Revistas e Palestras</span>
							<span>100% ONLINE e de fácil acésso</span>
						</h2>
						<div class="d-lg-flex d-none box-offer__sale">
							<div class="big">ONLINE</div>
							<div class="sale-group"><span class="percent">100%</span><span>e de fácil acésso</span></div>
						</div>
					</div>
					<div class="box-offer__footer">
						<div class="box-offer__media d-none d-lg-flex"><img src="enar/images/material.png" alt="" width="400" height=""/></div>
						<img class="d-block d-lg-none" src="enar/images/material.png" alt="" width="400" height=""/>
						<div class="group-md group-middle">
							<a href="{{$material['link']}}" target="_blank" class="m-0 button button-sm button-icon button-icon-left button-gradient-outline">
								<span class="bg button-sm">
									{{$content['link_label']}}
									<span class="icon pl-3 mdi {{$content['icon']}}"></span>
								</span>
							</a>
							{{-- <a href="{{$payload['material']['btn-2-link']}}"  class="button button-sm button-icon button-icon-right button-gradient-outline">
								<span class="bg button-sm">
									{{$payload['material']['btn-2']}}
									<span class="icon mdi mdi-video"></span>
								</span>
							</a>
							<a href="{{$payload['material']['btn-3-link']}}"  class="button button-sm button-icon button-icon-right button-gradient-outline">
								<span class="bg button-sm">
									{{$payload['material']['btn-3']}}
									<span class="icon mdi mdi-microphone-variant"></span>
								</span>
							</a> --}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach

</section>
