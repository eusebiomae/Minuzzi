<div class="row">
	@if ($fieldPageConfig->show('title'))
	<div class="form-group col-lg-7">
		<label for="" class="control-label">Título da pergunta</label>
		<input type="text" name="title" class="form-control" maxlength="255" {!! $fieldPageConfig->attr('title') !!}>
	</div>
	@if ($fieldPageConfig->show('flg_source'))
	<div class="form-group col-lg-3">
		<label class="control-label">Local</label>
		<select class="form-control" name="flg_source" onchange="onChangeFlgSource(event)" {!! $fieldPageConfig->attr('flg_source') !!}>
			<option value="leads_phone_call" selected>Contatos Telefônicos</option>
			<option value="guest_book">Livro de Visitas</option>
		</select>
	</div>
	@endif
	@if ($fieldPageConfig->show('flg_pcx'))
	<div data-pcx class="form-group col-lg-2 hide">
		<label class="control-label">
			<span title="Prospect">P.</span>
			<span title="Cliente">C.</span>
			<span title="Ex Cliente">X.</span>
		</label>
		<select class="form-control" name="flg_pcx" {!! $fieldPageConfig->attr('flg_pcx') !!}>
			<option value="P" selected>Prospect</option>
			<option value="C">Cliente</option>
			<option value="X">Ex Cliente</option>
		</select>
	</div>
	@endif
	<div class="col-lg-12">
		<h4>Tipo da resposta</h4>
	</div>
</div>

<div class="row vertical-divider">
	@if ($fieldPageConfig->show('flg_type'))
	<div class="col-lg-4">
		<div class="row">
			<label class="control-label">
				<input type="radio" name="flg_type" value="1" checked {!! $fieldPageConfig->attr('flg_type') !!}>
				Textual:
			</label>
		</div>
		<div class="row">
			<label class="control-label">
				<input type="radio" name="flg_type" value="2" {!! $fieldPageConfig->attr('flg_type') !!}>
				Múltipla escolha <sup>(Possível apenas marcar uma opção)</sup>:
			</label>
		</div>
		<div class="row">
			<label class="control-label">
				<input type="radio" name="flg_type" value="3" {!! $fieldPageConfig->attr('flg_type') !!}>
				Múltipla escolha <sup>(Pode marcar várias opções)</sup>:
			</label>
		</div>
		<div class="row">
			<label class="control-label">
				<input type="radio" name="flg_type" value="4" {!! $fieldPageConfig->attr('flg_type') !!}>
				Dicotômica <sup>(sim/não)</sup>
			</label>
		</div>
	</div>
	@endif
	@if ($fieldPageConfig->show('alternative'))
	<div class="col-lg-8">
		<label class="control-label hide" data-alternative>Alternativas</label>
		<button type="button" class="btn btn-info btn-sm hide" data-toggle="tooltip" data-placement="top" title="Adicionar nova alternativa" data-alternative onclick="addAlternative()">
			<i class="fa fa-plus"></i>
		</button>
		<div class="row">
			<div data-id="1" class="hide"></div>
			<div id="toTmplAlternative2" data-id="2" class="hide"></div>
			<div id="toTmplAlternative3" data-id="3" class="hide"></div>
			<div data-id="4" class="hide"></div>
		</div>
	</div>
	@endif
</div>
<script id="tmplAlternative" type="text/x-dot-template">
	<div class="col-lg-12 item-list" data-alternative-key="@{{= it.key }}" data-draggable>
		<button type="button" class="item-list-close" onclick="removeAlternative('@{{= it.key }}', @{{= it.id }})">
			<i class="fa fa-times"></i>
		</button>
		<input type="text" class="item-list-input" name="alternative[@{{= it.type }}][@{{= it.key }}][title]" value="@{{= it.title }}" maxlength="255">
		<input type="hidden" name="alternative[@{{= it.type }}][@{{= it.key }}][id]" value="@{{= it.id }}">
		<button type="button" class="item-list-ellipsis" ondragstart="handleDragStart(event)" draggable>
			<i class="fa fa-ellipsis-v"></i>
		</button>
	</div>
</script>

@section('scripts')
	@parent

	<script>
		var containeraAlternative = null;

		$(function() {
			$('input[type="radio"][name="flg_type"]').on('click', function(event) {
				var target = event.target;
				var divSection = $("div[data-id]");

				divSection.addClass('hide');

				containeraAlternative = divSection.filter('div[data-id="'+ target.value +'"]');

				containeraAlternative.removeClass('hide');

				if (["2","3"].includes(target.value)) {
					$('[data-alternative]').removeClass('hide');
				} else {
					$('[data-alternative]').addClass('hide');
				}
			});

			if (APP.scope.question) {
				if (APP.scope.question.flg_source === "guest_book") {
					document.querySelector("[data-pcx]").classList.remove('hide');
				}

				if (APP.scope.question.alternatives) {
					var alternatives = APP.scope.question.alternatives;

					$('input[type="radio"][name="flg_type"][value="'+ APP.scope.question.flg_type +'"]').trigger('click');

					for (var i = 0; i < alternatives.length; i++) {
						var alternative = alternatives[i];

						setTmplInsertAdjacentHTML({
							data: {
								id: alternative.id,
								type: alternative.flg_type,
								title: alternative.title,
								key: "alt" + generateUniqueKey()
							},
							tmpl: "tmplAlternative",
							toTmpl: "toTmplAlternative" + alternative.flg_type
						});
					}
				}
			}

		});

		function addAlternative(params) {
			var key = containeraAlternative.data('id');

			setTmplInsertAdjacentHTML({
				data: {
					id: '',
					type: key,
					title: '',
					key: "alt" + generateUniqueKey()
				},
				tmpl: 'tmplAlternative',
				toTmpl: containeraAlternative.attr('id'),
			});
		}

		function removeAlternative(key, id) {
			$('[data-alternative-key="' + key + '"]').remove();

			if (id) {
				$.get('/admin/configuration/question/alternative/remove/' + id);
			}
		}

		function onChangeFlgSource(event) {
			var target = event.target;

			if (target.value == "guest_book") {
				document.querySelector("[data-pcx]").classList.remove('hide');
			} else {
				document.querySelector("[data-pcx]").classList.add('hide');
			}
		}
	</script>
@endsection
