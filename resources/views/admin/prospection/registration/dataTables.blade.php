<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover dataTables-example" style="font-size: 12px;" >
		<thead>
			<tr>
				<th>ID</th>
				<th>Tipo</th>
				<th>Categoria</th>
				<th>Subcategoria</th>
				<th>Curso</th>
				<th>Turma</th>
				<th>Data</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($dataTable as $data)
			<tr>
				<td>{{ getValueByColumn($data, 'id') }}</td>
				<td>{{ getValueByColumn($data, 'course.courseCategoryType.title') }}</td>
				<td>{{ getValueByColumn($data, 'course.courseCategory.description_pt') }}</td>
				<td>{{ getValueByColumn($data, 'course.courseSubcategory.description_pt') }}</td>
				<td>{{ getValueByColumn($data, 'course.title_pt') }}</td>
				<td>{{ getValueByColumn($data, 'class.name') }}</td>
				<td>{{ getValueByColumn($data, 'created_at') }}</td>
				<td>
					<a href="/admin/prospection/student/update/{{ $data->id }}">
						<i class="fas fa-pencil-alt" title="Editar"></i>
					</a>
				</td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<th>ID</th>
				<th>Tipo</th>
				<th>Categoria</th>
				<th>Subcategoria</th>
				<th>Curso</th>
				<th>Turma</th>
				<th>Data</th>
				<th></th>
			</tr>
		</tfoot>
	</table>
</div>


@section('css')
@parent
<link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
@endsection

@section('scripts')
@parent
<script src="{!! asset('js/plugins/dataTables/datatables.min.js') !!}" type="text/javascript"></script>

@endsection
