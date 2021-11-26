@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/sweetalert/sweetalert.css') !!}"/>
@endsection

{{ csrf_field() }}
<input type="hidden" id="id" name="id" />
<div class="form-group">
	<label class="col-sm-2 control-label">Nome*</label>
	@if ($fieldPageConfig->show('name'))
	<div class="col-sm-6">
		<input type="text" id="name" name="name" class="form-control"  required {!! $fieldPageConfig->attr('name') !!} />
		<span class="help-block m-b-none">Digite o nome do Consultor.</span>
	</div>
	@endif

	<label class="col-sm-1 control-label">Função</label>
	@if ($fieldPageConfig->show('crp'))
	<div class="col-sm-3">
		<input type="text" id="crp" name="crp" class="form-control" maxlength="100" {!! $fieldPageConfig->attr('crp') !!} />
		<span class="help-block m-b-none"></span>
	</div>
	@endif

</div>

<div class="form-group">
	{{-- <label class="col-sm-2 control-label">Função*</label>
	@if ($fieldPageConfig->show('function_id'))
	<div class="col-sm-4">
		<select id="function_id" name="function_id" class="form-control m-b" required {!! $fieldPageConfig->attr('function_id') !!} >
			@foreach($listSelectBox->function as $item)
			<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
			@endforeach
		</select>
	</div>
	@endif --}}

	{{-- <label class="col-sm-2 control-label">Graduação*</label>
	@if ($fieldPageConfig->show('graduation_id'))
	<div class="col-sm-4">
		<select id="graduation_id" name="graduation_id" class="form-control m-b" required {!! $fieldPageConfig->attr('graduation_id') !!} >
			@foreach($listSelectBox->graduation as $item)
			<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
			@endforeach
		</select>
	</div>
	@endif --}}

</div>
<div class="form-group">
	{{-- <label class="col-sm-2 control-label">Nível de Inglês</label>
	@if ($fieldPageConfig->show('english_level_id'))
	<div class="col-sm-4">
		<select id="english_level_id" name="english_level_id" class="form-control m-b" required {!! $fieldPageConfig->attr('english_level_id') !!} />
			@foreach($listSelectBox->englishLevel as $item)
			<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
			@endforeach
		</select>
	</div>
	@endif--}}
{{-- <label class="col-sm-2 control-label">Cargo</label>
@if ($fieldPageConfig->show('office_id'))
<div class="col-sm-4">
	<select id="office_id" name="office_id" class="form-control m-b" required {!! $fieldPageConfig->attr('office_id') !!} >
		@foreach($listSelectBox->office as $item)
		<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
		@endforeach
	</select>
</div>
@endif --}}

</div>

<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Digite a descrição em Português*</h5>
				</div>
				<div class="ibox-content no-padding">
					<textarea name="description_pt" class="summernote"></textarea>
				</div>
			</div>
		</div>
	</div>
	{{-- <div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Digite a descrição em Inglês*</h5>
				</div>
				<div class="ibox-content no-padding">
					<textarea id="description_en" name="description_en" class="summernote" required></textarea>
				</div>
			</div>
		</div>
	</div> --}}
	{{-- <div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Digite a descrição em Espanhol</h5>
				</div>
				<div class="ibox-content no-padding">
					<textarea id="description_es" name="description_es" class="summernote"></textarea>
				</div>
			</div>
		</div>
	</div> --}}
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">Imagem em destaque*</label>
	<div class="col-sm-10">
		<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			<div class="form-control" data-trigger="fileinput">
				<i class="glyphicon glyphicon-file fileinput-exists"></i>
				<span class="fileinput-filename"></span>
			</div>
			<span class="input-group-addon btn btn-default btn-file">
				<span class="fileinput-new">Selecionar</span>
				<span class="fileinput-exists">Alterar</span>
				<input type="file" id="fileImage" name="fileImage" />
			</span>
			<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
		</div>
	</div>
</div>

@section('scripts')
@parent
<script src="{!! asset('js/plugins/sweetalert/sweetalert.min.js') !!}"></script>

<script>
	try {
		//  Sweet alert
		$('.gp-alert').click(function ($event) {
			try {
				var gpAlertKey = $event.target.dataset.gpAlert;
				var mapAlert = {
					markPay: {
						params: {
							title: "Deseja excluir a transação?",
							text: "Essa ação exclui todas as transações desta fatura e é IRREVERSÍVEL.",
							type: "warning",
						},
						callback: function () {
							swal("Feito!", "Excluir a transação.", "success");
						}
					},
					delete: {
						params: {
							title: "Deseja excluir esta fatura?",
							text: "Essa ação é IRREVERSÍVEL",
							type: "warning",
						},
						callback: function () {
							swal("Feito!", "Excluido esta fatura.", "success");
						}
					},
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
	} catch(error) {
		console.warn(error);
	}
</script>
@endsection