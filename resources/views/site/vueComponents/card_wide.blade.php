<script type="text/x-template" id="cardWide">
	<article class="box_list fadeIn">
		<div class="row no-gutters">
			<div class="col-lg-4">
				<figure>
					<a :href="payload.link">
						<img v-if="payload.image" :src="payload.image" />

						{{-- <div class="preview"><span>Detalhes</span></div> --}}
					</a>
				</figure>
			</div>
			<div class="col-lg-8 d-flex align-items-center">
				<div class="wrapper">
					<a :href="payload.link">
						<h3 class="card-title-wide">@{{ payload.title }}</h3>
					</a>
					<a class="btn_cards" :href="payload.link" role="button" style="font-size:12px; border-radius: 20px;">Detalhes</a>
			</div>
			</div>
		</div>
	</article>
</script>
<script>
	Vue.component('card-wide', {
		template: '#cardWide',
		props: {
			payload: {
				type: Object,
				required: true
			}
		}
	})
</script>
