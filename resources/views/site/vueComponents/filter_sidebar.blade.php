@section('css')
@parent
<link href="{!! asset('css/plugins/check/check.css') !!}" rel="stylesheet">
@endsection

<script type="text/x-template" id="filterSidebar">
	<div id="filters_col" class="shadow-sm">
		<a
			data-toggle="collapse"
			:href="'#collapseFilters' + filterSidebarKey"
			aria-expanded="false"
			:aria-controls="'#collapseFilters' + filterSidebarKey"
			id="filters_col_bt"
		>
		@{{ payload.title }}
		</a>

		<div class="collapse show" :id="'collapseFilters' + filterSidebarKey">
			<div class="filter_type">
				<ul>
					<li class="list-style" v-for="item in payload.items">
						<label class="control control--checkbox">
							@{{ item.label }}
							<input
								type="checkbox"
								class="icheck"
								:ref="'checkbox' + item.value"
								:value="item.value"
								:checked="item.checked"
								v-on:input="$emit('onFilterSidebar', { item, $event, key: filterSidebarKey})"
							/>
							<div class="control__indicator"></div>
						</label>
					</li>
				</ul>
			</div>
		</div>
	</div>
</script>

<script>
	Vue.component('filter-sidebar', {
		template: '#filterSidebar',
		props: {
			payload: {
				type: Object,
				required: true
			},
			filterSidebarKey: String,
		}
	});
</script>

@section('scripts')
@parent
<script>
	// document.addEventListener('DOMContentLoaded', function () {
	// 	$('.icheck').iCheck('update');
	// 	jQuery(function() {
	// 		jQuery('.icheck').iCheck({
	// 			checkboxClass: 'icheckbox_square-grey',
	// 			radioClass: 'iradio_square-grey'
	// 		});
	// 	})

	// });
	window.addEventListener("resize", function(){
    if (window.outerWidth < 991) {
        document.getElementById("collapseFilterscategory").classList.remove("show");
        // document.getElementById("collapseFilterssubcategory").classList.remove("show");
    } else {
        document.getElementById("collapseFilterscategory").classList.add("show");
        // document.getElementById("collapseFilterssubcategory").classList.add("show");
    }
	})
</script>
@endsection
