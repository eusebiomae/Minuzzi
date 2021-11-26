<section class="section section-lg bg-default">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-11">
				<div class="card-group-custom card-group-minimal" id="accordion1" role="tablist" aria-multiselectable="false">
					<!--Bootstrap card-->
					@foreach ($faq as $index => $content)
					<article class="card card-custom card-minimal">
						<div class="card-header" role="tab">
							<div class="card-title"><a class="collapsed" id="accordion1-{{$index}}" data-toggle="collapse" data-parent="#accordion1" href="#accordion1-body-{{$index}}" aria-controls="accordion1-body-{{$index}}" aria-expanded="true" role="button">{{$content['question']}}
									<div class="card-arrow"></div></a></div>
						</div>
						<div class="collapse" id="accordion1-body-{{$index}}" aria-labelledby="accordion1-{{$index}}" data-parent="#accordion1" role="tabpanel">
							<div class="card-body">
								<p class="big">
									{{$content['answer']}}
								</p>
							</div>
						</div>
					</article>
					@endforeach

				</div>
			</div>
		</div>
	</div>
</section>
