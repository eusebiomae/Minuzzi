
@section('css')
@parent
	<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
@endsection

<div class="table-responsived">
	<table id="dataTables{{ isset($id) ? $id : '' }}" class="table table-striped table-bordered table-hover" style="width: 100%"></table>
</div>

@section('scripts')
@parent
<script src="{!! asset('js/plugins/dataTables/datatables.min.js') !!}" type="text/javascript"></script>
<script>
  $(document).ready(function() {
		var appDataTable = {!! isset($dataTable) ? json_encode($dataTable) : 'null' !!}

		if (appDataTable && appDataTable.data) {

			if (!window.AppDataTable) {
				window.AppDataTable = []
			}

			window.AppDataTable.push(appDataTable)

			$('#dataTables{{ isset($id) ? $id : '' }}').DataTable({
				responsive: true,
				pageLength: 100,
				data: appDataTable.data,
				columns: appDataTable.header.map(function(column) {
					if (column.renderDoT) {
						column.render = function ( data, type, row, meta ) {
							return doT.template(column.renderDoT)({ data: data, type: type, row: row, meta: meta });
						}
					} else
					if (column.btnUpd) {
						column.render = function ( data, type, row, meta ) {
							if (!row.deleted_at) {
								return '<a href="'+ column.btnUpd +'/update/'+ row.id + '"><i class="fas fa-pencil-alt" title="Editar"></i></a>'
							}

							return ''
						}
					} else
					if (column.btnDel) {
						column.render = function ( data, type, row, meta ) {
							if (row.deleted_at) {
								return '<a href="'+ column.btnDel +'/enable/'+ row.id + '"><i class="fas fa-check-circle" title="Habilitar"></i></a>'
							} else {
								return '<a href="'+ column.btnDel +'/delete/'+ row.id + '"><i class="fas fa-trash-alt" title="Desabilitar"></i></a>'
							}
						}
					}

					return column
				}) || [],
			})
		}
  })
</script>
@endsection
