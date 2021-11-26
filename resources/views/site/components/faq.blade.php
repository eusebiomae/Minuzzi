<!-- Statistics & Frequently asked questions-->
@foreach ($pageData->content as $item)

<section id="faq" class="section section-variant-2 bg-gray-lighter novi-bg novi-bg-img"
		data-preset='{"title":"Statistics & faqs","category":"about","reload":true,"id":"statistics-&-faqs"}'>
		<div class="container container-bigger">
				<div
						class="row row-ten row-50 justify-content-md-center justify-content-xl-between flex-lg-row-reverse">
						<div class="col-md-12 col-lg-12">
								<h3>{{__('menu.faq')}}</h3>
								<div class="divider divider-default"></div>
								<!-- Bootstrap collapse-->
								<div class="accordion-custom-group accordion-custom-group-custom accordion-custom-group-corporate"
										id="accordion1" role="tablist" aria-multiselectable="false">
										<div class="accordion-custom-item accordion-custom-corporate">
												<h4 class="accordion-custom-heading" id="accordion1-accordion-head-dowjdyke">
														<button class="accordion-custom-button" type="button" data-bs-toggle="collapse"
																data-bs-target="#accordion1-accordion-body-qkrhclqh"
																aria-controls="accordion1-accordion-body-qkrhclqh" aria-expanded="true">What are
																the advantages of purchasing your template?<span
																		class="accordion-custom-arrow"></span>
														</button>
												</h4>
												<div class="accordion-custom-collapse collapse show"
														id="accordion1-accordion-body-qkrhclqh"
														aria-labelledby="accordion1-accordion-head-dowjdyke" data-bs-parent="#accordion1">
														<div class="accordion-custom-body">
																<p>The major advantage is price: You get a high quality design for just $20-$70.
																		You don’t have to hire a web designer or web design studio. Second advantage
																		is time frame: It usually takes 5-15 days for a good designer to produce a
																		web page of such quality.</p>
														</div>
												</div>
										</div>
										<div class="accordion-custom-item accordion-custom-corporate">
												<h4 class="accordion-custom-heading" id="accordion1-accordion-head-cjohigfs">
														<button class="accordion-custom-button" type="button" data-bs-toggle="collapse"
																data-bs-target="#accordion1-accordion-body-dplbqkeu"
																aria-controls="accordion1-accordion-body-dplbqkeu" aria-expanded="false">What do
																I receive when I order this template?<span
																		class="accordion-custom-arrow"></span>
														</button>
												</h4>
												<div class="accordion-custom-collapse collapse" id="accordion1-accordion-body-dplbqkeu"
														aria-labelledby="accordion1-accordion-head-cjohigfs" data-bs-parent="#accordion1">
														<div class="accordion-custom-body">
																<p>After you complete the payment via our secure form you will receive the
																		instructions for downloading the product. The source files in the download
																		package can vary based on the type of the product you have purchased.</p>
														</div>
												</div>
										</div>
										<div class="accordion-custom-item accordion-custom-corporate">
												<h4 class="accordion-custom-heading" id="accordion1-accordion-head-tjfjncym">
														<button class="accordion-custom-button" type="button" data-bs-toggle="collapse"
																data-bs-target="#accordion1-accordion-body-nnopdhxr"
																aria-controls="accordion1-accordion-body-nnopdhxr" aria-expanded="false">What am
																I allowed to do with the template?<span class="accordion-custom-arrow"></span>
														</button>
												</h4>
												<div class="accordion-custom-collapse collapse" id="accordion1-accordion-body-nnopdhxr"
														aria-labelledby="accordion1-accordion-head-tjfjncym" data-bs-parent="#accordion1">
														<div class="accordion-custom-body">
																<p>You may build a website using the template in any way you like. You may not
																		resell or redistribute templates (like we do); claim intellectual or
																		exclusive ownership to any of our products, modified or unmodified. All
																		products are property of content providing companies and individuals. You
																		are also not allowed to make more than one project using the same template
																		(you have to purchase the same template once more in order to make another
																		project with the same design).</p>
														</div>
												</div>
										</div>
										<div class="accordion-custom-item accordion-custom-corporate">
												<h4 class="accordion-custom-heading" id="accordion1-accordion-head-iagototf">
														<button class="accordion-custom-button" type="button" data-bs-toggle="collapse"
																data-bs-target="#accordion1-accordion-body-nywetpcx"
																aria-controls="accordion1-accordion-body-nywetpcx" aria-expanded="false">Do you
																provide any scripts with the template?<span
																		class="accordion-custom-arrow"></span>
														</button>
												</h4>
												<div class="accordion-custom-collapse collapse" id="accordion1-accordion-body-nywetpcx"
														aria-labelledby="accordion1-accordion-head-iagototf" data-bs-parent="#accordion1">
														<div class="accordion-custom-body">
																<p>Our templates do not include any additional scripts. Newsletter
																		subscriptions, search fields, forums, image galleries (in HTML versions of
																		Flash products) are inactive. Basic scripts can be easily added at zemez.io
																</p>
														</div>
												</div>
										</div>
								</div>
						</div>
						{{-- <div class="col-md-9 col-lg-5 col-xxl-4">
								<h3>Statistics</h3>
								<div class="divider divider-default"></div>
								<div class="d3-chart-wrap">
										<div class="d3-chart" id="line-chart" style="width:100%; height: 420px;"></div>
								</div>
						</div> --}}
				</div>
		</div>
</section>
@endforeach
