@extends('layouts.app')
@section('title', $module_page . ' ('. $title_page .')')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css" />

@endsection

@section('content')
@include($header)
<div id="pageDashboard">
	<div class="wrapper wrapper-content">
		<div class="row m-b">
			<div class="col-md-4 right">Filtro:</div>
			<div class="col-md-2">
					Mês:
					<select class="form-control" v-model="filter.month">
						<option v-for="month in months" :value="month.key">@{{ month.label }}</option>
					</select>
				</div>
				<div class="col-md-5">
					Vendedor:
					<select class="form-control" v-model="filter.seller">
						<option v-for="seller in sellers" :value="seller.id">@{{ seller.name }}</option>
					</select>
				</div>
				<div class="col-md-1">
					<input type="button" class="btn btn-primary" value="Filtrar" v-on:click="getData()"/>
				</div>
		</div>

		<div class="row">
			<dashboard-chart v-for="data in goal1PCX" :key="data.title" :payload="data" />
		</div>

		<div class="row">

			<div class="col-md-6">
				<div class="ibox float-e-margins card">
					<div class="ibox-content">
						<b-table striped hover :items="plannedExecutedPCX" :fields="{label: {label: 'PCX'}, planned: {label: 'Planejado'}, executed: {label: 'Executado'}}"/>
					</div>
					<div class="ibox-tools">
						<small class="stats-label">@{{ date }}</small>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="ibox float-e-margins card">
					<div class="ibox-title">
						<h5>Meta Diária</h5>
					</div>
					<div class="ibox-content">
						<b-table striped hover :items="goalMonth" :fields="{date: {label: 'Dia'}, goal_planned: {label: 'Planejado'}, goal_executed: {label: 'Executado'}}"/>
					</div>
					<div class="ibox-tools">
						<small class="stats-label">@{{ date }}</small>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="ibox float-e-margins card">
					<div class="ibox-content">
						<b-table striped hover :items="goalMonth" :fields="{date: {label: 'Dia'}, goal_planned: {label: 'Planejado'}, goal_executed: {label: 'Executado'}}"/>
					</div>
					<div class="ibox-tools">
						<small class="stats-label">@{{ date }}</small>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="ibox float-e-margins card">
					<div class="ibox-content">
						<b-table striped hover :items="goalMonth" :fields="{date: {label: 'Dia'}, goal: {label: 'Objectivo'}, finished: {label: 'Finalizado'}}"/>
					</div>
					<div class="ibox-tools">
						<small class="stats-label">@{{ date }}</small>
					</div>
				</div>
			</div>

			<div class="col-md-12">
				<div class="ibox float-e-margins card">
					<div class="ibox-title">
						<h5>PCX Diário</h5>
					</div>
					<div class="ibox-content">
						<b-table responsive :items="goalMonth" :fields="{
							date: {
								label: 'Dia'
							},
							p_planned: {
								label: 'Planejado'
							},
							p_executed: {
								label: 'Executado'
							},
							c_planned: {
								label: 'Planejado'
							},
							c_executed: {
								label: 'Executado'
							},
							x_planned: {
								label: 'Planejado'
							},
							x_executed: {
								label: 'Executado'
							}
						}">
							<template slot="thead-top" slot-scope="data">
								<b-tr>
									<b-td>&nbsp;</b-td>
									<b-th colspan="2" class="center">P</b-th>
									<b-th colspan="2" class="center">C</b-th>
									<b-th colspan="2" class="center">X</b-th>
								</b-tr>
							</template>
						</b-table>
					</div>
					<div class="ibox-tools">
						<small class="stats-label">@{{ date }}</small>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

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

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/combine/npm/chart.js@2.8.0,npm/chart.js@2.8.0/dist/Chart.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"></script>
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
			sellers: <?= isset($sellers) ? json_encode($sellers) : '[]' ?>,
			date: "",
			filter: {
				month: '<?= $filter['month'] ?>',
				seller: <?= $filter['seller'] ?>,
			},
			goalMonth: [],
			months: [
				{
					key: "01",
					label: "Janeiro"
				},
				{
					key: "02",
					label: "Fevereiro"
				},
				{
					key: "03",
					label: "Março"
				},
				{
					key: "04",
					label: "Abril"
				},
				{
					key: "05",
					label: "Maio"
				},
				{
					key: "06",
					label: "Junho"
				},
				{
					key: "07",
					label: "Julho"
				},
				{
					key: "08",
					label: "Agosto"
				},
				{
					key: "09",
					label: "Setembro"
				},
				{
					key: "10",
					label: "Outubro"
				},
				{
					key: "11",
					label: "Novembro"
				},
				{
					key: "12",
					label: "Dezembro"
				}
			],
			goal1PCX: [],
			plannedExecutedPCX: []
		},
		methods: {
			updateDataDashboard: function(options) {
				var mappingKey = [
					"goal_executed",
					"goal_planned",
					"p_executed",
					"c_executed",
					"x_executed",
					"p_planned",
					"c_planned",
					"x_planned"
				];

				var goalMonth = {
					date: this.date,
					goal_executed: 0,
					goal_planned: 0,
					p_executed: 0,
					c_executed: 0,
					x_executed: 0,
					p_planned: 0,
					c_planned: 0,
					x_planned: 0
				};

				var plannedExecuted = {
					labels: [],
					planned: [],
					executed: []
				};

				var plannedExecutedPCX = {
					p: {
						label: "P",
						planned: 0,
						executed: 0
					},
					c: {
						label: "C",
						planned: 0,
						executed: 0
					},
					x: {
						label: "X",
						planned: 0,
						executed: 0
					}
				};

				var plannedExecutedDay = [];

				this.goalMonth = [];
				for (var i = 0; i < options.goalMonth.length; i++) {
					var item = options.goalMonth[i];

					for (var j = mappingKey.length - 1; j > -1; j--) {
						var key = mappingKey[j];
						item[key] = parseFloat(item[key]) || 0;

						goalMonth[key] += item[key];

						if (!this.goalMonth[i]) {
							this.goalMonth[i] = {};
						}

						this.goalMonth[i][key] = numberWithCommas(item[key], 2);
					}

					plannedExecuted.labels.push(item.date);
					plannedExecuted.planned.push(item.goal_planned);
					plannedExecuted.executed.push(item.goal_executed);

					plannedExecutedPCX.p.planned += item.p_planned;
					plannedExecutedPCX.p.executed += item.p_executed;
					plannedExecutedPCX.c.planned += item.c_planned;
					plannedExecutedPCX.c.executed += item.c_executed;
					plannedExecutedPCX.x.planned += item.x_planned;
					plannedExecutedPCX.x.executed += item.x_executed;
				}

				var notReached = goalMonth.goal_planned - goalMonth.goal_executed;
				notReached = notReached < 0 ? 0 : notReached.toFixed(2);

				for (var j = mappingKey.length - 1; j > -1; j--) {
					var key = mappingKey[j];

					goalMonth[key] = goalMonth[key].toFixed(2);
				}

				this.plannedExecutedPCX = Object.values(plannedExecutedPCX);
				this.goal1PCX = [
					{
						type: "doughnut",
						key: "goal1Month",
						height: "50px",
						classCol: "col-md-6",
						title: "Objetivo alcançado Mês",
						subTitle: this.date,
						data: {
							labels: ["Não Alcançado", "Alcançado"],
							datasets: [
								{
									data:[
										notReached,
										goalMonth.goal_executed,
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
						type: "line",
						key: "goal1PCX",
						height: "50px",
						classCol: "col-md-6",
						title: "Meta",
						subTitle: goalMonth.date,
						data: {
							labels: plannedExecuted.labels,
							datasets: [
								{
									label: "Planejado",
									backgroundColor: "#5bf1b1",
									borderColor: "#5bf1b1",
									pointBorderColor: "black",
									pointBackgroundColor: "#5bf1b1",
									data: plannedExecuted.planned,
								},
								{
									label: "Executado",
									backgroundColor: "#710cd2",
									borderColor: "#710cd2",
									pointBorderColor: "black",
									pointBackgroundColor: "#710cd2",
									data: plannedExecuted.executed,
								}
							]
						},
						options:  {
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
				];

				setTimeout(() => {
					this.goal1PCX.forEach(this.updateChart);
				}, 300);
			},
			updateChart: function(params) {
				new Chart(document.getElementById(params.key).getContext('2d'), params);
			},
			getData: function() {
				var that = this;

				var options = {
					seller: this.filter.seller,
					month: this.filter.month,
					year: new Date().getUTCFullYear()
				};

				options._token = $('meta[name="csrf-token"]').attr('content');
				this.date = options.month + '/' + options.year;

				$.post('/admin/routine_management/report_goal_pcx/report', options).then(function(data) {
					that.updateDataDashboard(data);
				});
			}
		},
		mounted: function() {
			this.getData();
		}
	});
</script>
@endsection
