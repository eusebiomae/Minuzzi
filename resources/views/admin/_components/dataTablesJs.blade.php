
@section('css')
@parent
	<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
@endsection

<div class="table-responsived">
	<table name="{{ isset($dataTable->id) ? $dataTable->id : 'dataTables'}}" class="table table-striped table-bordered table-hover" style="width: 100%"></table>
</div>

@section('scripts')
@parent
<script src="{!! asset('js/plugins/dataTables/datatables.min.js') !!}" type="text/javascript"></script>
<script>

  $(document).ready(function() {
		var appDataTable = {!! isset($dataTable) ? json_encode($dataTable) : 'null' !!}
		console.log(appDataTable);

		if (appDataTable && appDataTable.data) {
			var opts = {
				responsive: true,
				pageLength: 100,
				data: appDataTable.data,
				columns: appDataTable.header.map(function(column) {

					if (column.renderDoT) {
						column.render = function ( data, type, row, meta ) {
							return doT.template(column.renderDoT)({ data: data, type: type, row: row, meta: meta });
						}
					} else if (column.btnUpd) {
						column.render = function ( data, type, row, meta ) {
							if (!row.deleted_at) {
								return '<a href="'+ column.btnUpd +'/update/'+ row.id + '"><i class="fas fa-pencil-alt" title="Editar"></i></a>'
							}

							return ''
						}
					} else if (column.btnDel) {
						column.render = function ( data, type, row, meta ) {
							if (row.deleted_at) {
								return '<a href="'+ column.btnDel +'/enable/'+ row.id + '"><i class="fas fa-check-circle" title="Habilitar"></i></a>'
							} else {
								return '<a href="'+ column.btnDel +'/delete/'+ row.id + '"><i class="fas fa-trash-alt" title="Desabilitar"></i></a>'
							}
						}
					} else if (column.btnFin) {
						// console.log(123)
						column.render = function ( data, type, row, meta ) {
							if (row.status == 'FI') {
								console.log(456)
								return '<a href="'+ column.btnFin +'/rollback/'+ row.id + '"><i class="fas fa-check-circle" title="Desfazer"></i></a>'
							} else {
								return '<a href="'+ column.btnFin +'/finish/'+ row.id + '"><i class="fas fa-check-circle" title="Finalizar"></i></a>'
							}
						}
					} else
					if(column.btnEnr){ // inscritos nas bolsas de estudo
						column.render = function ( data, type, row, meta ) {
							return '<a href="'+ column.btnEnr +'/enrolled/'+ row.id + '"><i class="fa fa-users" title="Inscritos"></i></a>'
						}
					} else
					if(column.btnRan){ // ranking dos candidatos às bolsas de estudo
						column.render = function ( data, type, row, meta ) {
							return '<a href="'+ column.btnRan +'/ranking/'+ row.id + '"><i class="fa fa-trophy" title="Ranking"></i></a>'
						}
					} else
					if(column.btnTest){ // Prova de Proficiência dos candidatos às bolsas de estudo
						column.render = function ( data, type, row, meta ) {
							return '<a href="'+ column.btnTest +'/test/'+ row.id + '"><i class="fa fa-file-text" title="Ver Prova de Proficiência"></i></a>'
						}
					} else
					if(column.btnProfile){ // Ver perfil dos candidatos às bolsas de estudo
						column.render = function ( data, type, row, meta ) {
							return '<a href="'+ column.btnProfile +'/profile/'+ row.id + '"><i class="fa fa-user" title="Ver Perfil"></i></a>'
						}
					}

					return column
				}) || [],
			}

			if (!APP.appDataTable) {
				APP.appDataTable = []
			}

			APP.appDataTable[appDataTable.id || 'default'] = appDataTable

			$('[name="{{ isset($dataTable->id) ? $dataTable->id : 'dataTables'}}"]').DataTable(Object.assign(opts, appDataTable.opts || {}))
		}
  })
</script>
@endsection
