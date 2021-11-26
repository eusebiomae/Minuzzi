@extends('layouts.app')

@section('title', 'Inscrição do aluno')

@section('css')
<link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/animate.css@^4.0.0/animate.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/quasar@1.14.3/dist/quasar.min.css" rel="stylesheet" type="text/css">

<style>
	.row {
		margin-right: 0 !important;
    margin-left: 0 !important;
	}
</style>
@parent
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-9">
		<h2>Inscrição do aluno</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/admin') }}">Home</a>
			</li>
			<li class="active">
				<strong>Inscrição do aluno</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-3" style="padding-top: 30px; text-align: right"></div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col">
			<div class="ibox float-e-margins">
				<div class="ibox-title"></div>
				<div class="ibox-content">
					<div id="q-app">
						<tabs-shopping-journey></tabs-shopping-journey>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/quasar@1.14.3/dist/quasar.ie.polyfills.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@^2.0.0/dist/vue.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quasar@1.14.3/dist/quasar.umd.min.js"></script>
@include('admin._components.shoppingJourneyVue')

<script>
	APP.payload = {!! isset($payload) ? json_encode($payload) : '{}' !!}

	Vue.prototype.$eventBus = new Vue();

	var vueApp = new Vue({
		el: '#q-app',
		data: function () {
			return {}
		},
		methods: {},
	})

	function showErrorShoppingJouney(showError) {
		var error = showError

		if (showError.errors) {
			error = showError.errors.reduce(function(carry, item) {
				carry.push(item.description)

				return carry
			}, []).join('\n')
		}

		console.warn(error)

		if (typeof error == "object") {
			error = JSON.stringify(error)
		}

		swal({
			title: 'Erro ao efetuar a inscrição',
			type: 'warning',
			text: error,
		})
	}
</script>

@parent
@endsection
