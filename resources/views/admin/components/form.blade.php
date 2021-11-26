@extends('layouts.app')

@section('title', $config->title)

@section('css')
@parent
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/summernote/summernote-bs3.css') !!}" />
<link rel="stylesheet" href="{!! asset('css/plugins/iCheck/custom.css') !!}" />

@endsection

@section('content')
@include($config->header)

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="col-lg-12">
	  <div class="ibox float-e-margins">
	    <div class="ibox-title">
	      <h5>{{ $config->title }}</h5>
	    </div>
	    <div class="ibox-content">
        <form name="form" method="post" action="{{ url($config->urlAction) }}" class="form-horizontal" enctype="multipart/form-data">
					{{ csrf_field() }}
					<input type="hidden" name="id">

					@include($config->pathViewInclude)

					<div class="form-group">
            <div class="col-sm-12 text-right">
              <button type="button" class="btn btn-white" onclick="location.href='{{ url($config->urlBase) }}'">Cancelar</button>
              <button class="btn btn-primary" data-gp-alert="save" type="submit">Salvar alterações</button>
            </div>
          </div>
        </form>
	    </div>
	  </div>
	</div>
</div>
@endsection

@section('scripts')
@parent
<script src="{!! asset('js/plugins/summernote/summernote.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/plugins/iCheck/icheck.min.js') !!}" type="text/javascript"></script>
<!-- iCheck -->
<script>
	try {
		$(document).ready(function () {
				$('.i-checks').iCheck({
						checkboxClass: 'icheckbox_square-green',
						radioClass: 'iradio_square-green',
				});
		});
	} catch (error) {
		console.warn(error);
	}
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
	try {
		APP.payload = {!! isset($payload) ? json_encode($payload) : 'null' !!}
		APP.listSelectBox = {!! isset($listSelectBox) ? json_encode($listSelectBox) : 'null' !!}

		if (APP.payload && APP.payload.data) {
			populate(document.forms.form, APP.payload.data)
		}

		document.dispatchEvent(new CustomEvent('APP.payload'))
		if ($('.summernote').length) {
			$('.summernote').summernote({
				minHeight: 200
			})
		}

	} catch (error) {
		console.warn(error);
	}
});
</script>
@endsection
