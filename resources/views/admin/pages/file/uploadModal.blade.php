<div class="modal inmodal" id="uloadFile" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<i class="fa fas fa-upload modal-icon"></i>
				<h4 class="modal-title">Upload Arquivo</h4>
				<small class="font-bold">Upload de Arquivos disponíveis para o curso</small>
			</div>
			<form name="formFile" method="post" action="{{ url('/admin/prospection/file/save') }}" class="form-horizontal" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="modal-body">
					<div style="row">
						@include('admin.prospection.file.formUpload')
					</div>
					<div class="clear-both"></div>
				</div>
				<div class="modal-footer" style="margin-top: 0">
					<button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>
