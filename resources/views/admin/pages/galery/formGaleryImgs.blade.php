@section('css')
@parent
<link rel="stylesheet" href="/lib/jquery-file-upload/css/jquery.fileupload-ui.css">
<link rel="stylesheet" href="/lib/jquery-file-upload/css/jquery.fileupload.css">
<link rel="stylesheet" href="/lib/jquery-file-upload/css/fileupload.css">
<link rel="stylesheet" href="/css/plugins/radio/radio.css">

<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="/lib/jquery-file-upload/css/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="/lib/jquery-file-upload/css/jquery.fileupload-ui-noscript.css"></noscript>
@endsection

<form name="formGaleryImgs" class="fileupload" method="post" action="{{ url($urlAction) }}" enctype="multipart/form-data" class="form-horizontal">
	<div class="fileupload-buttonbar">
		<div class="fileupload-buttons">
			<!-- The fileinput-button span is used to style the file input field as button -->
			<span class="fileinput-button">
				<span>Clique ou arraste uma imagem</span>
				<input type="file" name="fileImage" multiple>
			</span>
			<button type="submit" class="fileinput-button start btn btn-info btn-sm">Salvar imagens</button>
			<button type="reset" class="cancel btn btn-danger btn-sm">Cancelar upload</button>
			<!-- The global file processing state -->
			<span class="fileupload-process"></span>
		</div>
		<!-- The global progress state -->
		<div class="fileupload-progress fade" style="display:none">
			<!-- The global progress bar -->
			<div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
			<!-- The extended global progress state -->
			<div class="progress-extended">&nbsp;</div>
		</div>
	</div>
	<!-- The table listing the files available for upload/download -->
	<table role="presentation"><tbody class="files"></tbody></table>
	<input type="hidden" name="galery_id">
	{{ csrf_field() }}
</form>

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
	<tr class="template-upload">
		<td>
			<table width="100%">
				<colgroup>
					<col width="85px">
					<col>
					<col width="100px">
					<col width="140px">
				</colgroup>
				<tr>
					<td>
						<span class="preview"></span>
					</td>
					<td>
						<p class="name">{%=file.name%}</p>
						<strong class="error"></strong>
					</td>
					<td>
						<p class="size">Processing...</p>
						<div class="progress"></div>
					</td>
					<td>
						&nbsp;
						{% if (!i && !o.options.autoUpload) { %}
						<button class="start btn btn-info btn-sm" disabled>Iniciar</button>
						{% } %}
						{% if (!i) { %}
						<button class="cancel btn btn-danger btn-sm">Cancelar</button>
						{% } %}
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<div class="row">
							<div class="col-md-4">
								<label>Digite o título*</label>
								<input type="text" name="title_pt" maxlength="450" class="form-control" value="{%=file.name%}">
							</div>
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	{% } %}
</script>

@section('scripts')
@parent
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<script src="/lib/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
<script src="/lib/jquery-file-upload/js/jquery.iframe-transport.js"></script>
<script src="/lib/jquery-file-upload/js/jquery.fileupload.js"></script>
<script src="/lib/jquery-file-upload/js/jquery.fileupload-process.js"></script>
<script src="/lib/jquery-file-upload/js/jquery.fileupload-image.js"></script>
<script src="/lib/jquery-file-upload/js/jquery.fileupload-ui.js"></script>
<script src="/lib/jquery-file-upload/js/jquery.fileupload-jquery-ui.js"></script>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		try {
			APP.scope.galeryImgs = <?=isset($imgs) ? json_encode($imgs) : '[]'?>;

			var formGaleryImgs = document.forms.formGaleryImgs;

			if (APP.scope.galeryImgs) {
				// populate(document.forms.formGaleryImgs, APP.scope.galeryImgs);
			}

			setTimeout(function() {
				if (APP.scope.galery && APP.scope.galery.id) {
					document.forms.formGaleryImgs.galery_id.value = APP.scope.galery.id;
				}
			}, 350);

			$(formGaleryImgs).fileupload({
				downloadTemplateId: null,
				url: formGaleryImgs.action
			});

			var downloadTemplate = function (o) {
				var rows = $();
				$.each(o.files, function (index, file) {
					var row = $('<tr class="template-download">\
						<td>\
							<table width="100%">\
								<colgroup>\
									<col width="33%">\
									<col width="33%">\
									<col width="33%">\
								</colgroup>\
								<tr>\
									<td><span class="preview"></span></td>\
									<td>\
										<p class="name"></p>\
										<div class="error"></div>\
									</td>\
									<td class="gp-radio">\
										<label>\
											<input type="radio" name="gender" value="1">\
											<span></span>\
											Destaque\
										</label>\
									</td>\
									<td><button class="delete btn btn-danger btn-sm mr-3">Deletar</button></td>\
								</tr><tr>\
									<td colspan="4">\
										<div class="row">\
											<div class="col-md-4">\
												<span>Título:</span>\
												<strong data-name="title_pt"></strong>\
											</div>\
										</div>\
									</td>\
								</tr>\
							</table>\
						</td>\
					</tr>');

					if (file.error) {
						row.find('.name').text(file.title_pt);
						row.find('.error').text(file.error);
					} else {
						row.find('.name').text(file.title_pt);

						if (file.file) {
							row.find('.preview').append(
							$('<img>').prop('src', file.file)
							);
						}

						if (file.title_pt) {
							row.find('[data-name="title_pt"]').text(file.title_pt);
						}

						if (file.title_en) {
							row.find('[data-name="title_en"]').text(file.title_en);
						}

						if (file.title_es) {
							row.find('[data-name="title_es"]').text(file.title_es);
						}

						row.find('button.delete')
						.attr('data-type', 'DELETE')
						.attr('data-url', '/admin/galery/del-img/' + file.id);
					}

					rows = rows.add(row);
				});

				return rows;
			};

			$('form[name="formGaleryImgs"] table[role="presentation"] tbody.files').prepend(downloadTemplate({files: APP.scope.galeryImgs}));

			$(formGaleryImgs).fileupload('option', {
				disableImageResize: (/Android(?!.*Chrome)|Opera/).test(window.navigator.userAgent),
				maxFileSize: 999000,
				sequentialUploads: true,
				acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
				downloadTemplateId: null,
				downloadTemplate: downloadTemplate
			});

			// $(formGaleryImgs).fileupload('addDown', {
				// 	files: APP.scope.galeryImgs
				// });

				$(formGaleryImgs)
				.bind('fileuploadsubmit', function (e, data) {
					var inputs = data.context.find(':input');

					if (inputs.filter(function () {
						return !this.value && $(this).prop('required');
					}).first().focus().length) {
						data.context.find('button').prop('disabled', false);
						return false;
					}
					data.formData = inputs.serializeArray();

					data.formData.push({
						name: '_token',
						value: document.forms.formGaleryImgs._token.value
					});

					data.formData.push({
						name: 'galery_id',
						value: document.forms.formGaleryImgs.galery_id.value
					});
				})
				.bind('fileuploaddrop', function (e, data) {
					console.log(e, data);

				})
				.bind('fileuploadchange', function (e, data) {
					console.log(e, data);

				});

			} catch (error) {
				console.warn(error);
			}
		});
	</script>
	@endsection
