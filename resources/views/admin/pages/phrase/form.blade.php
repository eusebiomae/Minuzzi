@section('css')
@parent
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
<link rel="stylesheet" href="{!! asset('cetcc/css/icon_fonts/css/all_icons.min.css') !!}" >
@endsection

<div class="row">
	<div class="col-sm-12 m-t-sm">
		<label class="control-label">Nome*</label>
		<input type="text" name="name" class="form-control" required>
		<span class="help-block m-b-none">Digite o nome da Frase.</span>
	</div>

</div>
<div class="row">
	<div class="col-sm-12">
		<label class="control-label">Frase*</label>
		<textarea name="phrase" class="summernote" required></textarea>
		<span class="help-block m-b-none">Digite o nome da Frase.</span>
	</div>
</div>

<div class="form-group  m-t-sm">
	<label class="col-sm-2 control-label">Imagem de Perfil*</label>
	<div class="col-sm-10">
		<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			<div class="form-control" data-trigger="fileinput">
				<i class="glyphicon glyphicon-file fileinput-exists"></i>
				<span class="fileinput-filename"></span>
			</div>
			<span class="input-group-addon btn btn-default btn-file">
				<span class="fileinput-new">Selecionar</span>
				<span class="fileinput-exists">Alterar</span>
				<input type="file" id="fileImage" name="fileImage">
			</span>
			<a href="#" class="input-group-addon btn btn-default fileinput-exists"
				data-dismiss="fileinput">Remover</a>
		</div>
	</div>
</div>
<div class="row center">
	@if(isset($data) && isset($data['image']))
		<img height="200" src="{{ $data['image'] }}" />
	@endif
</div>

@section('scripts')
@parent
<!-- SUMMERNOTE -->
<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}" type="text/javascript"></script>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		try {
			// APP.scope.form = <?=isset($data) ? json_encode($data) : 'null'?>;

			// if (APP.scope.form) {
			// 	populate(document.forms.form, APP.scope.form);
			// }

			$('.summernote').summernote({
				minHeight: 200
			});

			//  Sweet alert
			$('.gp-alert').click(function ($event) {
				try {
					var gpAlertKey = $event.target.dataset.gpAlert;

					var mapAlert = {
						cancel: {
							params: {
								title: "Cancelado",
								text: "As modificações não foram salvas",
								type: "error",
								showCancelButton: false,
								confirmButtonText: "Ok",
								confirmButtonColor: "#1a7bb9"
							}
						},
						save: {
							params: {
								title: "Salvo com Sucesso",
								text: "As modificações foram salvas",
								type: "success",
								showCancelButton: false,
								confirmButtonText: "Ok",
								confirmButtonColor: "#1a7bb9"
							}
						},
					}

					swal(Object.assign({
						title: "Tem certeza disso?",
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Sim",
						showCancelButton: true,
						closeOnConfirm: false
					}, mapAlert[gpAlertKey].params), mapAlert[gpAlertKey].callback);
				} catch (error) {
					console.warn(error)
				}
      });

		} catch (error) {
			console.warn(error);
		}
	});
</script>
@endsection
