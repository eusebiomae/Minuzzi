@extends('layouts.app')

@section('title', 'Prova do Candidato')

@section('content')

@include('layouts.header')

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Prova do Candidato {{ $scholarshipStudent->student->name }}</h5>
			</div>

			<div class="ibox-content">
				<div id = "divTest"></div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
@parent

	<script src = "{!! asset('js/viewAvaliation.js') !!}"></script>
	<script>
		var scholarshipStudent = @json($scholarshipStudent);

		$(document).ready(function(){
			if(scholarshipStudent.scholarship.avaliation){
				AjaxViewAvaliation('/student_area/avaliation/student/0/' + scholarshipStudent.scholarship.avaliation_id + '/' + scholarshipStudent.student_id, '#divTest');
			}else{
				$('#divTest').html(`<div class="alert alert-danger" role="alert">
															Ainda não foi cadastrada nenhuma prova para esta bolsa!!!
														</div>`);
			}
		});
	</script>

@endsection
