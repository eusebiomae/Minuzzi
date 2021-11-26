@extends('layouts.app')

@section('title', 'Produtividade')

@section('css')
@parent
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Inserir</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li>
        <a href="{{ url('/admin/routine_management/productivity') }}">Produtividade</a>
      </li>
      <li class="active">
        <strong>Inserir</strong>
      </li>
    </ol>
  </div>
  <div class="col-lg-2">

  </div>
</div>
<div id="app" class="wrapper wrapper-content animated fadeInRight">
	<div class="col-lg-12">
	  <div class="ibox float-e-margins">
	    <div class="ibox-title">
	      <h5>Produtividade</h5>
	    </div>
	    <div class="ibox-content">
				<form name="formProductivity" method="post" action="{{ $urlAction }}" class="form-horizontal">
					<input type="hidden" id="id" name="id" />
	      	<div class="form-group">
						@if ($fieldPageConfig->show('title'))
						<div class="col-sm-8">
							<label class="control-label">Foco do dia</label>
	          	<input type="text" name="title" class="form-control" required maxlength="512" {!! $fieldPageConfig->attr('title') !!} />
	          </div>
						@if ($fieldPageConfig->show('date'))
						<div class="col-sm-2">
							<label class="control-label">Data</label>
							<input type="date" name="date" class="form-control" style="padding: 0px 12px;" required {!! $fieldPageConfig->attr('date') !!} />
						</div>
						@if ($fieldPageConfig->show('title'))
						<div class="col-sm-2">
							<label><input type="radio" name="weekday" value="dom" {!! $fieldPageConfig->attr('weekday') !!}/>Dom.</label>
							<label><input type="radio" name="weekday" value="seg" {!! $fieldPageConfig->attr('weekday') !!}/>Seg.</label>
							<label><input type="radio" name="weekday" value="ter" {!! $fieldPageConfig->attr('weekday') !!}/>Ter.</label>
							<label><input type="radio" name="weekday" value="qua" {!! $fieldPageConfig->attr('weekday') !!}/>Qua.</label>
							<label><input type="radio" name="weekday" value="qui" {!! $fieldPageConfig->attr('weekday') !!}/>Qui.</label>
							<label><input type="radio" name="weekday" value="sex" {!! $fieldPageConfig->attr('weekday') !!}/>Sex.</label>
							<label><input type="radio" name="weekday" value="sab" {!! $fieldPageConfig->attr('weekday') !!}/>Sab.</label>
						</div>
					</div>

					<div v-for="itemNumeric in listNumeric" :key="itemNumeric.key" class="form-group row" style="margin:0;">
						<div class="col-lg-11">
							<h3>@{{ itemNumeric.title }} </h3>
						</div>
						<div class="col-lg-1">
							<button type="button" class="btn btn-info" v-on:click="itemNumericFnPlus(itemNumeric.key)"><i class="fa fa-plus"></i></button>
						</div>
						<div class="row">

							<div v-for="(content, index) in listContent[itemNumeric.key]" :key="'content-' + content.key" class="">
								<input type="hidden" :name="'productivityContent['+ content.key +'][id]'" :value="content.id" />
								<input type="hidden" :name="'productivityContent['+ content.key +'][type]'" :value="itemNumeric.key" />
								<div class="col-lg-1 text-center" style="padding-top: 20px">@{{ index + 1 }}</div>
								<div class="col-lg-5 form-group" >
									<textarea
										:name="'productivityContent['+ content.key +'][content]'"
										class="form-control"
										rows="2"
									>@{{ content.content }}</textarea>
								</div>
							</div>
						</div>
					</div>

          <div class="form-group">
            <div class="col-sm-12 text-right">
              <button class="btn btn-white" type="reset">Cancelar</button>
              <button class="btn btn-primary" type="submit">Salvar alterações</button>
            </div>
        	</div>
					{{ csrf_field() }}
	      </form>
	    </div>
	  </div>
	</div>
</div>

<script type="text/x-template" id="listNumeric">
	<div>

	</div>
</script>
<script>
	Vue.component('listNumeric', {
		template: '#listNumeric',
		props: {
			payload: {
				type: Object,
				required: true
			}
		}
	});
</script>
@endsection

@section('scripts')
@parent
<script>
document.addEventListener('DOMContentLoaded', function() {
	try {
		APP.scope.productivity = {!! isset($data) ? json_encode($data) : 'null' !!};
		APP.scope.productivityContent = {!! isset($productivityContent) ? json_encode($productivityContent) : '[]' !!};

		if (APP.scope.productivity) {
			populate(document.forms.formProductivity, APP.scope.productivity);
		}
	} catch (error) {
		console.warn(error);
	}
})

var app = new Vue({
	el: '#app',
	data: function() {
		var that = this

		return {
			listNumeric: [
				{
					key: 'pri',
					defaultLines: 6,
					title: 'Prioridades:',
				},
				{
					key: 'aot',
					defaultLines: 6,
					title: 'Para evitar no dia:',
				},
				{
					key: 'ilt',
					defaultLines: 4,
					title: 'O que eu aprendi hoje?',
				},
				{
					key: 'iag',
					defaultLines: 4,
					title: 'Hoje eu sou grato(a) por ...',
				},
			],
			listContent: {},
		}
	},
	methods: {
		itemNumericFnPlus: function(type) {
			this.listContent[type].push({
				key: generateUniqueKey(),
				id: null,
				type: type,
				content: '',
			});

			this.$forceUpdate()
		},
		generateDefaultLines: function() {
			var that = this

			this.listNumeric.forEach(function(item) {
				for (var i = that.listContent[item.key].length; i < item.defaultLines; i++) {
					that.itemNumericFnPlus(item.key)
				}
			})
		},
	},
	beforeMount: function() {
		var that = this
		this.listNumeric.forEach(function(item) {
			that.listContent[item.key] = []
		})
	},
	mounted: function() {
		var that = this

		setTimeout(function() {
			APP.scope.productivityContent.forEach(function(item) {
				item.key = generateUniqueKey()
				that.listContent[item.type].push(item)
			})

			that.generateDefaultLines()
			that.$forceUpdate()
		}, 700)
	},
})
</script>
@endsection
