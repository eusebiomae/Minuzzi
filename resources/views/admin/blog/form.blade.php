@extends('layouts.app')

@section('title', 'Post Blog')

@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/basic.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/dropzone/dropzone.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/bootstrap-tagsinput.css') !!}" />
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Inserir Post - Blog</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('/admin') }}">Home</a>
			</li>
			<li>
				<a href="{{ url('/admin/blog') }}">Blog</a>
			</li>
			<li class="active">
				<strong>Formulário Post Blog</strong>
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
				<h5>Post <small>Cadastro e edição do post do blog.</small></h5>
			</div>
			<div class="ibox-content">
				<form name="formBlog" method="post" action="{{ $urlAction }}" enctype="multipart/form-data" class="form-horizontal">
					<div class="form-group">
						<input type="hidden" id="id" name="id">
						@if ($fieldPageConfig->show('description'))
							<div class="col-sm-2">
								<label class="control-label">Tipo*</label>
								<select onchange="typeBlog(this.value)" class="form-control m-b" {!! $fieldPageConfig->attr('title') !!}>
									<option value="blog">Blog</option>
									<option value="article">Artigo</option>
								</select>
							</div>
						@endif

						@if ($fieldPageConfig->show('blog_category'))
							<div class="col-sm-3">
								<label class="control-label">Categoria*</label>
								<select onchange="typeBlog(this.value)" class="form-control m-b" {!! $fieldPageConfig->attr('title') !!}>

								<select id="blog_category_id" name="blog_category_id" class="form-control m-b" {!! $fieldPageConfig->attr('blog_category_id') !!}>
									<option value="blog">Notícias</option>
									<option value="article">Artigo</option>
									<option value="article">Dica do mês</option>
								</select>
							</div>
						@endif

						{{-- @if ($fieldPageConfig->show('author_post'))
							<div class="col-sm-2">
								<label class="control-label">Autor*</label>
								<select id="author_post" name="author_post" class="form-control m-b" {!! $fieldPageConfig->attr('author_post') !!}>
									@foreach($listSelectBox->author as $item)
									<option value="{{ $item->id }}">{{ $item->name }}</option>
									@endforeach
								</select>
							</div>
						@endif --}}

						@if ($fieldPageConfig->show('scheduling_date'))
							<div class="col-sm-3">
								<label class="control-label">Data de agendamento*</label>
								<div class="input-group date">
									<input type="text" name="scheduling_date" class="form-control" readonly {!! $fieldPageConfig->attr('scheduling_date') !!}>
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div>
							</div>
						@endif

						@if ($fieldPageConfig->show('status'))
							<div class="col-sm-2">
								<label class="control-label">Status*</label>
								<div class="input-group">
									<select type="text" name="status" class="form-control" {!! $fieldPageConfig->attr('status') !!}></select>
								</div>
							</div>
						@endif

					</div>
					{{-- @if ($fieldPageConfig->show('date_post'))
						<div class="form-group" id="data_1">
							<label class="col-sm-2 control-label">Data*</label>
							<div class="col-sm-4">
								<div class="input-group date">
										<input type="text" id="date_post" name="date_post" class="form-control" value="08/12/2017" readonly {!! $fieldPageConfig->attr('date_post') !!}>
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div>
							</div>
						</div>
					@endif --}}

					<div class="form-group">
						@if ($fieldPageConfig->show('title_pt'))
							<div class="col-sm-6">
								<label class="control-label">Título PT-BR*</label>
								<input id="title_pt" name="title_pt" type="text" class="form-control" {!! $fieldPageConfig->attr('title_pt') !!}>
								<span class="help-block m-b-none">Digite o Título em Português.</span>
							</div>
						@endif

						@if ($fieldPageConfig->show('subtitle_pt'))
							<div class="col-sm-6">
								<label class="control-label">Subtítulo*</label>
								<input id="subtitle_pt" name="subtitle_pt" type="text" class="form-control" {!! $fieldPageConfig->attr('subtitle_pt') !!}>
								<span class="help-block m-b-none">Digite o Subtítulo.</span>
							</div>
						@endif
					</div>
					{{--
					@if ($fieldPageConfig->show('subtitle_en'))
						<div class="form-group">
							<label class="col-sm-2 control-label">Subtítulo EN*</label>
							<div class="col-sm-10">
								<input id="subtitle_en" name="subtitle_en" type="text" class="form-control" {!! $fieldPageConfig->attr('subtitle_en') !!}>
								<span class="help-block m-b-none">Digite o Subtítulo em Inglês.</span>
							</div>
						</div>
					@endif

					@if ($fieldPageConfig->show('subtitle_es'))

						<div class="form-group">
							<label class="col-sm-2 control-label">Subtítulo ES</label>
							<div class="col-sm-10">
								<input id="subtitle_es" name="subtitle_es" type="text" class="form-control" {!! $fieldPageConfig->attr('subtitle_es') !!}>
								<span class="help-block m-b-none">Digite o Subtítulo em Espanhol.</span>
							</div>
						</div>
					@endif
					--}}

					<div class="form-group">
						<div class="wrapper wrapper-content">
							@if ($fieldPageConfig->show('text_pt'))
								<div class="row">
									<div class="col-lg-12">
										<div class="ibox float-e-margins">
											<div class="ibox-title">
												<h5>Digite o conteúdo*</h5>
											</div>
											<div class="ibox-content no-padding">
												<textarea id="text_pt" name="text_pt" class="summernote" {!! $fieldPageConfig->attr('text_pt') !!}></textarea>
											</div>
										</div>
									</div>
								</div>
							@endif

							@if ($fieldPageConfig->show('tags'))
								<div class="row">
									<div class="col-lg-12">
										<div class="ibox float-e-margins">
											<div class="ibox-title">
												<h5>Tags</h5>
											</div>
											<div class="ibox-content no-padding">
												<input type="text" name="tags" class="form-control" {!! $fieldPageConfig->attr('tags') !!}/>
											</div>
										</div>
									</div>
								</div>
							@endif

							{{--
							@if ($fieldPageConfig->show('description'))
								<div class="row">
									<div class="col-lg-12">
										<div class="ibox float-e-margins">
											<div class="ibox-title">
												<h5>Digite o conteúdo em Espanhol</h5>
											</div>
											<div class="ibox-content no-padding">
												<textarea id="text_es" name="text_es" class="summernote" {!! $fieldPageConfig->attr('title') !!}></textarea>
											</div>
										</div>
									</div>
								</div>
							@endif
							--}}
						</div>
					</div>
					@if ($fieldPageConfig->show('image'))
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
										<input type="file" id="fileImage" name="fileImage">
									</span>
									<a href="#" class="input-group-addon btn btn-default fileinput-exists"
										data-dismiss="fileinput">Remover</a>
								</div>
							</div>
						</div>
					@endif

					<div class="row center">
						@if(isset($data) && isset($data['image']))
							<img height="200" src="{{ Storage::url("blog/{$data['image']}") }}" />
						@endif
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
<!-- Mainly scripts -->
<script src="{!! asset('js/plugins/metisMenu/jquery.metisMenu.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}" type="text/javascript"></script>

<!-- Custom and plugin javascript -->
<script src="{!! asset('js/inspinia.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/pace/pace.min.js') !!}" type="text/javascript"></script>

<!-- SUMMERNOTE -->
<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/jasny/jasny-bootstrap.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/dropzone/dropzone.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/typehead/bootstrap3-typeahead.min.js') !!}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<script src="{!! asset('js/bootstrap-tagsinput.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>

<script>
	// Dropzone.options.dropzoneForm = {
	// 	paramName: "file", // The name that will be used to transfer the file
	// 	maxFilesize: 2, // MB
	// 	dictDefaultMessage: "<strong>Drop files here or click to upload. </strong></br> (This is just a demo dropzone. Selected files are not actually uploaded.)"
	// };

	function typeBlog(flgType, selectBy) {
		var blogCategory = APP.scope.listSelectBox.blogCategory.filter(function(item) {
			return item.flg_type == flgType
		});

		populateSelectBox({
			list: blogCategory,
			target: document.forms.formBlog.blog_category_id,
			columnValue: "id",
			columnLabel: "description_pt",
			selectBy: [ selectBy ],
			emptyOption: {
				label: "Selecione..."
			}
		});
	}

	document.addEventListener('DOMContentLoaded', function() {
		try {
			APP.scope.blog = <?= isset($data) ? json_encode($data) : 'null'?>;
			APP.scope.blogsTags = <?=isset($blogsTags) ? json_encode($blogsTags) : 'null'?>;
			APP.scope.listSelectBox = <?=isset($listSelectBox) ? json_encode($listSelectBox) : 'null'?>;

			if (APP.scope.listSelectBox) {
				if (APP.scope.listSelectBox.status) {
					populateSelectBox({
						list: APP.scope.listSelectBox.status,
						target: document.forms.formBlog.status,
						columnValue: "flg",
						columnLabel: "label",
						selectBy: [],
					});
				}
			}

			if (APP.scope.blog) {
				populate(document.forms.formBlog, APP.scope.blog);

				typeBlog('blog', APP.scope.blog.blog_category_id);
			} else {
				typeBlog('blog')
			}
		} catch (error) {
			console.warn(error);
		}
	});

	$(document).ready(function() {
		$('.summernote').summernote({
			minHeight: 300
		});

		var inputTags = $('form[name="formBlog"] input[name="tags"]');

		var tagsData = new Bloodhound({
			datumTokenizer: Bloodhound.tokenizers.obj.whitespace('description'),
			queryTokenizer: Bloodhound.tokenizers.whitespace,
			prefetch: '/admin/configuration/blog/tags/json'
		});

		tagsData.initialize();

		inputTags.tagsinput({
			itemValue: 'id',
			itemText: 'description',
			typeaheadjs: {
				name: 'tags',
				displayKey: 'description',
				source: tagsData.ttAdapter()
			}
		});

		if (APP.scope.blogsTags) {
			for (var i = APP.scope.blogsTags.length - 1; i > -1; i--) {
				var blogTag = APP.scope.blogsTags[i];

				blogTag.tags.blogsTagsId = blogTag.id;

				inputTags.tagsinput('add', blogTag.tags);
			}
		}

		inputTags.on('beforeItemRemove', function(event) {
			if (event.item.blogsTagsId) {
				$.get('/admin/blog/removeTags/' + event.item.blogsTagsId);
			}
		});

		setDatePicker('.input-group.date')
	});
</script>
@endsection
