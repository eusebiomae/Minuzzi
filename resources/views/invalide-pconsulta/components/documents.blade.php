<section class="section section-xl position-relative overflow-hidden text-center">
	<div class="floating-text__left">Enar</div>
		<div class="container position-relative">
			<h6 class="title-8 wow fadeInUp">{{$pageData['description_pt']}}</h6>
			{{-- <h2 class="font-weight-bold wow fadeInUp">{{$pageData['subtitle_pt']}}</h2> --}}
			<h2 class="font-weight-bold wow fadeInUp mt-4">Apostilas</h2>
			{{-- {{$handout}} --}}
			<div class="row row-xl row-30 row-md-50">
				@foreach ($handout as $item)
				@include('site.components.card')
				@endforeach
			</div>

			<h2 class="font-weight-bold wow fadeInUp">Avaliações</h2>
			<div class="row row-xl row-30 row-md-50">
			{{-- {{$avaliations}} --}}
				@foreach($avaliations as $item)
				@include('site.components.card')

					@endforeach
			</div>

			<h2 class="font-weight-bold wow fadeInUp mt-4">Gabaritos</h2>
			{{-- {{$feedback}} --}}
			<div class="row row-xl row-30 row-md-50">
				@foreach ($feedback as $item)
				@include('site.components.card')
				@endforeach
			</div>
		</div>
	</div>
</section>
