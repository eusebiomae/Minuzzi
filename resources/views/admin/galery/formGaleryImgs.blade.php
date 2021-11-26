<form name="formGaleryImgs" method="post" action="{{ url($urlAction) }}" enctype="multipart/form-data" class="row" style = "padding: 10px;">
	{{ csrf_field() }}
	<input type="hidden" name="galery_id" value = "{{ isset($data) ? $data['id'] : '' }}" />
	<input type="hidden" name="title_pt" value = "{{ isset($data) ? $data['title_pt'] : '' }}" />

	<div class="form-group col-lg-4">
    <label for = "images">Clique no botão ao lado para selecionar as imagens do álbum*</label>
		<input type="file" id="images" name="images[]" value="" multiple="multiple" style = "display: none;" />
  </div>

	<div class="form-group col-lg-2">
    <button type = "button" class = "btn btn-block btn-success" onclick = "$('#images').click()">Escolher</button>
  </div>

	<div class="form-group col-lg-2" style = "display: none;" id = "delAll">
    <button type = "button" class = "btn btn-block btn-danger" onclick = "delImgAjax()">Deletar Todas</button>
  </div>

	<div class="form-group col-lg-12"><div class = "row" id = "imagesSelected"></div></div>

	<div class = "form-group col-lg-12 text-right" style = "display: none; margin-top: 8px;" id = "btnSubmit">
		<input type = "submit" value = "Salvar" class = "btn btn-warning" />
	</div>
</form>

@section('css')
@parent
  <link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
  <link rel="stylesheet" href="{!! asset('css/plugins/dropzone/basic.css') !!}" />
  <link rel="stylesheet" href="{!! asset('css/plugins/dropzone/dropzone.css') !!}" />
@endsection


@section('scripts')
@parent
	<script src="{!! asset('js/plugins/jasny/jasny-bootstrap.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('js/plugins/dropzone/dropzone.js') !!}" type="text/javascript"></script>

	<script>
		var data = @json($imgs ?? '');

		$(document).ready(function(){
			if(data.length > 0){
				var contentDatabase = '';

				for(var c = 0; c < data.length; c++){
					contentDatabase += cardsImages(data[c].file, data[c].id);
				}

				$('#imagesSelected').append(contentDatabase);
				$('#delAll').css('display', '');
			}

			$('#images').change(function(){
				var content = '';

				for(var i = 0; i < this.files.length; i++){
					content += cardsImages(URL.createObjectURL(this.files[i]));
				}

				$('#imagesSelected').append(content);
				$('#btnSubmit').css('display', '');
			});
		});

		function cardsImages(src, id){
			card = `<div class = "col-md-3 col-sm-4 col-xs-6" data-img = "${id}">
								<figure style = "text-align: center;">
									<img src = "${src}" width = "100%" />
									<figcaption style = "margin-top: 5px;">
										<button type = "button" class = "btn btn-sm btn-danger" onclick = "deleteImg(this)">Excluir</button>
									</figcaption>
								</figure>
							</div>`;

			return card;
		}

		function deleteImg(elem){
			var cardImg = $(elem).parents('[data-img]')
			var idx = cardImg.index()

			cardImg.remove();

			if(isNaN(cardImg.data('img'))){
				fileList = Array.from($('#images')[0].files);
				fileList.splice(idx, 1);

				var dt = new DataTransfer();

				fileList.forEach(file => dt.items.add(file));

				$('#images')[0].files = dt.files;
			}else{
				delImgAjax(cardImg.data('img'));
			}
		}

		async function delImgAjax(id){
			var whatIs = '';
			var confirmation = false;

			if(!id){
				id = $('input[name = "galery_id"]').val();
				whatIs = 'galery_id';

				var willDelete = await swal({
					title: "Tem certeza que deseja deletar todas as images?",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				});

				if (willDelete) {
					confirmation = true;
				}

				$('#imagesSelected').html('');
			}else{
				confirmation =  true;
			}

			if(confirmation){
				$.ajax({
					url: '/admin/galery/delete-imgs',
					type: 'post',
					data: {id, whatIs},
					success: function(resp){
						if(resp){
							console.error(resp);
						}
					}
				});
			}
		}
	</script>
@endsection
