<form name="formGalery" method="post" action="{{ url($urlAction) }}" enctype="multipart/form-data" class="form-horizontal">
  <div class="wrapper wrapper-content">
    <div class="form-group">
      <label class="col-sm-2 control-label">Secione a página *</label>
      <div class="col-sm-4">
        <select id="content_page_id" name="content_page_id" class="form-control m-b" value="" required>
          <option value="Selecione a página"></option>
          @foreach($listSelectBox->contentPage as $item)
          <option value="{{ $item->id }}">{{ $item->description_pt }}</option>
          @endforeach
        </select>
        <script>
          document.getElementById('content_page_id').value = '';
        </script>
      </div>
      <label class="col-sm-2 control-label">Secione a seção *</label>
      <div class="col-sm-4">
        <select id="content_section_id" name="content_section_id" class="form-control m-b"  value="" required>
          <option value="">Selecione a seção</option>
          @foreach($listSelectBox->contentSection as $item)
          <option value="{{ $item->id }}">{{ $item->description_pt }}</option>
          @endforeach
        </select>
        <script>
          document.getElementById('content_section_id').value = '';
        </script>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Pré título PT-BR *</label>
      <div class="col-sm-10">
        <input type="text" id="pretitle_pt" name="pretitle_pt" class="form-control" value="">
        <span class="help-block m-b-none">Digite o Sub título em Português.</span>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Título PT-BR *</label>
      <div class="col-sm-10">
        <input type="text" id="title_pt" name="title_pt" class="form-control" value="" required>
        <span class="help-block m-b-none">Digite o título em Português.</span>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Sub título PT-BR *</label>
      <div class="col-sm-10">
        <input type="text" id="subtitle_pt" name="subtitle_pt" class="form-control" value="">
        <span class="help-block m-b-none">Digite o Sub título em Português.</span>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Link</label>
      <div class="col-sm-4">
        <input type="text" id="link" name="link" class="form-control" value="">
      </div>
      <label class="col-sm-2 control-label">Label do Link</label>
      <div class="col-sm-4">
        <input type="text" id="link_label" name="link_label" class="form-control" value="">
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <h5>Digite a descrição</h5>
          </div>
          <div class="ibox-content no-padding">
            <textarea id="description_pt" name="description_pt" class="summernote"></textarea>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Imagem*</label>
      <div class="col-sm-10">
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
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12 text-right">
      <button class="btn btn-white" type="reset">Cancelar</button>
      <button class="btn btn-primary" type="submit">Salvar alterações</button>
    </div>
  </div>
  <input type="hidden" id="id" name="id">
  {{ csrf_field() }}
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
      APP.payload = {!! isset($payload) ? json_encode($payload) : 'null' !!}

      if (APP.payload && APP.payload.data) {
        populate(document.forms.formGalery, APP.payload.data);
      }

      var contentSectionElem = $('#content_section_id');
      $('#content_page_id').on('change', function(event) {
        contentSectionElem.html('');

        if (event.target.value) {
          $.ajax({
            url: "/api/contentsection/contentpage/" + event.target.value,
            dataType: 'json',
            method: 'get',
          }).then(function(data) {
            contentSectionElem.append($('<option>', {
              value: '',
              text: ''
            }));

            for (i = 0, ii = data.length; i < ii; i++) {
              var item = data[i];
              contentSectionElem.append($('<option>', {
                value: item.id,
                text: item.description_pt
              }));
            }
          });

        }

      });
    } catch (error) {
      console.warn(error);
    }
  });
</script>
@endsection
