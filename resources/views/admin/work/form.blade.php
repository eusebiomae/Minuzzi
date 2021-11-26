@extends('layouts.app')

@section('title', 'Dados Institucional ')

@section('css')
	<link rel="stylesheet" href="{!! asset('css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/select2/select2.min.css') !!}" />

	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/basic.css') !!}" />
	<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/dropzone.css') !!}" />
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Inserir Novo Currículum</h2>
    <ol class="breadcrumb">
			<li>
				<a href="{{ url('/admin') }}">Home</a>
			</li>
			<li>
				<a href="{{ url('/admin/work') }}">Trabalhe Conosco</a>
			</li>
			<li class="active">
				<strong>Inserir Currículo</strong>
			</li>
    </ol>
  </div>
  <div class="col-lg-2">

  </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="col-lg-12">
	  <div class="ibox float-e-margins">
	    <div class="ibox-title">
	      <h5>Currículo <small>Cadastro e edição de currículos.</small></h5>
	    </div>
	    <div class="ibox-content">
			<form name="formWork" method="post" action="{{ $urlAction }}" enctype="multipart/form-data"  class="form-horizontal">
				<input type="hidden" id="id" name="id" />

				<div class="form-group">

					<label class="col-sm-2 control-label">Nome*</label>
					@if ($fieldPageConfig->show('name'))
					<div class="col-sm-4">
						<input type="text" id="name" name="name" class="form-control" required {!! $fieldPageConfig->attr('name') !!} />
					</div>
					@endif

					<label class="col-sm-2 control-label">Sobrenome*</label>
					@if ($fieldPageConfig->show('last_name'))
					<div class="col-sm-4">
						<input type="text" id="last_name" name="last_name" class="form-control" required {!! $fieldPageConfig->attr('last_name') !!} />
					</div>
					@endif

				</div>

				<div class="form-group">

					<label class="col-sm-2 control-label">Gênero*</label>
					@if ($fieldPageConfig->show('genre'))
					<div class="col-sm-2">
            			<select id="genre" name="genre" class="form-control mb-30" required {!! $fieldPageConfig->attr('genre') !!}>
							<option value="M">Masculino</option>
							<option value="F" selected>Feminino</option>
            			</select>
					</div>
					@endif

					<label class="col-sm-2 control-label">Data de Nascimento*</label>
					@if ($fieldPageConfig->show('date_birth'))
					<div class="col-sm-2">
						<input type="date" class="form-control mb-30" name="date_birth" id="date_birth"  required {!! $fieldPageConfig->attr('date_birth') !!} />
					</div>
					@endif

					<label class="col-sm-2 control-label">Profissão*</label>
					@if ($fieldPageConfig->show('profession'))
					<div class="col-sm-2">
						<input type="text" class="form-control mb-30" name="profession" id="profession"  placeholder="" required {!! $fieldPageConfig->attr('profession') !!} />
					</div>
					@endif
				</div>

				<div class="form-group">

					<label class="col-sm-2 control-label">Graduação*</label>
					@if ($fieldPageConfig->show('graduation_id'))
					<div class="col-sm-4">
						<select class="form-control mb-30" id="graduation_id" name="graduation_id"  required {!! $fieldPageConfig->attr('graduation_id') !!} >
								@foreach($listSelectBox->graduation as $item)
								<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
								@endforeach
						</select>
					</div>
					@endif

					<label class="col-sm-2 control-label">Função*</label>
					@if ($fieldPageConfig->show('function_id'))
					<div class="col-sm-4">
						<select class="form-control mb-30" id="function_id" name="function_id" required {!! $fieldPageConfig->attr('function_id') !!} >
								@foreach($listSelectBox->function as $item)
								<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
								@endforeach
						</select>
					</div>
					@endif

				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Cargo Desejado*</label>
					@if ($fieldPageConfig->show('office_id'))
					<div class="col-sm-4">
						<select class="form-control mb-30" id="office_id" name="office_id"  required {!! $fieldPageConfig->attr('office_id') !!} >
								@foreach($listSelectBox->office as $item)
								<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
								@endforeach
						</select>
					</div>
					@endif

					<label class="col-sm-2 control-label">Nível de Inglês*</label>
					@if ($fieldPageConfig->show('english_level_id'))
					<div class="col-sm-4">
						<select class="form-control mb-30" id="english_level_id" name="english_level_id" required {!! $fieldPageConfig->attr('english_level_id') !!} >
								@foreach($listSelectBox->englishLevel as $item)
								<option value="{{ $item->id }}">{{ $item->description_pt }}</option>
								@endforeach
							</select>
					</div>
					@endif

				</div>

				<div class="form-group">

					<label class="col-sm-2 control-label">Endereço*</label>
					@if ($fieldPageConfig->show('address'))
					<div class="col-sm-7">
						<input type="text" class="form-control mb-30" name="address" id="address" placeholder="" required {!! $fieldPageConfig->attr('address') !!} />
					</div>
					@endif

					<label class="col-sm-1 control-label">N°*</label>
					@if ($fieldPageConfig->show('number'))
					<div class="col-sm-2">
						<input type="number" class="form-control mb-30" name="number" id="number" placeholder="" required {!! $fieldPageConfig->attr('number') !!} />
					</div>
					@endif

				</div>

				<div class="form-group">

					<label class="col-sm-2 control-label">Complemento*</label>
					@if ($fieldPageConfig->show('complement'))
					<div class="col-sm-10">
						<input type="text" class="form-control mb-30" name="complement" id="complement" placeholder="" required {!! $fieldPageConfig->attr('complement') !!}/>
					</div>
					@endif

				</div>

				<div class="form-group">

					<label class="col-sm-2 control-label">Bairro*</label>
					@if ($fieldPageConfig->show('neighborhood'))
					<div class="col-sm-4">
						<input type="text" class="form-control mb-30" name="neighborhood" id="neighborhood" placeholder="" required {!! $fieldPageConfig->attr('neighborhood') !!}/>
					</div>
					@endif

					<label class="col-sm-2 control-label">Cidade*</label>
					@if ($fieldPageConfig->show('city'))
					<div class="col-sm-4">
						<input type="text" class="form-control mb-30" name="city" id="city" placeholder="" required {!! $fieldPageConfig->attr('city') !!}/>
					</div>
					@endif

				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">UF*</label>
					@if ($fieldPageConfig->show('uf'))
					<div class="col-sm-4">
						<input type="text" class="form-control mb-30" name="uf" id="uf" placeholder="" required {!! $fieldPageConfig->attr('uf') !!}/>
					</div>
					@endif

					<label class="col-sm-2 control-label">CEP*</label>
					@if ($fieldPageConfig->show('cep'))
					<div class="col-sm-4">
						<input type="text" class="form-control mb-30" name="cep" id="cep" placeholder="" required {!! $fieldPageConfig->attr('cep') !!}/>
					</div>
					@endif

				</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Telefone*</label>
						@if ($fieldPageConfig->show('phone1'))
						<div class="col-sm-4">
							<input type="text" class="form-control mb-30" name="phone1" id="phone1" placeholder="" required {!! $fieldPageConfig->attr('phone1') !!}/>
						</div>
						@endif

						<label class="col-sm-2 control-label">Celular*</label>
						@if ($fieldPageConfig->show('cell_phone1'))
						<div class="col-sm-4">
							<input type="text" class="form-control mb-30" name="cell_phone1" id="cell_phone1" placeholder="" required {!! $fieldPageConfig->attr('cell_phone1') !!}/>
						</div>
						@endif

					</div>

					<div class="form-group">

						<label class="col-sm-2 control-label">E-mail*</label>
						@if ($fieldPageConfig->show('email1'))
						<div class="col-sm-10">
							<input type="text" class="form-control mb-30" name="email1" id="email1" placeholder="" required {!! $fieldPageConfig->attr('email1') !!}/>
						</div>
						@endif

					</div>

					<div class="form-group">

						<label class="col-sm-4 control-label">Por que gostaria de trabalhar conosco?*</label>
						@if ($fieldPageConfig->show('text_pt'))
						<div class="ibox-content no-padding">
							<textarea id="text_pt" name="text_pt" class="summernote" {!! $fieldPageConfig->attr('text_pt') !!} ></textarea>
						</div>
						@endif

					</div>

					<div class="form-group">

						<label class="col-sm-4 control-label">Why would you like to work with us?*</label>
						@if ($fieldPageConfig->show('text_en'))
						<div class="ibox-content no-padding">
							<textarea id="text_en" name="text_en" class="summernote" {!! $fieldPageConfig->attr('text_pt') !!} ></textarea>
						</div>
						@endif

					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Anexe o currículo:*</label>
						<div class="col-sm-10">
							<div class="fileinput fileinput-new input-group" data-provides="fileinput">
								<div class="form-control" data-trigger="fileinput">
									<i class="glyphicon glyphicon-file fileinput-exists"></i>
									<span class="fileinput-filename"></span>
								</div>
								<span class="input-group-addon btn btn-default btn-file">
									<span class="fileinput-new">Selecionar</span>
									<span class="fileinput-exists">Alterar</span>
										<input type="file" accept=".doc,.docx,.pdf"  id="fileCurriculum" name="fileCurriculum">
									</span>
								<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Anexe o vídeo:*</label>
						<div class="col-sm-10">
							<div class="fileinput fileinput-new input-group" data-provides="fileinput">
									<div class="form-control" data-trigger="fileinput">
										<i class="glyphicon glyphicon-file fileinput-exists"></i>
										<span class="fileinput-filename"></span>
									</div>
									<span class="input-group-addon btn btn-default btn-file">
										<span class="fileinput-new">Selecionar</span>
										<span class="fileinput-exists">Alterar</span>
											<input type="file" accept=".avi,.mov,.wmv,.mp4,.mpeg,.3gp,.mvk" id="fileVideo" name="fileVideo">
										</span>
									<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
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
@endsection

@section('scripts')
@parent
	<!-- Custom and plugin javascript -->
	<script src="{!! asset('js/plugins/pace/pace.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/metisMenu/jquery.metisMenu.js') !!}" type="text/javascript"></script>

	<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/jasny/jasny-bootstrap.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/select2/select2.full.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') !!}" type="text/javascript"></script>

	<script src="{!! asset('js/plugins/dropzone/dropzone.js') !!}" type="text/javascript"></script>

	<script>
		Dropzone.options.dropzoneForm = {
			paramName: "file", // The name that will be used to transfer the file
			maxFilesize: 2, // MB
			dictDefaultMessage: "<strong>Drop files here or click to upload. </strong></br> (This is just a demo dropzone. Selected files are not actually uploaded.)"
		};

		$(document).ready(function(){

			$('.summernote').summernote();

			$('.tagsinput').tagsinput({
				tagClass: 'label label-primary'
			});

			$(".select2_demo_1").select2();
			$(".select2_demo_2").select2();
			$(".select2_demo_3").select2({
				placeholder: "Select a state",
				allowClear: true
			});

		});
  </script>

<script>
document.addEventListener('DOMContentLoaded', function() {
	try {
		APP.scope.work = <?=isset($data) ? json_encode($data) : 'null'?>;

		if (APP.scope.work) {
			populate(document.forms.formWork, APP.scope.work);
		}
	} catch (error) {
		console.warn(error);
	}
});
</script>
@endsection
