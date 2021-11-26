@extends('layouts.app')

@section('title', 'Alimentação')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>Inserir Categorias Blog / Notícias</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{ url('/admin') }}">Home</a>
      </li>
      <li>
        <a href="#">Configurações</a>
      </li>
      <li>
        <a href="{{ url('/admin/configuration/blog/category') }}">Categoria</a>
      </li>
      <li class="active">
        <strong>Inserir Categorias</strong>
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
	      <h5>Categorias <small>Cadastro e edição de categorias.</small></h5>
	    </div>
	    <div class="ibox-content">
				<form name="formBlogCategory" method="post" action="{{ url($urlAction) }}" class="form-horizontal">
					<input type="hidden" id="id" name="id">
	      	<div class="form-group">

						@if ($fieldPageConfig->show('flg_type'))
							<div class="col-sm-3">
								<label class="control-label">Tipo*</label>
								<select name="flg_type" class="form-control m-b" {!! $fieldPageConfig->attr('flg_type') !!}>
									<option value="blog">Blog</option>
									<option value="article">Artigo</option>
								</select>
							</div>
						@endif

						@if ($fieldPageConfig->show('correspondingCourseCategory'))
							<div class="col-sm-3">
								<label class="control-label">Categoria de Curso (Correspondente)</label>
								<select name="correspondingCourseCategory[]" class="form-control m-b" {!! $fieldPageConfig->attr('correspondingCourseCategory') !!}></select>
							</div>
						@endif

						@if ($fieldPageConfig->show('description_pt'))
							<div class="col-sm-6">
								<label class="control-label">Categoria</label>
								<input type="text" id="description_pt" name="description_pt" class="form-control" {!! $fieldPageConfig->attr('description_pt') !!}>
								<span class="help-block m-b-none">Digite a Categoria.</span>
							</div>
						@endif

	      	{{--
					@if ($fieldPageConfig->show('description_en'))
						<div class="form-group">
							<label class="col-sm-2 control-label">Categoria EN</label>
							<div class="col-sm-10">
								<input type="text" id="description_en" name="description_en" class="form-control" {!! $fieldPageConfig->attr('description_en') !!}>
								<span class="help-block m-b-none">Digite a Categoria em Inglês.</span>
							</div>
						</div>
					@endif
					@if ($fieldPageConfig->show('description_es'))
						<div class="form-group">
							<label class="col-sm-2 control-label">Categoria ES</label>
							<div class="col-sm-10">
								<input type="text" id="description_es" name="description_es" class="form-control" {!! $fieldPageConfig->attr('description_es') !!}>
								<span class="help-block m-b-none">Digite a Categoria em Espanhol.</span>
							</div>
						</div>
					@endif
					--}}

					</div>

	      	<div class="form-group">
            <div class="col-sm-12 text-right">
              <button class="btn btn-white" type="submit">Cancelar</button>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
	try {
		APP.scope.blogCategory = <?=isset($data) ? json_encode($data) : 'null'?>;
		APP.scope.listSelectBox = {!! isset($listSelectBox) ? json_encode($listSelectBox) : 'null' !!};
		APP.scope.correspondingCourseCategory = {!! isset($correspondingCourseCategory) ? json_encode($correspondingCourseCategory) : 'null' !!};

		if (APP.scope.listSelectBox) {
			if (APP.scope.listSelectBox.courseCategory) {
				populateSelectBox({
					list: APP.scope.listSelectBox.courseCategory,
					target: document.forms.formBlogCategory.querySelector('[name="correspondingCourseCategory[]"]'),
					selectBy: APP.scope.correspondingCourseCategory ? APP.scope.correspondingCourseCategory.map(function(item) { return item.course_category_id }) : null,
					columnValue: "id",
					columnLabel: "description_pt",
					emptyOption: {
						label: "Selecione..."
					},
				});
			}
		}

		if (APP.scope.blogCategory) {
			populate(document.forms.formBlogCategory, APP.scope.blogCategory);
		}
	} catch (error) {
		console.warn(error);
	}
});
</script>
@endsection
