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
			<div class="col-md-6">
				<div class="row">
					<dashboard-card v-for="data in dashboardCard" :key="data.title" :payload="data" />
				</div>
				<div class="row">
					<dashboard-chart v-for="(data, index) in dashboardChart" :key="data.key" :payload="data" />
				</div>
			</div>

			<div class="col-md-6">
				<div class="row">
					<dashboard-card-pcx v-for="data in dashboardCardPCX" :key="data.key" :payload="data" />
				</div>
			</div>
		</div>

		<div class="row">
			<dashboard-chart v-if="yearComparison" :key="yearComparison.key" :payload="yearComparison" />
		</div>

		<div class="row">
			<dashboard-chart v-for="(data, index) in goal1PCX" :key="data.key" :payload="data" />
		</div>
	</div>
</div>

<script type="text/x-template" id="dashboard-card">
	<div :class="payload.classCol">
		<div class="ibox float-e-margins card">
			<div class="ibox-title">
				<h5>@{{ payload.title }}</h5>
			</div>
			<div class="ibox-content">
				<h1 class="no-margins">@{{ payload.total }}</h1>
			</div>
			<div class="ibox-tools">
				<small class="stats-label">@{{ payload.subTitle }}</small>
			</div>
		</div>
	</div>
</script>

<script type="text/x-template" id="dashboard-chart">
	<div :class="payload.classCol">
		<div class="ibox float-e-margins card">
			<div class="ibox-title">
				<h5>@{{ payload.title }}</h5>
			</div>
			<div class="ibox-content">
				<canvas :id="payload.key" width="100%" :height="payload.height"></canvas>
			</div>
			<div class="ibox-tools">
				<small class="stats-label">@{{ payload.subTitle }}</small>
			</div>
		</div>
	</div>
</script>

<script type="text/x-template" id="dashboard-card-pcx">
	<div :class="payload.classCol">
		<div class="ibox float-e-margins card">
			<div class="ibox-title">
				<h5>@{{ payload.title }}</h5>
			</div>
			<div class="ibox-content">
				<h1 class="no-margins">@{{ payload.total }}</h1>
			</div>
			<div class="ibox-title">
				<h4>@{{ payload.pValue }} <small class="stats-label .right">Prospect</small></h4>
			</div>
			<div class="ibox-title">
				<h4>@{{ payload.cValue }} <small class="stats-label .right">Cliente</small></h4>
			</div>
			<div class="ibox-title">
				<h4>@{{ payload.xValue }} <small class="stats-label .right">Ex Cliente</small></h4>
			</div>
			<div class="ibox-tools">
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

	Vue.component('dashboard-chart', {
		template: '#dashboard-chart',
		props: {
			payload: {
				type: Object,
				required: true
			}
		},
	});

	Vue.component('dashboard-card-pcx', {
		template: '#dashboard-card-pcx',
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
			dashboardCard: [],
			dashboardChart: [],
			dashboardCardPCX: [],
			goal1PCX: [],
			yearComparison: null
		},
		methods: {
			generateSparklineLayout: function(params) {
				return {
					type: 'line',
					key: params.key,
					height: "50px",
					classCol: params.classCol,
					title: params.title,
					subTitle: params.subTitle,
					payload: {
						labels: params.labels,
						datasets: params.datasets
					},
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
			updateDataDashboard: function(options) {
				this.dashboardCard = [
					{
						classCol: "col-md-6",
						title: "Venda Mês",
						total: numberWithCommas(options.salesMonth.value, 2),
						subTitle: options.salesMonth.date
					},
					{
						classCol: "col-md-6",
						title: "Venda Dia",
						total: numberWithCommas(options.salesDay.value, 2),
						subTitle: options.salesDay.date
					},
				];

				var fnPlannedExecuted = function(params) {
					return params.reduce(function(carry, item) {
						carry.labels.push(item.date);
						carry.planned.push(item.planned);
						carry.executed.push(item.executed);

						return carry;
					}, {
						labels: [],
						planned: [],
						executed: []
					});
				}

				var dataSparklineMonth = fnPlannedExecuted(options.monthComparison);

				this.dashboardChart = [
					this.generateSparklineLayout({
						key: 'dashboardSparkline_1',
						classCol: "col-md-6",
						title: "Mês",
						subTitle: '',
						labels: dataSparklineMonth.labels,
						datasets: [
							this.generateSparklineItem({
								label: "Planejado",
								color: "#5bf1b1",
								pointColor: "#5bf1b1",
								data: dataSparklineMonth.planned,
							}),
							this.generateSparklineItem({
								label: "Executado",
								color: "#710cd2",
								pointColor: "#710cd2",
								data: dataSparklineMonth.executed,
							}),
						]
					}),
				];

				var dayComparison = {
					type: "horizontalBar",
					key: "dashboardDayComparison",
					height: "50px",
					classCol: "col-md-6",
					title: "Dia",
					subTitle: "",
					payload: {
						labels: [ options.dayComparison.date ],
						datasets: [
							{
								label: "Planejado",
								backgroundColor: "#5bf1b1",
								data:[ options.dayComparison.planned ]
							},
							{
								label: "Executado",
								backgroundColor: "#710cd2",
								data:[ options.dayComparison.executed ]
							},
						]
					},
					options: null
				};

				this.dashboardChart.push(dayComparison);

				var dataYearComparison = fnPlannedExecuted(options.yearComparison);
				this.yearComparison = this.generateSparklineLayout({
					key: 'yearComparison',
					classCol: "col-md-12",
					title: "Planejado x Executado - Anual",
					subTitle: '',
					labels: dataYearComparison.labels,
					datasets: [
						this.generateSparklineItem({
							label: "Planejado",
							color: "#5bf1b1",
							pointColor: "#5bf1b1",
							data: dataYearComparison.planned,
						}),
						this.generateSparklineItem({
							label: "Executado",
							color: "#710cd2",
							pointColor: "#710cd2",
							data: dataYearComparison.executed,
						}),
					]
				});
				this.yearComparison.height = "25px";

				this.dashboardCardPCX = [
					{
						key: "previousMonthComparison",
						classCol: "col-md-6",
						title: "Meta Mês Anterior",
						total: options.previousMonthComparison.total,
						pValue: options.previousMonthComparison.p_executed,
						cValue: options.previousMonthComparison.c_executed,
						xValue: options.previousMonthComparison.x_executed,
						subTitle: options.previousMonthComparison.date,
					},
					{
						key: "previousYearComparison",
						classCol: "col-md-6",
						title: "Meta Ano Anterior",
						total: options.previousYearComparison.total,
						pValue: options.previousYearComparison.p_executed,
						cValue: options.previousYearComparison.c_executed,
						xValue: options.previousYearComparison.x_executed,
						subTitle: options.previousYearComparison.date,
					},
				];

				var goalReached = {
					notReached: options.salesMonth.goal_planned - options.salesMonth.value,
					reached: options.salesMonth.value,
					p_executed: options.salesMonth.p_executed,
					c_executed: options.salesMonth.c_executed,
					x_executed: options.salesMonth.x_executed,
					p_planned: options.salesMonth.p_planned,
					c_planned: options.salesMonth.c_planned,
					x_planned: options.salesMonth.x_planned,
					date: options.salesMonth.date
				};

				var previousGoalReached = {
					notReached: options.previousMonthComparison.goal_planned - options.previousMonthComparison.goal_executed,
					reached: options.previousMonthComparison.goal_executed,
					date: options.previousMonthComparison.date
				};

				this.goal1PCX = [
					{
						type: "doughnut",
						key: "goal1PreviousMonth",
						height: "50px",
						classCol: "col-md-4",
						title: "Objetivo alcançado Mês Anterior",
						subTitle: previousGoalReached.date,
						payload: {
							labels: ["Não Alcançado", "Alcançado"],
							datasets: [
								{
									data:[
										previousGoalReached.notReached.toFixed(2),
										previousGoalReached.reached.toFixed(2)
									],
									backgroundColor: ["#ed5565", "#1c84c6"],
									hoverBackgroundColor: [
										"#FF6384",
										"#36A2EB"
									]
								},
							]
						},
						options: null
					},
					{
						type: "doughnut",
						key: "goal1Month",
						height: "50px",
						classCol: "col-md-4",
						title: "Objetivo alcançado Mês",
						subTitle: goalReached.date,
						payload: {
							labels: ["Não Alcançado", "Alcançado"],
							datasets: [
								{
									data:[
										goalReached.notReached.toFixed(2),
										goalReached.reached.toFixed(2)
									],
									backgroundColor: ["#ed5565", "#1c84c6"],
									hoverBackgroundColor: [
										"#FF6384",
										"#36A2EB"
									]
								}
							]
						},
						options: null
					},
					{
						type: "horizontalBar",
						key: "goal1PCX",
						height: "50px",
						classCol: "col-md-4",
						title: "PCX",
						subTitle: options.salesMonth.date,
						payload: {
							labels: [ "P", "C", "X" ],
							datasets: [
								{
									label: "Planejado",
									backgroundColor: "#5bf1b1",
									data:[
										goalReached.p_executed,
										goalReached.c_executed,
										goalReached.x_executed
									]
								},
								{
									label: "Executado",
									backgroundColor: "#710cd2",
									data:[
										goalReached.p_planned,
										goalReached.c_planned,
										goalReached.x_planned
									]
								},
							]
						},
						options: null
					}
				];

				setTimeout(() => {
					this.dashboardChart.forEach(this.updateChart);
					this.updateChart(this.yearComparison);
					this.goal1PCX.forEach(this.updateChart);
				}, 300);
			},
			updateChart: function(params) {
				new Chart(document.getElementById(params.key).getContext('2d'), {
					type: params.type,
					data: params.payload,
					options: params.options
				});
			},
			getData: function(options) {
				var that = this;

				options._token = $('meta[name="csrf-token"]').attr('content');

				$.post('/admin/routine_management/report_goal_pcx/data', options).then(function(data) {
					that.updateDataDashboard(data);
				});
			}
		},
		mounted: function() {
			var date = new Date().toISOString().substr(0, 10).split('-');

			this.getData({
				day: date[2],
				month: date[1],
				year: date[0]
			});
		}
	});
</script>
@endsection
