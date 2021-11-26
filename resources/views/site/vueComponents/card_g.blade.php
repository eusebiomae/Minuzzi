<script type="text/x-template" id="cardG">
	<div>
		<div class="box_grid wow card" style="min-height: 365px">
			<figure class="block-reveal">
				<a :href="payload.link">
					<div class="block-horizzontal"></div>
					<img v-if="payload.image" :src="payload.image" class="img-fluid" alt="Img">
				</a>
			</figure>
			<div class="wrapper">
				<a :href="payload.link">
					<h6 class="card-title">@{{ payload.title }}</h6>
				</a>
			</div>
			<div class="text-center">
				<a class="btn_cards" :href="payload.link" role="button">Detalhes</a>
			</div>
		</div>
	</div>
</script>
<script>
	Vue.component('card-g', {
		template: '#cardG',
		props: {
			payload: {
				type: Object,
				required: true
			}
		}
	});
</script>
