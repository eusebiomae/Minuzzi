<form name="formGalery" method="post" action="{{ url($urlAction) }}" enctype="multipart/form-data" class="row" style = "padding: 10px;">
  {{ csrf_field() }}
  <input type="hidden" id="id" name="id" />
  <input type="hidden" name="content_page_id" value = "12" />
  <input type="hidden" name="content_section_id" value = "2" />

  <div class="form-group col-lg-12">
    <label for = "title_pt">Digite o Título*</label>
    <input type="text" name="title_pt" id = "title_pt" maxlength="450" class="form-control" required />
  </div>

  <div class="form-group col-lg-12">
    <label for = "description_pt">Digite a Descrição</label>
    <textarea id="description_pt" name="description_pt" class="summernote"></textarea>
  </div>

  <div class="form-group col-lg-12">
    <label for = "fileImage">Imagem de Capa*</label>
    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
      <div class="form-control" data-trigger="fileinput">
        <i class="glyphicon glyphicon-file fileinput-exists"></i>
        <span class="fileinput-filename"></span>
      </div>
      <span class="input-group-addon btn btn-default btn-file">
        <span class="fileinput-new">Selecionar</span>
        <span class="fileinput-exists">Alterar</span>
        <input type="file" id="fileImage" name="fileImage" value="">
      </span>
      <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
    </div>
  </div>

  <div class="form-group col-lg-12"><figure id = "actualImage" style = "text-align: center;"></figure></div>

  <div class="form-group col-lg-12 text-right">
    <button class="btn btn-white" type="reset">Cancelar</button>
    <button class="btn btn-primary" type="submit">Próximo</button>
  </div>
</form>

@section('css')
@parent
  <link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
  <link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
  <link rel="stylesheet" href="{!! asset('css/plugins/jasny/jasny-bootstrap.min.css') !!}" />
  <link rel="stylesheet" href="{!! asset('css/plugins/dropzone/basic.css') !!}" />
  <link rel="stylesheet" href="{!! asset('css/plugins/dropzone/dropzone.css') !!}" />
@endsection


@section('scripts')
@parent
<script src="{!! asset('js/plugins/jasny/jasny-bootstrap.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/dropzone/dropzone.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}" type="text/javascript"></script>
<script>
  Dropzone.options.dropzoneForm = {
		paramName: "file", // The name that will be used to transfer the file
		maxFilesize: 2, // MB
		dictDefaultMessage: "<strong>Drop files here or click to upload. </strong></br> (This is just a demo dropzone. Selected files are not actually uploaded.)"
	};

  document.addEventListener('DOMContentLoaded', function() {
    $(document).ready(function() {
      $('.summernote').summernote();
    });

    try {
      APP.scope.galery = @json($data ?? '');

      if (APP.scope.galery) {
        populate(document.forms.formGalery, APP.scope.galery);

        if(APP.scope.galery.image){
          $('#actualImage').html(`<img src = "${APP.scope.galery.image}" width = "18%" alt = "Imagem Atual" />
                                  <figcaption>Imagem Atual</figcaption>`);
        }
      }
    } catch (error) {
      console.warn(error);
    }
  });
</script>
@endsection
