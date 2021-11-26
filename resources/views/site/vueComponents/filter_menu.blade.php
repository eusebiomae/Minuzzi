@section('css')
@parent
<link href="{!! asset('css/plugins/check/check.css') !!}" rel="stylesheet">
@endsection
<script type="text/x-template" id="vueFilterMenu">
	<div class="container">
		<ul class="clearfix type_list d-flex">
			<li class="">
				<div class="switch-field">
					<template v-for="field in payload.menuField">
						<input
							type="radio"
							:id="field.key"
							name="listing_filter"
							:value="field.key"
							:checked="field.checked"
							v-on:click="$emit('onFilterMenuField', field)"
						/>
						<label class="type_item" :for="field.key">@{{ field.label }}</label>
					</template>
				</div>
			</li>
			<li>
				<div class="layout_view ">
					<a v-on:click="$emit('onFilterMenuLayoutView', 'card')" :class="{active: payload.layoutView === 'card'}"><i class="fas fa-th-large"></i></a>
					<a v-on:click="$emit('onFilterMenuLayoutView', 'list')" :class="{active: payload.layoutView === 'list'}"><i class="fa fa-th-list" aria-hidden="true"></i></a>
				</div>
			</li>
		</ul>
	</div>
</script>

<script>
	Vue.component('filter-menu', {
		template: '#vueFilterMenu',
		props: {
			payload: {
				type: Object,
			}
		}
	});
</script>
