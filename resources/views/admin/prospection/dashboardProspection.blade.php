@extends('layouts.app')
@section('title', $module_page . ' ('. $title_page .')')

@section('css')
	<link href="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.css" rel="stylesheet">
@endsection

@section('content')
@include($header)
<div id="pageDashboard">
	<div class="wrapper wrapper-content">
		<div class="row">
			<dashboard-card v-for="data in cardPCX" :key="data.title" :payload="data" />
		</div>
		<div class="row">
			<dashboard-sparkline v-for="(data, index) in sparkline" :key="data.title" :payload="data" />
		</div>
	</div>
</div>

<script type="text/x-template" id="dashboard-card">
	<div class="col-md-4">
		<div class="ibox float-e-margins card">
			<div class="ibox-title">
				<h5>@{{ payload.title }}</h5>
			</div>
			<div class="ibox-content">
				<h1 class="no-margins" :class="payload.class">@{{ payload.total }}</h1>
			</div>
		</div>
	</div>
</script>

<script type="text/x-template" id="dashboard-sparkline">
	<div class="col-md-6 card">
		<div class="ibox-title">
			<h5>@{{ payload.title }}</h5>
		</div>
		<div class="m-b-sm">
			<canvas :id="payload.key" width="100%" height="50px"></canvas>
		</div>
		<div class="row">
			<div class="col-xs-8">

			</div>
			<div class="col-xs-4">
				<small class="stats-label">@{{ payload.subTitle }}</small>
			</div>
		</div>
	</div>
</script>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/combine/npm/chart.js@2.8.0,npm/chart.js@2.8.0/dist/Chart.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script>
	Vue.component('dashboard-card', {
		template: '#dashboard-card',
		props: {
			payload: {
				type: Object,
				required: true
			}
		}
	});

	Vue.component('dashboard-sparkline', {
		template: '#dashboard-sparkline',
		props: {
			payload: {
				type: Object,
				required: true
			}
		},
	});

	var app = new Vue({
		el: '#pageDashboard',
		data: {
			cardPCX: [],
			sparkline: [],
		},
		methods: {
			generateSparklineLayout: function(options) {
				return {
					key: options.key,
					title: options.title,
					subTitle: options.subTitle,
					payload: {
						labels: options.labels,
						datasets: options.datasets
					}
				}
			},
			generateSparklineItem: function(options) {
				return {
					label: options.label,
					backgroundColor: options.color,
					borderColor: options.color,
					pointBorderColor: "black",
					pointBackgroundColor: options.pointColor,
					data: options.data,
				};
			},
			generateSparklineItemProspect: function(data) {
				return this.generateSparklineItem({
					label: "Prospects",
					color: "#f8ac59",
					pointColor: "#f9bd7b",
					data: data,
				});
			},
			generateSparklineItemClient: function(data) {
				return this.generateSparklineItem({
					label: "Clientes",
					color: "#1c84c6",
					pointColor: "#5eb0e4",
					data: data,
				});
			},
			generateSparklineItemFormerClient: function(data) {
				return this.generateSparklineItem({
					label: "Ex Clientes",
					color: "#ed5565",
					pointColor: "#ef8590",
					data: data,
				});
			},
			updateDataDashboard: function(options) {
				var data = {
					"P": {
						total: 0,
						data: []
					},
					"C": {
						total: 0,
						data: []
					},
					"X": {
						total: 0,
						data: []
					}
				};

				for (var key in options) {
					if (["P", "C", "X"].includes(key)) {
						var items = options[key];
						for (var i = 0; i < items.length; i++) {
							var value = parseFloat(items[i]);

							data[key].total += value;
							data[key].data.push(value);
						}
					}
				}

				this.cardPCX = [
					{
						title: "Prospect",
						total: data.P.total,
						class: "prospect-color"
					},
					{
						title: "Cliente",
						total: data.C.total,
						class: "client-color"
					},
					{
						title: "Ex Cliente",
						total: data.X.total,
						class: "former_client-color"
					}
				];

				this.sparkline = [
					this.generateSparklineLayout({
						key: 'dashboardSparkline_1',
						title: "Prospects x Clientes",
						subTitle: 'Últimos 30 dias',
						labels: options.labels,
						datasets: [
							this.generateSparklineItemProspect(data.P.data),
							this.generateSparklineItemClient(data.C.data),
						]
					}),
					this.generateSparklineLayout({
						key: 'dashboardSparkline_2',
						title: "Clientes x Ex Clientes",
						subTitle: 'Últimos 30 dias',
						labels: options.labels,
						datasets: [
							this.generateSparklineItemClient(data.C.data),
							this.generateSparklineItemFormerClient(data.X.data)
						]
					})
				];

				setTimeout(() => {
					this.sparkline.forEach(this.updateSparkline);
				}, 300);
			},
			updateSparkline: function(options) {
				new Chart(document.getElementById(options.key).getContext('2d'), {
					type: 'line',
					data: options.payload,
					options: {
						elements: {
							line: {
								fill: false,
								tension: 0
							}
						},
  					scales: {
							yAxes: [{
								ticks: {
									beginAtZero:true,
									stacked: true,
								}
							}]
						}
					}
				});
			},
			getData: function() {
				var that = this;
				$.get('/admin/prospection/dashboard/last30DaysPCX').then(function(data) {
					that.updateDataDashboard(data);
				});
			}
		},
		mounted: function() {
			this.getData()
		}
	});
</script>
@endsection
