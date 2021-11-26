
@section('css')
<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/chosen/bootstrap-chosen.css') !!}" />
@endsection

<div class="form-group">
	<div class="col-sm-2">
		<label class="control-label">Tipo*</label>
		<select onchange="typeBlog(this.value)" class="form-control m-b">
			<option value="blog">Blog</option>
			<option value="article">Artigo</option>
		</select>
	</div>

	<div class="col-sm-3">
		<label class="control-label">Categoria*</label>
		<select onchange="typeBlog(this.value)" name="blog_category_id" class="form-control m-b">
		</select>
	</div>

	<div class="col-sm-2">
		<label class="control-label">Autor*</label>
		<input id="author" name="author" class="form-control m-b" required />
	</div>

	<div class="col-sm-3">
		<label class="control-label">Data de agendamento*</label>
		<div class="input-group date">
			<input type="text" name="scheduling_date" class="form-control" required readonly>
			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		</div>
	</div>

	<div class="col-sm-2">
		<label class="control-label">Status*</label>
			<select id="status" name="status" class="form-control"></select>
	</div>
</div>
{{-- <div class="form-group" id="data_1">
	<label class="col-sm-2 control-label">Data*</label>
	<div class="col-sm-4">
		<div class="input-group date">
				<input type="text" id="date_post" name="date_post" class="form-control" value="" readonly required>
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		</div>
	</div>
</div> --}}
<div class="form-group">
	<div class="col-sm-6">
		<label class="control-label">Título PT-BR*</label>
		<input id="title_pt" name="title_pt" type="text" class="form-control" required>
		<span class="help-block m-b-none">Digite o Título em Português.</span>
	</div>

	<div class="col-sm-6">
		<label class="control-label">Subtítulo*</label>
		<input id="subtitle_pt" name="subtitle_pt" type="text" class="form-control" required>
		<span class="help-block m-b-none">Digite o Subtítulo.</span>
	</div>

	<div class="col-sm-6">
		<label class="control-label">Título EN*</label>
		<input id="subtitle_en" name="subtitle_en" type="text" class="form-control" required>
		<span class="help-block m-b-none">Digite o Título em Português.</span>
	</div>

	<div class="col-sm-6">
	<label class="control-label">Subtítulo EN*</label>
		<input id="subtitle_en" name="subtitle_en" type="text" class="form-control" required>
		<span class="help-block m-b-none">Digite o Subtítulo em Inglês.</span>
	</div>

	<div class="col-sm-6">
		<label class="control-label">Título ES*</label>
		<input id="subtitle_es" name="subtitle_es" type="text" class="form-control" required>
		<span class="help-block m-b-none">Digite o Título em Espanhol.</span>
	</div>

	<div class="col-sm-6">
	<label class="control-label">Subtítulo ES*</label>
		<input id="subtitle_es" name="subtitle_es" type="text" class="form-control" required>
		<span class="help-block m-b-none">Digite o Subtítulo em Espanhol.</span>
	</div>
</div>

<div class="form-group">
	<div class="wrapper wrapper-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Digite o conteúdo em Português*</h5>
					</div>
					<div class="ibox-content no-padding">
						<textarea id="text_pt" name="text_pt" class="summernote" required></textarea>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Tags</h5>
					</div>
					<div class="ibox-content no-padding">
						{{-- <input type="text" name="tags" class="form-control" /> --}}
						<select name="tags[]" data-placeholder="Selecione o módulo" class="chosen-select" multiple style="width:350px;" tabindex="4"></select>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Digite o conteúdo em Inglês</h5>
					</div>
					<div class="ibox-content no-padding">
						<textarea id="text_en" name="text_en" class="summernote"></textarea>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Digite o conteúdo em Espanhol</h5>
					</div>
					<div class="ibox-content no-padding">
						<textarea id="text_es" name="text_es" class="summernote"></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
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
				<input type="file" id="fileImage" name="fileImage">
			</span>
			<a href="#" class="input-group-addon btn btn-default fileinput-exists"
				data-dismiss="fileinput">Remover</a>
		</div>
	</div>
</div>
<div class="row center">
	@if(isset($data) && isset($data['image']))
		<img height="200" src="{{ Storage::url("blog/{$data['image']}") }}" />
	@endif
</div>

@section('scripts')
@parent


<script src="{!! asset('js/plugins/jasny/jasny-bootstrap.min.js') !!}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<script src="{!! asset('js/plugins/chosen/chosen.jquery.js') !!}" type="text/javascript"></script>

<script src="{!! asset('js/plugins/datapicker/bootstrap-datepicker.js') !!}"></script>


<script>

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

				if (APP.scope.listSelectBox.blogCategory) {
					populateSelectBox({
						list: APP.scope.listSelectBox.blogCategory,
						target: document.forms.formBlog.blog_category_id,
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

	// $(document).ready(function() {

	// 	var inputTags = $('form[name="form"] input[name="tags"]');

	// 	var tagsData = new Bloodhound({
	// 		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('description'),
	// 		queryTokenizer: Bloodhound.tokenizers.whitespace,
	// 		prefetch: '/admin/configuration/blog/tags/json'
	// 	});

	// 	tagsData.initialize();

	// 	inputTags.tagsinput({
	// 		itemValue: 'id',
	// 		itemText: 'description',
	// 		typeaheadjs: {
	// 			name: 'tags',
	// 			displayKey: 'description',
	// 			source: tagsData.ttAdapter()
	// 		}
	// 	});

	// 	if (APP.blogsTags) {
	// 		for (var i = APP.blogsTags.length - 1; i > -1; i--) {
	// 			var blogTag = APP.blogsTags[i];

	// 			blogTag.tags.blogsTagsId = blogTag.id;

	// 			inputTags.tagsinput('add', blogTag.tags);
	// 		}
	// 	}

	// 	inputTags.on('beforeItemRemove', function(event) {
	// 		if (event.item.blogsTagsId) {
	// 			$.get('/admin/blog/removeTags/' + event.item.blogsTagsId);
	// 		}
	// 	});



	// });
	$(document).ready(function() {
		try {
			if (APP.listSelectBox) {
				if (APP.listSelectBox.blogCategory) {
					populateSelectBox({
						list: APP.listSelectBox.blogCategory,
						target: document.forms.form.blog_category_id,
						columnValue: "id",
						columnLabel: "description_pt",
						selectBy: (APP.payload && APP.payload.data && APP.payload.data.blog_category_id) ? [APP.payload.data.blog_category_id] : null,
					});
				}

				if (APP.listSelectBox.author) {
					populateSelectBox({
						list: APP.listSelectBox.author,
						target: document.forms.form.author_post,
						columnValue: "id",
						columnLabel: "name",
						selectBy: (APP.payload && APP.payload.data && APP.payload.data.author_post) ? [APP.payload.data.author_post] : null,
					});
				}

				if (APP.listSelectBox.status) {
					populateSelectBox({
						list: APP.listSelectBox.status,
						target: document.forms.form.status,
						columnValue: "flg",
						columnLabel: "label",
						selectBy: (APP.payload && APP.payload.data && APP.payload.data.status) ? [APP.payload.data.status] : null,
					});
				}

				if (APP.listSelectBox.blogTag) {
					populateSelectBox({
						list: APP.listSelectBox.blogTag,
						target: document.forms.form['tags[]'],
						columnValue: "id",
						columnLabel: "description",
						selectBy: (APP.payload && APP.payload.data && APP.payload.data.blog_tag) ? APP.payload.data.blog_tag.map(function(item) { return item.id }) : null,

					});
				}

			}

			setDatePicker('.input-group.date');
			$('.chosen-select').chosen({width: "100%"});
		} catch(error) {
			console.warn(error);
		}
})
</script>
@endsection
