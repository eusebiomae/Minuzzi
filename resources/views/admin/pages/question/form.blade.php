<div class="row">
	<label for="" class="col-sm-2 control-label">Título da pergunta*</label>
	<div class="form-group col-lg-4">
		<input type="text" name="title" class="form-control" maxlength="255" required>
	</div>
	<label class="col-sm-1 control-label">Categoria:*</label>
	<div class="form-group col-lg-5">
		<select class="form-control" name="category_id" required>
		</select>
	</div>
</div>

<div class="row">
	{{-- <div class="col-sm-2">
		<label for="" class="control-label">Pontuação*</label>
		<input type="number" name="score" class="form-control" maxlength="5" required value="1">
	</div> --}}
</div>

<div class="row m-t-md m-b-md">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<label class="control-label">Digite a pergunta em Português*</label>
			</div>
			<div class="ibox-content no-padding">
				<textarea id="description" name="description" class="summernote"></textarea>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-2 control-label" >
		<h4>Tipo da resposta</h4>
	</div>
</div>

<div class="row vertical-divider m-b-md">
	<div class="col-lg-4 col-sm-offset-2">
		<div class="row">
			<div class="col-sm-12">
				<div class="i-checks">
					<label class="control-label">
						<input type="radio" value="1" name="flg_type" checked>
						<i></i> Textual:
					</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="i-checks"><label class="control-label"> <input type="radio" value="2" name="flg_type"> <i></i> Múltipla escolha <sup>(Possível apenas marcar uma opção)</sup>: </label></div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="i-checks"><label class="control-label"> <input type="radio" value="3" name="flg_type"> <i></i> 	Múltipla escolha <sup>(Pode marcar várias opções)</sup>: </label></div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="i-checks"><label class="control-label"> <input type="radio" value="4" name="flg_type"> <i></i> Dicotômica <sup>(sim/não)</sup> </label></div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<label class="control-label hide" data-alternative>Alternativas</label>
		<button type="button" class="btn btn-info btn-sm hide" data-toggle="tooltip" data-placement="top" title="Adicionar nova alternativa" data-alternative onclick="addAlternative()">
			<i class="fa fa-plus"></i>
		</button>
		<div class="row">
			<div id="toTmplText" data-id="1" class="hide"></div>
			<div id="toTmplAlternative2" data-id="2" class="hide"></div>
			<div id="toTmplAlternative3" data-id="3" class="hide"></div>
			<div id="toTmplDichotomous" data-id="4" class="hide m-l-sm"></div>
		</div>
	</div>
</div>
<script id="tmplAlternative" type="text/x-dot-template">
	<div class="col-lg-12 item-list" data-alternative-key="@{{= it.key }}" data-draggable>
		<div class="i-checks"><input type="checkbox" value="1" name="alternative[@{{= it.type }}][@{{= it.key }}][flg_correct]" @{{= it.flg_correct }}></div>
		<input type="text" class="item-list-input" style="margin-left: 10px;" name="alternative[@{{= it.type }}][@{{= it.key }}][title]" value="@{{= it.title }}" maxlength="255">
		<input type="hidden" name="alternative[@{{= it.type }}][@{{= it.key }}][id]" value="@{{= it.id }}">
		<button type="button" class="btn btn-danger m-n" onclick="removeAlternative('@{{= it.key }}', @{{= it.id }})">
			<i class="fa fa-times"></i>
		</button>
	</div>
</script>
{{-- Dichotomous --}}
<script id="tmplDichotomous" type="text/x-dot-template">
	<div class="row"><div class="col-sm-12 text-left"><h4>Escolha a alternativa para ser a Correta.</h4></div></div>
	<div class="row">
		<div class="col-sm-12">
			<input type="hidden" class="item-list-input" style="margin-left: 10px;" name="alternative[@{{= it.type }}][@{{= it.key }}][title]" value="Sim / Não" maxlength="255">
			<input type="hidden" name="alternative[@{{= it.type }}][@{{= it.key }}][id]" value="@{{= it.id }}">
			<div class="i-checks"><label class="control-label"> <input type="radio" value="1" name="alternative[@{{= it.type }}][@{{= it.key }}][flg_correct]" @{{= it.x_flg_correct }}> <i></i>Sim</label></div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="i-checks"><label class="control-label"> <input type="radio" value="0" name="alternative[@{{= it.type }}][@{{= it.key }}][flg_correct]" @{{= it.y_flg_correct }}> <i></i>Não</label></div>
		</div>
	</div>
</script>

@section('scripts')
	@parent

	<script>
		var containeraAlternative = null;

		$(function() {
			populateSelectBox({
				list: APP.listSelectBox.courseCategory,
				target: document.form.category_id,
				columnValue: "id",
				columnLabel: "description_pt",
				selectBy: (APP.payload && APP.payload.data && APP.payload.data.category_id) ? [APP.payload.data.category_id] : null,
				emptyOption: {
					label: "Selecione..."
				}
			})

			$('input[type="radio"][name="flg_type"]').on('ifChecked', function(event) {
				var target = event.target;
				var divSection = $("div[data-id]");

				divSection.addClass('hide');

				containeraAlternative = divSection.filter('div[data-id="'+ target.value +'"]');

				containeraAlternative.removeClass('hide');

				switch (target.value) {
					case '1':
							$('[data-alternative]').addClass('hide');
							$('#toTmplDichotomous').html('');
							console.log(target.value);

						break;

					case '2':
							$('[data-alternative]').removeClass('hide');
							$('#toTmplDichotomous').html('');
							$('#toTmplAlternative3').html('');
							console.log(2 + ' swich');
						break;
					case '3':
							$('[data-alternative]').removeClass('hide');
							$('#toTmplDichotomous').html('');
							$('#toTmplAlternative2').html('');
							console.log(3 + ' swich');
						break;

					case '4':
							$('[data-alternative]').addClass('hide');
							console.log(4 + ' swich');
							$('#toTmplAlternative2').html('');

							var data = {
								id: '',
								type: target.value,
								title: '',
								key: "alt" + generateUniqueKey()
							}

							if ((APP.payload && APP.payload.data && APP.payload.data.alternative.length)) {
								var alternative = APP.payload.data.alternative[0]

								data = {
									id: alternative.id,
									type: alternative.flg_type,
									title: alternative.title,
									x_flg_correct: alternative.flg_correct == 1 ? 'checked' : '',
									y_flg_correct: alternative.flg_correct == 0 ? 'checked' : '',
									key: "alt" + generateUniqueKey()
								}
							}

							setTmplInsertAdjacentHTML({
									data: data,
									tmpl: 'tmplDichotomous',
									toTmpl: 'toTmplDichotomous',
								});

								$('#toTmplDichotomous .i-checks').iCheck({
									checkboxClass: 'icheckbox_square-green',
									radioClass: 'iradio_square-green',
								});
						break;

					default:
						break;
				}

			});

			$('#toTmplAlternative2').on('ifChecked', '[name$="[flg_correct]"]', function(event) {
				$('#toTmplAlternative2 [name$="[flg_correct]"]').prop('checked', false)
				$(event.target).prop('checked', true);
				$('#toTmplAlternative2 [name$="[flg_correct]"]').iCheck('update');
			});

			if (APP.payload.data && APP.payload.data.alternative.length) {
				var alternatives = APP.payload.data.alternative

				$('input[type="radio"][name="flg_type"][value="'+ APP.payload.data.flg_type +'"]').trigger('ifChecked')

				for (var i = 0; i < alternatives.length; i++) {
					var alternative = alternatives[i];

						setTmplInsertAdjacentHTML({
							data: {
								id: alternative.id,
								type: alternative.flg_type,
								typeChoose: alternative.flg_type == 2 ? 'radio' : 'check',
								title: alternative.title,
								flg_correct: alternative.flg_correct ? 'checked' : '',

								key: "alt" + generateUniqueKey()
							},
							tmpl: "tmplAlternative",
							toTmpl: "toTmplAlternative" + alternative.flg_type
						});

					$('#toTmplAlternative' + alternative.flg_type +' .i-checks').iCheck({
						checkboxClass: 'icheckbox_square-green',
						radioClass: 'iradio_square-green',
					});
				}
			}
			/*if (APP.payload.data.flg_source === "guest_book") {
				document.querySelector("[data-pcx]").classList.remove('hide');
			}
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
			}*/

		});

		function addAlternative(params) {
			var key = containeraAlternative.data('id');

			setTmplInsertAdjacentHTML({
				data: {
					id: '',
					type: key,
					typeChoose: key == 2 ? 'radio' : 'check',
					title: '',
					key: "alt" + generateUniqueKey()
				},
				tmpl: 'tmplAlternative',
				toTmpl: containeraAlternative.attr('id'),
			});
			$('#toTmplAlternative' + key +' .i-checks').iCheck({
				checkboxClass: 'icheckbox_square-green',
				radioClass: 'iradio_square-green',
			});
		}

		function removeAlternative(key, id) {
			$('[data-alternative-key="' + key + '"]').remove();

			if (id) {
				$.get('/admin/question/alternative/remove/' + id);
			}
		}

		function alternativeChangeCorrect(target) {
			console.log(target);
		}
	</script>
@endsection
